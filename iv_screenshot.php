<?php
/*
Plugin Name: iv Screenshot
Plugin URI:  http://bivek.ca/iv_screenshot
Description: Take Screenshot of wordpress post or page using without loosing form data form data [wp_make_img]
Version:     1.0
Author:      Bivek
Author URI:  http://bivek.ca
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

add_shortcode('wp_make_img', 'iv_make_img');

function iv_make_img() {
    $wp_make_img_link="
            <button title='Takes Screenshot and Open it in new tab' class='iv_link_make_image' onclick='capture()'>Open Screenshot</button>
            <script type='text/javascript'>
            function capture(){
                jQuery('body').html2canvas({
                    onrendered: function (canvas) {
                        //Set hidden field's value to image data (base-64 string)
                        window.open(canvas.toDataURL('image/png'), '_blank');
                        //canvas.toDataURL('image/png')
                        //jQuery('a.iv_link_make_image').attr('href',canvas.toDataURL('image/png'));                            
                        //var positioni = jQuery('.iv_link_make_image').offset().top; 
                        //jQuery(window).scrollTop(positioni);
                    }                        
                });
            }
            </script>
            <style type='text/css'>
                a.iv_link_make_image{
                }
            </style>";
    return $wp_make_img_link;
}

add_action('wp_enqueue_scripts', 'iv_makeimg_scripts');

function iv_makeimg_scripts(){
    wp_enqueue_script('html2canvas', plugins_url('/js/html2canvas.js', __FILE__), array(), '1.0.0', true);
    wp_enqueue_script('plugin-html2canvas', plugins_url('/js/jquery.plugin.html2canvas.js', __FILE__), array(), '1.0.0', true);
}
?>