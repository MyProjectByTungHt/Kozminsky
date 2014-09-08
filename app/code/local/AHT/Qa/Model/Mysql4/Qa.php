<?php

class AHT_Qa_Model_Mysql4_Qa extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct() {
        $this->_init('qa/qa', 'qa_id');
    }
    
}

