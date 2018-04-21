<?php
/*
 Template Name: Taxonomy page
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>
<?php the_content(); ?>
	<section id="primary" <?php generate_content_class(); ?>>
		<main id="main" <?php generate_main_class(); ?>>
	<?php
				$pagetitle = get_the_title();
				$args = array(
					"label" 	=> $pagetitle,
				);
				$output = 'names'; // or names
				$taxonomies = get_taxonomies($args, $output);
				if ( $taxonomies ):
					foreach ( $taxonomies as $taxonomy ) :
						 $pagetax = $taxonomy;
					endforeach;
				endif;
			?>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</header><!-- .entry-header -->
					<div class="entry-content">
				<?php
					if ( have_posts() ) :
						while ( have_posts() ) : the_post();
							the_content();
						endwhile; ?>
					<?php endif; ?>
				<?php if ($pagetax != 'equipment'): ?>
					<?php
					$args = array(
						"orderby" => "count",
						"order" 	=> "desc",
						"number"		=> 3,
					);
					$terms = get_terms($pagetax, $args);
					if ( !empty( $terms ) && !is_wp_error( $terms ) ):
						?>
						<h2>Most Common <?php echo $pagetitle ?></h2>
						<article class="term-display <?php echo $pagetax; ?>">
						<?php	foreach ($terms as $term ):
							//henter de tre nyeste superheltene, innenfor riktig gruppe.
									$args = array(
											'post_type' => 'superhero',
											'showposts' => -1,
											'orderby'		=> 'publish_date',
											'order'			=> 'desc',
											'tax_query' => array(
													array (
													'taxonomy' => $pagetax,
													'field' => 'slug',
													'terms' => $term->name,
													)
											),
									 );
							?>
						<?php $posts = get_posts($args);?>
							<?php if (  sizeof($posts) > 1 && !is_wp_error( $posts ) ):  ?>
								<div class="box archive tax">
									<a href="<?php echo get_term_link($term) ?>"><h2><?php echo $term->name ?></h2></a>
									<?php foreach ($posts as $post):?>
										<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
												<div class="prev-img">
														<?php the_post_thumbnail(); ?>
													</div>
											<?php
												endif; ?>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>

					<?php endforeach; ?>
				<?php endif; ?>
			<?php endif; ?>
			 <?php $terms = get_terms($pagetax);?>
				<h2>All <?php echo $pagetitle; ?></h2>
					<ul class="termlist <?php echo ($pagetax != 'equipment' ? 'simple' : '' ) ;  ?>">
						<?php foreach ($terms as $term): ?>
							<?php if ($pagetax === 'equipment'): ?>
							<?php
							$args = array(
									'post_type' => 'superhero',
									'showposts' => 1,
									'tax_query' => array(
											array (
											'taxonomy' => $pagetax,
											'field' => 'slug',
											'terms' => $term->name,
											)
									),
							 );
					?>
				<?php $posts = get_posts($args);?>
						<?php if ( !is_wp_error( $posts ) ):  ?>
								<?php foreach ($posts as $post):?>
									<li class="equipment">
										 <a href="<?php echo get_term_link($term) ?>"> <h3><?php echo $term->name ?></h3></a>
										<?php get_template_part( 'content', get_post_type() ); ?>

									</li>
								<?php endforeach; ?>
						<?php endif; ?>
						<?php else: ?>
							<li class= "taxonomy"><a href="<?php echo get_term_link($term) ?>"><?php echo $term->name ?></a></li>
					<?php endif; ?>
				<?php endforeach; ?>
				</ul>

				</article>
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
