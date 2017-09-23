<?php



function scout_theme_enqueue_styles() {

    wp_enqueue_style( 'zerif_font', zerif_slug_fonts_url(), array(), null );

	wp_enqueue_style( 'zerif_font_all', add_query_arg( array( 'family' => urlencode( 'Open Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic' ), 'subset' => urlencode( 'latin' ) ), "//fonts.googleapis.com/css" ) );

    wp_enqueue_style( 'zerif_bootstrap_style', get_template_directory_uri() . '/css/bootstrap.css' );

    wp_style_add_data( 'zerif_bootstrap_style', 'rtl', 'replace' );

    wp_enqueue_style( 'zerif_fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), 'v1' );

    wp_enqueue_style( 'zerif_style',  get_template_directory_uri() . '/style.css', array( 'zerif_fontawesome' ), 'v1' );

	/* Add this style only for the other cases than New users that have a static page */
	$zerif_keep_old_fp_template = get_theme_mod( 'zerif_keep_old_fp_template' );

	if ( ! ( ! zerif_check_if_old_version_of_theme() && ( get_option( 'show_on_front' ) == 'page' ) && ! $zerif_keep_old_fp_template ) ) {
		$custom_css = 'body.home.page:not(.page-template-template-frontpage) {
			background-image: none !important;
		}';
		wp_add_inline_style( 'zerif_style', $custom_css );
	}

    wp_enqueue_style( 'zerif_responsive_style', get_template_directory_uri() . '/css/responsive.css', array('zerif_style'), 'v1' );

    wp_enqueue_style( 'zerif_ie_style', get_template_directory_uri() . '/css/ie.css', array('zerif_style'), 'v1' );
    wp_style_add_data( 'zerif_ie_style', 'conditional', 'lt IE 9' );

    if ( wp_is_mobile() ){

        wp_enqueue_style( 'zerif_style_mobile', get_template_directory_uri() . '/css/style-mobile.css', array('zerif_bootstrap_style', 'zerif_style'),'v1' );

    }


    wp_enqueue_style( 'scout-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'zerif_style' ),
        wp_get_theme()->get('Version')
    );


    /**
     * Big title section text
     *
     */

    function scout_big_title_img_text_function() {

        $scout_bigtitle_title_img = get_theme_mod('scout_bigtitle_title_img',get_stylesheet_directory_uri() . '/images/skaut_logo.png');

        if( !empty($scout_bigtitle_title_img) ):

            echo '<img class="intro-img" src="'.wp_kses_post( $scout_bigtitle_title_img ).'"/>';

        endif;

        $zerif_bigtitle_title_default = get_theme_mod( 'zerif_bigtitle_title' );

        if( ! empty ( $zerif_bigtitle_title_default ) ) {

            $zerif_bigtitle_title = get_theme_mod( 'zerif_bigtitle_title_2', $zerif_bigtitle_title_default );

        } elseif ( current_user_can( 'edit_theme_options' ) ) {

            $zerif_bigtitle_title = get_theme_mod ( 'zerif_bigtitle_title_2', sprintf( __( 'This piece of text can be changed in %s','zerif-lite' ), sprintf( '<a href="%1$s" class="zerif-default-links">%2$s</a>',esc_url( admin_url( 'customize.php?autofocus&#91;control&#93;=zerif_bigtitle_title_2' ) ), __( 'Big title section','zerif-lite' ) ) ) );

        } else {
            $zerif_bigtitle_title = get_theme_mod ( 'zerif_bigtitle_title_2' );
        }

        if( !empty($zerif_bigtitle_title) ):

            echo '<h1 class="intro-text">'.wp_kses_post( $zerif_bigtitle_title ).'</h1>';

        elseif ( is_customize_preview() ):

            echo '<h1 class="intro-text zerif_hidden_if_not_customizer"></h1>';
        endif;

    }
    remove_action('zerif_big_title_text', 'zerif_big_title_text_function');
    add_action( 'zerif_big_title_text', 'scout_big_title_img_text_function' ); #Outputs the image in Big title section




    function scout_our_focus_header_title_function() {

        $scout_ourfocus_title_default = get_theme_mod( 'scout_ourfocus_title' );

        if( ! empty ( $scout_ourfocus_title_default ) ) {

            $scout_ourfocus_title = get_theme_mod( 'zerif_ourfocus_title_2', $scout_ourfocus_title_default );

        } elseif ( current_user_can( 'edit_theme_options' ) ) {

            $scout_ourfocus_title = get_theme_mod ( 'zerif_ourfocus_title_2', sprintf( '<a href="%1$s" class="zerif-default-links">%2$s</a>', esc_url( admin_url( 'customize.php?autofocus&#91;control&#93;=zerif_ourfocus_title' ) ), __( 'Oddíly','scout-theme' ) ) );

        } else {
            $scout_ourfocus_title = get_theme_mod ( 'zerif_ourfocus_title_2' );
        }

        if( !empty($scout_ourfocus_title) ):
            echo '<h2 class="dark-text">'.wp_kses_post( $scout_ourfocus_title ).'</h2>';
        elseif ( is_customize_preview() ):
            echo '<h2 class="dark-text zerif_hidden_if_not_customizer"></h2>';
        endif;
    }
    remove_action('zerif_our_focus_header_title', 'zerif_our_focus_header_title_function');
    add_action( 'zerif_our_focus_header_title', 'scout_our_focus_header_title_function' ); #Outputs the title in Our focus section


    /************ Calendar section ********************/

    /**
     * Calendar section title
     *
     * HTML context: inside `.focus .section-header`
     */
    function scout_calendar_header_title_trigger() {
        do_action( 'scout_calendar_header_title' );
    }


    function scout_calendar_header_title_function() {

        $scout_calendar_title_default = get_theme_mod( 'scout_calendar_title' );

        if( ! empty ( $scout_calendar_title_default ) ) {

            $scout_calendar_title = get_theme_mod( 'scout_calendar_title', $scout_calendar_title_default );

        } elseif ( current_user_can( 'edit_theme_options' ) ) {

            $scout_calendar_title = get_theme_mod ( 'sscout_calendar_title', sprintf( '<a href="%1$s" class="zerif-default-links">%2$s</a>', esc_url( admin_url( 'customize.php?autofocus&#91;control&#93;=scout_calendar_title' ) ), __( 'Kalendář','scout-theme' ) ) );

        } else {
            $scout_calendar_title = get_theme_mod ( 'scout_calendar_title' );
        }

        if( !empty($scout_calendar_title) ):
            echo '<h2 class="dark-text">'.wp_kses_post( $scout_calendar_title ).'</h2>';
        elseif ( is_customize_preview() ):
            echo '<h2 class="dark-text zerif_hidden_if_not_customizer"></h2>';
        endif;
    }

    add_action( 'scout_calendar_header_title', 'scout_calendar_header_title_function' ); #Outputs the title in calendar section

    /**
     * Calendar us section subtitle
     *
     * HTML context: inside `.about-us .section-header`
     */
    function scout_calendar_header_subtitle_trigger() {
        do_action( 'scout_calendar_header_subtitle' );
    }

    /**
     * Before Calendar section
     *
     * HTML context: before `.focus`
     */
    function scout_before_calendar_trigger() {
        do_action( 'scout_before_calendar' );
    }

    /**
     * After Calendar section
     *
     * HTML context: after `.focus`
     */
    function scout_after_calendar_trigger() {
        do_action( 'scout_after_calendar' );
    }

    /**
     * Top of Calendar section
     *
     * HTML context: within `.focus`
     */
    function scout_top_calendar_trigger() {
        do_action( 'scout_top_calendar' );
    }

    /**
     * Bottom of Calendar section
     *
     * HTML context: within `.focus`
     */
    function scout_bottom_calendar_trigger() {
        do_action( 'scout_bottom_calendar' );
    }

}
add_action( 'wp_enqueue_scripts', 'scout_theme_enqueue_styles' );


/**
 * Declare textdomain for this child theme.
 * Translations can be filed in the /languages/ directory.
 */
function  scout_theme_setup() {
    // load custom translation file for the parent theme
    load_child_theme_textdomain( 'zerif-lite', get_stylesheet_directory() . '/languages/zerif-lite' );
    //load translation file for the child theme
    load_child_theme_textdomain( 'scout-theme', get_stylesheet_directory() . '/languages' );


}
add_action( 'after_setup_theme', 'scout_theme_setup' );

function customizer_setup(){
    /* Customizer additions. */
    require get_stylesheet_directory() . '/inc/customizer.php';

    /* Enable support for custom logo */
    add_theme_support( 'custom-logo', array(
        'flex-width'    => true
    ) );
}
add_action( 'init', 'customizer_setup' );

add_action('tgmpa_register', 'scout_register_required_plugins');
function scout_register_required_plugins() {

    $wp_version_nr = get_bloginfo('version');

    if( $wp_version_nr < 3.9 ):
        $plugins = array(
            array(
                'name' => 'Widget customizer',
                'slug' => 'widget-customizer',
                'required' => false
            ),
            array(
                'name'      => 'Pirate Forms',
                'slug'      => 'pirate-forms',
                'required'  => false,
            ),
            array(
                'name'      => 'ThemeIsle Companion for Scout theme',
                'slug'      => 'themeisle-companion',
                'required'  => false,
            ),
            array(
                'name'      => 'Easy Facebook Feed',
                'slug'      => 'easy-facebook-feed',
                'required'  => false,
            ),
            array(
                'name'      => 'Simple Calendar',
                'slug'      => 'google-calendar-events',
                'required'  => false,
            )
        );

    else:

        $plugins = array(
            array(
                'name'      => 'Pirate Forms',
                'slug'      => 'pirate-forms',
                'required'  => false,
            ),
            array(
                'name'      => 'ThemeIsle Companion for Scout theme',
                'slug'      => 'themeisle-companion',
                'required'  => false,
            ),
            array(
                'name'      => 'Easy Facebook Feed',
                'slug'      => 'easy-facebook-feed',
                'required'  => false,
            ),
            array(
                'name'      => 'Simple Calendar',
                'slug'      => 'google-calendar-events',
                'required'  => false,
            )
        );

    endif;
    $config = array(
        'default_path' => '',
        'menu' => 'tgmpa-install-plugins',
        'has_notices' => true,
        'dismissable' => true,
        'dismiss_msg' => '',
        'is_automatic' => false,
        'message' => '',
        'strings' => array(
            'page_title' => __('Install Required Plugins', 'zerif-lite'),
            'menu_title' => __('Install Plugins', 'zerif-lite'),
            'installing' => __('Installing Plugin: %s', 'zerif-lite'),
            'oops' => __('Something went wrong with the plugin API.', 'zerif-lite'),
            'notice_can_install_required' => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.','zerif-lite'),
            'notice_can_install_recommended' => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.','zerif-lite'),
            'notice_cannot_install' => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.','zerif-lite'),
            'notice_can_activate_required' => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.','zerif-lite'),
            'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.','zerif-lite'),
            'notice_cannot_activate' => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.','zerif-lite'),
            'notice_ask_to_update' => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.','zerif-lite'),
            'notice_cannot_update' => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.','zerif-lite'),
            'install_link' => _n_noop('Begin installing plugin', 'Begin installing plugins','zerif-lite'),
            'activate_link' => _n_noop('Begin activating plugin', 'Begin activating plugins','zerif-lite'),
            'return' => __('Return to Required Plugins Installer', 'zerif-lite'),
            'plugin_activated' => __('Plugin activated successfully.', 'zerif-lite'),
            'complete' => __('All plugins installed and activated successfully. %s', 'zerif-lite'),
            'nag_type' => 'updated'
        )
    );
    tgmpa($plugins, $config);
}

function scout_check_for_updates( $transient ) {

	if ( empty( $transient->checked ) ) {
		return $transient;
	}

	$themeName = '';

	foreach ( $transient->checked as $theme => $version ) {
		if ( strpos( $theme, 'dsw-skaut-svs' ) !== false && strpos( $theme, 'dsw-skaut-svs-companion' ) === false) {
			$themeName = $theme;
		}
	}

	if ( $themeName === '' ) {
		return $transient;
	}

	$raw = wp_remote_get( 'https://api.github.com/repos/skaut/dsw-skaut-svs/releases/latest', [ 'user-agent' => 'skaut' ] );
	if ( is_wp_error( $raw ) || wp_remote_retrieve_response_code( $raw ) !== 200 ) {
		return $transient;
	}

	$actual = json_decode( $raw['body'] );
	if ( $actual === null ) {
		return $transient;
	}

	if ( preg_match( '~\d+\.\d+~', $actual->tag_name ) === 1 ) {
		$package = $actual->zipball_url;

		if ( strpos( $actual->tag_name, 'v' ) === 0 ) {
			$version = substr( $actual->tag_name, 1 );
		} else {
			$version = $actual->tag_name;
		}

		if ( $package !== null && version_compare( $transient->checked[ $themeName ], $version, '<' ) ) {
			$transient->response[ $themeName ] = [
				'new_version' => $version,
				'url'         => $actual->html_url,
				'package'     => $package
			];
		}
	}

	return $transient;
}

add_filter( 'pre_set_site_transient_update_themes', 'scout_check_for_updates' );

add_filter( 'upgrader_source_selection', function ( $source ) {
	preg_match( "~([^\/]+)\/$~", $source, $result );
	if ( ! isset( $result[1] ) ) {
		return $source;
	}
	$newFolderName = str_replace( $result[1], 'dsw-skaut-svs', $source );
	rename( $source, $newFolderName );

	return $newFolderName;
}, 20, 1 );

//set_theme_mod( 'custom_logo',attachment_url_to_postid(get_stylesheet_directory_uri() . "/images/skaut_svetlusky.png"));
