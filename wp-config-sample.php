<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_plugins' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '$1r{/Zl=leu!kM<l<i{Cl$!)f9Nij|8^YJMGgJ]hHUE;*w&ite-$0;3O]H/WzT[7' );
define( 'SECURE_AUTH_KEY',  '4sE<<BK+6cf9L{Gie{)IVc VD+3UXpfA9cTnAL0WM %BHJ[4L}[cUsS#-%IByZ[3' );
define( 'LOGGED_IN_KEY',    '_+&P0c2M$gbjsY-oN,zz&cO~{}b+gclT>@:FQ8$6C;CD7Suv%2tUHh| K?3>p(N:' );
define( 'NONCE_KEY',        '2}m#KigdIWb9QaF7K6x!^e63GO2I)-RB>1iAv+rxut)0rZPQE:wezJqfe=F0nV4E' );
define( 'AUTH_SALT',        '{+LTjkazfmuU8@|rmtFTT SZpzfD::5Wv#.>AwCo4O<dDflTVocR9u1XKl^5FHo)' );
define( 'SECURE_AUTH_SALT', 's#$mnOe`!yX;<dw=8^#7OI?|~TpBnQqP^JH.f_4ADg}L-JHl#Wm(YDHc<tjQAlBi' );
define( 'LOGGED_IN_SALT',   'oV.:(z`JB<2fwS1g:Y#b$nUA_[So&7M.L`Ibl ->THp<HDyqT{gk19JC<OPt;QDe' );
define( 'NONCE_SALT',       'LH&%U{FHMG:lGss`F9h7QU=b!%d/@]edvQ2A0]3#4J`c ux6%0WrQ<( hBQtL7Op' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
