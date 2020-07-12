<?php
/*
 * Plugin Name: Lookback Plugin
 * Plugin URI: https://github.com/yurimataev/wp-lookback-plugin
 * Description: Look back to posts published on this day in previous years.
 * Version: 0.1
 * Author: Yuri Mataev
 * Author URI: https://github.com/yurimataev
 */

require_once __DIR__ . '/class-lookback-plugin.php';

( new Lookback_Plugin() )->initialize();