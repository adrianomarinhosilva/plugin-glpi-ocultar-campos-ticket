<?php
function plugin_hideticketfields_install() {
    global $DB;

    if (!$DB->tableExists("glpi_plugin_hideticketfields_configs")) {
        $query = "CREATE TABLE `glpi_plugin_hideticketfields_configs` (
                  `id` int(11) NOT NULL auto_increment,
                  `hide_urgency` tinyint(1) NOT NULL default '1',
                  `hide_impact` tinyint(1) NOT NULL default '1',
                  `hide_priority` tinyint(1) NOT NULL default '1',
                  `hide_source` tinyint(1) NOT NULL default '1',
                  `hide_status` tinyint(1) NOT NULL default '1',
                  PRIMARY KEY  (`id`)
               ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
        
        $DB->query($query) or die($DB->error());
        
        // Insert default values
        $DB->query("INSERT INTO `glpi_plugin_hideticketfields_configs` 
                   VALUES (1, 1, 1, 1, 1, 1)");
    } else {
        // Add status column if it doesn't exist
        if (!$DB->fieldExists("glpi_plugin_hideticketfields_configs", "hide_status")) {
            $query = "ALTER TABLE `glpi_plugin_hideticketfields_configs` 
                     ADD `hide_status` tinyint(1) NOT NULL default '1'";
            $DB->query($query);
        }
    }
    
    return true;
}

function plugin_hideticketfields_uninstall() {
    global $DB;
    $DB->query("DROP TABLE IF EXISTS `glpi_plugin_hideticketfields_configs`");
    return true;
}