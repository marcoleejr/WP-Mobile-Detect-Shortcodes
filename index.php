<?php
/**
 * Plugin Name:       WP Mobile Detect Shortcodes
 * Description:       Lightweight plugin that creates shortcodes to show or hide content based on the user's device, this uses the Mobile Detect Library https://github.com/serbanghita/Mobile-Detect
 * Version:           0.0.1
 * Author:            MarcoLeeJr
 * Author URI:        https://github.com/marcoleejr
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

require_once( __DIR__ . "/Mobile_Detect.php");

if (!class_exists('WP_Mobile_Detect_Shortcodes_MarcoLeeJr')) {
    class WP_Mobile_Detect_Shortcodes_MarcoLeeJr {

        public $detect;

        function __construct() {
            $this->detect = new WPMDS_Mobile_Detect;
            add_shortcode('show_in_desktop', array($this, 'show_in_desktop'));
            add_shortcode('show_in_mobile', array($this, 'show_in_mobile'));
            add_shortcode('show_in_mobile_and_tablets', array($this, 'show_in_mobile_and_tablets'));
            add_shortcode('show_in_iOS', array($this, 'show_in_iOS'));
            add_shortcode('show_in_android', array($this, 'show_in_android'));
            add_shortcode('show_in_tablet', array($this, 'show_in_tablet'));
        }

        // [show_in_desktop] shortcode
        public function show_in_desktop($atts, $content = null) {
            if(!$this->detect->isMobile()) {
                return wpautop( do_shortcode( $content ) );
            } else {
                return null;
            }
        }

        // [show_in_mobile] excluding tablets shortcode
        public function show_in_mobile($atts, $content = null) {
            if($this->detect->isMobile() && !$this->detect->isTablet()){
                return  wpautop( do_shortcode( $content ) );
            } else {
                return null;
            }
        }

        // [show_in_mobile_and_tablets] including tablets shortcode
        public function show_in_mobile_and_tablets($atts, $content = null) {
            if($this->detect->isMobile()) {
                return  wpautop( do_shortcode( $content ) );
            } else {
                return null;
            }
        }

        // [show_in_iOS] shortcode
        public function show_in_iOS($atts, $content = null) {
            if($this->detect->isiOS()) {
                return  wpautop( do_shortcode( $content ) );
            } else {
                return null;
            }
        }

        // [show_in_android] shortcode
        public function show_in_android($atts, $content = null) {
            if($this->detect->isAndroidOS()) {
                return  wpautop( do_shortcode( $content ) );
            } else {
                return null;
            }
        }

        // [show_in_tablet] shortcode
        public function show_in_tablet($atts, $content = null) {
            if($this->detect->isTablet()) {
                return  wpautop( do_shortcode( $content ) );
            } else {
                return null;
            }
        }
    }

    $WP_Mobile_Detect_Shortcodes_MarcoLeeJr = new WP_Mobile_Detect_Shortcodes_MarcoLeeJr();
}
