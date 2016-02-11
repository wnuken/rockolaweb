<?php

namespace Rockolaweb\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Rockolaweb\Music as ChildMusic;
use Rockolaweb\MusicQuery as ChildMusicQuery;
use Rockolaweb\Map\MusicTableMap;

/**
 * Base class that represents a query for the 'music' table.
 *
 *
 *
 * @method     ChildMusicQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildMusicQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildMusicQuery orderByRockId($order = Criteria::ASC) Order by the rock_id column
 * @method     ChildMusicQuery orderByYoutubeId($order = Criteria::ASC) Order by the youtube_id column
 * @method     ChildMusicQuery orderByGenderId($order = Criteria::ASC) Order by the gender_id column
 * @method     ChildMusicQuery orderByAuthorId($order = Criteria::ASC) Order by the author_id column
 *
 * @method     ChildMusicQuery groupById() Group by the id column
 * @method     ChildMusicQuery groupByTitle() Group by the title column
 * @method     ChildMusicQuery groupByRockId() Group by the rock_id column
 * @method     ChildMusicQuery groupByYoutubeId() Group by the youtube_id column
 * @method     ChildMusicQuery groupByGenderId() Group by the gender_id column
 * @method     ChildMusicQuery groupByAuthorId() Group by the author_id column
 *
 * @method     ChildMusicQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildMusicQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildMusicQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildMusicQuery leftJoinGenders($relationAlias = null) Adds a LEFT JOIN clause to the query using the Genders relation
 * @method     ChildMusicQuery rightJoinGenders($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Genders relation
 * @method     ChildMusicQuery innerJoinGenders($relationAlias = null) Adds a INNER JOIN clause to the query using the Genders relation
 *
 * @method     ChildMusicQuery leftJoinAuthor($relationAlias = null) Adds a LEFT JOIN clause to the query using the Author relation
 * @method     ChildMusicQuery rightJoinAuthor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Author relation
 * @method     ChildMusicQuery innerJoinAuthor($relationAlias = null) Adds a INNER JOIN clause to the query using the Author relation
 *
 * @method     \Rockolaweb\GendersQuery|\Rockolaweb\AuthorQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildMusic findOne(ConnectionInterface $con = null) Return the first ChildMusic matching the query
 * @method     ChildMusic findOneOrCreate(ConnectionInterface $con = null) Return the first ChildMusic matching the query, or a new ChildMusic object populated from the query conditions when no match is found
 *
 * @method     ChildMusic findOneById(int $id) Return the first ChildMusic filtered by the id column
 * @method     ChildMusic findOneByTitle(string $title) Return the first ChildMusic filtered by the title column
 * @method     ChildMusic findOneByRockId(string $rock_id) Return the first ChildMusic filtered by the rock_id column
 * @method     ChildMusic findOneByYoutubeId(string $youtube_id) Return the first ChildMusic filtered by the youtube_id column
 * @method     ChildMusic findOneByGenderId(int $gender_id) Return the first ChildMusic filtered by the gender_id column
 * @method     ChildMusic findOneByAuthorId(int $author_id) Return the first ChildMusic filtered by the author_id column *

 * @method     ChildMusic requirePk($key, ConnectionInterface $con = null) Return the ChildMusic by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMusic requireOne(ConnectionInterface $con = null) Return the first ChildMusic matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMusic requireOneById(int $id) Return the first ChildMusic filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMusic requireOneByTitle(string $title) Return the first ChildMusic filtered by the title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMusic requireOneByRockId(string $rock_id) Return the first ChildMusic filtered by the rock_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMusic requireOneByYoutubeId(string $youtube_id) Return the first ChildMusic filtered by the youtube_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMusic requireOneByGenderId(int $gender_id) Return the first ChildMusic filtered by the gender_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMusic requireOneByAuthorId(int $author_id) Return the first ChildMusic filtered by the author_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMusic[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildMusic objects based on current ModelCriteria
 * @method     ChildMusic[]|ObjectCollection findById(int $id) Return ChildMusic objects filtered by the id column
 * @method     ChildMusic[]|ObjectCollection findByTitle(string $title) Return ChildMusic objects filtered by the title column
 * @method     ChildMusic[]|ObjectCollection findByRockId(string $rock_id) Return ChildMusic objects filtered by the rock_id column
 * @method     ChildMusic[]|ObjectCollection findByYoutubeId(string $youtube_id) Return ChildMusic objects filtered by the youtube_id column
 * @method     ChildMusic[]|ObjectCollection findByGenderId(int $gender_id) Return ChildMusic objects filtered by the gender_id column
 * @method     ChildMusic[]|ObjectCollection findByAuthorId(int $author_id) Return ChildMusic objects filtered by the author_id column
 * @method     ChildMusic[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class MusicQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Rockolaweb\Base\MusicQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Rockolaweb\\Music', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildMusicQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildMusicQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildMusicQuery) {
            return $criteria;
        }
        $query = new ChildMusicQuery();
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
     * @return ChildMusic|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = MusicTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(MusicTableMap::DATABASE_NAME);
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
     * @return ChildMusic A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, title, rock_id, youtube_id, gender_id, author_id FROM music WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildMusic $obj */
            $obj = new ChildMusic();
            $obj->hydrate($row);
            MusicTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildMusic|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildMusicQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MusicTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildMusicQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MusicTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMusicQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(MusicTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(MusicTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MusicTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%'); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMusicQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $title)) {
                $title = str_replace('*', '%', $title);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MusicTableMap::COL_TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the rock_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRockId('fooValue');   // WHERE rock_id = 'fooValue'
     * $query->filterByRockId('%fooValue%'); // WHERE rock_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $rockId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMusicQuery The current query, for fluid interface
     */
    public function filterByRockId($rockId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rockId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $rockId)) {
                $rockId = str_replace('*', '%', $rockId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MusicTableMap::COL_ROCK_ID, $rockId, $comparison);
    }

    /**
     * Filter the query on the youtube_id column
     *
     * Example usage:
     * <code>
     * $query->filterByYoutubeId('fooValue');   // WHERE youtube_id = 'fooValue'
     * $query->filterByYoutubeId('%fooValue%'); // WHERE youtube_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $youtubeId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMusicQuery The current query, for fluid interface
     */
    public function filterByYoutubeId($youtubeId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($youtubeId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $youtubeId)) {
                $youtubeId = str_replace('*', '%', $youtubeId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MusicTableMap::COL_YOUTUBE_ID, $youtubeId, $comparison);
    }

    /**
     * Filter the query on the gender_id column
     *
     * Example usage:
     * <code>
     * $query->filterByGenderId(1234); // WHERE gender_id = 1234
     * $query->filterByGenderId(array(12, 34)); // WHERE gender_id IN (12, 34)
     * $query->filterByGenderId(array('min' => 12)); // WHERE gender_id > 12
     * </code>
     *
     * @see       filterByGenders()
     *
     * @param     mixed $genderId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMusicQuery The current query, for fluid interface
     */
    public function filterByGenderId($genderId = null, $comparison = null)
    {
        if (is_array($genderId)) {
            $useMinMax = false;
            if (isset($genderId['min'])) {
                $this->addUsingAlias(MusicTableMap::COL_GENDER_ID, $genderId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($genderId['max'])) {
                $this->addUsingAlias(MusicTableMap::COL_GENDER_ID, $genderId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MusicTableMap::COL_GENDER_ID, $genderId, $comparison);
    }

    /**
     * Filter the query on the author_id column
     *
     * Example usage:
     * <code>
     * $query->filterByAuthorId(1234); // WHERE author_id = 1234
     * $query->filterByAuthorId(array(12, 34)); // WHERE author_id IN (12, 34)
     * $query->filterByAuthorId(array('min' => 12)); // WHERE author_id > 12
     * </code>
     *
     * @see       filterByAuthor()
     *
     * @param     mixed $authorId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMusicQuery The current query, for fluid interface
     */
    public function filterByAuthorId($authorId = null, $comparison = null)
    {
        if (is_array($authorId)) {
            $useMinMax = false;
            if (isset($authorId['min'])) {
                $this->addUsingAlias(MusicTableMap::COL_AUTHOR_ID, $authorId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($authorId['max'])) {
                $this->addUsingAlias(MusicTableMap::COL_AUTHOR_ID, $authorId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MusicTableMap::COL_AUTHOR_ID, $authorId, $comparison);
    }

    /**
     * Filter the query by a related \Rockolaweb\Genders object
     *
     * @param \Rockolaweb\Genders|ObjectCollection $genders The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildMusicQuery The current query, for fluid interface
     */
    public function filterByGenders($genders, $comparison = null)
    {
        if ($genders instanceof \Rockolaweb\Genders) {
            return $this
                ->addUsingAlias(MusicTableMap::COL_GENDER_ID, $genders->getId(), $comparison);
        } elseif ($genders instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(MusicTableMap::COL_GENDER_ID, $genders->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByGenders() only accepts arguments of type \Rockolaweb\Genders or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Genders relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildMusicQuery The current query, for fluid interface
     */
    public function joinGenders($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Genders');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Genders');
        }

        return $this;
    }

    /**
     * Use the Genders relation Genders object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Rockolaweb\GendersQuery A secondary query class using the current class as primary query
     */
    public function useGendersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGenders($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Genders', '\Rockolaweb\GendersQuery');
    }

    /**
     * Filter the query by a related \Rockolaweb\Author object
     *
     * @param \Rockolaweb\Author|ObjectCollection $author The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildMusicQuery The current query, for fluid interface
     */
    public function filterByAuthor($author, $comparison = null)
    {
        if ($author instanceof \Rockolaweb\Author) {
            return $this
                ->addUsingAlias(MusicTableMap::COL_AUTHOR_ID, $author->getId(), $comparison);
        } elseif ($author instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(MusicTableMap::COL_AUTHOR_ID, $author->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByAuthor() only accepts arguments of type \Rockolaweb\Author or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Author relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildMusicQuery The current query, for fluid interface
     */
    public function joinAuthor($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Author');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Author');
        }

        return $this;
    }

    /**
     * Use the Author relation Author object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Rockolaweb\AuthorQuery A secondary query class using the current class as primary query
     */
    public function useAuthorQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAuthor($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Author', '\Rockolaweb\AuthorQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildMusic $music Object to remove from the list of results
     *
     * @return $this|ChildMusicQuery The current query, for fluid interface
     */
    public function prune($music = null)
    {
        if ($music) {
            $this->addUsingAlias(MusicTableMap::COL_ID, $music->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the music table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MusicTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            MusicTableMap::clearInstancePool();
            MusicTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(MusicTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(MusicTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            MusicTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            MusicTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // MusicQuery
