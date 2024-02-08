<?php
/**
 * Displays the menu icon and modal
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.3.7
 */

?>

<?php

	// globals
	global $globals;

?>

<div class="menu-modal cover-modal header-footer-group" data-modal-target-string=".menu-modal">

	<div class="menu-modal-inner modal-inner">

		<div class="menu-wrapper section-inner">

			<div class="menu-top">

				<button class="toggle close-nav-toggle fill-children-current-color" data-toggle-target=".menu-modal" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".menu-modal">
					<?php /*<span class="toggle-text"><?php _e( 'Close Menu', 'twentytwenty' ); ?></span>*/ ?>
					<?php twentytwenty_the_theme_svg( 'cross' ); ?>
				</button><!-- .nav-toggle -->

				<?php

				$mobile_menu_location = '';

				// If the mobile menu location is not set, use the primary and expanded locations as fallbacks, in that order.
				if ( has_nav_menu( 'mobile' ) ) {
					$mobile_menu_location = 'mobile';
				} elseif ( has_nav_menu( 'primary' ) ) {
					$mobile_menu_location = 'primary';
				} elseif ( has_nav_menu( 'expanded' ) ) {
					$mobile_menu_location = 'expanded';
				}

				if ( has_nav_menu( 'expanded' ) ) {

					$expanded_nav_classes = '';

					if ( 'expanded' === $mobile_menu_location ) {
						$expanded_nav_classes .= ' mobile-menu';
					}

					?>

					<nav class="expanded-menu<?php echo esc_attr( $expanded_nav_classes ); ?>" aria-label="<?php esc_attr_e( 'Expanded', 'twentytwenty' ); ?>" role="navigation">

						<ul class="modal-menu reset-list-style">
							<?php
							if ( has_nav_menu( 'expanded' ) ) {
								wp_nav_menu(
									array(
										'container'      => '',
										'items_wrap'     => '%3$s',
										'show_toggles'   => true,
										'theme_location' => 'expanded',
									)
								);
							}
							?>
						</ul>

					</nav>

					<?php
				}

				if ( 'expanded' !== $mobile_menu_location ) {
					?>

					<nav class="mobile-menu" aria-label="<?php esc_attr_e( 'Mobile', 'twentytwenty' ); ?>" role="navigation">

						<ul class="modal-menu reset-list-style">

						<?php
						if ( $mobile_menu_location ) {

							wp_nav_menu(
								array(
									'container'      => '',
									'items_wrap'     => '%3$s',
									'show_toggles'   => true,
									'theme_location' => $mobile_menu_location,
								)
							);

						} else {

							wp_list_pages(
								array(
									'match_menu_classes' => true,
									'show_toggles'       => true,
									'title_li'           => false,
									'walker'             => new TwentyTwenty_Walker_Page(),
								)
							);

						}
						?>

						</ul>

					</nav>

					<?php
				}
				?>

			</div><!-- .menu-top -->

			<div class="menu-bottom">

				<nav aria-label="<?php esc_attr_e( 'Display mode toggling', 'twentytwenty' ); ?>" role="navigation">

					<div class="current-display-mode">
						<?php echo sprintf( __( 'Display Mode: %s', 'twentytwenty-child' ), isset( $_COOKIE[ 'index_display_mode' ] ) ? $globals[ 'display' ][ $_COOKIE[ 'index_display_mode' ] ] : '' ); ?>
					</div>

					<form class="display-mode-toggle">
						<label for="display-mode-select"><?php _e( 'Change to display mode:', 'twentytwenty-child' ); ?></label>
						<select name="display-modes" id="display-mode-select">
							<option value=""><?php _e( '--Please choose an option--', 'twentytwenty-child' ); ?></option>
							<?php foreach ( $globals[ 'display' ] as $key => $value ) {
								echo '<option value="' . $key . '"' . ( $_COOKIE[ 'index_display_mode' ] == $key ? ' selected="selected"' : '' ) . '>' . $value . '</option>';
							} ?>
						</select>

						<div id="curator-mode-pass">
							<label for="display-mode-pass"><?php _e( 'Enter password:', 'twentytwenty-child' ); ?></label>
							<input type="password" name="display-mode-pass" id="display-mode-pass" />
						</div>

						<button class="submit"><?php _e( 'Send', 'twentytwenty-child' ); ?></button>
						<div class="notification"></div>
					</form>

				</nav><!-- .social-menu -->

			</div><!-- .menu-bottom -->

		</div><!-- .menu-wrapper -->

	</div><!-- .menu-modal-inner -->

</div><!-- .menu-modal -->
