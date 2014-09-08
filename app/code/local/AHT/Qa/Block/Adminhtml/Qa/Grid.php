<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AHT_Qa_Block_Adminhtml_Qa_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('qaGrid');
        $this->setDefaultSort('qa_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel('qa/qa')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $this->addColumn('qa_id', array(
            'header' => Mage::helper('qa')->__('ID'),
            'align' => 'right',
            'width' => '50px',
            'index' => 'qa_id',
        ));
        $this->addColumn('answer', array(
            'header' => Mage::helper('qa')->__('Answer'),
            'align' => 'left',
            'index' => 'answer',
        ));
        $this->addColumn('question', array(
            'header' => Mage::helper('qa')->__('Question'),
            'align' => 'left',
            'width' => '80px',
            'index' => 'question',
        ));
        $this->addColumn('create_time', array(
            'header' => Mage::helper('<module>')->__('Creation Time'),
            'align' => 'left',
            'width' => '120px',
            'type' => 'date',
            'default' => '--',
            'index' => 'create_time',
        ));
        return parent::_prepareColumns();
    }

    public function getRowUrl($url) {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    public function getGridUrl() {
        return $this->getUrl('*/*/grid', array('_current' => true));
    }

}
