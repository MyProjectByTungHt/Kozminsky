<?php

class AHT_Qa_Block_Adminhtml_Qa_Edit extends Mage_Adminhtml_Block_Widget_Form_Container{
     public function __construct() {
         parent::__construct();
         $this->_objectId = 'id';
         $this->_blockGroup = 'qa';
         $this->_controller = 'adminhtml_qa';
         $this->updateButton('save','label',Mage::helper('qa')->__('Save Item'));
         $this->updateButton('delete','label',Mage::helper('qa')->__('Delete Item'));
    }
    public function getHeaderText() {
        if(Mage::registry('qa_data')&&Mage::registry('qa_data')->getId()){
            return Mage::helper('qa')->__("Edit Item '%s'",$this->htmlEscape(Mage::registry('qa_data')->getTitle()));
        }else{
            return Mage::hepler('qa')->__('Add Item');
        }
    }
}

