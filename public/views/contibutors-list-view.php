<?php
/**
 * Display Contributor MetaBox.
 *
 * @package   Kt_Post_Contributor/Admin/View
 */

defined( 'ABSPATH' ) || exit;
// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
?>
<div class="ktpc_contributors_block container">
	<h4><?php esc_html_e( 'Contributors', 'ktpc' ); ?></h4>
	<div class="col-12 row">
		<?php foreach ( $contributor_users as $ktpc_user ) : ?>
		<div class="ktpc_contributor media col-md-6 col-sm-12" id="ktpc_contributor_<?php echo $ktpc_user->id; ?>">
			<?php echo get_avatar( $ktpc_user->id, 96, '', $ktpc_user->display_name, array( 'class' => 'mr-2' ) ); ?>
			<div class="media-body">
				<h5 class="mt-1">
					<a href="<?php echo get_author_posts_url( $ktpc_user->id ); ?>" target="_blank" class="ktpc_display_name"><?php echo esc_html( $ktpc_user->display_name ); ?></a>
				</h5>
			</div>
		</div>
			<?php
		endforeach;
			// phpcs:enable
		?>
	</div>
</div>
