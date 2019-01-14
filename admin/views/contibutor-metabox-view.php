<?php
/**
 * Display Contributor MetaBox.
 *
 * @package   Kt_Post_Contributor/Admin/View
 */

defined( 'ABSPATH' ) || exit;
wp_nonce_field( 'ktpc_contributor_nonce', 'ktpc_contributor_nonce' );
// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped, WordPress.PHP.StrictInArray.MissingTrueStrict
?>
<ul>
	<?php foreach ( $wp_users as $ktpc_user ) : ?>
		<li id="li-ktpc-contributor-<?php echo $ktpc_user->id; ?>">
			<label for="ktpc_contributor-<?php echo $ktpc_user->id; ?>" >
				<input id="ktpc_contributor-<?php echo $ktpc_user->id; ?>" type="checkbox" name="ktpc_contributors[]" value="<?php echo $ktpc_user->id; ?>" <?php echo in_array( $ktpc_user->id, $contributors ) ? 'checked="checked"' : ''; ?> >
				<?php echo esc_html( $ktpc_user->display_name ); ?> ( <?php echo esc_html( $ktpc_user->user_email ); ?> )
			</label>
		</li>
		<?php
	endforeach;
	// phpcs:enable
	?>
</ul>
