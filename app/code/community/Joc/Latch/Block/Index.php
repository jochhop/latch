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
}
