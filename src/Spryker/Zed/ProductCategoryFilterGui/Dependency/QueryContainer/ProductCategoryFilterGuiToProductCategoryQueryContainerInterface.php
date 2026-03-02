<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductCategoryFilterGui\Dependency\QueryContainer;

use Orm\Zed\ProductCategory\Persistence\SpyProductCategoryQuery;

interface ProductCategoryFilterGuiToProductCategoryQueryContainerInterface
{
    public function queryProductCategoryMappings(): SpyProductCategoryQuery;
}
