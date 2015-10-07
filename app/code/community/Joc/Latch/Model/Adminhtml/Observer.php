<?php

class Joc_Latch_Model_Adminhtml_Observer {
    
    /**
     * Observer which fires Latch pair/unpair when admin user is saved
     */
    public function saveAdmin($observer) {
        $user = $observer->getEvent()->getObject();
        $token = Mage::app()->getRequest()->getPost('token', false);

        if($token) {
            /* @var $latchHelper Joc_Latch_Helper_Data */
            $latchHelper = Mage::helper('latch');
            $result = $latchHelper->pairAdmin($token, $user);
            
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
                $result = $latchHelper->unpairAdmin($user);

                if($result['status'] == 1) {
                    Mage::getSingleton('core/session')->addSuccess($result['message']); 
                } else {
                    Mage::getSingleton('core/session')->addError($result['message']);
                }
            }
        }
    }
    
    /**
     * Observer which fires Latch detection on admin log in
     */
    public function adminLogin($observer) {
        $user = $observer->getEvent()->getUser();

        if($user) {
            /* @var $user Mage_Admin_Model_User */
            $adminModel = Mage::getModel('admin/user');

            if ($latchId = $user->getData('latch_id')) {
                /* @var $latchHelper Joc_Latch_Helper_Data */
                $latchHelper = Mage::helper('latch');
                $latchEnabled = $latchHelper->getIfAdminLatchEnabled($latchId, $user);

                if($latchEnabled['status'] == 1) {
                    /* @var $adminSession Mage_Admin_Model_Session */
                    $adminSession = Mage::getSingleton('admin/session');
                    $adminSession->unsetAll();
                    $adminSession->getCookie()->delete($adminSession->getSessionName());
                    Mage::getSingleton('core/session')->addError("Invalid User Name or Password");

                    Mage::app()->getResponse()->setRedirect('*');
                    return;
                }
            }
        }
        
        return $this;
    }

}
