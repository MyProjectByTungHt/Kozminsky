<?php

class AHT_CreatorModule_Block_Adminhtml_CreatorModule_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setUseAjax(true);
        $this->setId('creatormoduleGrid');
        $this->setDefaultSort('creatormodule_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel('creatormodule/creatormodule')->getCollection();
        $collection->addFilter('parent_id', array('eq' => 0));
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {

        $this->addColumn('creatormodule_id', array(
            'header' => Mage::helper('creatormodule')->__('Id Question'),
            'align' => 'left',
            'index' => 'creatormodule_id',
        ));

        /*
          $this->addColumn('content', array(
          'header'    => Mage::helper('creatormodule')->__('Item Content'),
          'width'     => '150px',
          'index'     => 'content',
          ));
         */

        $this->addColumn('content', array(
            'header' => Mage::helper('creatormodule')->__('Content'),
            'align' => 'left',
            'width' => '80%',
            'index' => 'content',
        ));

        $this->addColumn('action', array(
            'header' => Mage::helper('creatormodule')->__('Action'),
            'width' => '100',
            'type' => 'action',
            'getter' => 'getId',
            'actions' => array(
                array(
                    'caption' => Mage::helper('creatormodule')->__('Edit'),
                    'url' => array('base' => '*/*/edit'),
                    'field' => 'id'
                )
            ),
            'filter' => false,
            'sortable' => false,
            'index' => 'stores',
            'is_system' => true,
        ));

        $this->addExportType('*/*/exportCsv', Mage::helper('creatormodule')->__('CSV'));
        $this->addExportType('*/*/exportXml', Mage::helper('creatormodule')->__('XML'));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction() {
        $this->setMassactionIdField('creatormodule_id');
        $this->getMassactionBlock()->setFormFieldName('creatormodule');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => Mage::helper('creatormodule')->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('creatormodule')->__('Are you sure?')
        ));

//        $statuses = Mage::getSingleton('creatormodule/status')->getOptionArray();
//
//        array_unshift($statuses, array('label' => '', 'value' => ''));
//        $this->getMassactionBlock()->addItem('status', array(
//            'label' => Mage::helper('creatormodule')->__('Change status'),
//            'url' => $this->getUrl('*/*/massStatus', array('_current' => true)),
//            'additional' => array(
//                'visibility' => array(
//                    'name' => 'status',
//                    'type' => 'select',
//                    'class' => 'required-entry',
//                    'label' => Mage::helper('creatormodule')->__('Status'),
//                    'values' => $statuses
//                )
//            )
//        ));
        return $this;
    }

    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    public function getGridUrl() {

        return $this->getUrl('*/*/grid', array('_current' => true));
    }
}
