<?php

function scout_customize_register( $wp_customize ) {


    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial( 'scout_bigtitle_title_img', array(
            'selector'        => '.intro-img',
            'settings'        => 'scout_bigtitle_title_img',
            'render_callback' => 'scout_bigtitle_title_image_render_callback',
        ) );

        $wp_customize->selective_refresh->add_partial( 'scout_logo', array(
            'selector'        => '.icon-top red-text img',
            'settings'        => 'scout_logo',
            'render_callback' => 'scout_logo_render_callback',
        ) );

        $wp_customize->selective_refresh->add_partial( 'scout_logo_href', array(
            'selector'        => '.icon-top red-text img',
            'settings'        => 'scout_logo_href',
            'render_callback' => 'scout_logo_href_render_callback',
        ) );

        $wp_customize->selective_refresh->add_partial( 'scout_calendar_title', array(
            'selector'        => '.calendar .section-header',
            'settings'        => 'scout_calendar_title',
            'render_callback' => 'scout_calendar_title_render_callback',
        ) );

        $wp_customize->selective_refresh->add_partial( 'scout_calendar_subtitle', array(
            'selector'        => '.calendar .section-header',
            'settings'        => 'scout_calendar_subtitle',
            'render_callback' => 'scout_calendar_subtitle_render_callback',
        ) );

        $wp_customize->selective_refresh->add_partial( 'scout_calendar_shortcode', array(
            'selector'        => '.calendar .row',
            'settings'        => 'scout_calendar_shortcode',
            'render_callback' => 'scout_calendar_shortcode_render_callback',
        ) );
    }






    /* title image */
    $wp_customize->add_setting( 'scout_bigtitle_title_img', array(
        'sanitize_callback' => 'esc_url_raw',
        'default' => get_stylesheet_directory_uri() . '/images/skaut_logo.png'
    ));

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'scout_bigtitle_title_img', array(
        'label'    	=> __( 'Image', 'scout-theme' ),
        'section'  => 'zerif_bigtitle_section',
        'settings' 	=> 'scout_bigtitle_title_img',
        'priority'	=> 2,
    )));



    /******************************************/
    /**********    ABOUT US SECTION **************/
    /******************************************/

    if ( zerif_check_if_wp_greater_than_4_7() ) {

        $panel_about = new Zerif_WP_Customize_Panel( $wp_customize, 'panel_about', array(
            'priority' => 32,
            'title'    => __( 'About us section', 'zerif-lite' ),
            'panel'    => 'zerif_frontpage_sections_panel'
        ) );

        $wp_customize->add_panel( $panel_about );

    } else {

        $wp_customize->add_panel( 'panel_about', array(
            'priority' => 32,
            'title'    => __( 'About us section', 'zerif-lite' )
        ) );

    }

    $wp_customize->add_section( 'zerif_aboutus_main_section', array(
        'title'    => __( 'Main content', 'zerif-lite' ),
        'priority' => 2,
        'panel'    => 'panel_about'
    ) );

    /* big left title */
    $zerif_aboutus_biglefttitle_default = '';
    if ( defined( 'THEMEISLE_COMPANION_VERSION' ) ) {
            $zerif_aboutus_biglefttitle_default = 'Skautské středisko';
    }

    if ( current_user_can( 'edit_theme_options' ) ) {
        $wp_customize->add_setting( 'zerif_aboutus_biglefttitle', array(
            'sanitize_callback' => 'zerif_sanitize_input',
            'default'           => $zerif_aboutus_biglefttitle_default,
            'transport'         => 'postMessage'
        ) );
    } else {
        $wp_customize->add_setting( 'zerif_aboutus_biglefttitle', array(
            'sanitize_callback' => 'zerif_sanitize_input',
            'transport'         => 'postMessage'
        ) );
    }

    $wp_customize->add_control( 'zerif_aboutus_biglefttitle', array(
        'label'    => __( 'Big left side title', 'zerif-lite' ),
        'section'  => 'zerif_aboutus_main_section',
        'priority' => 4,
    ) );


    /* text */
    $zerif_aboutus_text_default = sprintf( __( 'Change this text in %s', 'zerif-lite' ), __( 'About us section', 'zerif-lite' ) );
    if ( defined( 'THEMEISLE_COMPANION_VERSION' ) ) {
        $zerif_aboutus_text_default = '
            <strong>Celý název:</strong> Junák - český skaut, středisko, z. s.<br><strong>Číslo střediska: </strong><span> 123.45</span><br><strong>IČO:</strong> 12345678<br><strong>Sídlo:</strong> Ulice 123, 123 45 Město<br><strong>Počet registrovaných členů:</strong><span> 123 (rok 2017)<br></span><strong>WWW:</strong><span> https://stredisko.skauting.cz<br><strong>Vůdce střediska:</strong>  JANA NOVÁKOVÁ';
    }

    if ( current_user_can( 'edit_theme_options' ) ) {
        $wp_customize->add_setting( 'zerif_aboutus_text', array(
            'sanitize_callback' => 'zerif_sanitize_input',
            'default'           => $zerif_aboutus_text_default,
            'transport'         => 'postMessage'
        ) );
    } else {
        $wp_customize->add_setting( 'zerif_aboutus_text', array(
            'sanitize_callback' => 'zerif_sanitize_input',
            'transport'         => 'postMessage'
        ) );
    }

    $wp_customize->add_control( 'zerif_aboutus_text', array(
        'type'     => 'textarea',
        'label'    => __( 'Text', 'zerif-lite' ),
        'section'  => 'zerif_aboutus_main_section',
        'priority' => 5,
    ) );

    $wp_customize->add_section( 'zerif_aboutus_feat1_section', array(
        'title'    => __( 'Feature no#1', 'zerif-lite' ),
        'priority' => 3,
        'panel'    => 'panel_about'
    ) );

    /* title */
    if ( current_user_can( 'edit_theme_options' ) ) {
        $wp_customize->add_setting( 'zerif_aboutus_title', array(
            'sanitize_callback' => 'zerif_sanitize_input',
            'default'           => __( 'O středisku', 'scout-theme' ),
            'transport'         => 'postMessage'
        ) );
    } else {
        $wp_customize->add_setting( 'zerif_aboutus_title', array(
            'sanitize_callback' => 'zerif_sanitize_input',
            'transport'         => 'postMessage'
        ) );
    }

    $wp_customize->add_control( 'zerif_aboutus_title', array(
        'label'    => __( 'Title', 'zerif-lite' ),
        'section'  => 'zerif_aboutus_main_section',
        'priority' => 2,
    ) );


    /* feature no#1 */
    if ( current_user_can( 'edit_theme_options' ) ) {
        $wp_customize->add_setting( 'zerif_aboutus_feature1_title', array(
            'sanitize_callback' => 'zerif_sanitize_input',
            'default'           => "",
            'transport'         => 'postMessage'
        ) );
    } else {
        $wp_customize->add_setting( 'zerif_aboutus_feature1_title', array(
            'sanitize_callback' => 'zerif_sanitize_input',
            'transport'         => 'postMessage'
        ) );
    }

    $wp_customize->add_control( 'zerif_aboutus_feature1_title', array(
        'label'    => __( 'Feature no1 title', 'zerif-lite' ),
        'section'  => 'zerif_aboutus_feat1_section',
        'priority' => 6,
    ) );

    $wp_customize->add_setting( 'zerif_aboutus_feature1_text', array(
        'sanitize_callback' => 'zerif_sanitize_input',
        'transport'         => 'postMessage'
    ) );

    $wp_customize->add_control( 'zerif_aboutus_feature1_text', array(
        'label'    => __( 'Feature no1 text', 'zerif-lite' ),
        'section'  => 'zerif_aboutus_feat1_section',
        'priority' => 7,
    ) );

    $wp_customize->add_setting( 'zerif_aboutus_feature1_nr', array(
        'sanitize_callback' => 'absint',
        'default'           => ''
    ) );

    $wp_customize->add_control( new Zerif_Customizer_Number_Control( $wp_customize, 'zerif_aboutus_feature1_nr', array(
        'type'     => 'number',
        'label'    => __( 'Feature no1 percentage', 'zerif-lite' ),
        'section'  => 'zerif_aboutus_feat1_section',
        'priority' => 8
    ) ) );

    $wp_customize->add_section( 'zerif_aboutus_feat2_section', array(
        'title'    => __( 'Feature no#2', 'zerif-lite' ),
        'priority' => 4,
        'panel'    => 'panel_about'
    ) );

    /* feature no#2 */
    if ( current_user_can( 'edit_theme_options' ) ) {
        $wp_customize->add_setting( 'zerif_aboutus_feature2_title', array(
            'sanitize_callback' => 'zerif_sanitize_input',
            'default'           => '',
            'transport'         => 'postMessage'
        ) );
    } else {
        $wp_customize->add_setting( 'zerif_aboutus_feature2_title', array(
            'sanitize_callback' => 'zerif_sanitize_input',
            'transport'         => 'postMessage'
        ) );
    }

    $wp_customize->add_control( 'zerif_aboutus_feature2_title', array(
        'label'    => __( 'Feature no2 title', 'zerif-lite' ),
        'section'  => 'zerif_aboutus_feat2_section',
        'priority' => 9,
    ) );

    $wp_customize->add_setting( 'zerif_aboutus_feature2_text', array(
        'sanitize_callback' => 'zerif_sanitize_input',
        'transport'         => 'postMessage'
    ) );

    $wp_customize->add_control( 'zerif_aboutus_feature2_text', array(
        'label'    => __( 'Feature no2 text', 'zerif-lite' ),
        'section'  => 'zerif_aboutus_feat2_section',
        'priority' => 10,
    ) );

    $wp_customize->add_setting( 'zerif_aboutus_feature2_nr', array(
        'sanitize_callback' => 'absint',
        'default'           => ''
    ) );

    $wp_customize->add_control( new Zerif_Customizer_Number_Control( $wp_customize, 'zerif_aboutus_feature2_nr', array(
        'type'     => 'number',
        'label'    => __( 'Feature no2 percentage', 'zerif-lite' ),
        'section'  => 'zerif_aboutus_feat2_section',
        'priority' => 11
    ) ) );

    $wp_customize->add_section( 'zerif_aboutus_feat3_section', array(
        'title'    => __( 'Feature no#3', 'zerif-lite' ),
        'priority' => 5,
        'panel'    => 'panel_about'
    ) );

    /* feature no#3 */
    if ( current_user_can( 'edit_theme_options' ) ) {
        $wp_customize->add_setting( 'zerif_aboutus_feature3_title', array(
            'sanitize_callback' => 'zerif_sanitize_input',
            'default'           => '',
            'transport'         => 'postMessage'
        ) );
    } else {
        $wp_customize->add_setting( 'zerif_aboutus_feature3_title', array(
            'sanitize_callback' => 'zerif_sanitize_input',
            'transport'         => 'postMessage'
        ) );
    }

    $wp_customize->add_control( 'zerif_aboutus_feature3_title', array(
        'label'    => __( 'Feature no3 title', 'zerif-lite' ),
        'section'  => 'zerif_aboutus_feat3_section',
        'priority' => 12,
    ) );

    $wp_customize->add_setting( 'zerif_aboutus_feature3_text', array(
        'sanitize_callback' => 'zerif_sanitize_input',
        'transport'         => 'postMessage'
    ) );

    $wp_customize->add_control( 'zerif_aboutus_feature3_text', array(
        'label'    => __( 'Feature no3 text', 'zerif-lite' ),
        'section'  => 'zerif_aboutus_feat3_section',
        'priority' => 13,
    ) );

    $wp_customize->add_setting( 'zerif_aboutus_feature3_nr', array(
        'sanitize_callback' => 'absint',
        'default'           => ''
    ) );

    $wp_customize->add_control( new Zerif_Customizer_Number_Control( $wp_customize, 'zerif_aboutus_feature3_nr', array(
        'type'     => 'number',
        'label'    => __( 'Feature no3 percentage', 'zerif-lite' ),
        'section'  => 'zerif_aboutus_feat3_section',
        'priority' => 14
    ) ) );

    $wp_customize->add_section( 'zerif_aboutus_feat4_section', array(
        'title'    => __( 'Feature no#4', 'zerif-lite' ),
        'priority' => 6,
        'panel'    => 'panel_about'
    ) );

    /* feature no#4 */
    if ( current_user_can( 'edit_theme_options' ) ) {
        $wp_customize->add_setting( 'zerif_aboutus_feature4_title', array(
            'sanitize_callback' => 'zerif_sanitize_input',
            'default'           => '',
            'transport'         => 'postMessage'
        ) );
    } else {
        $wp_customize->add_setting( 'zerif_aboutus_feature4_title', array(
            'sanitize_callback' => 'zerif_sanitize_input',
            'transport'         => 'postMessage'
        ) );
    }
    $wp_customize->add_control( 'zerif_aboutus_feature4_title', array(
        'label'    => __( 'Feature no4 title', 'zerif-lite' ),
        'section'  => 'zerif_aboutus_feat4_section',
        'priority' => 15,
    ) );

    $wp_customize->add_setting( 'zerif_aboutus_feature4_text', array(
        'sanitize_callback' => 'zerif_sanitize_input',
        'transport'         => 'postMessage'
    ) );

    $wp_customize->add_control( 'zerif_aboutus_feature4_text', array(
        'label'    => __( 'Feature no4 text', 'zerif-lite' ),
        'section'  => 'zerif_aboutus_feat4_section',
        'priority' => 16,
    ) );

    $wp_customize->add_setting( 'zerif_aboutus_feature4_nr', array(
        'sanitize_callback' => 'absint',
        'default'           => ''
    ) );

    $wp_customize->add_control( new Zerif_Customizer_Number_Control( $wp_customize, 'zerif_aboutus_feature4_nr', array(
        'type'     => 'number',
        'label'    => __( 'Feature no4 percentage', 'zerif-lite' ),
        'section'  => 'zerif_aboutus_feat4_section',
        'priority' => 17
    ) ) );


    /* RIBBON SECTION WITH BOTTOM BUTTON */

    $scout_bottomribbon_text_default = '';

    /* For new users, add default values for the Ribbon section controls */
    if ( ! zerif_check_if_old_version_of_theme() && current_user_can( 'edit_theme_options' ) ) {
            $scout_bottomribbon_text_default = __( 'Skauting je příležitost pro nové zážitky v každém věku','scout-theme' );
    }

    /* text */
    $wp_customize->add_setting( 'zerif_bottomribbon_text', array(
        'sanitize_callback' => 'zerif_sanitize_input',
        'default' => $scout_bottomribbon_text_default,
        'transport'         => 'postMessage'
    ) );

    /* button label */
    $wp_customize->add_setting( 'zerif_bottomribbon_buttonlabel', array(
        'sanitize_callback' => 'zerif_sanitize_input',
        'default' => '',
        'transport'         => 'postMessage'
    ) );

    /* button link */
    $wp_customize->add_setting( 'zerif_bottomribbon_buttonlink', array(
        'sanitize_callback' => 'esc_url_raw',
        'default' => '',
        'transport'         => 'postMessage'
    ) );

    /* RIBBON SECTION WITH BUTTON IN THE RIGHT SIDE */

    $scout_ribbonright_text_default = '';

    /* For new users, add default values for the Ribbon section controls */
    if ( ! zerif_check_if_old_version_of_theme() && current_user_can( 'edit_theme_options' ) ) {
        $scout_ribbonright_text_default = __( 'Najít kamarády – zažít dobrodružství','scout-theme' );
    }


    /* text */
    $wp_customize->add_setting( 'zerif_ribbonright_text', array(
        'sanitize_callback' => 'zerif_sanitize_input',
        'default' => $scout_ribbonright_text_default,
        'transport'         => 'postMessage'
    ) );

    /* button label */
    $wp_customize->add_setting( 'zerif_ribbonright_buttonlabel', array(
        'sanitize_callback' => 'zerif_sanitize_input',
        'default' => '',
        'transport'         => 'postMessage'
    ) );

    /* button link */
    $wp_customize->add_setting( 'zerif_ribbonright_buttonlink', array(
        'sanitize_callback' => 'esc_url_raw',
        'default' => '',
        'transport'         => 'postMessage'
    ) );

    /****************************************************/
    /***************** FOOTER OPTIONS ******************/
    /***************************************************/

    /* Scout - logo */
    if ( current_user_can( 'edit_theme_options' ) ) {
        $wp_customize->add_setting( 'scout_logo', array(
            'sanitize_callback' => 'esc_url_raw',
            'default'           => get_stylesheet_directory_uri() . '/images/skaut_logo_footer.png',
            'transport'         => 'postMessage'
        ) );
    } else {
        $wp_customize->add_setting( 'scout_logo', array(
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'postMessage'
        ) );
    }

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'scout_logo', array(
        'label'    => __( 'Skautské logo', 'skaut-theme' ),
        'section'  => 'zerif_general_footer_section',
        'priority' => 8,
    ) ) );

    /* scout - href */
    if ( current_user_can( 'edit_theme_options' ) ) {
        $wp_customize->add_setting( 'scout_logo_href', array(
            'sanitize_callback' => 'zerif_sanitize_input',
            'default'           => 'http://skaut.cz',
            'transport'         => 'postMessage'
        ) );
    } else {
        $wp_customize->add_setting( 'zerif_logo_href', array(
            'sanitize_callback' => 'zerif_sanitize_input',
            'transport'         => 'postMessage'
        ) );
    }

    $wp_customize->add_control( 'scout_logo_href', array(
        'label'    => __( 'Adresa odkazu', 'scout-theme' ),
        'type'     => 'textarea',
        'section'  => 'zerif_general_footer_section',
        'priority' => 8
    ) );

    /* address */
    if ( current_user_can( 'edit_theme_options' ) ) {
        $wp_customize->add_setting( 'zerif_address', array(
            'sanitize_callback' => 'esc_url_raw',
            'default'           => '',
            'transport'         => 'postMessage'
        ) );
    } else {
        $wp_customize->add_setting( 'zerif_address', array(
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'postMessage'
        ) );
    }

    /* address - ICON */
    if ( current_user_can( 'edit_theme_options' ) ) {
        $wp_customize->add_setting( 'zerif_address_icon', array(
            'sanitize_callback' => 'esc_url_raw',
            'default'           => '',
            'transport'         => 'postMessage'
        ) );
    } else {
        $wp_customize->add_setting( 'zerif_address_icon', array(
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'postMessage'
        ) );
    }

    /* email - ICON */
    if ( current_user_can( 'edit_theme_options' ) ) {
        $wp_customize->add_setting( 'zerif_email_icon', array(
            'sanitize_callback' => 'esc_url_raw',
            'default' => '',
            'transport'         => 'postMessage'
        ) );
    } else {
        $wp_customize->add_setting( 'zerif_email_icon', array(
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'postMessage'
        ) );
    }

    /* email */
    if ( current_user_can( 'edit_theme_options' ) ) {
        $wp_customize->add_setting( 'zerif_email', array(
            'sanitize_callback' => 'zerif_sanitize_input',
            'default'           => '',
            'transport'         => 'postMessage'
        ) );
    } else {
        $wp_customize->add_setting( 'zerif_email', array(
            'sanitize_callback' => 'zerif_sanitize_input',
            'transport'         => 'postMessage'
        ) );
    }


    /* phone number - ICON */
    if ( current_user_can( 'edit_theme_options' ) ) {
        $wp_customize->add_setting( 'zerif_phone_icon', array(
            'sanitize_callback' => 'esc_url_raw',
            'default' => '',
            'transport'         => 'postMessage'
        ) );
    } else {
        $wp_customize->add_setting( 'zerif_phone_icon', array(
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'postMessage'
        ) );
    }


    /* phone number */
    if ( current_user_can( 'edit_theme_options' ) ) {
        $wp_customize->add_setting( 'zerif_phone', array(
            'sanitize_callback' => 'zerif_sanitize_input',
            'default'           => '',
            'transport'         => 'postMessage'
        ) );
    } else {
        $wp_customize->add_setting( 'zerif_phone', array(
            'sanitize_callback' => 'zerif_sanitize_input',
            'transport'         => 'postMessage'
        ) );
    }

    /**********************************************/
    /**********	CALENDAR SECTION ***************/
    /**********************************************/
    $wp_customize->add_section( 'scout_calendar_section' , array(
        'title'       => __( 'Sekce Kalendář', 'scout-theme' ),
        'priority'    => 35
    ) );

    if ( zerif_check_if_wp_greater_than_4_7() ) {
        $wp_customize->get_section( 'scout_calendar_section' )->panel = 'zerif_frontpage_sections_panel';
    }

    /* calendar news show/hide */
    $wp_customize->add_setting( 'scout_calendar_show', array(
        'sanitize_callback' => 'zerif_sanitize_checkbox',
        'transport' => 'postMessage'
    ) );

    $wp_customize->add_control( 'scout_calendar_show', array(
        'type' => 'checkbox',
        'label' => __('Zobrazit sekci kalendář?','scout-theme'),
        'section' => 'scout_calendar_section',
        'priority'    => 1,
    ) );

    /* calendar title */
    $wp_customize->add_setting( 'scout_calendar_title', array(
        'sanitize_callback' => 'zerif_sanitize_input',
        'transport' => 'postMessage'
    ) );

    $wp_customize->add_control( 'scout_calendar_title', array(
        'label'    		=> __( 'Název', 'scout-theme' ),
        'section'  		=> 'scout_calendar_section',
        'priority'    	=> 2,
    ) );

    /* calendar subtitle */
    $wp_customize->add_setting( 'scout_calendar_subtitle', array(
        'sanitize_callback' => 'zerif_sanitize_input',
        'transport' => 'postMessage'
    ) );

    $wp_customize->add_control( 'scout_calendar_subtitle', array(
        'label'    		=> __( 'Kalendáře - podnázev', 'scout-theme' ),
        'section'  		=> 'scout_calendar_section',
        'priority'   	=> 3,
    ) );

    /* Calendar shortcode */
    $wp_customize->add_setting( 'scout_calendar_shortcode', array(
        'sanitize_callback' => 'zerif_sanitize_input',
        'transport' => 'postMessage'
    ) );

    $wp_customize->add_control( 'scout_calendar_shortcode', array(
        'label'    		=> __( 'Shortcode kalendáře', 'scout-theme' ),
        'section'  		=> 'scout_calendar_section',
        'priority'   	=> 3,
    ) );

    /**********************************************/
    /**********	FACEBOOK SUBSECTION ***************/
    /**********************************************/

    /* face news show/hide */
    $wp_customize->add_setting( 'scout_facebook_show', array(
        'sanitize_callback' => 'zerif_sanitize_checkbox',
        'transport' => 'postMessage'
    ) );

    $wp_customize->add_control( 'scout_facebook_show', array(
        'type' => 'checkbox',
        'label' => __('Zobrazit facebook feed?','scout-theme'),
        'section' => 'zerif_latestnews_section',
        'default' => true,
    ) );

    /* face title */
    $wp_customize->add_setting( 'scout_facebook_title', array(
        'sanitize_callback' => 'zerif_sanitize_input',
        'transport' => 'postMessage'
    ) );

    $wp_customize->add_control( 'scout_facebook_title', array(
        'label'    		=> __( 'Nadpis Facebook', 'scout-theme' ),
        'section'  		=> 'zerif_latestnews_section',
        'default'       => __( 'Facebook', 'scout-theme' ),
        'priority'    	=> 4,
    ) );

    /* face subtitle */
    $wp_customize->add_setting( 'scout_facebook_subtitle', array(
        'sanitize_callback' => 'zerif_sanitize_input',
        'transport' => 'postMessage'
    ) );

    $wp_customize->add_control( 'scout_facebook_subtitle', array(
        'label'    		=> __( 'Podnadpis Facebook', 'scout-theme' ),
        'section'  		=> 'zerif_latestnews_section',
        'priority'   	=> 5,
    ) );

}
add_action( 'customize_register', 'scout_customize_register' );


function scout_bigtitle_title_image_render_callback() {
    return wp_kses_post( get_theme_mod( 'scout_bigtitle_title_img' ) );
}

function scout_logo_render_callback() {
    return wp_kses_post( get_theme_mod( 'scout_logo' ) );
}

function scout_logo_href_render_callback() {
    return wp_kses_post( get_theme_mod( 'scout_logo_href' ) );
}


function scout_scout_calendar_show_render_callback() {
    return wp_kses_post( get_theme_mod( 'scout_calendar_show' ) );
}

function scout_scout_calendar_shortcode_render_callback() {
    return wp_kses_post( get_theme_mod( 'scout_calendar_shortcode' ) );
}

function scout_scout_calendar_title_render_callback() {
    return wp_kses_post( get_theme_mod( 'scout_calendar_title' ) );
}

function scout_scout_calendar_subtitle_render_callback() {
    return wp_kses_post( get_theme_mod( 'scout_calendar_subtitle' ) );
}