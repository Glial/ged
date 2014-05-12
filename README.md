[![Latest Stable Version](https://poser.pugx.org/glial/new-project/v/stable.png)](https://packagist.org/packages/glial/new-project) [![Total Downloads](https://poser.pugx.org/glial/new-project/downloads.png)](https://packagist.org/packages/glial/new-project) [![Latest Unstable Version](https://poser.pugx.org/glial/new-project/v/unstable.png)](https://packagist.org/packages/glial/new-project) [![License](https://poser.pugx.org/glial/new-project/license.png)](https://packagist.org/packages/glial/new-project)
[![Dependency Status](https://www.versioneye.com/php/glial:new-project/dev-master/badge.png)](https://www.versioneye.com/php/glial:new-project/dev-master)



You need :

 * PHP 5.5
 * Distribution based on Linux. (don't work with windows!)



To install a new project working with Glial :



install composer

`$ curl -sS https://getcomposer.org/installer | php`

`$ mv composer.phar /usr/local/bin/composer`


install a new project (install in current directory, will create a new dir)


`$ composer create-project -sdev --dev --keep-vcs glial/new-project my_glial_project`


update `configuration/db.config.ini.php`

update `webroot.config.php`


`cd myproject/application/webroot`

`php index.php administration admin_table`

`php index.php administration admin_init`


You are ready to work !
