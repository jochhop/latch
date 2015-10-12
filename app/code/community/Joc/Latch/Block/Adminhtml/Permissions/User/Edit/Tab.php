<?php

class Joc_Latch_Block_Adminhtml_Permissions_User_Edit_Tab 
    extends Mage_Adminhtml_Block_Widget_Form 
        implements Mage_Adminhtml_Block_Widget_Tab_Interface {

    /**
     * 
     */
    public function _beforeToHtml() {
        $this->_initForm();
        return parent::_beforeToHtml();
    }

    /**
     * Add the form to Latch tab
     */
    protected function _initForm() {
        $userId = $this->getRequest()->getParam('user_id');
        /* @var $user Mage_Admin_Model_User */
        $user = Mage::getModel('admin/user')->load($userId);
        $form = new Varien_Data_Form();

        $fieldset = $form->addFieldset('base_fieldset', array('legend' => Mage::helper('latch')->__('Latch Settings')));

        if($user->getData('latch_id')){
            $fieldset->addField('unlink_latch', 'checkbox', array(
                'name' => 'unlink_latch',
                'label' => Mage::helper('latch')->__('Unlink Latch Account'),
                'id' => 'unlink_latch',
                'value' => 1
                )
            );
        } else {
            $fieldset->addField('token', 'text', array(
                'name' => 'token',
                'label' => Mage::helper('latch')->__('Token Application'),
                'id' => 'token',
                'after_element_html' => 
                    Mage::helper('latch')->__("Don't you know how to get the token? <a href='https://latch.elevenpaths.com/www/how.html' target='_blank'>click here</a> for more details.")
                )
            );
        }
        
        $this->setForm($form);
    }

    /**
     * Retrieve the label used for the tab relating to this block
     *
     * @return string
     */
    public function getTabLabel() {
        return Mage::helper('latch')->__('Latch');
    }

    /**
     * Retrieve the title used by this tab
     *
     * @return string
     */
    public function getTabTitle() {
        return Mage::helper('latch')->__('Click here to view Latch settings');
    }

    /**
     * Determines whether to display the tab
     * Add logic here to decide whether you want the tab to display
     *
     * @return bool
     */
    public function canShowTab() {
        return true;
    }

    /**
     * Stops the tab being hidden
     *
     * @return bool
     */
    public function isHidden() {
        return false;
    }

}
