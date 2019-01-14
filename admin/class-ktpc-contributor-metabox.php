<?php
/**
 * Contributor MetaBox Admin code.
 *
 * @class KTPC_Contributor_MetaBox
 * @package   Kt_Post_Contributor/Admin
 */

/**
 * Class for Contributor MetaBox.
 */
class KTPC_Contributor_MetaBox {


	/**
	 * Uqiue id contributor metabox.
	 *
	 * @var string
	 */
	private $meta_box_id;

	/**
	 *  Initialize class variables.
	 */
	public function __construct() {
		$this->$meta_box_id = 'ktpc_contributors_box_id';
	}

	/**
	 * Initialize all the hooks.
	 *
	 * @return void
	 */
	public function run() {
		add_action( 'add_meta_boxes', array( $this, 'add_custom_box' ) );
		add_action( 'save_post', array( $this, 'save_postdata' ) );
	}

	/**
	 * Register Contributor MetaBox.
	 *
	 * @return void
	 */
	public function add_custom_box() {
		$user = wp_get_current_user();
		if ( in_array( 'author', (array) $user->roles, true ) || in_array( 'editor', (array) $user->roles, true ) || in_array( 'administrator', (array) $user->roles, true ) ) {
			add_meta_box(
				$this->$meta_box_id,
				__( 'Contributors', 'ktpc' ),
				array( $this, 'render_contributor_box' ),
				'post'
			);
		}
	}

	/**
	 * Rendering code for contributor code.
	 *
	 * @param object $post Current page post object.
	 * @return void
	 */
	public function render_contributor_box( $post ) {
		$wp_users     = get_users();
		$contributors = get_post_meta( $post->ID, 'ktpc_contributors', true );
		require_once KTPC_ADMIN_VIEWS_DIR . '/contibutor-metabox-view.php';
	}

	/**
	 * Save Posted Data.
	 *
	 * @param int $post_id current page post id.
	 * @return int/boolean/void post_id if autosave or true if success, void in all other cases.
	 */
	public function save_postdata( $post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		if ( ! empty( $_POST['ktpc_contributors'] ) && check_admin_referer( 'ktpc_contributor_nonce', 'ktpc_contributor_nonce' ) ) {
			if ( array_key_exists( 'ktpc_contributors', $_POST ) ) {
				return update_post_meta(
					$post_id,
					'ktpc_contributors',
					// phpcs:disable WordPress.Security.ValidatedSanitizedInput.MissingUnslash,WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
					array_filter( $_POST['ktpc_contributors'], 'ctype_digit' )                   // remove values with non digit.
					// phpcs:enable
				);
			}
		}
	}
}
