<?php
class AHT_CreatorModule_Block_Adminhtml_CreatorModule extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_creatormodule';
    $this->_blockGroup = 'creatormodule';
    $this->_headerText = Mage::helper('creatormodule')->__('Question Manager');
    $this->_addButtonLabel = Mage::helper('creatormodule')->__('Add Question');
    parent::__construct();
  }
}