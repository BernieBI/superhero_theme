<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Razor Lite
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

<?php //Visning av de tre nyeste sue ?>
			<?php

			//henter de tre nyeste superheltene.
			    query_posts(array(
			        'post_type' => 'superhero',
			        'showposts' => 3,
							'orderby'		=> 'publish_date',
							'order'			=> 'desc'
			    ) );
			?>
		<?php if ( have_posts() ) : ?>
			<?php /* Start the Loop */ ?>
			<div id="newest-additions"class="box newest">
				<h2>Newest additions</h2>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php

					get_template_part( 'components/content/content', get_post_type() );
				?>

			<?php endwhile; ?>
		</div>


			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'components/content-none/content', 'none' ); ?>

		<?php endif; ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
