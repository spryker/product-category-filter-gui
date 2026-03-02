<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductCategoryFilterGui\Communication\Saver;

use Generated\Shared\Transfer\ProductCategoryFilterTransfer;

interface ProductCategoryFilterSaverInterface
{
    public function save(ProductCategoryFilterTransfer $productCategoryFilterTransfer): ProductCategoryFilterTransfer;
}
