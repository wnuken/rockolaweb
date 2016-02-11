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

Remenber put in file propel.yml.dist path tu Clases
Example:
phpDir: myproject/generated-classes (Path to model:build -- content in composer.json)


./propel sql:build --overwrite
./propel model:build

./propel config:convert

./propel sql:insert

propel init

composer dump-autoload




<!--
    Awesome, your propel set up is nearly done! You just have to describe how you want your database to look like.

    You can let propel set up your mysql database by running `vendor/bin/propel database:create && vendor/bin/propel database:insert-sql`.
    This will create your database including all the tables.
-->

<!--
    The root tag of the XML schema is the <database> tag.

    The `name` attribute defines the name of the connection that Propel uses for the tables in this schema. It is not
    necessarily the name of the actual database. In fact, Propel uses some configuration properties to link a connection
    name with real connection settings (like database name, user and password).

    The `defaultIdMethod` attribute indicates that the tables in this schema use the database's "native"
    auto-increment/sequence features to handle id columns that are set to auto-increment.

   [TIP]: You can define several schemas for a single project. Just make sure that each of the schema
          filenames end with schema.xml.
-->
<database name="default" defaultIdMethod="native"
          xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
          xsi:noNamespaceSchemaLocation="http://xsd.propelorm.org/1.6/database.xsd"
          namespace="rockolaweb"
        >
    <!-- Within the <database> tag, Propel expects one <table> tag for each table -->


    <!--
        Each table element should have a `name` attribute. It will be used for naming the sql table.

        The `phpName` is the name that Propel will use for the generated PHP class. By default, Propel uses a
        CamelCase version of the table name as its phpName - that means that you could omit the `phpName` attribute
        on our `book` table.
    -->
    <table name="music" phpName="Music">
        <!--
            Each column has a `name` (the one used by the database), and an optional `phpName` attribute. Once again,
            the Propel default behavior is to use a CamelCase version of the name as `phpName` when not specified.

            Each column also requires a `type`. The XML schema is database agnostic, so the column types and attributes
            are probably not exactly the same as the one you use in your own database. But Propel knows how to map the
            schema types with SQL types for many database vendors. Existing Propel column types are:
            `boolean`, `tinyint`, `smallint`, `integer`, `bigint`, `double`, `float`, `real`, `decimal`, `char`,
            `varchar`, `longvarchar`, `date`, `time`, `timestamp`, `blob`, `clob`, `object`, and `array`.

            Some column types use a size (like `varchar` and `int`), some have unlimited size (`longvarchar`, `clob`,
            `blob`).

            Check the (schema reference)[http://propelorm.org/reference/schema.html] for more details
            on each column type.

            As for the other column attributes, `required`, `primaryKey`, and `autoIncrement`, they mean exactly
            what their names imply.
        -->
        <column name="id" type="integer" required="true" primaryKey="true" autoIncrement="true"/>
        <column name="title" type="varchar" size="255" required="true"/>
        <column name="rock_id" type="varchar" size="24" required="true" />
        <column name="youtube_id" type="varchar" size="24" required="true" />
        <column name="gender_id" type="integer" required="true"/>
        <column name="author_id" type="integer" required="true"/>

        <!--
            A foreign key represents a relationship. Just like a table or a column, a relationship has a `phpName`.
            By default, Propel uses the `phpName` of the foreign table as the `phpName` of the relation.

            The `refPhpName` defines the name of the relation as seen from the foreign table.
        -->
        <foreign-key foreignTable="genders" phpName="Genders" refPhpName="Music">
            <reference local="gender_id" foreign="id"/>
        </foreign-key>
        <foreign-key foreignTable="author">
            <reference local="author_id" foreign="id"/>
        </foreign-key>
    </table>

    <table name="author" phpName="Author">
        <column name="id" type="integer" required="true" primaryKey="true" autoIncrement="true"/>
        <column name="name" type="varchar" size="255" required="true"/>
        <column name="nationality" type="varchar" size="128" required="true"/>
    </table>

    <table name="genders" phpName="Genders">
        <column name="id" type="integer" required="true" primaryKey="true" autoIncrement="true"/>
        <column name="name" type="varchar" size="128" required="true"/>
    </table>

    <!--
        When you're done with editing, open a terminal and run
            `$ cd /vagrant/www/rockolaweb`
            `$ vendor/bin/propel build`
        to generate the model classes.

        You should now be able to perform basic crud operations with your models. To learn how to use these models
        please look into our documentation: http://propelorm.org/documentation/03-basic-crud.html
    -->
</database>