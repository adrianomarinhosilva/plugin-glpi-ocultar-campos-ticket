<?php
define('HIDETICKETFIELDS_VERSION', '1.0.0');

function plugin_init_hideticketfields() {
    global $PLUGIN_HOOKS, $DB;
    
    $PLUGIN_HOOKS['csrf_compliant']['hideticketfields'] = true;
    
    if (Session::haveRight('config', UPDATE)) {
        $PLUGIN_HOOKS['config_page']['hideticketfields'] = 'front/config.form.php';
    }
    
    // Adiciona CSS e JavaScript apenas nas páginas de ticket
    if (strpos($_SERVER['PHP_SELF'], 'ticket.form.php') !== false || 
        strpos($_SERVER['PHP_SELF'], 'newticket.form.php') !== false) {
        
        // Carrega configurações atuais
        $query = "SELECT * FROM glpi_plugin_hideticketfields_configs WHERE id = 1";
        $result = $DB->query($query);
        if ($config = $DB->fetchAssoc($result)) {
            // Gera o CSS dinâmico baseado nas configurações
            $css = [];
            
            if ($config['hide_urgency'] == 1) {
                $css[] = "div.form-field.row:has(select[name='urgency']), 
                         .select2-container:has(select[name='urgency']), 
                         div.form-field:has(label[for*='urgency']), 
                         div:has(> select[name='urgency']) { display: none !important; }";
            }
            
            if ($config['hide_impact'] == 1) {
                $css[] = "div.form-field.row:has(select[name='impact']), 
                         .select2-container:has(select[name='impact']), 
                         div.form-field:has(label[for*='impact']), 
                         div:has(> select[name='impact']) { display: none !important; }";
            }
            
            if ($config['hide_priority'] == 1) {
                $css[] = "div.form-field.row:has(select[name='priority']), 
                         .select2-container:has(select[name='priority']), 
                         div.form-field:has(label[for*='priority']), 
                         div:has(> select[name='priority']) { display: none !important; }";
            }
            
            if ($config['hide_source'] == 1) {
                $css[] = "div.form-field.row:has(select[name='requesttypes_id']), 
                         .select2-container:has(select[name='requesttypes_id']), 
                         div.form-field:has(label[for*='requesttypes_id']), 
                         div:has(> select[name='requesttypes_id']) { display: none !important; }";
            }
            
            if ($config['hide_status'] == 1) {
                $css[] = "div.form-field.row:has(select[name='status']), 
                         .select2-container:has(select[name='status']), 
                         div.form-field:has(label[for*='status']), 
                         div:has(> select[name='status']), 
                         div.form-field:has(select[id*='status']), 
                         .select2-container:has(select[id*='status']) { display: none !important; }";
            }
            
            // Injeta o CSS dinâmico
            if (!empty($css)) {
                echo "<style>" . implode("\n", $css) . "</style>";
            }
        }
    }
}

function plugin_version_hideticketfields() {
    return [
        'name'           => 'Ocultar Campos do Chamado',
        'version'        => HIDETICKETFIELDS_VERSION,
        'author'         => 'Adriano Marinho',
        'license'        => 'GPLv2+',
        'homepage'       => 'https://github.com/malakaygames',
        'requirements'   => [
            'glpi' => [
                'min' => '10.0'
            ]
        ]
    ];
}

function plugin_hideticketfields_check_prerequisites() {
    if (version_compare(GLPI_VERSION, '10.0', 'lt')) {
        echo "Este plugin requer GLPI >= 10.0";
        return false;
    }
    return true;
}

function plugin_hideticketfields_check_config() {
    if (true) {
        return true;
    }
    if ($verbose) {
        echo 'Installed / not configured';
    }
    return false;
}