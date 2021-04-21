<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://titan.email
 * @since             1.0.0
 * @package           MY_PLUGIN
 *
 * @wordpress-plugin
 * Plugin Name:       my_plugin
 * Plugin URI:        https://titan.email
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 */

// If this file is called directly, abort.
if (!defined("WPINC")) {
    die();
}

/**
 * Currently plugin version.
 * Rename this for your plugin and update it as you release new versions.
 */
define("MY_PLUGIN_VERSION", "1.0.0");

echo "my_plugin is activated";