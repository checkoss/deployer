<?php
/* (c) Anton Medvedev <anton@medv.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Deployer;

use Symfony\Component\Console\Output\Output;

class JoyTest extends AbstractTest
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        putenv('DEPLOYER_LOCAL_WORKER=false'); // Allow to start workers. Don't forget to disable it later.
    }

    public static function tearDownAfterClass(): void
    {
        putenv('DEPLOYER_LOCAL_WORKER=true');
        parent::tearDownAfterClass();
    }

    public function testWorker()
    {
        $recipe = __DIR__ . '/joy.php';
        $this->init($recipe);

        $this->tester->run([
            'echo',
            '-f' => $recipe,
            '-s' => 'all'
        ], [
            'verbosity' => Output::VERBOSITY_NORMAL,
        ]);
        self::assertEquals(0, $this->tester->getStatusCode(), $this->tester->getDisplay());
    }

    public function testServer()
    {
        $recipe = __DIR__ . '/joy.php';
        $this->init($recipe);

        $this->tester->setInputs(['prod', 'Black bear']);
        $this->tester->run([
            'ask',
            '-f' => $recipe,
        ], [
            'verbosity' => Output::VERBOSITY_NORMAL,
            'interactive' => true,
        ]);
        $display = $this->tester->getDisplay();
        self::assertEquals(0, $this->tester->getStatusCode(), $display);
        self::assertStringContainsString('[prod] Question: What kind of bear is best?', $display);
        self::assertStringContainsString('[prod] Black bear', $display);
    }

    public function testOption()
    {
        $recipe = __DIR__ . '/joy.php';
        $this->init($recipe);

        $this->tester->run(
            [
                'echo',
                '-s' => 'all',
                '-o' => ['greet=Hello'],
                '-f' => $recipe,
                //'-l' => 1,
            ],
            [
                'verbosity' => Output::VERBOSITY_DEBUG,
                'interactive' => false,
            ]
        );

        $display = $this->tester->getDisplay();
        self::assertEquals(0, $this->tester->getStatusCode(), $display);
        self::assertStringContainsString('[prod] Hello, prod!', $display);
        self::assertStringContainsString('[beta] Hello, beta!', $display);
    }

    public function testCachedHostConfig()
    {
        $recipe = __DIR__ . '/joy.php';
        $this->init($recipe);

        $this->tester->run([
            'cache_config_test',
            '-f' => $recipe,
            '-s' => 'all'
        ], [
            'verbosity' => Output::VERBOSITY_NORMAL,
        ]);

        $display = $this->tester->getDisplay();
        self::assertEquals(0, $this->tester->getStatusCode(), $display);
        self::assertStringContainsString(filter_stdout(<<<STDOUT
[prod] running worker on prod
[prod] echo 1: PROD
[beta] running worker on beta
[beta] echo 1: BETA
task after:cache_config_test
[prod] echo 2: PROD
[beta] echo 2: BETA
STDOUT
        ), $display);
    }
}

function filter_stdout($stdout)
{
    $lines = explode("\n", $stdout);
    $lines = array_filter($lines, function ($line) {
        return preg_match("/\r$/", $line);
    });
    return implode("\n", $lines);
}
