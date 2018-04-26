<?php
/**
 * The Template for displaying all single posts.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

	<div id="primary" class="single" <?php generate_content_class();?>>
		<main id="main" <?php generate_main_class(); ?>>
			<?php
			/**
			 * generate_before_main_content hook.
			 *
			 * @since 0.1
			 */
			do_action( 'generate_before_main_content' );

			while ( have_posts() ) : the_post(); ?>


			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php generate_article_schema( 'CreativeWork' ); ?>>
				<div class="inside-article">
					<header class="entry-header superhero">
						<?php

						do_action( 'generate_before_entry_title' );
						if ( generate_show_title() ) {
							the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' );
						}



						do_action( 'generate_after_entry_title' );
						?>
					</header><!-- .entry-header -->

					<?php

					do_action( 'generate_after_entry_header' );
					?>

					<div class="entry-content" itemprop="text">
						<?php
						the_content();

						wp_link_pages( array(
							'before' => '<div class="page-links">' . __( 'Pages:', 'generatepress' ),
							'after'  => '</div>',
						) );
						?>
					</div><!-- .entry-content -->

					<?php
					do_action( 'generate_after_entry_content' );


					do_action( 'generate_after_content' );
					?>
				</div><!-- .inside-article -->
			</article><!-- #post-## -->
			<?php //henter ut stats  ?>
			<aside class="hero-stats">
				<?php $post_terms = get_the_terms(get_the_ID(), 'category'); ?>

				<?php if ( !is_wp_error( $post_terms) && $post_terms != false ) : ?>
						<?php foreach ($post_terms as $term) : ?>
									<?php if ($term->slug == 'user-submitted'): ?>
											<span class="tag user-submitted">
											<?php echo $term->name; ?>
											</span>
									<?php endif; ?>
						<?php endforeach; ?>
				<?php endif; ?>
				<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
						<?php the_post_thumbnail(); ?>
				<?php endif; ?>

				<ul>


					<li class ="head element">
						<span>Full Name:
							<?php the_field('full_name') ?>
						</span>
					</li>
				 <?php
				 	$taxonomies = get_taxonomies($args, 'objects');
		 				if ( $taxonomies ):
		 					foreach ( $taxonomies as $taxonomy ) :
			 				$post_terms = get_the_terms(get_the_ID(), $taxonomy->name);
				 			if ( !is_wp_error( $post_terms) && $post_terms != false ) : ?>

								<?php if ($taxonomy->name !== 'category'): ?>
								 <li class=" <?php echo $taxonomy->labels->name; ?> ">

												<span> <?php echo $taxonomy->labels->name; ?> </span>

											<?php foreach ($post_terms as $term) :?>
													<a href="<?php echo get_term_link($term) ?>"><?php  echo  $term->name; ?></a>
										<?php endforeach; ?>

									</li>
							<?php endif; ?>
					<?php endif;
					endforeach;
				endif; ?>
			</ul>
			</aside>

				<?php   // If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || '0' != get_comments_number() ) : ?>

					<div class="comments-area">
						<?php comments_template(); ?>
					</div>

				<?php endif;

			endwhile;


			do_action( 'generate_after_main_content' );
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php

	 do_action( 'generate_after_primary_content_area' );

get_footer();
