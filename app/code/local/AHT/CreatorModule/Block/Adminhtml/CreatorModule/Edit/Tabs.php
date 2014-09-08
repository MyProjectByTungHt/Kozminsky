<?php

class AHT_CreatorModule_Block_Adminhtml_CreatorModule_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs {

    public function __construct() {
        parent::__construct();
        $this->setId('creatormodule_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('creatormodule')->__('Question & Answer Information'));
    }

    protected function _beforeToHtml() {
        $this->addTab('form_sectionss', array(
            'label' => Mage::helper('creatormodule')->__('Question Information'),
            'title' => Mage::helper('creatormodule')->__('Question Information'),
            'content' => $this->getLayout()->createBlock('creatormodule/adminhtml_creatormodule_edit_tab_questionform')->toHtml(),
        ));

        $this->addTab('grid_answer', array(
            'label' => Mage::helper('creatormodule')->__('List Answer'),
            'title' => Mage::helper('creatormodule')->__('List Answer'),
            'content' => $this->getLayout()->createBlock('creatormodule/adminhtml_creatormodule_edit_tab_answergrid')->toHtml(),
        ));
        $this->addTab('grid_products', array(
            'label' => Mage::helper('creatormodule')->__('Product List'),
            'title' => Mage::helper('creatormodule')->__('Product List'),
//          'content'   => $this->getLayout()->createBlock('creatormodule/adminhtml_creatormodule_edit_tab_productgrid')->toHtml(),
            'url' => $this->getUrl('*/*/products', array('_current' => true)),
            'class' => 'ajax',
        ));
        return parent::_beforeToHtml();
    }

}
