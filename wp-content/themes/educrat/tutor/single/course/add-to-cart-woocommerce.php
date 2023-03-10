<?php
/**
 * Tutor add to cart for WC product that will be visible on the course details page
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

$product_id = tutor_utils()->get_course_product_id();
$product    = wc_get_product( $product_id );

$is_logged_in             = is_user_logged_in();
$enable_guest_course_cart = tutor_utils()->get_option( 'enable_guest_course_cart' );
$required_loggedin_class  = '';
if ( ! $is_logged_in && ! $enable_guest_course_cart ) {
	$required_loggedin_class = apply_filters( 'tutor_enroll_required_login_class', 'tutor-open-login-modal' );
}

if ( $product ) {
	if ( tutor_utils()->is_course_added_to_cart( $product_id, true ) ) {
		?>
			<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="tutor-btn tutor-btn-outline-primary tutor-btn-lg tutor-btn-block tutor-woocommerce-view-cart">
				<?php esc_html_e( 'View Cart', 'educrat' ); ?>
			</a>
		<?php
	} else {
		$sale_price    = $product->get_sale_price();
		$regular_price = $product->get_regular_price();
		?>
		<div class="tutor-course-sidebar-card-pricing">
            <?php ob_start(); ?>
                <div class="course-price d-flex align-items-center">
				<span class="sale-price">
					<?php echo wc_price( $sale_price ? $sale_price : $regular_price ); //phpcs:ignore?>
				</span>
				<?php if ( $regular_price && $sale_price && $sale_price != $regular_price ) : ?>
					<span class="origin-price ms-auto">
						<?php echo wc_price( $regular_price ); //phpcs:ignore?>
					</span>
				<?php endif; ?>
			    </div>
            <?php echo apply_filters( 'tutor_course_details_wc_add_to_cart_price', ob_get_clean(), $product ); //phpcs:ignore ?>
		</div>
		<form action="<?php echo esc_url( apply_filters( 'tutor_course_add_to_cart_form_action', get_permalink( get_the_ID() ) ) ); ?>" method="post" enctype="multipart/form-data">
			<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>"  class="tutor-btn tutor-btn-primary tutor-btn-lg tutor-btn-block tutor-mt-24 tutor-add-to-cart-button <?php echo esc_attr( $required_loggedin_class ); ?>">
				<span class="btn-icon tutor-icon-cart-filled"></span>
				<span><?php echo esc_html( $product->single_add_to_cart_text() ); ?></span>
			</button>
		</form>
		<?php
	}
} else {
	?>
	<p class="tutor-alert-warning">
		<?php esc_html_e( 'Please make sure that your product exists and valid for this course', 'educrat' ); ?>
	</p>
	<?php
}
