<?php

$installer = $this;

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('creatormodule')};
CREATE TABLE {$this->getTable('creatormodule')} (
  `creatormodule_id` int(11) unsigned NOT NULL auto_increment,
  `question_id` int(11) NOT NULL default '',
  `product_id` int(11) unsigned NOT NULL,
  `answer` varchar(255) NOT NULL default '',
  `question` varchar(255) NOT NULL default '',
  `create_time` datetime default NULL,
  PRIMARY KEY (`creatormodule_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");

$installer->endSetup(); 