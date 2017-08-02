<?php
/**
 * The template for displaying the footer.
 * Contains the closing of the #content div and all content after
 */

?>

</div><!-- .site-content -->

<?php zerif_before_footer_trigger(); ?>

<footer id="footer" itemscope="itemscope" itemtype="http://schema.org/WPFooter">

	<?php zerif_footer_widgets_trigger(); ?>

	<div class="container">

		<?php zerif_top_footer_trigger(); ?>

		<?php
			$footer_sections = 0;

                $scout_logo = get_theme_mod('scout_logo',get_stylesheet_directory_uri() . '/images/skaut_logo_footer.png');
                $scout_logo_href = get_theme_mod('scout_logo_href','https://skaut.cz');

				$zerif_address = get_theme_mod( 'zerif_address' );
				$zerif_address_icon = get_theme_mod( 'zerif_address_icon' );


				$zerif_email = get_theme_mod( 'zerif_email' );
				$zerif_email_icon = get_theme_mod( 'zerif_email_icon' );


				$zerif_phone = get_theme_mod( 'zerif_phone' );
				$zerif_phone_icon = get_theme_mod( 'zerif_phone_icon' );


			$zerif_socials_facebook = get_theme_mod( 'zerif_socials_facebook' );
			$zerif_socials_twitter = get_theme_mod( 'zerif_socials_twitter' );
			$zerif_socials_linkedin = get_theme_mod( 'zerif_socials_linkedin' );
			$zerif_socials_behance = get_theme_mod( 'zerif_socials_behance' );
			$zerif_socials_dribbble = get_theme_mod( 'zerif_socials_dribbble' );
			$zerif_socials_instagram = get_theme_mod( 'zerif_socials_instagram' );

			$zerif_accessibility = get_theme_mod('zerif_accessibility');
			$zerif_copyright = get_theme_mod('zerif_copyright');

			$zerif_powered_by = true;


            if( ! empty( $scout_logo ) || ! empty( $scout_logo_href ) ) {
                $footer_sections ++;
            }

			if( ! empty( $zerif_address ) || ! empty( $zerif_address_icon ) ) {
				$footer_sections ++;
			}

			if( ! empty( $zerif_email ) || ! empty( $zerif_email_icon ) ) {
				$footer_sections ++;
			}

			if( ! empty( $zerif_phone ) || ! empty( $zerif_phone_icon ) ) {
				$footer_sections ++;
			}
			if( ! empty( $zerif_socials_facebook ) || ! empty( $zerif_socials_twitter ) || ! empty( $zerif_socials_linkedin ) || ! empty( $zerif_socials_behance ) || ! empty( $zerif_socials_dribbble ) ||
			! empty( $zerif_copyright ) || ! empty( $zerif_powered_by ) || ! empty( $zerif_socials_instagram ) ) {
				$footer_sections ++;
			}

			if( $footer_sections == 1 ) {
				$footer_class = 'col-md-12';
			} elseif( $footer_sections == 2 ) {
				$footer_class = 'col-md-6';
			} elseif( $footer_sections == 3 ) {
				$footer_class = 'col-md-4';
			} elseif( $footer_sections == 4 ) {
				$footer_class = 'col-md-3';
            } elseif( $footer_sections == 5 ) {
                $footer_class = 'col-md-2';
            }else {
				$footer_class = 'col-md-2';
			}

			if( ! empty( $footer_class ) ) {

                /* SCOUT LOGO */
                if( !empty($scout_logo) || !empty($scout_logo) ) {
                    echo '<div class="'.$footer_class.' company-details"> ';

                    if( !empty($scout_logo_href) ) {
                        echo '<a href="'.esc_url($scout_logo_href).'" target="_blank">';
                    }

                    if( !empty($scout_logo) ) {
                        echo '<div class="icon-top red-text">';
                        echo '<img src="'.esc_url($scout_logo).'" alt="" />';
                        echo '</div>';
                    }

                    if( !empty($scout_logo_href) ) {
                        echo '</a>';
                    }
                    echo '</div>';
                }

                /* COMPANY ADDRESS */
                if( !empty($zerif_address_icon) || !empty($zerif_address) ) {
                    echo '<div class="'.$footer_class.' company-details">';

                    if( !empty($zerif_address_icon) ) {
                        echo '<div class="icon-top red-text">';
                        echo '<img src="'.esc_url($zerif_address_icon).'" alt="" />';
                        echo '</div>';
                    }

                    if( !empty($zerif_address) ) {
                        echo '<div class="zerif-footer-address">';
                        echo wp_kses_post( $zerif_address );
                        echo '</div>';
                    } else if( is_customize_preview() ) {
                        echo '<div class="zerif-footer-address zerif_hidden_if_not_customizer"></div>';
                    }

                    echo '</div>';
                }

				/* COMPANY EMAIL */
				if( ! empty( $zerif_email_icon) || ! empty( $zerif_email) ) {
					echo '<div class="'.$footer_class.' company-details">';

						if( ! empty( $zerif_email_icon) ) {
							echo '<div class="icon-top green-text">';
								echo '<img src="'.esc_url($zerif_email_icon).'" alt="" />';
							echo '</div>';
						}
						if( ! empty( $zerif_email) ) {
							echo '<div class="zerif-footer-email">';
								echo wp_kses_post( $zerif_email );
							echo '</div>';
						} else if( is_customize_preview() ) {
							echo '<div class="zerif-footer-email zerif_hidden_if_not_customizer"></div>';
						}

					echo '</div>';
				}

				/* COMPANY PHONE NUMBER */
				if( ! empty( $zerif_phone_icon ) || ! empty( $zerif_phone ) ) {
					echo '<div class="'.$footer_class.' company-details">';
						if( ! empty( $zerif_phone_icon ) ) {
							echo '<div class="icon-top blue-text">';
								echo '<img src="'.esc_url( $zerif_phone_icon ).'" alt="" />';
							echo '</div>';
						}
						if( ! empty( $zerif_phone ) ) {
							echo '<div class="zerif-footer-phone">';
								echo wp_kses_post( $zerif_phone );
							echo '</div>';
						} else if( is_customize_preview() ) {
							echo '<div class="zerif-footer-phone zerif_hidden_if_not_customizer"></div>';
						}
					echo '</div>';
				}
			}

			// open link in a new tab when checkbox "accessibility" is not ticked
			$attribut_new_tab = (isset($zerif_accessibility) && ($zerif_accessibility != 1) ? ' target="_blank"' : '' );

			if( ! empty( $zerif_socials_facebook ) || ! empty( $zerif_socials_twitter ) || ! empty( $zerif_socials_linkedin ) || ! empty( $zerif_socials_behance ) || ! empty( $zerif_socials_dribbble ) ||
			! empty( $zerif_copyright ) || ! empty( $zerif_powered_by ) || ! empty( $zerif_socials_instagram ) ) {

				echo '<div class="' . $footer_class . ' copyright">';
				if ( ! empty( $zerif_socials_facebook ) || ! empty( $zerif_socials_twitter ) || ! empty( $zerif_socials_linkedin ) || ! empty( $zerif_socials_behance ) || ! empty( $zerif_socials_dribbble ) ) {

					echo '<ul class="social">';

					/* facebook */
					if ( ! empty( $zerif_socials_facebook ) ) {
						echo '<li id="facebook"><a' . $attribut_new_tab . ' href="' . esc_url( $zerif_socials_facebook ) . '"><span class="sr-only">' . __( 'Facebook link', 'zerif-lite' ) . '</span> <i class="fa fa-facebook"></i></a></li>';
					}
					/* twitter */
					if ( ! empty( $zerif_socials_twitter ) ) {
						echo '<li id="twitter"><a' . $attribut_new_tab . ' href="' . esc_url( $zerif_socials_twitter ) . '"><span class="sr-only">' . __( 'Twitter link', 'zerif-lite' ) . '</span> <i class="fa fa-twitter"></i></a></li>';
					}
					/* linkedin */
					if ( ! empty( $zerif_socials_linkedin ) ) {
						echo '<li id="linkedin"><a' . $attribut_new_tab . ' href="' . esc_url( $zerif_socials_linkedin ) . '"><span class="sr-only">' . __( 'Linkedin link', 'zerif-lite' ) . '</span> <i class="fa fa-linkedin"></i></a></li>';
					}
					/* behance */
					if ( ! empty( $zerif_socials_behance ) ) {
						echo '<li id="behance"><a' . $attribut_new_tab . ' href="' . esc_url( $zerif_socials_behance ) . '"><span class="sr-only">' . __( 'Behance link', 'zerif-lite' ) . '</span> <i class="fa fa-behance"></i></a></li>';
					}
					/* dribbble */
					if ( ! empty( $zerif_socials_dribbble ) ) {
						echo '<li id="dribbble"><a' . $attribut_new_tab . ' href="' . esc_url( $zerif_socials_dribbble ) . '"><span class="sr-only">' . __( 'Dribble link', 'zerif-lite' ) . '</span> <i class="fa fa-dribbble"></i></a></li>';
					}
					/* instagram */
					if ( ! empty( $zerif_socials_instagram ) ) {
						echo '<li id="instagram"><a' . $attribut_new_tab . ' href="' . esc_url( $zerif_socials_instagram ) . '"><span class="sr-only">' . __( 'Instagram link', 'zerif-lite' ) . '</span> <i class="fa fa-instagram"></i></a></li>';
					}

					echo '</ul><!-- .social -->';
				}

				if ( ! empty( $zerif_copyright ) ) {
					echo '<p id="zerif-copyright">' . wp_kses_post( $zerif_copyright ) . '</p>';
				} elseif ( is_customize_preview() ) {
					echo '<p id="zerif-copyright" class="zerif_hidden_if_not_customizer"></p>';
				}

				echo '<div class="zerif-copyright-box"><a class="zerif-copyright" rel="nofollow">Zerif Lite </a>' . __( 'developed by', 'zerif-lite' ) . ' ' . '<a class="zerif-copyright" href="' . esc_url( 'https://themeisle.com' ) . '" ' . $attribut_new_tab . ' rel="nofollow"> ' . __( 'ThemeIsle', 'zerif-lite' ) . '</a></div>';

                echo '<div class="scout-copyright-box"><a class="scout-copyright" rel="nofollow">Scout theme </a>' . __( 'upraveno', 'scout-theme' ) . ' ' . '<a class="scout-copyright" href="' . esc_url( 'https://dobryweb.skauting.cz/' ) . '" ' . $attribut_new_tab . ' rel="nofollow"> ' . __( 'Dobry skautsky web / Jan Teply', 'scout-theme' ) . '</a></div>';

				echo '</div>';

			}
		?>
		<?php zerif_bottom_footer_trigger(); ?>
	</div> <!-- / END CONTAINER -->

</footer> <!-- / END FOOOTER  -->

<?php zerif_after_footer_trigger(); ?>

	</div><!-- mobile-bg-fix-whole-site -->
</div><!-- .mobile-bg-fix-wrap -->

<?php
/*
 *  Fix for sections with widgets not appearing anymore after the hide button is selected for each section
 * */
if ( is_customize_preview() ) {

	if ( is_active_sidebar( 'sidebar-ourfocus' ) ) {
		echo '<div class="zerif_hidden_if_not_customizer">';
			dynamic_sidebar( 'sidebar-ourfocus' );
		echo '</div>';
	}
	if ( is_active_sidebar( 'sidebar-aboutus' ) ) {
		echo '<div class="zerif_hidden_if_not_customizer">';
			dynamic_sidebar( 'sidebar-aboutus' );
		echo '</div>';
	}
	if ( is_active_sidebar( 'sidebar-ourteam' ) ) {
		echo '<div class="zerif_hidden_if_not_customizer">';
			dynamic_sidebar( 'sidebar-ourteam' );
		echo '</div>';
	}
	if ( is_active_sidebar( 'sidebar-testimonials' ) ) {
		echo '<div class="zerif_hidden_if_not_customizer">';
			dynamic_sidebar( 'sidebar-testimonials' );
		echo '</div>';
	}
}

?>

<?php wp_footer(); ?>

<?php zerif_bottom_body_trigger(); ?>

</body>

</html>