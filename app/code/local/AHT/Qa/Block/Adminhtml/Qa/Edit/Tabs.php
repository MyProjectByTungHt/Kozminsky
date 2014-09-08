<?php

class AHT_Qa_Block_Adminhtml_Qa_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs {

    public function __construct() {
        parent::__construct();
        $this->setId('qa_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('<module>')->__('News Information'));
    }

    protected function _beforeToHtml() {
        $this->addTab('form_section', array(
            'label' => Mage::helper('<module>')->__('Item Information'),
            'title' => Mage::helper('<module>')->__('Item Information'),
            'content' => $this->getLayout()->createBlock('<module>/adminhtml_<module>_edit_tab_form')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }

}
