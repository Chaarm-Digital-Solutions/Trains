<?php
/*
Plugin Name: DATables
Description: Plugin displaying datatables for departures and arrivals from the selected train stations
Version: 0.1
Author: Chaarm Digital Solutions
*/

function datables_menu() {
    add_menu_page(
        'DATables Settings',
        'DATables',
        'manage_options',
        'wcrm-settings',
        'render_datables_settings_page',
        'https://cdn-icons-png.flaticon.com/256/1008/1008048.png'
    );

    add_submenu_page(
        'datables-settings',
        'DATables Settings',
        'Settings',
        'manage_options',
        'datables-settings',
        'render_datables_settings_page'
    );
}

// Render the WCRM settings page
function render_datables_settings_page() {
    ?>
    <div class="wrap">
        <h2>
            DATables settings
        </h2>
        <form method="post" action="options.php">
            <?php
            settings_fields('datables-settings-group');
            do_settings_sections('datables-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Register settings and add custom fields for WCRM
function wcrm_settings_init() {
    register_setting(
        'wcrm-settings-group',
        'wcrm_platform_url'
    );
    register_setting(
        'wcrm-settings-group',
        'wcrm_registration_email'
    );
    register_setting(
        'wcrm-settings-group',
        'wcrm_client_secret'
    );
    register_setting(
        'wcrm-settings-group',
        'wcrm_password'
    );
    register_setting(
        'wcrm-settings-group',
        'wcrm_status'
    );

    add_settings_section(
        'wcrm-settings-section',
        'WCRM Settings',
        'wcrm_settings_section_callback',
        'wcrm-settings'
    );

    $fields = array(
        'wcrm_platform_url' => 'Platform URL',
        'wcrm_registration_email' => 'Registation Email Address',
        'wcrm_client_secret' => 'Client Secret',
        'wcrm_password' => 'Password',
        'wcrm_status' => 'Status',
    );

    foreach ($fields as $field_key => $field_label) {
        add_settings_field(
            $field_key,
            $field_label,
            'wcrm_field_callback',
            'wcrm-settings',
            'wcrm-settings-section',
            array('field_key' => $field_key)
        );
    }
}

// Callback function for rendering custom fields for WCRM
function wcrm_field_callback($args) {
    $field_key = $args['field_key'];
    $value = get_option($field_key);

    if ($field_key === 'wcrm_password') {
        echo '<input type="password" name="' . esc_attr($field_key) . '" value="' . esc_attr($value) . '" />';
    } elseif ($field_key === 'wcrm_status') {
        $options = array(
            'active' => 'Active',
            'inactive' => 'Inactive',
        );

        echo '<select name="' . esc_attr($field_key) . '">';
        foreach ($options as $option_value => $option_label) {
            echo '<option value="' . esc_attr($option_value) . '" ' . selected($value, $option_value, false) . '>' . esc_html($option_label) . '</option>';
        }
        echo '</select>';
    } else {
        echo '<input type="text" name="' . esc_attr($field_key) . '" value="' . esc_attr($value) . '" />';
    }
}

// Callback function for the settings section
function wcrm_settings_section_callback() {
    echo '<p>Configure WCRM settings below:</p>';
}

// Hook into WordPress actions for WCRM
add_action('admin_menu', 'wcrm_menu');
add_action('admin_init', 'wcrm_settings_init');

function wcrm_enqueue_scripts() {

    wp_enqueue_script('jquery');
    wp_enqueue_script('datatables', '//cdn.datatables.net/2.0.8/js/dataTables.min.js', array('jquery'), '1.11.10', true);
    wp_enqueue_style('datatables-css', '//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css');

    wp_enqueue_script('datables', plugins_url('js/datables.js', __FILE__), array('jquery', 'datables'), '1.0', true);
    wp_enqueue_script('datables-script', 'js/datables.js', array('jquery'), null, true);
    wp_enqueue_style('styles', plugin_dir_url(__FILE__) . 'css/styles.css');
    
    wp_localize_script('datables-script', 'datablesData', array(
        // 'billingReferencesArray' => $billing_references_array,
        // 'platformUrl' => $platform_url
    ));
}
add_action('wp_enqueue_scripts', 'wcrm_enqueue_scripts');

function departures_table_function() 
{
    return '<div class="loading-message">Loading...</div>
            <table id="departures-table" class="display"></table>';
}
add_shortcode('departures-table', 'departures_table_function');

function arrivals_table_function() 
{
    return '<div class="loading-message">Loading...</div>
            <table id="arrivals-table" class="display"></table>';
}
add_shortcode('arrivals-table', 'arrivals_table_function');

?>