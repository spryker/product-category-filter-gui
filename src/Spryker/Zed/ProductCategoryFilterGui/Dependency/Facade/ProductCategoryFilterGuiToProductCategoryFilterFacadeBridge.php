<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductCategoryFilterGui\Dependency\Facade;

use Generated\Shared\Transfer\ProductCategoryFilterTransfer;

class ProductCategoryFilterGuiToProductCategoryFilterFacadeBridge implements ProductCategoryFilterGuiToProductCategoryFilterFacadeInterface
{
    /**
     * @var \Spryker\Zed\ProductCategoryFilter\Business\ProductCategoryFilterFacadeInterface
     */
    protected $productCategoryFilterFacade;

    /**
     * @param \Spryker\Zed\ProductCategoryFilter\Business\ProductCategoryFilterFacadeInterface $productCategoryFilterFacade
     */
    public function __construct($productCategoryFilterFacade)
    {
        $this->productCategoryFilterFacade = $productCategoryFilterFacade;
    }

    public function createProductCategoryFilter(ProductCategoryFilterTransfer $productCategoryFilterTransfer): ProductCategoryFilterTransfer
    {
        return $this->productCategoryFilterFacade->createProductCategoryFilter($productCategoryFilterTransfer);
    }

    public function updateProductCategoryFilter(ProductCategoryFilterTransfer $productCategoryFilterTransfer): ProductCategoryFilterTransfer
    {
        return $this->productCategoryFilterFacade->updateProductCategoryFilter($productCategoryFilterTransfer);
    }

    /**
     * @param int $categoryId
     *
     * @return void
     */
    public function deleteProductCategoryFilterByCategoryId($categoryId): void
    {
        $this->productCategoryFilterFacade->deleteProductCategoryFilterByCategoryId($categoryId);
    }

    /**
     * @param int $categoryId
     *
     * @return \Generated\Shared\Transfer\ProductCategoryFilterTransfer
     */
    public function findProductCategoryFilterByCategoryId($categoryId): ProductCategoryFilterTransfer
    {
        return $this->productCategoryFilterFacade->findProductCategoryFilterByCategoryId($categoryId);
    }

    public function getAllProductCategoriesWithFilters(): array
    {
        return $this->productCategoryFilterFacade->getAllProductCategoriesWithFilters();
    }
}
