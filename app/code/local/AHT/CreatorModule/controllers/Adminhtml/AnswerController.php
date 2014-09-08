<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AnswerController
 *
 * @author Tung
 */
class AHT_CreatorModule_Adminhtml_AnswerController extends Mage_Adminhtml_Controller_action {

    //put your code here
    protected function _initAction() {
        $this->loadLayout()
                ->_setActiveMenu('creatormodule/questions')
                ->_addBreadcrumb(Mage::helper('adminhtml')->__('Questions Manager'), Mage::helper('adminhtml')->__('Question Manager'));

        return $this;
    }

    public function indexAction() {
        $this->_initAction()
                ->renderLayout();
    }

    public function gridAction() {
        $this->loadLayout();
        $this->getResponse()->setBody(
                $this->getLayout()->createBlock('creatormodule/adminhtml_creatormodule_grid')->toHtml());
    }

    public function listAnswerAction() {
        $this->loadLayout();
        $this->getResponse()->setBody(
                $this->getLayout()->createBlock('creatormodule/adminhtml_creatormodule_edit_tab_answergrid')->toHtml());
    }

    public function productsAction() {
        $this->loadLayout();
        $this->getLayout()->getBlock('creatormodule.edit.tab.productgrid')
                ->setCreatormoduleProducts($this->getRequest()->getPost('creatormodule_products', null));
        $this->renderLayout();
    }

    public function productsGridAction() {
        $this->loadLayout();
        $this->getLayout()->getBlock('creatormodule.edit.tab.productgrid')
                ->setCreatormoduleProducts($this->getRequest()->getPost('creatormodule_products', null));
        $this->renderLayout();
    }

    public function editAction() {

        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('creatormodule/creatormodule')->load($id);

        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }

            Mage::register('creatormodule_data', $model);

            $this->loadLayout();
            $this->_setActiveMenu('creatormodule/items');
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Quesion Manager'), Mage::helper('adminhtml')->__('Item Manager'));

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this->_addContent($this->getLayout()->createBlock('creatormodule/adminhtml_creatormodule_edit'))
                    ->_addLeft($this->getLayout()->createBlock('creatormodule/adminhtml_creatormodule_edit_tabs'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('creatormodule')->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function editanswerAction() {
        
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('creatormodule/creatormodule')->load($id);

        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }

            Mage::register('creatormodule_data', $model);
            $questionId = $this->getRequest()->getParam('idQuestion');
            Mage::register('questionId', $questionId);
            $this->loadLayout();
            $this->_setActiveMenu('creatormodule/items');
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Answer Manager'), Mage::helper('adminhtml')->__('Item Manager'));

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this->_addContent($this->getLayout()->createBlock('creatormodule/adminhtml_answer_edit'))
                    ->_addLeft($this->getLayout()->createBlock('creatormodule/adminhtml_answer_edit_tabs'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('creatormodule')->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function newAction() {
        $this->_forward('edit');
    }

    public function saveAnswerAction() {
        if ($data = $this->getRequest()->getPost()) {
            $id = $this->getRequest()->getParam('id');
            $qid = $this->getRequest()->getParam('qid');
            $model = Mage::getModel('creatormodule/creatormodule');
            $model->setData($data)
                    ->setId($id)
                    ->setContent($_POST['contentAnswer'])
                    ->setCreate_time($_POST['create_time']);
            try {
                if ($model->getCreatedTime == NULL) {
                    $model->setCreatedTime(now());
                }
                $model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('creatormodule')->__('Answer was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                $model->load($id);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/editanswer', array('id' => $model->getId(), 'idQuestion' => $model->getParentId()));
                    return;
                }
                $this->_redirect('*/adminhtml_creatormodule/edit',array('id'=>$qid));
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('creatormodule')->__('Unable to find item to save'));
        $this->_redirect('*/*/');
    }

    

    public function deleteAction() {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $model = Mage::getModel('creatormodule/creatormodule');

                $model->setId($this->getRequest()->getParam('id'))
                        ->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction() {
        $creatormoduleIds = $this->getRequest()->getParam('creatormodule');
        if (!is_array($creatormoduleIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            try {
                foreach ($creatormoduleIds as $creatormoduleId) {
                    $creatormodule = Mage::getModel('creatormodule/creatormodule')->load($creatormoduleId);
                    $creatormodule->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                        Mage::helper('adminhtml')->__(
                                'Total of %d record(s) were successfully deleted', count($creatormoduleIds)
                        )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    public function massDeleteAnswerAction() {
        $creatormoduleIds = $this->getRequest()->getParam('creatormodule');
        if (!is_array($creatormoduleIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            try {
                foreach ($creatormoduleIds as $creatormoduleId) {
                    $creatormodule = Mage::getModel('creatormodule/creatormodule')->load($creatormoduleId);
                    $creatormodule->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                        Mage::helper('adminhtml')->__(
                                'Total of %d record(s) were successfully deleted', count($creatormoduleIds)
                        )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/');
    }

   

   

}
