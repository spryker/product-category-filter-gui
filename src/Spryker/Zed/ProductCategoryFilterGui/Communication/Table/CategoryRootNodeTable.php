<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductCategoryFilterGui\Communication\Table;

use Orm\Zed\Category\Persistence\Map\SpyCategoryAttributeTableMap;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;
use Spryker\Zed\ProductCategoryFilterGui\Dependency\QueryContainer\ProductCategoryFilterGuiToCategoryQueryContainerInterface;

class CategoryRootNodeTable extends AbstractTable
{
    public const string TABLE_IDENTIFIER = 'root-node-table';

    /**
     * The table is initialized centrally by the Table library, which finds it through `gui-table-data`.
     */
    public const string TABLE_CLASS = 'gui-table-data-category gui-table-data';

    /**
     * @var \Spryker\Zed\ProductCategoryFilterGui\Dependency\QueryContainer\ProductCategoryFilterGuiToCategoryQueryContainerInterface
     */
    protected $productCategoryFilterGuiQueryContainer;

    /**
     * @var int
     */
    protected $idLocale;

    /**
     * @param \Spryker\Zed\ProductCategoryFilterGui\Dependency\QueryContainer\ProductCategoryFilterGuiToCategoryQueryContainerInterface $productCategoryFilterGuiQueryContainer
     * @param int $idLocale
     */
    public function __construct(ProductCategoryFilterGuiToCategoryQueryContainerInterface $productCategoryFilterGuiQueryContainer, $idLocale)
    {
        $this->productCategoryFilterGuiQueryContainer = $productCategoryFilterGuiQueryContainer;
        $this->idLocale = $idLocale;
        $this->setTableIdentifier(static::TABLE_IDENTIFIER);
    }

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return \Spryker\Zed\Gui\Communication\Table\TableConfiguration
     */
    protected function configure(TableConfiguration $config)
    {
        $this->tableClass = static::TABLE_CLASS;

        // Selecting a row reads the category ID from its first cell, which collapsing columns into child
        // rows would move. The search box stays hidden because the table lists the root nodes only.
        $config->setTableAttributes([
            'data-searching' => 'false',
            'data-responsive' => 'false',
        ]);

        $config->setHeader([
            SpyCategoryAttributeTableMap::COL_FK_CATEGORY => 'Category Id',
            SpyCategoryAttributeTableMap::COL_NAME => 'Name',
        ]);

        $config->setSortable([
            SpyCategoryAttributeTableMap::COL_NAME,
        ]);

        $config->setSearchable([
            SpyCategoryAttributeTableMap::COL_FK_CATEGORY,
            SpyCategoryAttributeTableMap::COL_NAME,
        ]);

        return $config;
    }

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return array
     */
    protected function prepareData(TableConfiguration $config)
    {
        $query = $this->productCategoryFilterGuiQueryContainer->queryRootNodes()
            ->orderBy(SpyCategoryAttributeTableMap::COL_NAME)
            ->setModelAlias('spy_locale')
            ->filterByFkLocale($this->idLocale);

        $queryResults = $this->runQuery($query, $config);

        $results = [];
        foreach ($queryResults as $rootNode) {
            $results[] = [
                SpyCategoryAttributeTableMap::COL_FK_CATEGORY => $this->formatInt(
                    $rootNode[SpyCategoryAttributeTableMap::COL_FK_CATEGORY],
                ),
                SpyCategoryAttributeTableMap::COL_NAME => $rootNode[SpyCategoryAttributeTableMap::COL_NAME],
            ];
        }
        unset($queryResults);

        return $results;
    }
}
