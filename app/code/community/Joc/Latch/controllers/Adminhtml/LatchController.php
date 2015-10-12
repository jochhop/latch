<?php

class Joc_Latch_Adminhtml_LatchController extends Mage_Adminhtml_Controller_Action {
    
    /**
     * Render Latch settings in administration "My account"
     */
    public function myaccountAction() {
        $this->loadLayout();
        $this->renderLayout();
    }
    
    /**
     * Link Latch account by "My account" form
     */
    public function linkAction() {
        /* @var $user Mage_Admin_Model_User */
        $user = Mage::getSingleton('admin/session')->getUser();
        $token = $this->getRequest()->getPost('token', false);
        
        if($user && $token) {
            /* @var $latchHelper Joc_Latch_Helper_Data */
            $latchHelper = Mage::helper('latch');
            Mage::getSingleton('core/session')->setAdminMustSave(true);
            $result = $latchHelper->pairAdmin($token, $user);
            
            if(array($result)) {
                if($result['status']){
                    Mage::getSingleton('core/session')->addSuccess($result['message']);
                }else{
                    Mage::getSingleton('core/session')->addError($result['message']);
                }
            } else {
                Mage::getSingleton('core/session')->addError($result);
            }
        } else { 
            Mage::getSingleton('core/session')->addError(Mage::helper('latch')->__("Couldn't link Latch account. Data was no valid."));
        }
        
        $this->_redirect('*/*/myaccount');
        return;
    }
    
    /**
     * Unlink Latch account by "My account" form
     */
    public function unlinkAction() {
        /* @var $user Mage_Admin_Model_User */
        $user = Mage::getSingleton('admin/session')->getUser();
        
        if($user && $this->getRequest()->getPost('unlink_latch') == 1) {
            /* @var $latchHelper Joc_Latch_Helper_Data */
            $latchHelper = Mage::helper('latch');
            Mage::getSingleton('core/session')->setAdminMustSave(true);
            $result = $latchHelper->unpairAdmin($user);

            if(array($result)) {
                if($result['status'] == 1){
                    Mage::getSingleton('core/session')->addSuccess($result['message']);
                }else{
                    Mage::getSingleton('core/session')->addError($result['message']);
                }
            } else {
                Mage::getSingleton('core/session')->addNotice($result);
            }
        } else {
            Mage::getSingleton('core/session')->addError(Mage::helper('latch')->__("Couldn't unlink Latch account. Data was no valid."));
        }
        
        $this->_redirect('*/*/myaccount');
        return;
    }

}
