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

				<?php $term = get_queried_object(); ?>
				<?php //sjekker om bilde er satt til å vises ?>
				<?php if (get_field('show_image', $term)): ?>
					<?php //Henter bilde knyttet til taxonomien, som er lagt til med ACF ?>
					<img class="tax image" src="<?php the_field('image', $term); ?>" alt="">
				<?php endif;
				do_action( 'generate_archive_title' );
 				?>
		</div>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php

					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
