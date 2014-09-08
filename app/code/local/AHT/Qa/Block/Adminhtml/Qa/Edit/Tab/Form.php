<?php

class AHT_Qa_Block_Adminhtml_Qa_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('qa_form', array('legend'=>Mage::helper('qa')->__('Item information')));
       
        $fieldset->addField('answer', 'text', array(
            'label'     => Mage::helper('qa')->__('answer'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'answer',
        ));
 
        $fieldset->addField('question', 'text', array(
            'label'     => Mage::helper('qa')->__('question'),
            'name'      => 'question',
            'required'  => true,
            'name'      => 'answer',
        ));
       
        
       
        if ( Mage::getSingleton('adminhtml/session')->getQaData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getQaData());
            Mage::getSingleton('adminhtml/session')->setQaData(null);
        } elseif ( Mage::registry('<module>_data') ) {
            $form->setValues(Mage::registry('<module>_data')->getData());
        }
        return parent::_prepareForm();
    }
}