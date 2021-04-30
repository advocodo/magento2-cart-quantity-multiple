<?php

namespace Advocodo\CartQuantityMultiple\Observer;

use Magento\Checkout\Model\Cart as CustomerCart;
use Magento\Framework\App\Response\RedirectInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Message\ManagerInterface;
use Advocodo\CartQuantityMultiple\Helper\Data as HelperData;

class ValidateCartObserver implements ObserverInterface
{
    /**
     * @var ManagerInterface
     */
    protected $messageManager;

    /**
     * @var RedirectInterface
     */
    protected $redirect;

    /**
     * @var CustomerCart
     */
    protected $cart;

    /**
     * @var HelperData
     */
    protected $helperData;

    /**
     * @param ManagerInterface $messageManager
     * @param RedirectInterface $redirect
     * @param CustomerCart $cart
     * @param HelperData $helperData
     */
    public function __construct(
        ManagerInterface $messageManager,
        RedirectInterface $redirect,
        CustomerCart $cart,
        HelperData $helperData
    ) {
        $this->messageManager = $messageManager;
        $this->redirect = $redirect;
        $this->cart = $cart;

        $this->helperData = $helperData;
    }

    /**
     * Validate Cart Before going to checkout
     * - event: controller_action_predispatch_checkout_index_index
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        if (!$this->helperData->getConfigFlag('enable')) {
            return;
        }

        if (!$this->helperData->getConfigFlag('block_ordering')) {
            return;
        }

        /** Get quote data from current cart */
        $quote = $this->cart->getQuote();

        /** Get the Controller Action */
        $controller = $observer->getControllerAction();

        /** Multiplier */
        $multiplier = $this->helperData->getConfig('multiplier');

        /** Error message */
        $errorMessage = $this->helperData->getConfig('error_message');

        /** Array with excluded category ID's */
        if (empty($this->helperData->getConfig('excluded_categories'))) {
            $excludedCats = [];
        } else {
            $excludedCats = explode(',', $this->helperData->getConfig('excluded_categories'));
        }

        /* Set cart quantity to zero */
        $totalQty = 0;

        foreach ($quote->getAllVisibleItems() as $item) {
            /** Set check counter to 0 */
            $count = 0;

            /** Get category ID's this item is linked to */
            $cats = $item->getProduct()->getCategoryIds();

            /** Check if any of there ID's is in the excluded array */
            foreach ($cats as $cat) {
                if (in_array($cat, $excludedCats)) {
                    /** If so, up counter value */
                    $count++;
                }
            }
            /** Only if category is not in the excluded list, count as totalQty */
            if ($count == 0) {
                $totalQty += $item->getQty();
            }
        }

        if (0 != $totalQty % $multiplier) {
            /** This adds error message and add error to the Quote */
            $message = str_replace('%', $multiplier, $errorMessage);
            $this->messageManager->addErrorMessage(__($message));
            $this->redirect->redirect($controller->getResponse(), 'checkout/cart');
        }
    }
}
