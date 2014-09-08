<?php

class AHT_CreatorModule_Block_CreatorModule extends Mage_Core_Block_Template {

    public function _prepareLayout() {
        return parent::_prepareLayout();
    }

    public function getActionOfForm() {
        return $this->getUrl('creatormodule/index/createQuestion');
    }

    public function getActionAnswerForm($quesId) {
        return $this->getUrl('creatormodule/index/createAn/qId/' . $quesId);
    }

}
