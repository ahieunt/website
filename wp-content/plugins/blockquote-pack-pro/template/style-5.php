<?php
/**
 * The template to show quote style 5
 *
 * [bs-quote] shortcode
 *
 * @author     BetterStudio
 * @package    Blockquote Pack Pro
 * @version    1.0
 */

if ( ! isset( $atts['align'] ) ) {
	$atts['align'] = 'center';
}

$_check = array(
	'left'  => '',
	'right' => '',
);

if ( ! isset( $_check[ $atts['align'] ] ) ) {
	echo '<div class="bs-quote-clearfix clearfix">';
}

$id = '';

if ( ! empty( $atts['color'] ) ) {

	$id = 'bsq-' . mt_rand( 1000, 10000 );

	bf_add_css( "blockquote#{$id}.bs-quote.bsq-t1:after {
	        background-color: {$atts['color']};
		}
		blockquote#{$id}.bs-quote.bsq-t1 a{
	        color: {$atts['color']};
		}",
		FALSE,
		TRUE
	);
}

$id = ! empty( $id ) ? "id='{$id}'" : '';

?>
	<blockquote <?php echo $id; ?> class="bs-quote bs-quote-5 bsq-t1 bsq-s5 bsq-<?php echo $atts['align']; ?>">

		<div class="quote-content">
			<?php echo wpautop( $atts['quote'] ); ?>
		</div>

		<?php if ( ! empty( $atts['author'] ) || ! empty( $atts['author_job'] ) || ! empty( $atts['author_avatar'] ) ) {
			?>
			<div class="quote-author">
				<?php if ( ! empty( $atts['author_avatar'] ) ) { ?>
					<img class="quote-author-avatar" src="<?php echo $atts['author_avatar']; ?>"/>
				<?php } ?>

				<?php if ( ! empty( $atts['author_name'] ) ) { ?>
					<?php echo bf_is_fia() ? '<cite>' : '<span class="quote-author-name">'; ?>
					<?php if ( ! empty( $atts['author_link'] ) ) { ?>
						<a href="<?php echo $atts['author_link']; ?>" target="_blank"
						   rel="nofollow"><?php echo $atts['author_name']; ?></a>
					<?php } else { ?>
						<?php echo $atts['author_name']; ?>
					<?php } ?>
					<?php echo bf_is_fia() ? '</cite>' : '</span>'; ?>
				<?php } ?>

				<?php if ( $atts['author_job'] && ! bf_is_fia() ) { ?>
					<span class="quote-author-job"><?php echo $atts['author_job']; ?></span>
					<?php
				} ?>
			</div>
			<?php
		} ?>
	</blockquote>
<?php

if ( ! isset( $_check[ $atts['align'] ] ) ) {
	echo '</div>';
}
