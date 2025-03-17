<?php
/**
 * Copyright © Panca, Inc. All rights reserved.
 */
namespace Panca\HidePrice\Plugin\Pricing\Render;

use Panca\HidePrice\Model\DefaultConfigProvider;

class FinalPriceBox
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
     * @param \Magento\Catalog\Pricing\Render\FinalPriceBox $subject
     * @param string $result
     * @return string
     */
    function afterToHtml(
        \Magento\Catalog\Pricing\Render\FinalPriceBox $subject,
        $result
    ) {
        $hidePrice = $this->configProvider->hidePrices();

        if ($hidePrice) {
            return $this->configProvider->getGeneralConfig(DefaultConfigProvider::XML_KEY_PRICE_TEXT);
        } else {
            return $result;
        }
    }
}
