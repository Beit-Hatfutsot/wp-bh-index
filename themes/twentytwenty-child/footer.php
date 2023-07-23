<?php
/**
 * footer.php
 *
 * @author		Nir Goldberg
 * @package		twentytwenty-child
 * @version		1.3.5
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'get_field' ) )
	return;

// vars
$lang	= pll_current_language();
$credit	= get_field( 'acf-options_credit_' . $lang, 'option' );

?>

		<script>

			var js_globals = {};
			js_globals.template_url	= "<?php echo TEMPLATE; ?>";
			js_globals.ajaxurl		= "<?php echo admin_url( "admin-ajax.php" ); ?>";

		</script>

		<?php if ( $credit ) : ?>

			<section class="credit">
				<div class="section-inner">
					<?php echo $credit; ?>
				</div>
			</section>

		<?php endif; ?>

		<footer id="site-footer" role="contentinfo" class="header-footer-group">

			<div class="section-inner">

				<div class="footer-credits">

					<p class="footer-copyright">&copy;
						<?php
						echo date_i18n(
							/* translators: Copyright date format, see https://www.php.net/date */
							_x( 'Y', 'copyright date format', 'twentytwenty' )
						);
						?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
					</p><!-- .footer-copyright -->

					<p class="powered-by-wordpress">
						<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'twentytwenty' ) ); ?>">
							<?php _e( 'Powered by WordPress', 'twentytwenty' ); ?>
						</a>
					</p><!-- .powered-by-wordpress -->

				</div><!-- .footer-credits -->

				<a class="to-the-top" href="#site-header">
					<span class="to-the-top-long">
						<?php
						/* translators: %s: HTML character for up arrow. */
						printf( __( 'To the top %s', 'twentytwenty' ), '<span class="arrow" aria-hidden="true">&uarr;</span>' );
						?>
					</span><!-- .to-the-top-long -->
					<span class="to-the-top-short">
						<?php
						/* translators: %s: HTML character for up arrow. */
						printf( __( 'Up %s', 'twentytwenty' ), '<span class="arrow" aria-hidden="true">&uarr;</span>' );
						?>
					</span><!-- .to-the-top-short -->
				</a><!-- .to-the-top -->

			</div><!-- .section-inner -->

		</footer><!-- #site-footer -->

		<?php wp_footer(); ?>

	</body>
</html>