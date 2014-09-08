<?php

class AHT_CreatorModule_Block_Adminhtml_Answer_Edit_Form extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm() {
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/saveanswer', 
                    array('id' => $this->getRequest()->getParam('id'),
                        'qid'=>  $this->getRequest()->getParam('idQuestion'))),
            'method' => 'post',
            'enctype' => 'multipart/form-data'
                )
        );
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }

}