<?php

class Joc_Latch_Block_Adminhtml_Latch_Edit_Form extends Mage_Adminhtml_Block_Widget_Form {

    /**
     * Render Latch settings form
     * 
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm() {
        $user = $this->_getCurrentAdminUser();
        
        if($user->getData('latch_id')) {
            $postUrl = $this->getUrl('*/*/unlink');
        } else {
            $postUrl = $this->getUrl('*/*/link');
        }
        
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $postUrl,
            'method' => 'post'
        ));
        
        $fieldset = $form->addFieldset('base_fieldset', array('legend' => Mage::helper('latch')->__('Latch Settings')));
        
        if($user->getData('latch_id')){
            $fieldset->addField('unlink_latch', 'checkbox', array(
                'name' => 'unlink_latch',
                'label' => Mage::helper('latch')->__('Unlink Latch Account') . '*',
                'id' => 'unlink_latch',
                'value' => 1,
                'class' => 'required-entry'
                )
            );
        } else {
            $fieldset->addField('token', 'text', array(
                'name' => 'token',
                'label' => Mage::helper('latch')->__('Token Application') . '*',
                'id' => 'token',
                'class' => 'required-entry',
                'after_element_html' => 
                    Mage::helper('latch')->__("Don't you know how to get the token? <a href='https://latch.elevenpaths.com/www/how.html' target='_blank'>click here</a> for more details.")
                )
            );
        }

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
    
    /**
     * Return current admin user
     * 
     * @return Mage_Admin_Model_User
     */
    protected function _getCurrentAdminUser() {
        $sessionUser = Mage::getSingleton('admin/session')->getUser();
        return Mage::getModel('admin/user')->load($sessionUser->getId());
    }

}
