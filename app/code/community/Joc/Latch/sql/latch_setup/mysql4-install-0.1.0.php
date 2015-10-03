<?php
/**
 * Add latch_id attribute to customer
 */
$installer = $this;
$installer->startSetup();

$installer->addAttribute("customer", "latch_id", array(
    "type" => "varchar",
    "backend" => "",
    "label" => "Latch ID",
    "input" => "text",
    "source" => "",
    "visible" => true,
    "required" => false,
    "default" => "",
    "frontend" => "",
    "unique" => false,
    "note" => ""
));

$installer->endSetup();
