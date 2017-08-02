<?php
		scout_before_calendar_trigger();

		echo '<section class="calendar" id="calendar">';

			scout_top_calendar_trigger();
		
			echo '<div class="container">';

				/* SECTION HEADER */
				
				echo '<div class="section-header">';

					/* Title */
					scout_calendar_header_title_trigger();

					/* Subtitle */
					scout_calendar_header_subtitle_trigger();
				
				echo '</div><!-- END .section-header -->';

				echo '<div class="clear"></div>';
				
				echo do_shortcode(get_theme_mod('scout_calendar_shortcode'));

			echo '</div><!-- .container -->';


			scout_bottom_calendar_trigger();

		echo '</section>';

	scout_after_calendar_trigger();

?>
