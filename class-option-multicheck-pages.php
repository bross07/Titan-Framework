<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class TitanFrameworkOptionMulticheckPages extends TitanFrameworkOptionMulticheck {

    public $defaultSecondarySettings = array(
        'options' => array(),
    );

    private static $allPages;

    /*
     * Display for options and meta
     */
    public function display() {

        // Remember the pages so as not to perform any more lookups
        if ( ! isset( self::$allPages ) ) {
            self::$allPages = get_pages();
        }

        $this->settings['options'] = array();
        foreach ( self::$allPages as $page ) {
            $this->settings['options'][$page->ID] = $page->post_title;
        }

        parent::display();
    }

    /*
     * Display for theme customizer
     */
    public function registerCustomizerControl( $wp_customize, $section, $priority = 1 ) {
        // Remember the pages so as not to perform any more lookups
        if ( ! isset( self::$allPages ) ) {
            self::$allPages = get_pages();
        }

        $this->settings['options'] = array();
        foreach ( self::$allPages as $page ) {
            $this->settings['options'][$page->ID] = $page->post_title;
        }

        $wp_customize->add_control( new TitanFrameworkOptionMulticheckControl( $wp_customize, $this->getID(), array(
            'label' => $this->settings['name'],
            'section' => $section->settings['id'],
            'settings' => $this->getID(),
            'description' => $this->settings['desc'],
            'options' => $this->settings['options'],
            'priority' => $priority,
        ) ) );
    }
}

?>