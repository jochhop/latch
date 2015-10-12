<?php

class Joc_Latch_Block_Adminhtml_Latch_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

    /**
     * Prepare container for insert the edit form
     */
    public function __construct() {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'latch';
        $this->_controller = 'adminhtml_latch';
        $this->_mode = 'edit';
        $this->removeButton('reset');
        
        $this->_updateButton('save', 'label', Mage::helper('latch')->__('Confirm action'));
    }

    /**
     * Return header text
     * 
     * @return string
     */
    public function getHeaderText() {
        return Mage::helper('latch')->__("My Account: Latch Settings");
    }

}
