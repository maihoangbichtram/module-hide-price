<?php
/**
 * Copyright © Panca, Inc. All rights reserved.
 */
namespace Panca\HidePrice\Model\Layer\Category\Plugin;

use Magento\Catalog\Model\Layer\Category\CollectionFilter;
use Panca\HidePrice\Model\DefaultConfigProvider;

class SimpleCollectionFilter
{
    /**
     * Catalog product visibility
     *
     * @var \Magento\Catalog\Model\Product\Visibility
     */
    protected $productVisibility;

    /**
     * Catalog config
     *
     * @var \Magento\Catalog\Model\Config
     */
    protected $catalogConfig;

    /**
     * @var DefaultConfigProvider
     */
    protected $configProvider;

    /**
     * @param \Magento\Catalog\Model\Product\Visibility $productVisibility
     * @param \Magento\Catalog\Model\Config $catalogConfig
     * @param DefaultConfigProvider $configProvider
     */
    public function __construct(
        \Magento\Catalog\Model\Product\Visibility $productVisibility,
        \Magento\Catalog\Model\Config $catalogConfig,
        DefaultConfigProvider $configProvider
    ) {
        $this->productVisibility = $productVisibility;
        $this->catalogConfig = $catalogConfig;
        $this->configProvider = $configProvider;
    }

    /**
     * Price data adjustments
     *
     * @param CollectionFilter $subject
     * @param callable $proceed
     * @param \Magento\Catalog\Model\ResourceModel\Product\Collection $collection
     * @param \Magento\Catalog\Model\Category $category
     * @return void
     */
    public function aroundFilter(
        CollectionFilter $subject,
        callable $proceed,
        $collection,
        \Magento\Catalog\Model\Category $category
    ) {
        $hidePrice = $this->configProvider->hidePrices();
        $loadMinimalPrice = $this->configProvider->getPriceLoadConfig(DefaultConfigProvider::XML_KEY_LOAD_MINIMAL_PRICE);
        $loadFinalPrice = $this->configProvider->getPriceLoadConfig(DefaultConfigProvider::XML_KEY_LOAD_FINAL_PRICE);

        $collection
            ->addAttributeToSelect($this->catalogConfig->getProductAttributes())
            // ->addMinimalPrice()
            // ->addFinalPrice()
            ->addTaxPercents()
            ->addUrlRewrite($category->getId())
            ->setVisibility($this->productVisibility->getVisibleInCatalogIds());

        if (!$hidePrice || $loadMinimalPrice) {
            $collection->addMinimalPrice();
        }

        if (!$hidePrice || $loadFinalPrice) {
            $collection->addFinalPrice();
        }
    }
}
