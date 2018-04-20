<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Razor Lite
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php if ( have_posts() ) : ?>

			<div class="tax header">

				<?php
				do_action( 'generate_archive_title' );
				 $term = get_queried_object(); ?>
				<?php //sjekker om bilde er satt til å vises ?>
				<?php if (get_field('show_image', $term)): ?>
				<?php //Henter bilde knyttet til taxonomien, som er lagt til med ACF ?>
				<img class="tax image" src="<?php the_field('image', $term); ?>" alt="">
				<?php endif;
 				?>
		</div>
		<div class="box archive tax">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php

					get_template_part( 'content', get_post_type() );
				?>

			<?php endwhile; ?>
		</div>
			<?php the_posts_navigation(); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php
		do_action( 'generate_after_main_content' );
		?>
	</main><!-- #main -->
	</section><!-- #primary -->

	<?php
	/**
	* generate_after_primary_content_area hook.
	*
	* @since 2.0
	*/
	do_action( 'generate_after_primary_content_area' );

	generate_construct_sidebars();

	get_footer();
