<?php

class Biztech_Facebook_Model_System_Config_Source_Locale {

    public function toOptionArray() {
    	$options   = array();
    	$options[] = array('value' => 'auto', 'label' => Mage::helper('facebook')->__('Automatically'));
    	
        $fb_locale = file_get_contents('http://www.facebook.com/translations/FacebookLocales.xml');
        $locales   = simplexml_load_string($fb_locale, 'Varien_Simplexml_Element');
        if (!$locales instanceof SimpleXMLElement) {
        	return $options;
        }
        foreach($locales->children() as $locale) {
        	$options[] = array('value' => $locale->codes->code->standard->representation, 'label' => $locale->englishName);
        }
        return $options;
    }
}
