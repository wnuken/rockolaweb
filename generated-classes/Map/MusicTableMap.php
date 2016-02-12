<?php

namespace Map;

use \Music;
use \MusicQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'music' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class MusicTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.MusicTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'rockolaweb';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'music';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Music';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Music';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the id field
     */
    const COL_ID = 'music.id';

    /**
     * the column name for the title field
     */
    const COL_TITLE = 'music.title';

    /**
     * the column name for the rock_id field
     */
    const COL_ROCK_ID = 'music.rock_id';

    /**
     * the column name for the youtube_id field
     */
    const COL_YOUTUBE_ID = 'music.youtube_id';

    /**
     * the column name for the gender_id field
     */
    const COL_GENDER_ID = 'music.gender_id';

    /**
     * the column name for the author_id field
     */
    const COL_AUTHOR_ID = 'music.author_id';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'Title', 'RockId', 'YoutubeId', 'GenderId', 'AuthorId', ),
        self::TYPE_CAMELNAME     => array('id', 'title', 'rockId', 'youtubeId', 'genderId', 'authorId', ),
        self::TYPE_COLNAME       => array(MusicTableMap::COL_ID, MusicTableMap::COL_TITLE, MusicTableMap::COL_ROCK_ID, MusicTableMap::COL_YOUTUBE_ID, MusicTableMap::COL_GENDER_ID, MusicTableMap::COL_AUTHOR_ID, ),
        self::TYPE_FIELDNAME     => array('id', 'title', 'rock_id', 'youtube_id', 'gender_id', 'author_id', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Title' => 1, 'RockId' => 2, 'YoutubeId' => 3, 'GenderId' => 4, 'AuthorId' => 5, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'title' => 1, 'rockId' => 2, 'youtubeId' => 3, 'genderId' => 4, 'authorId' => 5, ),
        self::TYPE_COLNAME       => array(MusicTableMap::COL_ID => 0, MusicTableMap::COL_TITLE => 1, MusicTableMap::COL_ROCK_ID => 2, MusicTableMap::COL_YOUTUBE_ID => 3, MusicTableMap::COL_GENDER_ID => 4, MusicTableMap::COL_AUTHOR_ID => 5, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'title' => 1, 'rock_id' => 2, 'youtube_id' => 3, 'gender_id' => 4, 'author_id' => 5, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('music');
        $this->setPhpName('Music');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Music');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('title', 'Title', 'VARCHAR', true, 255, null);
        $this->addColumn('rock_id', 'RockId', 'VARCHAR', true, 24, null);
        $this->addColumn('youtube_id', 'YoutubeId', 'VARCHAR', true, 24, null);
        $this->addForeignKey('gender_id', 'GenderId', 'INTEGER', 'genders', 'id', true, null, null);
        $this->addForeignKey('author_id', 'AuthorId', 'INTEGER', 'author', 'id', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Genders', '\\Genders', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':gender_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Author', '\\Author', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':author_id',
    1 => ':id',
  ),
), null, null, null, false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? MusicTableMap::CLASS_DEFAULT : MusicTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Music object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = MusicTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = MusicTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + MusicTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = MusicTableMap::OM_CLASS;
            /** @var Music $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            MusicTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = MusicTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = MusicTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Music $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                MusicTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(MusicTableMap::COL_ID);
            $criteria->addSelectColumn(MusicTableMap::COL_TITLE);
            $criteria->addSelectColumn(MusicTableMap::COL_ROCK_ID);
            $criteria->addSelectColumn(MusicTableMap::COL_YOUTUBE_ID);
            $criteria->addSelectColumn(MusicTableMap::COL_GENDER_ID);
            $criteria->addSelectColumn(MusicTableMap::COL_AUTHOR_ID);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.title');
            $criteria->addSelectColumn($alias . '.rock_id');
            $criteria->addSelectColumn($alias . '.youtube_id');
            $criteria->addSelectColumn($alias . '.gender_id');
            $criteria->addSelectColumn($alias . '.author_id');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(MusicTableMap::DATABASE_NAME)->getTable(MusicTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(MusicTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(MusicTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new MusicTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Music or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Music object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MusicTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Music) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(MusicTableMap::DATABASE_NAME);
            $criteria->add(MusicTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = MusicQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            MusicTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                MusicTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the music table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return MusicQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Music or Criteria object.
     *
     * @param mixed               $criteria Criteria or Music object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MusicTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Music object
        }

        if ($criteria->containsKey(MusicTableMap::COL_ID) && $criteria->keyContainsValue(MusicTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.MusicTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = MusicQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // MusicTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
MusicTableMap::buildTableMap();
