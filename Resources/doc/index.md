Installation
==============================

Installation can be easily done using composer. just add

    "kinwae/bootstrap-bundle":"dev-master"

to the requires section of your main composer.json file

Please note that KinwaeBootstrap requires twitter bootstrap to be installed in order to function.

 By default KinwaeBootstrap assumes that twitter bootstrap will be installed via composer under the symfony2 'vendor' directory
 If for any reason your twitter bootstrap folder is not located in this default directory
 (i.e /vendor/twitter/bootstrap/twitter/bootstrap) you can add the following config parameter to your config file stating the
 directory where twitter bootstrap is installed

 kinwae_bootstrap:
        bootstrap_install_dir: /path/to/twitter/bootstrap/lib

Creating symlink to your twitter bootstrap lib in your public accessible folder
==========================================================================================

Twitter bootstrap js, css and images files are usually called from your template files. If you are using twig
and you wish to eliminate the need to dynamically access your twitter bootstrap files (because assetic lib for some reasons
doesnt work well with accessing resources via bundle i.e @BundleName:ResourceDir:Asset), you can create a symbolic link
(symlink) in your web directory to point to your bootstrap installation. The command

    php app/console kinwae_bootstrap:link

can be used to install a symlink to twitter bootstrap installation in your web folder.

This command is dependant on 4 config variables
    webroot: if your webroot is not web (symfony2 default)
    bootstrap_dir: subfolder under the webroot where the symlink will be installed in (defaults to 'assets')
    bootstrap_name: the name of the symlink (defaults to 'bootstrap')
    bootstrap_install_dir: the directory where bootstrap is installed (defaults to 'vendor/twitter/bootstrap/twitter/bootstrap')

    e.g

    kinwae_bootstrap:
            bootstrap_install_dir: /path/to/twitter/bootstrap/lib
            webroot: web # the web accessible root directory
            bootstrap_dir: assets # subfolder under the webroot where the symlink will be installed in
            bootstrap_name: bootstrap #the name of the symlink

This bundle ease the integration of twitter bootstrap lib with symfony2 (using the twig engine).

