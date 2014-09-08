<?php

class AHT_CreatorModule_Model_CreatorModule extends Mage_Core_Model_Abstract {

    protected $_productInstance = null;

    public function _construct() {
        parent::_construct();
        $this->_init('creatormodule/creatormodule');
    }

   

}
