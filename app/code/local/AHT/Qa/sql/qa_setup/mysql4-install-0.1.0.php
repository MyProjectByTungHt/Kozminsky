<?php

$installer = $this;
$installer->startSetup();
$installer->run("-- DROP TABLE IF EXIST {$this->getTable('qa')};"
        . "CREATE TABLE {$this->getTable('qa')}(`qa_id` int(11) unsigned NOT NULL auto_increment,"
        . "`answer` varchar(255) not null default '',"
        . "`question` varchar(255) not null default '',"
        . "`` varchar(255) null,"
        . "`user_question` varchar(255) not null,"
        . "`create_time` datetime null,"
        . "PRIMARY KEY (`qa_id`))ENGINE=InnoDB DEFAULT CHARSET=utf8;");
$installer->endSetup();

