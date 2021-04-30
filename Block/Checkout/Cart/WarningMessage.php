<?php

namespace Advocodo\CartQuantityMultiple\Block\Checkout\Cart;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Advocodo\CartQuantityMultiple\Helper\Data;

class WarningMessage extends Template
{
    /**
     * @var Data
     */
    private $helperData;

    /**
     * Config constructor.
     * @param Context $context
     * @param Data $coreHelper
     */
    public function __construct(
        Context $context,
        Data $coreHelper,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->helperData = $coreHelper;
    }

    public function getDisplayPermanentWarningMessage(): bool
    {
        return $this->helperData->getConfigFlag('display_permanent_warning_message');
    }

    public function getPermanentWarningMessage(): string
    {
        $multiplier = $this->helperData->getConfig('multiplier');
        $warringMessage = $this->helperData->getConfig('permanent_warning_message');

        return str_replace('%', $multiplier, $warringMessage);
    }
}
