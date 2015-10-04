<?php

class Joc_Latch_Model_Adminhtml_Observer {
    
    /**
     * 
     */
    public function saveAdmin($observer) {
        $user = $observer->getEvent()->getObject();
        $token = Mage::app()->getRequest()->getPost('token', false);

        if($token) {
            /* @var $latchHelper Joc_Latch_Helper_Data */
            $latchHelper = Mage::helper('latch');
            $result = $latchHelper->pair($token, $user);
            
            if($result['status'] == 1) {
                Mage::getSingleton('core/session')->addSuccess($result['message']); 
            } else {
                Mage::getSingleton('core/session')->addError($result['message']);
            }
        } else {
            $unlinkAccount = Mage::app()->getRequest()->getPost('unlink_latch', false);
            
            if($unlinkAccount == 1){
                /* @var $latchHelper Joc_Latch_Helper_Data */
                $latchHelper = Mage::helper('latch');
                $result = $latchHelper->unpair($user);

                if($result['status'] == 1) {
                    Mage::getSingleton('core/session')->addSuccess($result['message']); 
                } else {
                    Mage::getSingleton('core/session')->addError($result['message']);
                }
            }
        }
    }
    
    /**
     * 
     * @param type $observer
     * @return void
     */
    public function adminLogin($observer) {
//        $customer = $observer->getEvent()->getCustomer();
//        $session = Mage::getSingleton('customer/session');
//
//        if ($latchId = $customer->getData('latch_id')) {
//            /* @var $latchHelper Joc_Latch_Helper_Data */
//            $latchHelper = Mage::helper('latch');
//            $latchEnabled = $latchHelper->getIfLatchEnabled($latchId, $customer->getId());
//
//            if($latchEnabled['status'] == 1) {
//                $session->setId(null)
//                    ->setCustomerGroupId(Mage_Customer_Model_Group::NOT_LOGGED_IN_ID)
//                    ->getCookie()->delete('customer');
//                Mage::getSingleton('core/session')->addError($latchEnabled['message']);
//            }
//            
//            return;
//        }
    }

}
