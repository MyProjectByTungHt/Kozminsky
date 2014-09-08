<?php
class Biztech_Facebook_Model_System_Config_Source_Color
{
     public function toOptionArray()
    {
        return array(
            array('value'=>'light', 'label'=>Mage::helper('facebook')->__('Light')),
            array('value'=>'dark', 'label'=>Mage::helper('facebook')->__('Dark'))
        );
    }
}
