<?php

/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || false === wc_get_loop_product_visibility($product->get_id()) || !$product->is_visible()) {
	return;
}
?>
<div <?php wc_product_class('col-lg-4 col-md-6', $product); ?>>
	<div class="product__item <?php do_action('os_is_product_on_sale', $product) ?>">
		<div class="product__item__pic set-bg" data-setbg="<?php echo  get_the_post_thumbnail_url()  ?>">
			<?php do_action('os_product_label', $product) ?>
			<ul class="product__hover">
				<li><a href="<?php echo  get_the_post_thumbnail_url()  ?>" class="image-popup"><span class="arrow_expand"></span></a></li>
				<li><a href="#"><span class="icon_heart_alt"></span></a></li>
				<li> <?php woocommerce_template_loop_add_to_cart() ?></li>
			</ul>
		</div>
		<div class="product__item__text">
			<?php do_action('woocommerce_shop_loop_item_title') ?>
			<div class="rating">
				<?php do_action('woocommerce_after_shop_loop_item_title') ?>
			</div>
			<?php do_action('os_product_price', $product) ?>
		</div>
	</div>
</div>
<!-- <pre>
	<?php if ($product->get_type() == 'variable') : ?>
	<?php $a = new WC_Product_Variable() ?>
	<?php print_r($a->add_to_cart_text()) ?>
	<?php endif; ?>
</pre> -->