<?php

class AHT_CreatorModule_Model_Mysql4_CreatorModule_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('creatormodule/creatormodule');
    }
}