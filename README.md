NewscoopMeteobluePluginBundle
===================

NewscoopMeteobluePluginBundle

## Installation/Updating/Removing
#### Overview

All install/update/removal functions are handled by the Newscoop Plugin Manager.

#### Installation

Once installed schedule the daily update job for header temperature values (stored in the db) the weather:update job on your crontab schedule.  To run the job manually, run the following command


```
    php application/console weather:update
```

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
