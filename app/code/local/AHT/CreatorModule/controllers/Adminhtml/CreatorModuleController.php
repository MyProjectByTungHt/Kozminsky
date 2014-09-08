<?php

class AHT_CreatorModule_Adminhtml_CreatorModuleController extends Mage_Adminhtml_Controller_action {

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
            Mage::register('questionId', $this->getRequest()->getParam('idQuestion'));
            $this->loadLayout();
            $this->_setActiveMenu('creatormodule/items');
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Answer Manager'), Mage::helper('adminhtml')->__('Item Manager'));

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this->_addContent($this->getLayout()->createBlock('creatormodule/adminhtml_creatormodule_editanswer'))
                    ->_addLeft($this->getLayout()->createBlock('creatormodule/adminhtml_creatormodule_editanswer_tabs'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('creatormodule')->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
    }
    public function newAction() {
        $this->_forward('edit');
    }
    

    public function saveAction() {

        if ($data = $this->getRequest()->getPost()) {

            $qId = $this->getRequest()->getParam('id');
            $model = Mage::getModel('creatormodule/creatormodule');
            $model->setData($data)
                    ->setId($qId)
                    ->setContent($_POST['contentQuestion'])
                    ->setCreate_time($_POST['create_time']);
            try {
                if ($model->getCreatedTime == NULL) {
                    $model->setCreatedTime(now());
                }
                $model->save();
                if (isset($data['links'])) {
                    $decode = Mage::helper('adminhtml/js')->decodeGridSerializedInput($data['links']['products']);
                    $model2 = Mage::getModel('creatormodule/creatormodule')->load($qId);
                    $newpID = "";
                    foreach ($decode as $key => $value) {
                        $newpID .= $key.",";
                    }
                    $model2->addData(array('product_id'=>$newpID));
                    $model2->save();
                }
                

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('creatormodule')->__('Question was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                    return;
                }
                $this->_redirect('*/*/');
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

    public function exportCsvAction() {
        $fileName = 'creatormodule.csv';
        $content = $this->getLayout()->createBlock('creatormodule/adminhtml_creatormodule_grid')
                ->getCsv();

        $this->_sendUploadResponse($fileName, $content);
    }

    public function exportXmlAction() {
        $fileName = 'creatormodule.xml';
        $content = $this->getLayout()->createBlock('creatormodule/adminhtml_creatormodule_grid')
                ->getXml();

        $this->_sendUploadResponse($fileName, $content);
    }

    protected function _sendUploadResponse($fileName, $content, $contentType = 'application/octet-stream') {
        $response = $this->getResponse();
        $response->setHeader('HTTP/1.1 200 OK', '');
        $response->setHeader('Pragma', 'public', true);
        $response->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true);
        $response->setHeader('Content-Disposition', 'attachment; filename=' . $fileName);
        $response->setHeader('Last-Modified', date('r'));
        $response->setHeader('Accept-Ranges', 'bytes');
        $response->setHeader('Content-Length', strlen($content));
        $response->setHeader('Content-type', $contentType);
        $response->setBody($content);
        $response->sendResponse();
    }

}
