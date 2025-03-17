<?php
/**
 * Copyright © Panca, Inc. All rights reserved.
 */
namespace Panca\HidePrice\Block;

use Magento\Customer\Model\Customer\Source\GroupSourceInterface;
use Panca\HidePrice\Model\CompositeConfigProvider;

class Config extends \Magento\Framework\View\Element\Template
{
    /**
     * @var CompositeConfigProvider
     */
    private $configProvider;

    /**
     * @var \Magento\Framework\Serialize\Serializer\Json
     */
    private $serializer;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\Serialize\Serializer\Json $serializer
     * @param CompositeConfigProvider $configProvider
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Serialize\Serializer\Json $serializer,
        CompositeConfigProvider $configProvider,
        array $data = []
    ) {
        $this->serializer = $serializer;
        $this->configProvider = $configProvider;
        parent::__construct($context, $data);
    }

    /**
     * Retrieve Hide Price configuration
     *
     * @return array
     * @codeCoverageIgnore
     */
    public function getHidePriceConfig(): array
    {
        return $this->configProvider->getConfig();
    }

    /**
     * Get Serialized Hide Price Config
     *
     * @return bool|string
     */
    public function getSerializedHidePriceConfig(): bool|string
    {
        return $this->serializer->serialize($this->getHidePriceConfig());
    }
}
