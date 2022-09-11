## PHP8_mod_ariextmenu
A Patch to migrate the [joomla](https://www.joomla.org/) module [**ARI Ext Menu**](https://extensions.joomla.org/extension/ari-ext-menu/) to PHP 8.

The following aspects of the PHP code were patched:
+ Substitution of curly braces for character access in arrays (i.e. "my_array[0]" instead of "my_array{0}")
+ Declaration of static methods as static (i.e. "static function" instead of "function" only)

##  Installation
+ Download the [latest release](https://github.com/Jefferson49/PHP8_mod_ariextmenu/releases/latest) of the module
+ Unzip the file to a local directory and copy the folder "mod_ariextmenu" into the "modules" folder of your joomla installation

Please note that the patch only contains a patched subset of the module files, which were migrated to PHP 8. If you want to install the complete module from scratch, you need to install the [ARI Ext Menu module](https://extensions.joomla.org/extension/ari-ext-menu/) first and apply the patch afterwards.

##  Versions: joomla, PHP, ARI Ext Menu 
The patch was developed and tested with: 
+ [joomla 3.10.11](https://downloads.joomla.org/cms/joomla3); but should also run with other joomla 3.x versions.
+ PHP 8.0.20
+ ARI Ext Menu 2.2.11

##  Github repository  
https://github.com/Jefferson49/PHP8_mod_ariextmenu