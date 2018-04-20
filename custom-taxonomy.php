<?php
/*
Template Name: Taxonomy list
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
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
					foreach ($terms as $term ):

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
			<article id="<?php echo $term->name ?>" class="term-display box">
				<?php if ( have_posts() ) : ?>

				<div id="<?php echo $term->name ?>" class=" <?php echo $pagetax; ?>">
				<a href="<?php echo get_term_link($term) ?>"><h2><?php echo $term->name ?></h2></a>
					<?php while ( have_posts() ) : the_post(); ?>

							<?php get_template_part( 'content', get_post_type() ); ?>

					<?php endwhile; ?>
				</div><!-- .entry-content -->
			<?php endif; ?>
			</article>
		<?php endforeach; ?>
	<?php endif; ?>

	<footer class="entry-footer">
		<?php edit_post_link( esc_html__( 'Edit', 'razor-lite' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
	</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
