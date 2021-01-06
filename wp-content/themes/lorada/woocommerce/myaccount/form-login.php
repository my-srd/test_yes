<?php
/**
 * Login Form
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 4.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<div class="container" id="customer_login">

	<div class="row justify-content-md-center"> <!-- row start -->

		<div class="col-sm-6 col-xs-12">

			<div class="account-tab-container">
				<div class="account-tab-item login-form-tab">
					<a href="#login_form" title="<?php esc_html_e('Login', 'lorada') ?>" class="active"><?php esc_html_e('Login', 'lorada') ?></a>
				</div>

				<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>
				
					<div class="account-tab-item register-form-tab">
						<a href="#register_form" title="<?php esc_html_e('Register', 'lorada') ?>"><?php esc_html_e('Register', 'lorada') ?></a>
					</div>

				<?php endif; ?>

			</div>

			<div class="account-forms-container"> 

				<div id="login_form" class="custom-login-form account-form active">
					
					<form class="woocommerce-form woocommerce-form-login login" method="post">

						<?php do_action( 'woocommerce_login_form_start' ); ?>

						<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
							<label for="username"><?php esc_html_e( 'Username or email address', 'lorada' ); ?> <span class="required">*</span></label>
							<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" />
						</p>

						<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
							<label for="password"><?php esc_html_e( 'Password', 'lorada' ); ?> <span class="required">*</span></label>
							<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" />
						</p>

						<?php do_action( 'woocommerce_login_form' ); ?>

						<p class="form-row"> 
							<span class="remember-check">
								<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" />
								<label for="rememberme" class="woocommerce-form__label woocommerce-form__label-for-checkbox remember-checkbox">
									<span><?php esc_html_e( 'Remember me', 'lorada' ); ?></span>
								</label>
							</span>

							<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" class="lost-pwd-link"><?php esc_html_e( 'Lost your password?', 'lorada' ); ?></a>
						</p>

						<p class="form-row">
							<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>

							<input type="submit" class="woocommerce-Button" name="login" value="<?php esc_attr_e( 'Login', 'lorada' ); ?>" />
						</p>

						<?php do_action( 'woocommerce_login_form_end' ); ?>

					</form>

				</div>

			<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

				<div id="register_form" class="custom-register-form account-form">
					
					<form method="post" class="register">

						<?php do_action( 'woocommerce_register_form_start' ); ?>

						<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

							<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
								<label for="reg_username"><?php esc_html_e( 'Username', 'lorada' ); ?> <span class="required">*</span></label>
								<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" />
							</p>

						<?php endif; ?>

						<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
							<label for="reg_email"><?php esc_html_e( 'Email', 'lorada' ); ?> <span class="required">*</span></label>
							<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" />
						</p>

						<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

							<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
								<label for="reg_password"><?php esc_html_e( 'Password', 'lorada' ); ?> <span class="required">*</span></label>
								<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" />
							</p>

						<?php endif; ?>

						<?php do_action( 'woocommerce_register_form' ); ?>

						<p class="woocommerce-FormRow form-row">
							<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
							<input type="submit" class="woocommerce-Button" name="register" value="<?php esc_attr_e( 'Register', 'lorada' ); ?>" />
						</p>

						<?php do_action( 'woocommerce_register_form_end' ); ?>

					</form>

				</div>

			<?php endif; ?>

			</div>

		</div>

	</div> <!-- row ended -->

</div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
