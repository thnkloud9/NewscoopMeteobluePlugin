NewscoopMeteobluePluginBundle
===================

NewscoopMeteobluePluginBundle

## Installation/Updating/Removing
#### Overview

The whole plugin system (installation/management) is based on [Composer][1] packages.
Packages can live on [github.com][github] or your own private git repositories but they must be listed on [packagist.org][packagist] or private own (based on [satis][satis]) composer repositories.

For now we support only this way of plugins management. But we have plans for installation from .zip files.

The whole management process should be done through our Newscoop\Services\Plugin\ManagerService class. It's important because this way we allow for developers to react on installation/remove/update events (and more) in their plugins.

#### Installation

```
    php application/console plugins:install "vendor/plugin-name" "optional version"
    php application/console plugins:install "newscoop/meteoblue-plugin-bundle" --env=prod # installs this plugin
```
Install command will add your package to your composer.json file (and install it) and update plugins/avaiable_plugins.json file (used for plugin booted as Bundle). This command will also fire "plugin.install" event with plugin_name parameter in event data

#### Removing

```
    php application/console plugins:remove "vendor/plugin-name"
    php application/console plugins:remove "newscoop/meteoblue-plugin-bundle" --env=prod # removes this plugin
```
Remove command will remove your package from composer.json file and update your dependencies (for now this is only way), it will also remove info about plugin from plugins/avaiable_plugins.json file and fire "plugin.remove" event with plugin_name parameter in event data.

#### Updating

```
    php application/console plugins:update "vendor/plugin-name" "optional version"
    php application/console plugins:update "newscoop/meteoblue-plugin-bundle" --env=prod # updates this plugin
```

Update command is little specific - it will first remove your your plugin form newscoop (but won't fire plugin.remove event) and after that will install again your plugin (again without plugin.install event). After all of that it will fire plugin.update event.

