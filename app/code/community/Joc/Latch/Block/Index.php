<?php

class Joc_Latch_Block_Index extends Mage_Core_Block_Template {

    /**
     * Constructor which renders the template for the Latch tab on customer dashboard
     */
    protected function _construct() {
        parent::_construct();
        $this->setTemplate('latch/customer/account/dashboard/latch.phtml');
    }

    /**
     * Return the form action url
     * 
     * @return string
     */
    public function getFormActionUrl() {
        return $this->getUrl('*/*/savetoken');
    }
    
    /**
     * Return the form unlink action url
     * 
     * @return string
     */
    public function getFormUnlinkActionUrl() {
        return $this->getUrl('*/*/unlinkaccount');
    }
    
    /**
     * Get current customer
     * 
     * @return Mage_Customer_Model_Customer
     */
    public function getCurrentCustomer() {
        return Mage::getSingleton('customer/session')->getCustomer();
    }
}
