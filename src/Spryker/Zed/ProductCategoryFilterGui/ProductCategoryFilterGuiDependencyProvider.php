<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductCategoryFilterGui;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\ProductCategoryFilterGui\Dependency\Client\ProductCategoryFilterGuiToCatalogClientBridge;
use Spryker\Zed\ProductCategoryFilterGui\Dependency\Client\ProductCategoryFilterGuiToProductCategoryFilterClientBridge;
use Spryker\Zed\ProductCategoryFilterGui\Dependency\Facade\ProductCategoryFilterGuiToCategoryFacadeBridge;
use Spryker\Zed\ProductCategoryFilterGui\Dependency\Facade\ProductCategoryFilterGuiToLocaleFacadeBridge;
use Spryker\Zed\ProductCategoryFilterGui\Dependency\Facade\ProductCategoryFilterGuiToProductCategoryFilterFacadeBridge;
use Spryker\Zed\ProductCategoryFilterGui\Dependency\Facade\ProductCategoryFilterGuiToProductFacadeBridge;
use Spryker\Zed\ProductCategoryFilterGui\Dependency\Facade\ProductCategoryFilterGuiToProductSearchFacadeBridge;
use Spryker\Zed\ProductCategoryFilterGui\Dependency\QueryContainer\ProductCategoryFilterGuiToCategoryQueryContainerBridge;
use Spryker\Zed\ProductCategoryFilterGui\Dependency\QueryContainer\ProductCategoryFilterGuiToProductCategoryQueryContainerBridge;
use Spryker\Zed\ProductCategoryFilterGui\Dependency\Service\ProductCategoryFilterGuiToUtilEncodingServiceBridge;

/**
 * @method \Spryker\Zed\ProductCategoryFilterGui\ProductCategoryFilterGuiConfig getConfig()
 */
class ProductCategoryFilterGuiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_PRODUCT_CATEGORY_FILTER = 'FACADE_PRODUCT_CATEGORY_FILTER';

    /**
     * @var string
     */
    public const FACADE_LOCALE = 'FACADE_LOCALE';

    /**
     * @var string
     */
    public const FACADE_CATEGORY = 'FACADE_CATEGORY';

    /**
     * @var string
     */
    public const FACADE_PRODUCT = 'FACADE_PRODUCT';

    /**
     * @var string
     */
    public const FACADE_PRODUCT_SEARCH = 'FACADE_PRODUCT_SEARCH';

    /**
     * @var string
     */
    public const QUERY_CONTAINER_CATEGORY = 'QUERY_CONTAINER_CATEGORY';

    /**
     * @var string
     */
    public const QUERY_CONTAINER_PRODUCT_CATEGORY = 'QUERY_CONTAINER_PRODUCT_CATEGORY';

    /**
     * @var string
     */
    public const CLIENT_CATALOG = 'CLIENT_CATALOG';

    /**
     * @var string
     */
    public const CLIENT_PRODUCT_CATEGORY_FILTER = 'CLIENT_PRODUCT_CATEGORY_FILTER';

    /**
     * @var string
     */
    public const SERVICE_UTIL_ENCODING = 'SERVICE_UTIL_ENCODING';

    /**
     * @var string
     */
    public const PLUGINS_PRODUCT_CATEGORY_LIST_ACTION_VIEW_DATA_EXPANDER = 'PLUGINS_PRODUCT_CATEGORY_LIST_ACTION_VIEW_DATA_EXPANDER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container)
    {
        $this->addProductCategoryFilterFacade($container);
        $this->addLocaleFacade($container);
        $this->addCategoryFacade($container);
        $this->addProductSearchFacade($container);
        $this->addProductFacade($container);
        $this->addCategoryQueryContainer($container);
        $this->addCatalogClient($container);
        $this->addProductCategoryFilterClient($container);
        $this->addUtilEncodingService($container);
        $this->addProductCategoryListActionViewDataExpanderPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container)
    {
        $this->addCategoryQueryContainer($container);
        $this->addProductCategoryQueryContainer($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return void
     */
    protected function addUtilEncodingService(Container $container)
    {
        $container->set(static::SERVICE_UTIL_ENCODING, function (Container $container) {
            return new ProductCategoryFilterGuiToUtilEncodingServiceBridge($container->getLocator()->utilEncoding()->service());
        });
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductCategoryFilterFacade(Container $container)
    {
        $container->set(static::FACADE_PRODUCT_CATEGORY_FILTER, function (Container $container) {
            return new ProductCategoryFilterGuiToProductCategoryFilterFacadeBridge($container->getLocator()->productCategoryFilter()->facade());
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCategoryQueryContainer(Container $container)
    {
        $container->set(static::QUERY_CONTAINER_CATEGORY, function (Container $container) {
            return new ProductCategoryFilterGuiToCategoryQueryContainerBridge($container->getLocator()->category()->queryContainer());
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductCategoryQueryContainer(Container $container)
    {
        $container->set(static::QUERY_CONTAINER_PRODUCT_CATEGORY, function (Container $container) {
            return new ProductCategoryFilterGuiToProductCategoryQueryContainerBridge($container->getLocator()->productCategory()->queryContainer());
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return void
     */
    protected function addLocaleFacade(Container $container)
    {
        $container->set(static::FACADE_LOCALE, function (Container $container) {
            return new ProductCategoryFilterGuiToLocaleFacadeBridge($container->getLocator()->locale()->facade());
        });
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return void
     */
    protected function addCategoryFacade(Container $container)
    {
        $container->set(static::FACADE_CATEGORY, function (Container $container) {
            return new ProductCategoryFilterGuiToCategoryFacadeBridge($container->getLocator()->category()->facade());
        });
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return void
     */
    protected function addProductSearchFacade(Container $container)
    {
        $container->set(static::FACADE_PRODUCT_SEARCH, function (Container $container) {
            return new ProductCategoryFilterGuiToProductSearchFacadeBridge($container->getLocator()->productSearch()->facade());
        });
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return void
     */
    protected function addProductFacade(Container $container)
    {
        $container->set(static::FACADE_PRODUCT, function (Container $container) {
            return new ProductCategoryFilterGuiToProductFacadeBridge($container->getLocator()->product()->facade());
        });
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return void
     */
    protected function addCatalogClient(Container $container)
    {
        $container->set(static::CLIENT_CATALOG, function (Container $container) {
            return new ProductCategoryFilterGuiToCatalogClientBridge($container->getLocator()->catalog()->client());
        });
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return void
     */
    protected function addProductCategoryFilterClient(Container $container)
    {
        $container->set(static::CLIENT_PRODUCT_CATEGORY_FILTER, function (Container $container) {
            return new ProductCategoryFilterGuiToProductCategoryFilterClientBridge($container->getLocator()->productCategoryFilter()->client());
        });
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductCategoryListActionViewDataExpanderPlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_PRODUCT_CATEGORY_LIST_ACTION_VIEW_DATA_EXPANDER, function () {
            return $this->getProductCategoryListActionViewDataExpanderPlugins();
        });

        return $container;
    }

    /**
     * @return array<\Spryker\Zed\ProductCategoryFilterGuiExtension\Dependency\Plugin\ProductCategoryListActionViewDataExpanderPluginInterface>
     */
    protected function getProductCategoryListActionViewDataExpanderPlugins(): array
    {
        return [];
    }
}
