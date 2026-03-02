<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductCategoryFilterGui\Dependency\Facade;

use Generated\Shared\Transfer\ProductCategoryFilterTransfer;

interface ProductCategoryFilterGuiToProductCategoryFilterFacadeInterface
{
    public function createProductCategoryFilter(ProductCategoryFilterTransfer $productCategoryFilterTransfer): ProductCategoryFilterTransfer;

    public function updateProductCategoryFilter(ProductCategoryFilterTransfer $productCategoryFilterTransfer): ProductCategoryFilterTransfer;

    /**
     * @param int $categoryId
     *
     * @return void
     */
    public function deleteProductCategoryFilterByCategoryId($categoryId): void;

    /**
     * @param int $categoryId
     *
     * @return \Generated\Shared\Transfer\ProductCategoryFilterTransfer
     */
    public function findProductCategoryFilterByCategoryId($categoryId): ProductCategoryFilterTransfer;

    public function getAllProductCategoriesWithFilters(): array;
}
