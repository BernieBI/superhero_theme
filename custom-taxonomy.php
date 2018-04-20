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

	<section id="primary" <?php generate_content_class(); ?>>
		<main id="main" <?php generate_main_class(); ?>>
			<?php
						$args = array(
							"label" => get_the_title()
						);
						$output = 'names'; // or names
						$taxonomies = get_taxonomies($args, $output);
						if ( $taxonomies ) {
							foreach ( $taxonomies as $taxonomy ) {
								 $pagetax = $taxonomy;
							}
						}
					?>
						<header class="entry-header">
							<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
						</header><!-- .entry-header -->

						<div class="entry-content">
							<?php
							$terms = get_terms($pagetax);
							if ( !empty( $terms ) && !is_wp_error( $terms ) ):
							?>
							<article class="term-display <?php echo $pagetax; ?>">
							<?php	foreach ($terms as $term ):

							//henter de tre nyeste superheltene, innenfor riktig gruppe.
									query_posts(array(
											'post_type' => 'superhero',
											'showposts' => 3,
											'orderby'		=> 'publish_date',
											'order'			=> 'desc',
											'tax_query' => array(
													array (
													'taxonomy' => $pagetax,
													'field' => 'slug',
													'terms' => $term->name,
													)
											),
									) );
							?>
							<?php if ( have_posts() ) : ?>
								<div class="box archive tax">

									<a href="<?php echo get_term_link($term) ?>"><h2><?php echo $term->name ?></h2></a>
								<?php while ( have_posts() ) : the_post(); ?>
												<div class="prev-img">
												<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
														<?php the_post_thumbnail(); ?>
													</div>
											<?php
												endif; ?>
								<?php endwhile; ?>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
				</article>
				<?php endif;

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
