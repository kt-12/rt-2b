<?php
/**
 * Plugin Name:     Kt Post Contributor
 * Plugin URI:      https://
 * Description:     Post meta for selecting contributor
 * Author:          Karthik Thayyil
 * Author URI:      https://kt12.in
 * Text Domain:     kt-post-contributor
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Kt_Post_Contributor
 */

defined( 'ABSPATH' ) || exit;

/**
 * Constants for this plugin.
 */
require 'ktpc-constants.php';

/**
 * Admin Side Functionalities.
 */
require KTPC_ADMIN_DIR . '/class-ktpc-contributor-metabox.php';
$ktpc_contributor_metabox = new KTPC_Contributor_MetaBox();
$ktpc_contributor_metabox->run();

/**
 * Public side Functionalities.
 */
require KTPC_PUBLIC_DIR . '/class-ktpc-post-contributors.php';
$ktpc_post_contributors = new KTPC_Post_Contributors();
$ktpc_post_contributors->run();
