<?php

namespace PagePlus\Model\Base;

use \Exception;
use \PDO;
use PagePlus\Model\PagePlusI18n as ChildPagePlusI18n;
use PagePlus\Model\PagePlusI18nQuery as ChildPagePlusI18nQuery;
use PagePlus\Model\Map\PagePlusI18nTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'page_plus_i18n' table.
 *
 *
 *
 * @method     ChildPagePlusI18nQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPagePlusI18nQuery orderByLocale($order = Criteria::ASC) Order by the locale column
 * @method     ChildPagePlusI18nQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildPagePlusI18nQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildPagePlusI18nQuery orderByImage($order = Criteria::ASC) Order by the image column
 * @method     ChildPagePlusI18nQuery orderByAlt($order = Criteria::ASC) Order by the alt column
 *
 * @method     ChildPagePlusI18nQuery groupById() Group by the id column
 * @method     ChildPagePlusI18nQuery groupByLocale() Group by the locale column
 * @method     ChildPagePlusI18nQuery groupByTitle() Group by the title column
 * @method     ChildPagePlusI18nQuery groupByDescription() Group by the description column
 * @method     ChildPagePlusI18nQuery groupByImage() Group by the image column
 * @method     ChildPagePlusI18nQuery groupByAlt() Group by the alt column
 *
 * @method     ChildPagePlusI18nQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPagePlusI18nQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPagePlusI18nQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPagePlusI18nQuery leftJoinPagePlus($relationAlias = null) Adds a LEFT JOIN clause to the query using the PagePlus relation
 * @method     ChildPagePlusI18nQuery rightJoinPagePlus($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PagePlus relation
 * @method     ChildPagePlusI18nQuery innerJoinPagePlus($relationAlias = null) Adds a INNER JOIN clause to the query using the PagePlus relation
 *
 * @method     ChildPagePlusI18n findOne(ConnectionInterface $con = null) Return the first ChildPagePlusI18n matching the query
 * @method     ChildPagePlusI18n findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPagePlusI18n matching the query, or a new ChildPagePlusI18n object populated from the query conditions when no match is found
 *
 * @method     ChildPagePlusI18n findOneById(int $id) Return the first ChildPagePlusI18n filtered by the id column
 * @method     ChildPagePlusI18n findOneByLocale(string $locale) Return the first ChildPagePlusI18n filtered by the locale column
 * @method     ChildPagePlusI18n findOneByTitle(string $title) Return the first ChildPagePlusI18n filtered by the title column
 * @method     ChildPagePlusI18n findOneByDescription(string $description) Return the first ChildPagePlusI18n filtered by the description column
 * @method     ChildPagePlusI18n findOneByImage(string $image) Return the first ChildPagePlusI18n filtered by the image column
 * @method     ChildPagePlusI18n findOneByAlt(string $alt) Return the first ChildPagePlusI18n filtered by the alt column
 *
 * @method     array findById(int $id) Return ChildPagePlusI18n objects filtered by the id column
 * @method     array findByLocale(string $locale) Return ChildPagePlusI18n objects filtered by the locale column
 * @method     array findByTitle(string $title) Return ChildPagePlusI18n objects filtered by the title column
 * @method     array findByDescription(string $description) Return ChildPagePlusI18n objects filtered by the description column
 * @method     array findByImage(string $image) Return ChildPagePlusI18n objects filtered by the image column
 * @method     array findByAlt(string $alt) Return ChildPagePlusI18n objects filtered by the alt column
 *
 */
abstract class PagePlusI18nQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \PagePlus\Model\Base\PagePlusI18nQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'thelia', $modelName = '\\PagePlus\\Model\\PagePlusI18n', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPagePlusI18nQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPagePlusI18nQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof \PagePlus\Model\PagePlusI18nQuery) {
            return $criteria;
        }
        $query = new \PagePlus\Model\PagePlusI18nQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$id, $locale] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildPagePlusI18n|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PagePlusI18nTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PagePlusI18nTableMap::DATABASE_NAME);
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
     * @return   ChildPagePlusI18n A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT ID, LOCALE, TITLE, DESCRIPTION, IMAGE, ALT FROM page_plus_i18n WHERE ID = :p0 AND LOCALE = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            $obj = new ChildPagePlusI18n();
            $obj->hydrate($row);
            PagePlusI18nTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ChildPagePlusI18n|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
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
     * @return ChildPagePlusI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(PagePlusI18nTableMap::ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(PagePlusI18nTableMap::LOCALE, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ChildPagePlusI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(PagePlusI18nTableMap::ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(PagePlusI18nTableMap::LOCALE, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @see       filterByPagePlus()
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPagePlusI18nQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PagePlusI18nTableMap::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PagePlusI18nTableMap::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PagePlusI18nTableMap::ID, $id, $comparison);
    }

    /**
     * Filter the query on the locale column
     *
     * Example usage:
     * <code>
     * $query->filterByLocale('fooValue');   // WHERE locale = 'fooValue'
     * $query->filterByLocale('%fooValue%'); // WHERE locale LIKE '%fooValue%'
     * </code>
     *
     * @param     string $locale The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPagePlusI18nQuery The current query, for fluid interface
     */
    public function filterByLocale($locale = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($locale)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $locale)) {
                $locale = str_replace('*', '%', $locale);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PagePlusI18nTableMap::LOCALE, $locale, $comparison);
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
     * @return ChildPagePlusI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(PagePlusI18nTableMap::TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%'); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPagePlusI18nQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $description)) {
                $description = str_replace('*', '%', $description);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PagePlusI18nTableMap::DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the image column
     *
     * Example usage:
     * <code>
     * $query->filterByImage('fooValue');   // WHERE image = 'fooValue'
     * $query->filterByImage('%fooValue%'); // WHERE image LIKE '%fooValue%'
     * </code>
     *
     * @param     string $image The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPagePlusI18nQuery The current query, for fluid interface
     */
    public function filterByImage($image = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($image)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $image)) {
                $image = str_replace('*', '%', $image);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PagePlusI18nTableMap::IMAGE, $image, $comparison);
    }

    /**
     * Filter the query on the alt column
     *
     * Example usage:
     * <code>
     * $query->filterByAlt('fooValue');   // WHERE alt = 'fooValue'
     * $query->filterByAlt('%fooValue%'); // WHERE alt LIKE '%fooValue%'
     * </code>
     *
     * @param     string $alt The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPagePlusI18nQuery The current query, for fluid interface
     */
    public function filterByAlt($alt = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($alt)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $alt)) {
                $alt = str_replace('*', '%', $alt);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PagePlusI18nTableMap::ALT, $alt, $comparison);
    }

    /**
     * Filter the query by a related \PagePlus\Model\PagePlus object
     *
     * @param \PagePlus\Model\PagePlus|ObjectCollection $pagePlus The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPagePlusI18nQuery The current query, for fluid interface
     */
    public function filterByPagePlus($pagePlus, $comparison = null)
    {
        if ($pagePlus instanceof \PagePlus\Model\PagePlus) {
            return $this
                ->addUsingAlias(PagePlusI18nTableMap::ID, $pagePlus->getId(), $comparison);
        } elseif ($pagePlus instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PagePlusI18nTableMap::ID, $pagePlus->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPagePlus() only accepts arguments of type \PagePlus\Model\PagePlus or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PagePlus relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildPagePlusI18nQuery The current query, for fluid interface
     */
    public function joinPagePlus($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PagePlus');

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
            $this->addJoinObject($join, 'PagePlus');
        }

        return $this;
    }

    /**
     * Use the PagePlus relation PagePlus object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \PagePlus\Model\PagePlusQuery A secondary query class using the current class as primary query
     */
    public function usePagePlusQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinPagePlus($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PagePlus', '\PagePlus\Model\PagePlusQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPagePlusI18n $pagePlusI18n Object to remove from the list of results
     *
     * @return ChildPagePlusI18nQuery The current query, for fluid interface
     */
    public function prune($pagePlusI18n = null)
    {
        if ($pagePlusI18n) {
            $this->addCond('pruneCond0', $this->getAliasedColName(PagePlusI18nTableMap::ID), $pagePlusI18n->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(PagePlusI18nTableMap::LOCALE), $pagePlusI18n->getLocale(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the page_plus_i18n table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PagePlusI18nTableMap::DATABASE_NAME);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PagePlusI18nTableMap::clearInstancePool();
            PagePlusI18nTableMap::clearRelatedInstancePool();

            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $affectedRows;
    }

    /**
     * Performs a DELETE on the database, given a ChildPagePlusI18n or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ChildPagePlusI18n object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
     public function delete(ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PagePlusI18nTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PagePlusI18nTableMap::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();


        PagePlusI18nTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PagePlusI18nTableMap::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

} // PagePlusI18nQuery
