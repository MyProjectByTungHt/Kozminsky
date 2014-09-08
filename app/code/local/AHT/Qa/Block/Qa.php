<?php


class AHT_Qa_Block_Qa extends Mage_Core_Block_Template {

    /**
     * prepare block's layout
     *
     * @return Basetut_Helloworld_Block_Helloworld
     */
    
    public function _prepareLayout() {
        
        return parent::_prepareLayout();
    }

    public function getActionOfForm(){
        return $this->getUrl('qa/index/createQuestion');
    }
    public function getActionAnswerForm($item) {
        return $this->getUrl('qa/index/createAn/qId/'.$item);
    }
}
