<?php
/**
 * Copyright © Panca, Inc. All rights reserved.
 */
namespace Panca\HidePrice\Model;

interface ConfigProviderInterface
{
    /**
     * Retrieve assoc array of Hide Price configuration
     *
     * @return array
     */
    public function getConfig();
}
