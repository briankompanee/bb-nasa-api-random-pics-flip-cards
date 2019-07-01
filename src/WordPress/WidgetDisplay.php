<?php

/*
 * This file is part of WordPress Widget Boilerplate
 * (c) Tom McFarlin <tom@tommcfarlin.com>
 *
 * This source file is subject to the GPL license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WordPressWidgetBoilerplate\WordPress;

/**
 * Validates and displays the content of the widget.
 */
class WidgetDisplay
{
    /**
     * @var string a reference to the slug of the widget to which this class is associated
     */
    private $widgetSlug;

    /**
     * Initializes the class.
     *
     * @param string a reference to the slug of the widget to which the serialier is associated
     */
    public function __construct(string $widgetSlug)
    {
        $this->widgetSlug = $widgetSlug;
    }

    /**
     * Displays the widget based on the contents of the included template.
     *
     * @param array $args     argument provided by WordPress that may be useful in rendering the widget
     * @param array $instance the values of the widget
     *
     * @SuppressWarnings("unused")
     */
    public function show($args, $instance)
    {   
        //Set Variables for options
        $title    = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts', 'bb-nasa-api-random-posts' );

        echo $args['before_widget'];
        if ( $title ) {
            echo $args[ 'before_title' ] . $title . $args[ 'after_title' ];
            include plugin_dir_path(__FILE__).'Views/Widget.php';
            echo $args['after_widget'];
        }
    }
}