<?php
/**
 * The template for displaying Archive pages.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

	<div id="primary" class="archivepage" <?php generate_content_class(); ?>>
		<main id="main" <?php generate_main_class(); ?>>
			<?php
			/**
			 * generate_before_main_content hook.
			 *
			 * @since 0.1
			 */
			do_action( 'generate_before_main_content' );

			if ( have_posts() ) :

				/**
				 * generate_archive_title hook.
				 *
				 * @since 0.1
				 *
				 * @hooked generate_archive_title - 10
				 */
				do_action( 'generate_archive_title' );
				?>
				<div class="box archive">
				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'content', get_post_type() );

				endwhile;
				?>
			</div>
				<?php
				generate_content_nav( 'nav-below' );

			else :

				get_template_part( 'no-results', 'archive' );

			endif;

			/**
			 * generate_after_main_content hook.
			 *
			 * @since 0.1
			 */
			do_action( 'generate_after_main_content' );
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php
	/**
	 * generate_after_primary_content_area hook.
	 *
	 * @since 2.0
	 */
	 do_action( 'generate_after_primary_content_area' );


get_footer();
