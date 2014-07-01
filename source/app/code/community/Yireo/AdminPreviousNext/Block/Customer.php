<?php
/**
 * Yireo AdminPreviousNext for Magento 
 *
 * @package     Yireo_AdminPreviousNext
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright (c) 2014 Yireo (http://www.yireo.com/)
 * @license     Open Source License
 */

/**
 * AdminPreviousNext Abstract block
 */
class Yireo_AdminPreviousNext_Block_Customer extends Yireo_AdminPreviousNext_Block_Abstract
{
    public function getPrevious()
    {
        $customerIds = $this->getCustomerIds();
        $currentId = Mage::registry('current_customer')->getId();
        $currentKey = array_search($currentId, $customerIds);
        $previousKey = $currentKey - 1;
        if($previousKey >= 0 && isset($customerIds[$previousKey])) {
            $previousId = $customerIds[$previousKey];
            $previous = Mage::getModel('customer/customer')->load($previousId);
            $previous->setUrl(Mage::helper('adminhtml')->getUrl('adminhtml/customer/edit', array('id' => $previousId)));
            $previous->setLabel(Mage::helper('adminpreviousnext')->__('Previous'));
            return $previous;
        }
    }

    public function getNext()
    {
        $customerIds = $this->getCustomerIds();
        $currentId = Mage::registry('current_customer')->getId();
        $currentKey = array_search($currentId, $customerIds);
        $nextKey = $currentKey + 1;
        if(isset($customerIds[$nextKey])) {
            $nextId = $customerIds[$nextKey];
            $next = Mage::getModel('customer/customer')->load($previousId);
            $next->setUrl(Mage::helper('adminhtml')->getUrl('adminhtml/customer/edit', array('id' => $nextId)));
            $next->setLabel(Mage::helper('adminpreviousnext')->__('Next'));
            return $next;
        }
    }

    public function getCustomerIds()
    {
        $collection = Mage::getModel('customer/customer')->getCollection();
        $customerIds = $collection->getAllIds();
        return $customerIds;
    }
}
