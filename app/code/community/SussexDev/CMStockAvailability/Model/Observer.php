<?php
/*
 * @package    SussexDev_CMStockAvailability
 * @copyright  Copyright (c) 2019 Scott Parsons
 * @license    https://github.com/ScottParsons/magento-creditmemo-stockavailability/blob/master/LICENSE.md
 * @version    1.0.0
 */
class SussexDev_CMStockAvailability_Model_Observer
{
    /**
     * System configuration path
     */
    const XML_PATH_CM_STOCK_AVAILABILTY = 'cataloginventory/item_options/update_stockavailability';

    /**
     * Return creditmemo items qty to stock
     *
     * @param Varien_Event_Observer $observer
     */
    public function refundOrderInventory($observer)
    {
        if ($this->isModuleEnabled()) {
            $creditmemo = $observer->getEvent()->getCreditmemo();
            foreach ($creditmemo->getAllItems() as $item) {
                $return = false;
                if ($item->hasBackToStock()) {
                    if ($item->getBackToStock() && $item->getQty()) {
                        $return = true;
                    }
                } elseif (Mage::helper('cataloginventory')->isAutoReturnEnabled()) {
                    $return = true;
                }

                if ($return) {
                    $productId = $item->getProductId();
                    $product = Mage::getModel('catalog/product')->load($productId);

                    if (!$product->isConfigurable()) {
                        $stockItem = $product->getStockItem();
                        $stockItem->setIsInStock(1);
                        $stockItem->save();
                    }
                }
            }
        }
    }

    /**
     * Check if module has been enabled in the admin
     *
     * @return bool
     */
    public function isModuleEnabled()
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_CM_STOCK_AVAILABILTY);
    }
}
