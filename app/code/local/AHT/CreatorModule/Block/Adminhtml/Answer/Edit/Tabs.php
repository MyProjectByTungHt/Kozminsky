<?php

class AHT_CreatorModule_Block_Adminhtml_Answer_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs {

    public function __construct() {
        parent::__construct();
        $this->setId('creatormodule_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('creatormodule')->__('Question & Answer Information'));
    }

    protected function _beforeToHtml() {
        $this->addTab('form_sections', array(
            'label' => Mage::helper('creatormodule')->__('Answer Information'),
            'title' => Mage::helper('creatormodule')->__('Answer Information'),
            'content' => $this->getLayout()->createBlock('creatormodule/adminhtml_answer_edit_tab_answerform')->toHtml(),
        ));
        
        return parent::_beforeToHtml();
    }

}
