<?php

class AHT_CreatorModule_IndexController extends Mage_Core_Controller_Front_Action {

    public function indexAction() {

        /*
         * Load an object by id 
         * Request looking like:
         * http://site.com/creatormodule?id=15 
         *  or
         * http://site.com/creatormodule/id/15 	
         */
        /*
          $creatormodule_id = $this->getRequest()->getParam('id');

          if($creatormodule_id != null && $creatormodule_id != '')	{
          $creatormodule = Mage::getModel('creatormodule/creatormodule')->load($creatormodule_id)->getData();
          } else {
          $creatormodule = null;
          }
         */

        /*
         * If no param we load a the last created item
         */
        /*
          if($creatormodule == null) {
          $resource = Mage::getSingleton('core/resource');
          $read= $resource->getConnection('core_read');
          $creatormoduleTable = $resource->getTableName('creatormodule');

          $select = $read->select()
          ->from($creatormoduleTable,array('creatormodule_id','title','content','status'))
          ->where('status',1)
          ->order('created_time DESC') ;

          $creatormodule = $read->fetchRow($select);
          }
          Mage::register('creatormodule', $creatormodule);
         */


        $this->loadLayout();
        $this->renderLayout();
    }

    public function createQuestionAction() {
        $currentDate = date("Y-m-d H:i:s", Mage::getModel('core/date')->timestamp(time()));
        $questionContent = $this->getRequest()->get('question');
        $productId = $this->getRequest()->get('product');
        $currentUrl = $this->getRequest()->getPost('curentUrl');
        var_dump($currentUrl);
        $data = array('parent_id' => 0, 'create_time' => $currentDate,
            'content' => $questionContent, 'product_id' => $productId);
        $model = Mage::getModel('creatormodule/creatormodule')->setData($data);
        try {
            $model->save();
            $this->_redirectUrl($currentUrl);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function createAnAction() {
        $currentDate = date("Y-m-d H:i:s", Mage::getModel('core/date')->timestamp(time()));
        $questID = $this->getRequest()->get('qId');
        $currentUrl = $this->getRequest()->getPost('curentUrl');
        $answerContent = $this->getRequest()->getPost('answer');
        $pId = $this->getRequest()->getPost('product');
        $data = array('parent_id' => $questID, 'create_time' => $currentDate,
            'content' => $answerContent,'product_id'=>$pId);
        $model = Mage::getModel('creatormodule/creatormodule')->setData($data);
        try {
            $model->save();
            $this->_redirectUrl($currentUrl);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}
