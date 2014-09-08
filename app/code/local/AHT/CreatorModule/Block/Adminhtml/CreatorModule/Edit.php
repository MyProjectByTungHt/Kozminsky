<?php

class AHT_CreatorModule_Block_Adminhtml_CreatorModule_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

    public function __construct() {
        $this->_objectId = 'id';
        $this->_blockGroup = 'creatormodule';
        $this->_controller = 'adminhtml_creatormodule';
        parent::__construct();
        $this->_updateButton('save', 'label', Mage::helper('creatormodule')->__('Save'));
        $this->_removeButton('reset');

        $this->_addButton('saveandcontinue', array(
            'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save',
                ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('creatormodule_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'creatormodule_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'creatormodule_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText() {
        if (Mage::registry('creatormodule_data') && Mage::registry('creatormodule_data')->getId()) {
            return Mage::helper('creatormodule')->__("Edit Question '%s'", $this->htmlEscape(Mage::registry('creatormodule_data')->getCreatormodule_id()));
        } else {
            return Mage::helper('creatormodule')->__('Add Question');
        }
    }

}
