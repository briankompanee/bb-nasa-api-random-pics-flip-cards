<?php
/**
 * WordPress Widget Boilerplate is used to power this widget
 * https://github.com/tommcfarlin/WordPress-Widget-Boilerplate
 *
 * The WordPress Widget Boilerplate is an organized, maintainable boilerplate for building
 * widgets using WordPress best practices.
 *
 * @package   WordPressWidgetBoilerplate
 * @author    Brian Brown
 * @link              https://thekompanee.com
 * @license   GPL-3.0+
 * @copyright 2011 - 2019 Brian Brown
 * @since             1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:       Brian's NASA API Pics 
 * Plugin URI:        https://thekompanee.com
 * Description:       Creates a widget that will get and display 5 random pics as flip cards from NASA's API feed.
 * Version:           1.0.0
 * Author:            Brian Brown
 * Author URI:        https://thekompanee.com
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       bb-nasa-api-random-posts
 * Domain Path:       /languages
 */

namespace WordPressWidgetBoilerplate;

use WordPressWidgetBoilerplate\Utilities\Registry;
use WordPressWidgetBoilerplate\Plugin;
use WordPressWidgetBoilerplate\Subscriber\WidgetSubscriber;
use WordPressWidgetBoilerplate\Subscriber\DeleteWidgetCacheSubscriber;
use WordPressWidgetBoilerplate\Subscriber\PublicStyleAssetSubscriber;
use WordPressWidgetBoilerplate\Subscriber\PublicScriptAssetSubscriber;

// Prevent this file from being called directly.
defined('WPINC') || die;

// Include the autoloader.
require_once __DIR__ . '/vendor/autoload.php';

// Setup a filter so we can retrieve the registry throughout the plugin.
$registry = new Registry();
add_filter('wpwBoilerplateRegistry', function () use ($registry) {
    return $registry;
});

// Add subscribers.
$registry->add('deleteWidgetCacheSubscriber', new DeleteWidgetCacheSubscriber('flush_widget_cache'));

// Add the Widget base class to the Registry.
$registry->add('widgetSubscriber', new WidgetSubscriber('widgets_init'));

// Add the Widget CSS
$registry->add('PublicStyleAssetSubscriber', new PublicStyleAssetSubscriber('widgets_init'));

// Add the Widget JS
$registry->add('PublicScriptAssetSubscriber', new PublicScriptAssetSubscriber('wp_footer'));

// Start the machine.
(new Plugin($registry))->start();
