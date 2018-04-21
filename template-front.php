<?php
/*
Template Name: Front page
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

	<section id="primary" <?php generate_content_class(); ?>>
		<main id="main" <?php generate_main_class(); ?>>
					<?php
						//henter de tre nyeste superheltene.
						    $args = array(
						        'post_type' => 'superhero',
						        'showposts' => 3,
										'orderby'		=> 'publish_date',
										'order'			=> 'desc'
						    );
						?>
						<?php $posts = get_posts($args);?>
						<?php /* Start the Loop */ ?>
						<div id="newest-superheroes"class="box newest superheroes">
							<h2>Newest additions</h2>
							<?php if ( !empty( $posts ) && !is_wp_error( $posts ) ):  ?>
							<?php foreach ($posts as $post):?>

								<?php get_template_part( 'content', get_post_type($post->id) );?>

						<?php endforeach; ?>
					</div>


					<?php else : ?>

						<?php get_template_part( 'no-results' ); ?>

					<?php endif; ?>

					<?php
					//henter de tre nyeste gruppene.
							$args = array(
									'orderby'		=> 'publish_date',
									'order'			=> 'desc'
							 );
					?>
					<?php $terms = get_terms('group', $args);?>
					<div id="newest-groups"class="box newest groups">
					<h2>Newest groups</h2>
					<?php if ( !empty( $terms ) && !is_wp_error( $terms ) ):  ?>
						<?php
						//legger til teller som begrenser til de 3 nyeste.
						 $i = 0; ?>
						<?php foreach ($terms as $term): $i++;  ?>
							<?php if ($i < 4 ): ?>
							<div class="group-wrapper wrapper">
								<article class="group">
								<a href="<?php echo get_term_link($term) ?>"><h3><?php  echo  $term->name; ?></h3></a>
								<?php  //sjekker om bilde er satt til å vises
								 if (get_field('show_image', $term)): ?>
									<?php //Henter bilde knyttet til taxonomien, som er lagt til med ACF ?>
									<img class="tax image" src="<?php the_field('image', $term); ?>" alt="">
								<?php endif; ?>

							</article>
						</div>
							<?php  endif; ?>
							<?php endforeach; ?>
				<?php endif; ?>
			</div>
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


get_footer();
