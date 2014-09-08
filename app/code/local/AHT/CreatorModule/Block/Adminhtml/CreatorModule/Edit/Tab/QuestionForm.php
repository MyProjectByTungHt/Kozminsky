<?php

class AHT_CreatorModule_Block_Adminhtml_CreatorModule_Edit_Tab_QuestionForm extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm() {
//        echo '<pre>';print_r(Mage::registry('creatormodule_data')->getData());die();

        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('creatormodule_form', array('legend' => Mage::helper('creatormodule')->__('Question information')));

        $fieldset->addField('content', 'editor', array(
            'name' => 'contentQuestion',
            'label' => Mage::helper('creatormodule')->__('Content Question'),
            'title' => Mage::helper('creatormodule')->__('Content Question'),
            'style' => 'width:700px; height:300px;',
//            'config'=> Mage::getSingleton('cms/wysiwyg_config')->getConfig(),
            'wysiwyg' => false,
            'required' => true,
        ));


        $fieldset->addField('create_time', 'date', array(
            'name' => 'create_time',
            'label' => Mage::helper('creatormodule')->__('Create Date'),
            'tabindex' => 1,
            'required'=>true,
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT)
        ));

        if (Mage::getSingleton('adminhtml/session')->getCreatorModuleData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getCreatorModuleData());
            Mage::getSingleton('adminhtml/session')->setCreatorModuleData(null);
        } elseif (Mage::registry('creatormodule_data')) {
            $form->setValues(Mage::registry('creatormodule_data')->getData());
        }
        return parent::_prepareForm();
    }
//
//    protected function _prepareLayout() {
//         if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
//                            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
//        }
//        return parent::_prepareLayout();
//    }

  

}
