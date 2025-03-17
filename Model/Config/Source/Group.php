<?php
/**
 * Copyright © Panca, Inc. All rights reserved.
 */
namespace Panca\HidePrice\Model\Config\Source;

use Magento\Customer\Model\Customer\Source\GroupSourceInterface;

class Group implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var array
     */
    protected $_options;

    /**
     * @var GroupSourceInterface
     */
    private $groupSource;

    /**
     * @param GroupSourceInterface $groupSource
     */
    public function __construct(
        GroupSourceInterface $groupSource
    ) {
        $this->groupSource = $groupSource;
    }

    /**
     * @inheritdoc
     */
    public function toOptionArray(): array
    {
        if (!$this->_options) {
            $this->_options = $this->groupSource->toOptionArray();
        }

        return $this->_options;
    }
}
