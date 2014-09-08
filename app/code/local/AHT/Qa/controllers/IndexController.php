<?php

class AHT_Qa_IndexController extends Mage_Core_Controller_Front_Action {

    public function indexAction() {
        
        $this->loadLayout();
        $this->renderLayout();
    }

    public function createQuestionAction() {
        $currentDate = date("Y-m-d H:i:s", Mage::getModel('core/date')->timestamp(time()));
        $questionContent = $this->getRequest()->get('question');
        $questionId = rand();
        $data = array('question_id' => $questionId, 'create_time' => $currentDate, 'question' => $questionContent);
        $model = Mage::getModel('qa/qa')->setData($data);
        try {
            $insertId = $model->save()->getId();            
            $this->_redirect('qa');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function createAnAction() {
        $currentDate = date("Y-m-d H:i:s", Mage::getModel('core/date')->timestamp(time()));
        $questID = $this->getRequest()->get('qId');
        $answerContent = $this->getRequest()->get('answer');
        $qContent = $this->getRequest()->get('questContent');
        $data = array('question_id'=>$questID,'create_time'=>$currentDate,'question'=>$qContent,'answer'=>$answerContent);
        $model = Mage::getModel('qa/qa')->setData($data);
        try {
            $insertId = $model->save()->getId();            
            $this->_redirect('qa');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}
