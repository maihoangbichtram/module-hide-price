<?php
/**
 * Copyright © Panca, Inc. All rights reserved.
 */
namespace Panca\HidePrice\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Customer\Api\Data\GroupInterface;

class DefaultConfigProvider implements ConfigProviderInterface
{
    /**
     * Configuration path for 'general' group
     */
    const XML_PATH_GENERAL = 'hide_price/general/';

    /**
     * Configuration path for 'price load' group
     */
    const XML_PATH_PRICE_LOAD = 'hide_price/price_load/';

    /**
     * Configuration key for 'Enable Hide Price' field
     */
    const XML_KEY_ENABLE_HIDE_PRICE = 'enabled';

    /**
     * Configuration key for 'Price Text' field
     */
    const XML_KEY_PRICE_TEXT = 'price_text';

    /**
     * Configuration key for 'customer group' field
     */
    const XML_KEY_CUSTOMER_GROUP_TO_HIDE_PRICE = 'customer_group';

    /**
     * Configuration key for 'Disable Add To Cart' field
     */
    const XML_KEY_DISABLE_ADD_TO_CART = 'disable_add_to_cart';

    /**
     * Configuration key for 'Load Base Price' field
     */
    const XML_KEY_LOAD_BASE_PRICE = 'load_base_price';

    /**
     * Configuration key for 'Load Tier Price' field
     */
    const XML_KEY_LOAD_TIER_PRICE = 'load_tier_price';

    /**
     * Configuration key for 'Load Minimal Price' field
     */
    const XML_KEY_LOAD_MINIMAL_PRICE = 'load_minimal_price';

    /**
     * Configuration key for 'Load Final Price' field
     */
    const XML_KEY_LOAD_FINAL_PRICE = 'load_final_price';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;

    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param \Magento\Customer\Model\Session $customerSession
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        \Magento\Customer\Model\Session $customerSession
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->customerSession = $customerSession;
    }

    /**
     * Returns 'general' config value
     *
     * @param string $key
     * @param \Magento\Store\Model\Store $store
     * @return \Magento\Framework\App\Config\Element
     */
    public function getGeneralConfig($key, $store = null)
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_GENERAL . $key,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );
    }

    /**
     * Returns 'price load' config value
     *
     * @param string $key
     * @param \Magento\Store\Model\Store $store
     * @return \Magento\Framework\App\Config\Element
     */
    public function getPriceLoadConfig($key, $store = null)
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_PRICE_LOAD . $key,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );
    }

    /**
     * Returns if 'Hide Price' is enabled
     *
     * @param \Magento\Store\Model\Store $store
     * @return bool
     */
    public function hidePrices($store = null): bool
    {
        $hidePriceEnabled =  $this->scopeConfig->getValue(
            self::XML_PATH_GENERAL . self::XML_KEY_ENABLE_HIDE_PRICE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );

        $groupsToHidePrice =  $this->scopeConfig->getValue(
            self::XML_PATH_GENERAL . self::XML_KEY_CUSTOMER_GROUP_TO_HIDE_PRICE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );

        $customerGroupId = $this->customerSession->getCustomerGroupId();

        return $hidePriceEnabled && ((int)$groupsToHidePrice === GroupInterface::CUST_GROUP_ALL ||  in_array($customerGroupId, explode(',', $groupsToHidePrice)));
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig(): array
    {
        $config = [
            'disableAddToCart' => (boolean)$this->getGeneralConfig(self::XML_KEY_DISABLE_ADD_TO_CART),
        ];
        return $config;
    }
}
