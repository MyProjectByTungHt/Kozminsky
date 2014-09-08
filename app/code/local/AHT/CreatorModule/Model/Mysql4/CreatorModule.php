<?php

class AHT_CreatorModule_Model_Mysql4_CreatorModule extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the creatormodule_id refers to the key field in your database table.
        $this->_init('creatormodule/creatormodule', 'creatormodule_id');
    }
}