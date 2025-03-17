<?php
/**
 * Copyright © Panca, Inc. All rights reserved.
 */
namespace Panca\HidePrice\Pricing\Price\Plugin;

use Magento\Catalog\Pricing\Price\BasePrice;
use Magento\Catalog\Pricing\Price\TierPrice;
use Panca\HidePrice\Model\DefaultConfigProvider;

class SimpleTierPrice
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
     * Adjustment for Tier Price load
     *
     * @param TierPrice $subject
     * @param callable $proceed
     * @return float|bool
     */
    public function aroundGetValue(
        TierPrice $subject,
        callable $proceed
    ) {
        if ($this->disableTierPriceLoad()) {
            return $subject->getProduct()->getPrice();
        }

        return $proceed();
    }

    /**
     * Adjustment for Tier Price List load
     *
     * @param TierPrice $subject
     * @param callable $proceed
     * @return array
     */
    public function aroundGetTierPriceList(
        TierPrice $subject,
        callable $proceed
    ) {
        if ($this->disableTierPriceLoad()) {
            return [];
        }

        return $proceed();
    }

    /**
     * Whether the Tier Price Load is disabled
     *
     * @return bool
     */
    public function disableTierPriceLoad(): bool
    {
        $hidePrice = $this->configProvider->hidePrices();
        $loadTierPrice = $this->configProvider->getPriceLoadConfig(DefaultConfigProvider::XML_KEY_LOAD_TIER_PRICE);

        return $hidePrice && !$loadTierPrice;
    }
}
