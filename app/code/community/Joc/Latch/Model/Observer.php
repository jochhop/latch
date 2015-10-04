<?php

class Joc_Latch_Model_Observer {

    /**
     * 
     * @param type $observer
     * @return void
     */
    public function customerLogin($observer) {
        $customer = $observer->getEvent()->getCustomer();
        $session = Mage::getSingleton('customer/session');

        if ($latchId = $customer->getData('latch_id')) {
            /* @var $latchHelper Joc_Latch_Helper_Data */
            $latchHelper = Mage::helper('latch');
            $latchEnabled = $latchHelper->getIfLatchEnabled($latchId, $customer->getId());

            if($latchEnabled['status'] == 1) {
                $session->setId(null)
                    ->setCustomerGroupId(Mage_Customer_Model_Group::NOT_LOGGED_IN_ID)
                    ->getCookie()->delete('customer');
                Mage::getSingleton('core/session')->addError($latchEnabled['message']);
            }
            
            return;
        }
    }

}
