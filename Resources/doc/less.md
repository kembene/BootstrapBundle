Less Compilation
-------------------

If you wish to use the less feature, it is recommended that you include the phpless compiler.
Its better you download with composer by

    "leafo/lessphp": "dev-master"

in the requires section of your composer.json file.

After wards, to have the less compiler compile your less files, include the lessphp filter in your assetic config

assetic:
    filters:
            lessphp:
                    #location of the lessc php class
                    file: %kernel.root_dir%/../vendor/leafo/lessphp/lessc.inc.php
                    #if you want the filter to be appled automatically to any .less files
                    apply_to: "\.less$"