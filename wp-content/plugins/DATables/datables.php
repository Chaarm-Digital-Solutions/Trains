<?php
/*
Plugin Name: DATables
Description: Plugin displaying datatables for departures and arrivals from the selected train stations
Version: 0.1
Author: Chaarm Digital Solutions
*/
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