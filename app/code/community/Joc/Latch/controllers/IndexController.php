<?php

class Joc_Latch_IndexController extends Mage_Core_Controller_Front_Action {
    
    /**
     * Render Latch customer dashboard form
     * 
     * @return void
     */
    public function indexAction() {
        if(!$this->_checkIsLoggedIn()) {
            $this->norouteAction();
            return;
        }
        
        $this->loadLayout();
        $this->renderLayout();
    }
    
    /**
     * Save token and pair account with Latch
     * 
     * @return void
     */
    public function savetokenAction() {
        if(!$this->_checkIsLoggedIn() || !$this->getRequest()->getPost('latch_token', false)) {
            $this->norouteAction();
            return;
        }
        
        /* @var $latchHelper Joc_Latch_Helper_Data */
        $latchHelper = Mage::helper('latch');
        $token = $this->getRequest()->getPost('latch_token');
        $result = $latchHelper->pairCustomer($token);
        
        if(array($result)) {
            if($result['status']){
                Mage::getSingleton('core/session')->addSuccess($result['message']);
            }else{
                Mage::getSingleton('core/session')->addError($result['message']);
            }
        } else {
            Mage::getSingleton('core/session')->addError($result);
        }
        
        $this->_redirect('*/*/index');
        return;
    }
    
    /**
     * Unlink an account with Latch
     * 
     * @return void
     */
    public function unlinkaccountAction() {
        if(!$this->_checkIsLoggedIn()) {
            $this->norouteAction();
            return;
        }
        
        if($this->getRequest()->getPost('unlink_latch') == 1) {
            /* @var $latchHelper Joc_Latch_Helper_Data */
            $latchHelper = Mage::helper('latch');
            $result = $latchHelper->unpairCustomer();

            if(array($result)) {
                if($result['status'] == 1){
                    Mage::getSingleton('core/session')->addSuccess($result['message']);
                }else{
                    Mage::getSingleton('core/session')->addError($result['message']);
                }
            } else {
                Mage::getSingleton('core/session')->addNotice($result);
            }
        }
        
        $this->_redirect('*/*/index');
        return;
    }
    
    /**
     * Check if customer is logged in
     * 
     * @return bool
     */
    protected function _checkIsLoggedIn() {
        return Mage::getSingleton('customer/session')->isLoggedIn();
    }
    
}

