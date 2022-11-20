[![Latest Release](https://img.shields.io/github/v/release/Jefferson49/PHP8_mod_ariextmenu?display_name=tag)](https://github.com/Jefferson49/PHP8_mod_ariextmenu/releases/latest)
[![joomla major version](https://img.shields.io/badge/joomla-v4.x-green)](https://downloads.joomla.org/cms/joomla4)
[![PHP major version](https://img.shields.io/badge/php-v8.x-green)](https://www.php.net/)
## Joomla 4.x and PHP8 mod_ariextmenu
Patches to migrate the [joomla](https://www.joomla.org/) module [**ARI Ext Menu**](https://extensions.joomla.org/extension/ari-ext-menu/) to joomla 4.x and PHP 8.

The following aspects of the PHP code were patched:
+ PHP 8
    + Substitution of curly braces for character access in arrays (i.e. "my_array[0]" instead of "my_array{0}")
    + Declaration of static methods as static (i.e. "static function" instead of "function" only)
+ joomla 4.x
    + Adaptions to joomla 4.x CMS and module API

##  Installation
+ joomla 4.x and PHP 8
    + Download the [latest release](https://github.com/Jefferson49/PHP8_mod_ariextmenu/releases/latest) of the module
    + Unzip the file to a local directory and copy the folder "mod_ariextmenu" into the "modules" folder of your joomla installation
+ joomla 3.x and PHP 8
    + Download [release v1.0.0](https://github.com/Jefferson49/PHP8_mod_ariextmenu/releases/tag/v1.0.0) of the module
    + Unzip the file to a local directory and copy the folder "mod_ariextmenu" into the "modules" folder of your joomla installation

Please note that the patch only contains a patched subset of the module files, which were migrated to PHP 8. If you want to install the complete module from scratch, you need to install the [ARI Ext Menu module](https://extensions.joomla.org/extension/ari-ext-menu/) first and apply the patch afterwards.

##  Versions: joomla, PHP, ARI Ext Menu 
The PHP 8 patch was developed and tested with: 
+ [joomla 3.10.11](https://downloads.joomla.org/cms/joomla3); but should also run with other joomla 3.x versions.
+ PHP 8.0.20
+ ARI Ext Menu 2.2.11

The joomla 4.x patch (including PHP 8 patch) was developed and tested with: 
+ [joomla 4.2.5](https://downloads.joomla.org/cms/joomla4); but should also run with other joomla 4.x versions.
+ PHP 8.0.23
+ ARI Ext Menu 2.2.11 (with patch v1.0.0)

##  Github repository  
https://github.com/Jefferson49/PHP8_mod_ariextmenu