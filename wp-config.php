<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'zBgE6hxpoMVV+H/vbqRFrv+tZOSokZ9hW9EZnQ12vTD/HfSXOz1mtQSWMeDXYpBEp/ikyNgmwepAbWfGTuy2Nw==');
define('SECURE_AUTH_KEY',  'Q1bJt/DG9Zivtz/7D60OmPzumO5dBPYFEQRzTpqCHuojx0dzHKqV5YsW3G3G//3E/vI/60foTPf7VaKOWATv5A==');
define('LOGGED_IN_KEY',    'qapO6Q1IBsZmDjqtoLnvIfH5LXmc/8Ra7cmu4JzJcGmAwfHQMBbu0J7OB8gmQMMtazbcSDPvoKiW9CW6tEya2Q==');
define('NONCE_KEY',        'NvA6kOnw4weyJCzHWq1hReVd4xjOrXX+Fy1nFR4cjV0vG0KLBaP9091YYF6Ffjd/c3dfEKrqmAf1CQF2Rt3L9Q==');
define('AUTH_SALT',        '7XiUEERpUnXAt1ReHe3wkfmGeubD0e9jZ/JCZQDiYGgEoG08/8qybH+g9WjejJr7hXFpluoJ/iZ6WEfWQqqCNA==');
define('SECURE_AUTH_SALT', 'PiHZskBdsf1SrFSzWobU7VryWcpAclPnUSpl9cQnmXIcESeH1V/6dSke1H41UsTYqjafTEcDD0Ze9D9iPHU6oA==');
define('LOGGED_IN_SALT',   '9WpdUnIUW4UYj82JIm04YE0GCVhAfQiQdlgSEO8vxXohj7Qqg1xTZxXK3QnS1FDKPLk9szSPFCltDf0RFzWXcA==');
define('NONCE_SALT',       'wGGzd3mcMqzcC+vRyAgogyzyoNqhSnY8h/FSwRAmPom3QWrW64CAcpRHQZxUNHnw+iknartTF0smtfToTbe3OA==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
