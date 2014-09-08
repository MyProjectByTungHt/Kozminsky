<?php
class Biztech_Facebook_Model_System_Config_Source_Target
{
     public function toOptionArray()
    {
        return array(
            array('value'=>'_blank', 'label'=>Mage::helper('facebook')->__('_blank')),
            array('value'=>'_top', 'label'=>Mage::helper('facebook')->__('_top'))
        );
    }
}