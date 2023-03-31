<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductCategoryFilterGui\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;

/**
 * @method \Spryker\Zed\ProductCategoryFilterGui\Communication\ProductCategoryFilterGuiCommunicationFactory getFactory()
 * @method \Spryker\Zed\ProductCategoryFilterGui\Persistence\ProductCategoryFilterGuiQueryContainerInterface getQueryContainer()
 */
class IndexController extends AbstractController
{
    /**
     * @return array
     */
    public function indexAction()
    {
        $rootCategoriesTable = $this
            ->getFactory()
            ->createCategoryRootNodeTable($this->getCurrentLocale()->getIdLocaleOrFail());

        $viewData = $this->executeProductCategoryListActionViewDataExpanderPlugins([
            'RootCategoriesTable' => $rootCategoriesTable->render(),
        ]);

        return $this->viewResponse($viewData);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function tableAction()
    {
        $productTable = $this
            ->getFactory()
            ->createCategoryRootNodeTable($this->getCurrentLocale()->getIdLocaleOrFail());

        return $this->jsonResponse(
            $productTable->fetchData(),
        );
    }

    /**
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    protected function getCurrentLocale()
    {
        return $this->getFactory()
            ->getLocaleFacade()
            ->getCurrentLocale();
    }

    /**
     * @param array<string, mixed> $viewData
     *
     * @return array<string, mixed>
     */
    protected function executeProductCategoryListActionViewDataExpanderPlugins(array $viewData): array
    {
        foreach ($this->getFactory()->getProductCategoryListActionViewDataExpanderPlugins() as $productCategoryListActionViewDataExpanderPlugin) {
            $viewData = $productCategoryListActionViewDataExpanderPlugin->expand($viewData);
        }

        return $viewData;
    }
}
