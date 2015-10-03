<?php

class Joc_Latch_IndexController extends Mage_Core_Controller_Front_Action {
    
    public function indexAction() {
        if(!$this->_checkIsLoggedIn()) {
            $this->norouteAction();
            return;
        }
        
        $this->loadLayout();
        $this->renderLayout();
    }
    
    public function savetokenAction() {
        if(!$this->_checkIsLoggedIn() || !$this->getRequest()->getPost('latch_token', false)) {
            $this->norouteAction();
            return;
        }
        
        /* @var $latchHelper Joc_Latch_Helper_Data */
        $latchHelper = Mage::helper('latch');
        $appId = $latchHelper->getApplicationId();
        $appSecret = $latchHelper->getSecretKey();
        $apiUrl = $latchHelper->getApiUrl();
        $token = $this->getRequest()->getPost('latch_token');
        
        if($apiUrl){
            $api = new Latch($appId, $appSecret, $apiUrl);
        }else{
            $api = new Latch($appId, $appSecret);
        }
        
        $apiResponse = $api->pair($token);
        $responseData = $apiResponse->getData();
        
        if(!empty($responseData)) {
                $accountId = $responseData->{"accountId"};
        }
        if(!empty($accountId)) {
            $customer = Mage::getSingleton('customer/session')->getCustomer();
            $customer->setData('latch_id', $accountId);
            
            try {
                $customer->save();
            } catch (Exception $ex) {
                Mage::getSingleton('core/session')->addError($latchHelper->__("Couldn't link the given token with Latch: ") . $latchHelper->__($ex->getMessage()));
                $this->_redirect('*/*/index');
                return;
            }
        } elseif ($apiResponse->getError() == NULL) {
            Mage::getSingleton('core/session')->addError($latchHelper->__("Latch pairing error: Cannot connect to the server. Please, try again later."));
        } else {
            Mage::getSingleton('core/session')->addError($latchHelper->__("Couldn't link the given token with Latch: ") . $latchHelper->__($apiResponse->getError()->getMessage()));
        }
					
    }
    
    protected function _checkIsLoggedIn() {
        return Mage::getSingleton('customer/session')->isLoggedIn();
    }
    
}

