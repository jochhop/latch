<?php
/**
 * Add latch_id attribute to admin user
 */
$installer = $this;
$installer->startSetup();

$installer->getConnection()->addColumn($installer->getTable('admin/user'), 'latch_id', array(
    'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
    'nullable' => true,
    'default' => null,
    'comment' => 'Latch ID'
)); 

$installer->endSetup();
