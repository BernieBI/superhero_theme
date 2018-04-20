<?php
/**
 * The template for displaying all single posts.
 *
 * @package Razor Lite
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>


			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php
					if ( has_post_thumbnail() && ! post_password_required() ) :
						$featuredimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'razor-large' );
				?>

					<div class="feature-header" style="background-image: url(<?php echo esc_url( $featuredimage[0] ); ?>);">
						<div class="header-wrapper">
							<header class="header-inner">
								<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
							</header>
						</div><!-- .site-branding -->
					</div>
					<div class="entry-wrapper">

						<?php if ( has_excerpt() ) : ?>
							<div class="entry-summary">
								<?php the_excerpt(); ?>
							</div><!-- .entry-summary -->
						<?php endif; ?>

						<div class="entry-meta">
					<?php
						if ( false === get_theme_mod( 'meta_date' ) ) {
							razor_lite_posted_on();
						}
						if ( false === get_theme_mod( 'meta_by' ) ) {
							razor_lite_posted_by();
						}
					?>
						</div><!-- .entry-meta -->

				<?php else : ?>
				<div class="entry-wrapper">

					<?php if ( has_excerpt() ) : ?>
						<div class="entry-summary">
							<?php the_excerpt(); ?>
						</div><!-- .entry-summary -->
					<?php endif; ?>

					<div class="entry-meta">
					<?php
						if ( false === get_theme_mod( 'meta_date' ) ) {
							razor_lite_posted_on();
						}
						if ( false === get_theme_mod( 'meta_by' ) ) {
							razor_lite_posted_by();
						}
					?>
					</div><!-- .entry-meta -->

					<header class="entry-header">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</header><!-- .entry-header -->

				<?php endif; ?>

					<div class="entry-content">
						<?php the_content(); ?>
						<?php
							wp_link_pages( array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'razor-lite' ),
								'after'  => '</div>',
							) );
						?>
					</div><!-- .entry-content -->

					<footer class="entry-footer">
					<?php
						if ( false === get_theme_mod( 'meta_cat' ) ) {
							razor_lite_entry_footer();
						}
						razor_lite_entry_footer_links();
					?>
					</footer><!-- .entry-footer -->
				</div>
			</article><!-- #post-## -->

			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
