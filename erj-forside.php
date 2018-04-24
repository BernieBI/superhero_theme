<?php
/*
 * Template name: ERJ forside
 */

get_header(); ?>

	<div id="primary" class="content-area" style="width:100%;">
		<main id="main" class="site-main" role="main">
			<section id="homepage2">
				<div class="home wrapper">

				<?php // check if the repeater field has rows of data?>
				<?php if( have_rows('rad') ):  ?>
						<?php  while ( have_rows('rad') ) : the_row(); ?>
							<div class="row wide">

								<?php	if( have_rows('velg_type') ):  ?>
										<?php  while ( have_rows('velg_type') ) : the_row(); ?>

											<?php	if( have_rows('halv_bredde') ):  ?>
													<?php  while ( have_rows('halv_bredde') ) : the_row(); ?>

														<?php	if( get_sub_field('bilde') ):  ?>
																<div class="square">
																	<div class="homepage2 product">
																	<a href="<?php the_sub_field('link_til_side') ?>"><img src=" <?php the_sub_field('bilde') ?>"></a>
																</div>
															</div>

														<?php	elseif( have_rows('kategorier') ): ?>

																<?php $kategorier = "" ?>
																<?php	while ( have_rows('kategorier') ) : the_row(); ?>
																	<?php if (get_sub_field('kategori') != ""): ?>
																		<?php $kategorier .= trim(get_sub_field("kategori")) . ", "; ?>
																	<?php endif; ?>
																<?php	endwhile; ?>

																<?php echo do_shortcode( " [products limit=4 columns=2 category='" . $kategorier . "' orderby='rand']"); ?>


														<?php	elseif( get_sub_field('bilde_1') ): ?>

																<div class="square">
																	<div class="homepage2 product half">

																	<a href="<?php the_sub_field('sidelink_1') ?>"><img src=" <?php the_sub_field('bilde_1') ?>"></a>
																	<a href="<?php the_sub_field('sidelink_2') ?>"><img src=" <?php the_sub_field('bilde_2') ?>"></a>

																</div>
															</div>

														<?php	endif; ?>

													<?php endwhile; ?>
											<?php	endif; ?>

											<?php	if( have_rows('full_bredde') ):  ?>
													<?php  while ( have_rows('full_bredde') ) : the_row(); ?>

															<?php if (get_sub_field('bilde')): ?>

																<?php if (get_sub_field('bruk_tekst')): ?>

																		<?php if (get_sub_field('sidelink_til_tekst') == "" ): ?>
																						<?php $e = "div" ?>
																		<?php else: ?>
																			<?php $e = "a" ?>

																		<?php endif; ?>

																			<?php if (get_sub_field('rekkefolge') == tekst): ?>

																			<<?php echo $e ?> href="<?php the_sub_field('sidelink_til_tekst') ?>" class="promo-text" style="background:<?php the_sub_field('bakgrunnsfarge'); ?>; ">
																				<h1 style=" color:<?php the_sub_field('tekstfarge');?>; "> <?php the_sub_field('stor_tekst') ?> </h1>
																				<p style=" color:<?php the_sub_field('tekstfarge');?>; "> <?php the_sub_field('liten_tekst') ?></p>
																			</<?php echo $e ?>>
																			<div class="homepage2 product">
																				<a href="<?php the_sub_field('bilde_link') ?>"><img src=" <?php the_sub_field('bilde') ?>"></a>
																			</div>

																		<?php elseif (get_sub_field('rekkefolge') == "bilde"): ?>

																			<div class="homepage2 product">
																				<a href="<?php the_sub_field('bilde_link') ?>"><img src=" <?php the_sub_field('bilde') ?>"></a>
																			</div>
																			<<?php echo $e ?> href="<?php the_sub_field('sidelink_til_tekst') ?>" class="promo-text" style="background:<?php the_sub_field('bakgrunnsfarge'); ?>; ">
																				<h1 style=" color:<?php the_sub_field('tekstfarge');?>; "> <?php the_sub_field('stor_tekst') ?> </h1>
																				<p style=" color:<?php the_sub_field('tekstfarge');?>; "> <?php the_sub_field('liten_tekst') ?></p>
																			</<?php echo $e ?>>

																		<?php endif; ?>

														<?php else: ?>

															<div class="homepage2 product">
																<a href="<?php the_sub_field('bilde_link') ?>"><img src=" <?php the_sub_field('bilde') ?>"></a>
															</div>

															<?php endif; ?>

														<?php elseif (get_sub_field('produktkarusell')): ?>

																	<?php echo do_shortcode( the_sub_field('produktkarusell') ) ?>

														<?php elseif (get_sub_field('tekst')): ?>

																			<?php if (get_sub_field('sidelink_stor') == "" ): ?>
																							<?php $e = "div" ?>
																			<?php else: ?>
																							<?php $e = "a" ?>
																			<?php endif; ?>

																			<div class="homepage2 product">
																				<<?php echo $e ?> href="<?php the_sub_field('sidelinkt_stor') ?>" class="full-text" style=" display:block; text-align: center; background:<?php the_sub_field('bakgrunnsfarge_stor'); ?>; ">
																				<h1 style=" padding:0.5em; color:<?php the_sub_field('tekstfarge_stor');?>; "> <?php the_sub_field('tekst') ?> </h1>
																				</<?php echo $e ?>>
																			</div>

													<?php endif; ?>

													<?php endwhile; ?>
											<?php	endif; ?>

										<?php endwhile; ?>
								<?php	endif; ?>

							</div>
						<?php endwhile; ?>
				<?php	endif; ?>

		</div>

		</section>
		</main><!-- #main -->
	</div><!-- #primary -->
<style media="screen">
/*skjuler knapper på forsiden*/

a.button.add_to_cart.add_to_cart_button.jck_wssv_add_to_cart.product_type_variation, a.button.product_type_simple.add_to_cart_button.ajax_add_to_cart, a.button.product_type_variable.add_to_cart_button {
display: none!important;
}
.entry-header {
display: none!important;
}

@media screen and (max-width: 800px) {
<?php echo $e ?>.promo-text h1 {
	font-size: 2em!important;
}
<?php echo $e ?>.promo-text p {
	font-size: 1em;
	margin: 10px 0;
}
<?php echo $e ?>.promo-text {
	width: 100%;
	flex-direction: row;
	justify-content: space-evenly;
	align-items: center;
	padding: 1em .5em;
	margin: 2px;
}
}

@media screen and (min-width: 800px) {
<?php echo $e ?>.promo-text {
	flex-direction: column;
	justify-content: center;
	padding: 2em;
	max-width: 30%;
}
<?php echo $e ?>.promo-text h1 {
	font-size: 3em!important;
}
<?php echo $e ?>.promo-text p {
	font-size: 1.2em;
	margin: 20px;
}
}

<?php echo $e ?>.promo-text h1,
<?php echo $e ?>.promo-text p {
text-transform: uppercase;
color: white;
}

<?php echo $e ?>.promo-text {
background: #522e3a;
color: white;
display: flex;
}

.wpcsp_product_carousel_slider {
width: 50%;
margin: 0!important;
}

#homepage>article.homepage.news>a,
#homepage2>div.homepage2.news>a {
border-bottom: 0px;
}

.row .woocommerce {
width: 50%;
}


ul.products li.product .wp-post-image{
border-radius: 0!important;
}

#homepage {
display: none;
}

@media(max-width: 768px) {
.row {
	border-top: none!important;
}
.row.news {
	order: 0;
}
.row.posters {
	order: 1;
}
}

.row {
display: flex;
flex-direction: row;
width: 100%;
height: auto;
overflow: hidden;
font-family: abel !important;
padding: 10px 0 0 0;
}


.row:first-child{
padding-top: 0;
}


.square {
width: 50%;
display: flex;
flex-wrap: wrap;
justify-content: center;
}

.homepage2 img,
.homepage img {
width: 100%;
}

.homepage2.product,
.homepage2.text {
overflow: hidden;
width: 100%;
}

.homepage2.text img {
background: #0d5959;
}

@media (max-width: 800px) {
.home.wrapper {
	width: 100%;
	display: flex;
	flex-wrap: wrap;
}
.row {
	width: 50%;
	background: none !important;
	padding: 0;
}
.square {
	width: 100%;
}
.row.wide {
	width: 100%;
	flex-direction: column;
	align-items: center;
	margin-left: 2px;
	margin-right: 2px;
}
.homepage2.product,
.homepage2.text {
	margin: 2px!important;
	width: 100%;
}
.row .woocommerce {
	display: none;
}
.homepage2.wide {
	min-width: 100%;
}
.homepage2.products.small {
	background: white;
}
.page-template-template-homepage .type-page {
	padding-top: 0em!important;
}
.entry-content {
	margin-top: 3px;
}
}

.homepage2.half a {
width: 50%;
display: block;
}
.homepage2.half {
display:flex;
}
</style>
<?php
get_footer();
