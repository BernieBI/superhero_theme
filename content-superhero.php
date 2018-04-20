<?php
/**
 * Template part for displaying posts.
 *
 * @package Razor Lite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
		<div class="entry-thumbnail">
			<a href="<?php echo esc_url( get_permalink() ); ?>">
				<?php the_post_thumbnail(); ?>
			</a>
		</div>
	<?php
		endif; ?>

	<div class="entry-wrapper">

		<header class="entry-header">

		<?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
		<?php
			if ( false === get_theme_mod( 'meta_date_blog' ) ) {
				razor_lite_posted_on();
			}
			if ( false === get_theme_mod( 'meta_by_blog' ) ) {
				razor_lite_posted_by();
			}
		?>
			</div><!-- .entry-meta -->
		<?php endif; ?>

		</header><!-- .entry-header -->




	</div>
</article><!-- #post-## -->
