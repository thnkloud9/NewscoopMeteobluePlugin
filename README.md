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

To schedule the daily update job for header temperature values (stored in the db) the weather:update job must be added to cron.  To run the job manually, run the following command


```
    php application/console weather:update
```

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

#### Template examples

```
    {{ meteoblue_header }}
```

Place the above code to implement the weather stats header into your templates

```
    {{ assign var="ch_city" value=$smarty.get.city }}
    {{ if  empty($ch_city) }}{{ $ch_city = 'Basel' }}{{ /if }}

    {{ if $ch_city == "Basel" }}{{ assign var="citycode" value="basel_ch_376" }}{{ /if }}
    {{ if $ch_city == "Liestal" }}{{ assign var="citycode" value="liestal_ch_2612" }}{{ /if }}
    {{ if $ch_city == "Gempen" }}{{ assign var="citycode" value="gempen_ch_1587" }}{{ /if }}
    {{ if $ch_city == "Passwang" }}{{ assign var="citycode" value="passwang_ch_3469" }}{{ /if }}
    {{ if $ch_city == "Zurich" }}{{ assign var="citycode" value="zurich_ch_5254" }}{{ /if }}
    {{ if $ch_city == "Bern" }}{{ assign var="citycode" value="bern_ch_449" }}{{ /if }}  
    {{ if $ch_city == "Genf" }}{{ assign var="citycode" value="genf_ch_1605" }}{{ /if }}
    {{ if $ch_city == "Lugano" }}{{ assign var="citycode" value="lugano_ch_2680" }}{{ /if }}    

        <div class="content-box clearfix">

            <section>
                {{ meteoblue_details citycode=$citycode height=1900 width=650 }}
            </section>

        </div>
```

The above code can be used to create a details page that takes a city name as a parameter and displays the meteoblue weather details iframe.  See meteoblue.com for more details on available city codes.
