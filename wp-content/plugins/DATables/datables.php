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
        'datables-settings',
        'render_datables_settings_page',
        //'https://cdn-icons-png.flaticon.com/256/1008/1008048.png'
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

function datables_settings_init() {
    register_setting(
        'datables-settings-group',
        'datables_departures_platform_url'
    );

    register_setting(
        'datables-settings-group',
        'datables_arrivals_platform_url'
    );

    register_setting(
        'datables-settings-group',
        'datables_departures_api_key'
    );

    register_setting(
        'datables-settings-group',
        'datables_arrivals_api_key'
    );

    add_settings_section(
        'datables-settings-section',
        'DATables Settings',
        'datables_settings_section_callback',
        'datables-settings'
    );

    $fields = array(
        'datables_departures_platform_url' => 'Departures Platform URL',
        'datables_arrivals_platform_url' => 'Arrivals Platform URL',
        'datables_departures_api_key' => 'DATables Departures API Key',
        'datables_arrivals_api_key' => 'DATables Arrivals API Key',
    );

    foreach ($fields as $field_key => $field_label) {
        add_settings_field(
            $field_key,
            $field_label,
            'datables_field_callback',
            'datables-settings',
            'datables-settings-section',
            array('field_key' => $field_key)
        );
    }
}

function datables_field_callback($args) {
    $field_key = $args['field_key'];
    $value = get_option($field_key);

    echo '<input type="text" name="' . esc_attr($field_key) . '" value="' . esc_attr($value) . '" />';
}

function datables_settings_section_callback() {
    echo '<p>Configure DATables settings below:</p>';
}

add_action('admin_menu', 'datables_menu');
add_action('admin_init', 'datables_settings_init');

function datables_enqueue_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('datatables', '//cdn.datatables.net/2.0.8/js/dataTables.min.js', array('jquery'), '1.11.10', true);
    wp_enqueue_style('datatables-css', '//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css');

    wp_enqueue_script('datables-script', plugins_url('js/datables.js', __FILE__), array('jquery', 'datatables'), '1.0', true);
    wp_enqueue_style('datables-styles', plugin_dir_url(__FILE__) . 'css/styles.css');

    $departures_platform_url = esc_url(get_option('datables_departures_platform_url'));
    $arrivals_platform_url = esc_url(get_option('datables_arrivals_platform_url'));
    $departures_api_key = esc_attr(get_option('datables_departures_api_key'));
    $arrivals_api_key = esc_attr(get_option('datables_arrivals_api_key'));
    
    wp_localize_script('datables-script', 'datablesData', array(
        'departuresPlatformUrl' => $departures_platform_url,
        'arrivalsPlatformUrl' => $arrivals_platform_url,
        'departuresApiKey' => $departures_api_key,
        'arrivalsApiKey' => $arrivals_api_key
    ));
}
add_action('wp_enqueue_scripts', 'datables_enqueue_scripts');

function departures_table_function($atts) 
{
    $atts = shortcode_atts(
        array(
            'crs' => '',
        ),
        $atts,
        'departures-table'
    );
    $crs = esc_attr($atts['crs']);

    return '<div class="loading-message">Loading...</div>
            <table id="departures-table" class="display" data-crs="' . $crs . '"></table>';
}
add_shortcode('departures-table', 'departures_table_function');

function arrivals_table_function($atts) 
{
    $atts = shortcode_atts(
        array(
            'crs' => '',
        ),
        $atts,
        'arrivals-table'
    );
    $crs = esc_attr($atts['crs']);

    return '<div class="loading-message">Loading...</div>
            <table id="arrivals-table" class="display" data-crs="' . $crs . '"></table>';
}
add_shortcode('arrivals-table', 'arrivals_table_function');

?>