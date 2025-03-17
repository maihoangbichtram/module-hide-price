<?php
/**
 * Copyright © Panca, Inc. All rights reserved.
 */
namespace Panca\HidePrice\Pricing\Price\Plugin;

use Magento\Catalog\Model\Layer\Category\CollectionFilter;
use Magento\Catalog\Pricing\Price\BasePrice;
use Panca\HidePrice\Model\DefaultConfigProvider;
class SimpleBasePrice
{
    /**
     * @var DefaultConfigProvider
     */
    protected $configProvider;

    /**
     * @param DefaultConfigProvider $configProvider
     */
    public function __construct(
        DefaultConfigProvider $configProvider
    ) {
        $this->configProvider = $configProvider;
    }

    /**
     * Adjustment for Base Price load
     *
     * @param BasePrice $subject
     * @param callable $proceed
     * @return float|bool
     */
    public function aroundGetValue(
        BasePrice $subject,
        callable $proceed
    ) {
        $hidePrice = $this->configProvider->hidePrices();
        $loadBasePrice = $this->configProvider->getPriceLoadConfig(DefaultConfigProvider::XML_KEY_LOAD_BASE_PRICE);;

        if ($hidePrice && !$loadBasePrice) {
            return $subject->getProduct()->getPrice();
        }

        return $proceed();
    }
}
