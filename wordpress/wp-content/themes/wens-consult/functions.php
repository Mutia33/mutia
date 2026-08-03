<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;


function wens_consult_scripts(){
   // enqueue parent style
	wp_enqueue_style('wens-consult-parent-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'wens_consult_scripts');


function wens_consult_register_block_pattern_categories(){
    register_block_pattern_category(
        'wens-consult',
        array( 'label' => __( 'WENS Consult', 'wens-consult' ) )
    );

}
add_action('init', 'wens_consult_register_block_pattern_categories');
