<?php

class AHT_Qa_Block_Adminhtml_Qa extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct() {
        $this->_controller = 'adminhtml_qa';
        $this->_blockGroup = 'qa';
        $this->_headerText = Mage::helper('qa')->__('Item Manager');
        $this->_addButtomLabel = Mage::helper('qa')->__('Add Item');
        parent::__construct();
    }
}

