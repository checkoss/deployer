<!-- DO NOT EDIT THIS FILE! -->
<!-- Instead edit recipe/joomla.php -->
<!-- Then run bin/docgen -->

# joomla

[Source](/recipe/joomla.php)



* Require
  * [`recipe/common.php`](/docs/recipe/common.md)
* Config
  * [`shared_files`](#shared_files)
  * [`shared_dirs`](#shared_dirs)
  * [`writable_dirs`](#writable_dirs)
* Tasks
  * [`deploy`](#deploy)

## Config
### shared_files
[Source](/recipe/joomla.php#L6)

* Overrides [`shared_files`](/docs/recipe/common.md#shared_files) from `recipe/common.php`



### shared_dirs
[Source](/recipe/joomla.php#L7)

* Overrides [`shared_dirs`](/docs/recipe/common.md#shared_dirs) from `recipe/common.php`



### writable_dirs
[Source](/recipe/joomla.php#L8)

* Overrides [`writable_dirs`](/docs/recipe/common.md#writable_dirs) from `recipe/common.php`




## Tasks
### deploy
[Source](/recipe/joomla.php#L10)



This task is group task which contains next tasks:
* [`deploy:info`](/docs/recipe/deploy/info.md#deployinfo)
* [`deploy:setup`](/docs/recipe/deploy/setup.md#deploysetup)
* [`deploy:lock`](/docs/recipe/deploy/lock.md#deploylock)
* [`deploy:release`](/docs/recipe/deploy/release.md#deployrelease)
* [`deploy:update_code`](/docs/recipe/deploy/update_code.md#deployupdate_code)
* [`deploy:shared`](/docs/recipe/deploy/shared.md#deployshared)
* [`deploy:writable`](/docs/recipe/deploy/writable.md#deploywritable)
* [`deploy:symlink`](/docs/recipe/deploy/symlink.md#deploysymlink)
* [`deploy:unlock`](/docs/recipe/deploy/lock.md#deployunlock)
* [`deploy:cleanup`](/docs/recipe/deploy/cleanup.md#deploycleanup)


