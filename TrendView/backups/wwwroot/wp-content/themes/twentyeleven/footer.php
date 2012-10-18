<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

	</div><!-- #main -->

	<footer id="colophon" role="contentinfo">

			<?php
				/* A sidebar in the footer? Yep. You can can customize
				 * your footer with three columns of widgets.
				 */
				get_sidebar( 'footer' );
			?>

			<div id="site-generator" align = "right">
				<?php do_action( 'twentyeleven_credits' ); ?>
				<a href="<?php echo esc_url( 'http://www.radsinnovativesolutions.com/'); ?>" title="<?php esc_attr_e( 'An RIS Initiative'); ?>" rel="generator"><?php printf( __( 'Rads Innovative Solutions' ), 'WordPress' ); ?></a>
			</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>