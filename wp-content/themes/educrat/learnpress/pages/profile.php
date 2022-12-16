<?php
/**
 * Template for displaying main user profile page.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  4.0.0
 */

defined( 'ABSPATH' ) || exit();

if ( ! isset( $profile ) ) {
	return;
}
?>

<div id="learn-press-profile" <?php $profile->main_class(); ?>>
	<?php if ( $profile->is_public() || $profile->get_user()->is_guest() ) : ?>

		<?php do_action( 'learn-press/before-user-profile', $profile ); ?>

 		<div class="lp-content-area">
			<?php
			if ( ! is_user_logged_in() ) {
				learn_press_print_messages( true );
			}

			/**
			 * @since 3.0.0
			 */
			remove_action( 'learn-press/user-profile', LP()->template( 'profile' )->func( 'login_form' ), 10 );
			remove_action( 'learn-press/user-profile', LP()->template( 'profile' )->func( 'register_form' ), 15 );
			do_action( 'learn-press/user-profile', $profile );

			if ( $profile->get_user()->is_guest() ) {
				if ( 'yes' === LP()->settings()->get( 'enable_login_profile' ) || 'yes' === LP()->settings()->get( 'enable_register_profile') ) {
			?>


				<ul class="nav nav-tabs-account" id="myTab" role="tablist">

					<?php if ( 'yes' === LP()->settings()->get( 'enable_login_profile' ) ) { ?>
					  <li class="nav-item" role="presentation">
					    <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab" aria-controls="login" aria-selected="true"><?php echo esc_html__('Login','educrat') ?></button>
					  </li>
					<?php } ?>
					<?php if ( 'yes' === LP()->settings()->get( 'enable_register_profile' ) ) { ?>
					  <li class="nav-item" role="presentation">
					    <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab" aria-controls="register" aria-selected="false"><?php echo esc_html__('Register','educrat') ?></button>
					  </li>
					<?php } ?>
				</ul>


				<div class="tab-content" id="myTabContent">
				  <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
				  	<?php
						if ( 'yes' === LP()->settings()->get( 'enable_login_profile' ) ) {
							learn_press_get_template( 'global/form-login.php' );
						}
				  	?>
				  </div>
				  <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
				  	<?php 

						if ( 'yes' === LP()->settings()->get( 'enable_register_profile' ) ) {
							learn_press_get_template( 'global/form-register.php' );
						}
				  	?>
				  </div>
				</div>
			<?php 
				}
			} ?>
		</div>
	<?php else : ?>
		<div class="lp-content-area">
			<?php esc_html_e( 'This user does not public their profile.', 'educrat' ); ?>
		</div>
	<?php endif; ?>

</div>