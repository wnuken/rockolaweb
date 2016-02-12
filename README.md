rockolaweb
==========

Install

Propel Install:

A. Via Composer

1. Just create a new composer.json file at the root of your project.

 Content
________________

 {
    "require": {
        "propel/propel": "~2.0@dev"
    },
    "autoload": {
        "classmap": ["generated-classes/"]
    }
}
_______________

2. Then you have to download Composer itself so in a terminal just type the following:

$ wget http://getcomposer.org/composer.phar
# If you haven't wget on your computer
$ curl -s http://getcomposer.org/installer | php

3. Finally, to install all your project dependencies, type the following:

$ php composer.phar install

B. Via Git

If you want, you can also setup Propel using Git cloning the Github repository:

$ git clone git://github.com/propelorm/Propel2 vendor/propel

Propel is well unit-tested so the cloned version should be pretty stable. If you want to update Propel, just go to the repository and pull the remote:

$ cd myproject/vendor/propel
$ git pull

###

Add the propel generator's bin/ directory to your PATH, or create a symlink in proyect folder.

ln -s vendor/bin/propel propel

Configure Propel

propel init

select path schema to schema.xml
select path myproject/generated-classes to model:build

Set config files types: json.

Remenber put in file propel.json.dist path tu Clases
Example:
phpDir: myproject/generated-classes (Path to model:build -- content in composer.json)

change names default by rockolaweb in schema.xml and propel.json

*************
schema.xml
--------------
<database name="rockolaweb" defaultIdMethod="native" ... >


propel.json
--------------
...
"connections": {
                "rockolaweb": {
                    "adapter": "mysql",
...

*************



./propel sql:build --overwrite
./propel model:build

./propel config:convert

./propel sql:insert (Only if schema no has been create)


composer dump-autoload

