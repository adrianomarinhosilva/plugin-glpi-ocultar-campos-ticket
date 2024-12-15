<?php
class PluginHideticketfieldsConfig extends CommonDBTM {
    
    static $rightname = 'config';
    static $table = 'glpi_plugin_hideticketfields_configs';
    
    static function getTypeName($nb = 0) {
        return 'Ocultar Campos do Chamado';
    }
    
    function showFormConfig() {
        global $CFG_GLPI;
        
        if (!self::canView()) {
            return false;
        }
        
        $this->getFromDB(1);
        
        echo "<form method='post' action='" . Toolbox::getItemTypeFormURL(__CLASS__) . "'>";
        echo "<div class='center' id='tabsbody'>";
        echo "<table class='tab_cadre_fixe'>";
        
        echo "<tr class='tab_bg_1'>";
        echo "<th colspan='4'>" . __('Configuração dos Campos do Chamado', 'hideticketfields') . "</th>";
        echo "</tr>";
        
        echo "<tr class='tab_bg_2'>";
        echo "<td>" . __('Ocultar campo Urgência', 'hideticketfields') . "</td>";
        echo "<td>";
        Dropdown::showYesNo('hide_urgency', $this->fields['hide_urgency'] ?? 1);
        echo "</td>";
        echo "</tr>";
        
        echo "<tr class='tab_bg_2'>";
        echo "<td>" . __('Ocultar campo Impacto', 'hideticketfields') . "</td>";
        echo "<td>";
        Dropdown::showYesNo('hide_impact', $this->fields['hide_impact'] ?? 1);
        echo "</td>";
        echo "</tr>";
        
        echo "<tr class='tab_bg_2'>";
        echo "<td>" . __('Ocultar campo Prioridade', 'hideticketfields') . "</td>";
        echo "<td>";
        Dropdown::showYesNo('hide_priority', $this->fields['hide_priority'] ?? 1);
        echo "</td>";
        echo "</tr>";
        
        echo "<tr class='tab_bg_2'>";
        echo "<td>" . __('Ocultar campo Origem da Requisição', 'hideticketfields') . "</td>";
        echo "<td>";
        Dropdown::showYesNo('hide_source', $this->fields['hide_source'] ?? 1);
        echo "</td>";
        echo "</tr>";
        
        echo "<tr class='tab_bg_2'>";
        echo "<td colspan='4' class='center'>";
        echo "<input type='hidden' name='id' value='1'>";
        echo "<input type='submit' name='update' value='" . _sx('button', 'Salvar') . "' class='submit'>";
        echo "</td>";
        echo "</tr>";
        
        echo "</table>";
        echo "</div>";
        Html::closeForm();
    }
    
    static function install() {
        global $DB;
        
        if (!$DB->tableExists(self::$table)) {
            $query = "CREATE TABLE IF NOT EXISTS `" . self::$table . "` (
                `id` int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `hide_urgency` tinyint NOT NULL DEFAULT '1',
                `hide_impact` tinyint NOT NULL DEFAULT '1',
                `hide_priority` tinyint NOT NULL DEFAULT '1',
                `hide_source` tinyint NOT NULL DEFAULT '1'
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
            
            $DB->query($query) or die($DB->error());
            
            $DB->query("INSERT INTO `" . self::$table . "` (`id`, `hide_urgency`, `hide_impact`, `hide_priority`, `hide_source`) VALUES (1, 1, 1, 1, 1)");
        }
        return true;
    }
    
    static function uninstall() {
        global $DB;
        $DB->query("DROP TABLE IF EXISTS `" . self::$table . "`");
        return true;
    }
    
    function update($input) {
        parent::update($input);
        
        // Atualiza o CSS após salvar
        $this->updateCSS();
        return true;
    }
    
    private function updateCSS() {
        $css = [];
        
        if ($this->fields['hide_urgency']) {
            $css[] = "div.form-field.row:has(select[name='urgency'])";
            $css[] = ".select2-container:has(select[name='urgency'])";
        }
        
        if ($this->fields['hide_impact']) {
            $css[] = "div.form-field.row:has(select[name='impact'])";
            $css[] = ".select2-container:has(select[name='impact'])";
        }
        
        if ($this->fields['hide_priority']) {
            $css[] = "div.form-field.row:has(select[name='priority'])";
            $css[] = ".select2-container:has(select[name='priority'])";
        }
        
        if ($this->fields['hide_source']) {
            $css[] = "div.form-field.row:has(select[name='requesttypes_id'])";
            $css[] = ".select2-container:has(select[name='requesttypes_id'])";
        }
        
        $css_content = !empty($css) ? implode(",\n", $css) . " {\n    display: none !important;\n}" : "";
        
        $css_file = GLPI_PLUGIN_DOC_DIR . '/hideticketfields/hideticketfields.css';
        if (!is_dir(dirname($css_file))) {
            mkdir(dirname($css_file), 0755, true);
        }
        file_put_contents($css_file, $css_content);
    }
}