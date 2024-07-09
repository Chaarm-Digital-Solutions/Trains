<?php
/*
Plugin Name: DATables
Description: Plugin displaying datatables for departures and arrivals from the selected train stations
Version: 0.1
Author: Chaarm Digital Solutions
*/
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