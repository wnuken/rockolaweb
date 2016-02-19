<?php

namespace Base;

use \Songlist as ChildSonglist;
use \SonglistQuery as ChildSonglistQuery;
use \Exception;
use \PDO;
use Map\SonglistTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'songlist' table.
 *
 *
 *
 * @method     ChildSonglistQuery orderByTime($order = Criteria::ASC) Order by the time column
 * @method     ChildSonglistQuery orderBySong($order = Criteria::ASC) Order by the song column
 *
 * @method     ChildSonglistQuery groupByTime() Group by the time column
 * @method     ChildSonglistQuery groupBySong() Group by the song column
 *
 * @method     ChildSonglistQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSonglistQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSonglistQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSonglist findOne(ConnectionInterface $con = null) Return the first ChildSonglist matching the query
 * @method     ChildSonglist findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSonglist matching the query, or a new ChildSonglist object populated from the query conditions when no match is found
 *
 * @method     ChildSonglist findOneByTime(double $time) Return the first ChildSonglist filtered by the time column
 * @method     ChildSonglist findOneBySong(string $song) Return the first ChildSonglist filtered by the song column *

 * @method     ChildSonglist requirePk($key, ConnectionInterface $con = null) Return the ChildSonglist by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSonglist requireOne(ConnectionInterface $con = null) Return the first ChildSonglist matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSonglist requireOneByTime(double $time) Return the first ChildSonglist filtered by the time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSonglist requireOneBySong(string $song) Return the first ChildSonglist filtered by the song column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSonglist[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSonglist objects based on current ModelCriteria
 * @method     ChildSonglist[]|ObjectCollection findByTime(double $time) Return ChildSonglist objects filtered by the time column
 * @method     ChildSonglist[]|ObjectCollection findBySong(string $song) Return ChildSonglist objects filtered by the song column
 * @method     ChildSonglist[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SonglistQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\SonglistQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'rockolaweb', $modelName = '\\Songlist', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSonglistQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSonglistQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSonglistQuery) {
            return $criteria;
        }
        $query = new ChildSonglistQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildSonglist|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SonglistTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SonglistTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSonglist A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT time, song FROM songlist WHERE time = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildSonglist $obj */
            $obj = new ChildSonglist();
            $obj->hydrate($row);
            SonglistTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildSonglist|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildSonglistQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SonglistTableMap::COL_TIME, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSonglistQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SonglistTableMap::COL_TIME, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the time column
     *
     * Example usage:
     * <code>
     * $query->filterByTime(1234); // WHERE time = 1234
     * $query->filterByTime(array(12, 34)); // WHERE time IN (12, 34)
     * $query->filterByTime(array('min' => 12)); // WHERE time > 12
     * </code>
     *
     * @param     mixed $time The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSonglistQuery The current query, for fluid interface
     */
    public function filterByTime($time = null, $comparison = null)
    {
        if (is_array($time)) {
            $useMinMax = false;
            if (isset($time['min'])) {
                $this->addUsingAlias(SonglistTableMap::COL_TIME, $time['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($time['max'])) {
                $this->addUsingAlias(SonglistTableMap::COL_TIME, $time['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SonglistTableMap::COL_TIME, $time, $comparison);
    }

    /**
     * Filter the query on the song column
     *
     * Example usage:
     * <code>
     * $query->filterBySong('fooValue');   // WHERE song = 'fooValue'
     * $query->filterBySong('%fooValue%'); // WHERE song LIKE '%fooValue%'
     * </code>
     *
     * @param     string $song The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSonglistQuery The current query, for fluid interface
     */
    public function filterBySong($song = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($song)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $song)) {
                $song = str_replace('*', '%', $song);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SonglistTableMap::COL_SONG, $song, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSonglist $songlist Object to remove from the list of results
     *
     * @return $this|ChildSonglistQuery The current query, for fluid interface
     */
    public function prune($songlist = null)
    {
        if ($songlist) {
            $this->addUsingAlias(SonglistTableMap::COL_TIME, $songlist->getTime(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the songlist table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SonglistTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SonglistTableMap::clearInstancePool();
            SonglistTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SonglistTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SonglistTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SonglistTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SonglistTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SonglistQuery
