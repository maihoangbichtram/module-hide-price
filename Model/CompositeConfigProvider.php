<?php
/**
 * Copyright © Panca, Inc. All rights reserved.
 */
namespace Panca\HidePrice\Model;

class CompositeConfigProvider implements ConfigProviderInterface
{
    /**
     * @var ConfigProviderInterface[]
     */
    private $configProviders;

    /**
     * @param ConfigProviderInterface[] $configProviders
     * @codeCoverageIgnore
     */
    public function __construct(
        array $configProviders
    ) {
        $this->configProviders = $configProviders;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig()
    {
        $config = [];
        foreach ($this->configProviders as $configProvider) {
            $config = array_merge_recursive($config, $configProvider->getConfig());
        }
        return $config;
    }
}
