<?php

class Joc_Latch_Helper_Data extends Mage_Core_Helper_Abstract {
    
    const LATCH_APPLICATION_ID_PATH = 'latch/api_settings/app_id';
    const LATCH_SECRET_KEY_PATH     = 'latch/api_settings/app_secret_key';
    const LATCH_API_URL_PATH        = 'latch/api_settings/app_api_url';
    
    public function getApplicationId() {
        return $this->_getConfig(self::LATCH_APPLICATION_ID_PATH);
    }
    
    public function getSecretKey() {
        return $this->_getConfig(self::LATCH_SECRET_KEY_PATH);
    }
    
    public function getApiUrl() {
        return $this->_getConfig(self::LATCH_API_URL_PATH);
    }
    
    protected function _getConfig($path) {
        return Mage::getStoreConfig($path);
    }
    
}
