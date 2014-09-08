<?php

class AHT_Qa_Model_Qa extends Mage_Core_Model_Abstract {

    public function _construct() {
        parent::_construct();
        $this->_init('qa/qa');
    }

}
