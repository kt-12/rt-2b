<?php
/**
 * Display Contributors details on post.
 *
 * @class KTPC_Post_Contributors
 * @package   Kt_Post_Contributor/Public
 */

/**
 * Class for handling frontend contributors.
 */
class KTPC_Post_Contributors {


	/**
	 * Initialize all the hooks.
	 *
	 * @return void
	 */
	public function run() {
			add_filter( 'the_content', array( $this, 'append_post_contributor_list' ), 100 );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * Enqueue Styles and Scripts to the post page.
	 *
	 * @return void
	 */
	public function enqueue_scripts() {
		if ( is_singular( 'post' ) ) {
			wp_enqueue_style( 'ktpc-bootstrap', KTPC_LIB_DIR_URL . '/css/bootstrap.min.css', array(), __return_false() );
		}
	}

	/**
	 * Appends contributor list html to the end of the post content.
	 *
	 * @param string $content Initial post content html.
	 * @return string $content final html with the orginal content and the list to be displayed.
	 */
	public function append_post_contributor_list( $content ) {
		if ( ! is_singular( 'post' ) ) {
			return $content;
		}
		$post_id           = get_post()->ID;
		$contributor_users = $this->get_contrubutor_users( $post_id );
		ob_start();
		require_once KTPC_PUBLIC_VIEWS_DIR . '/contibutors-list-view.php';
		$contributors_list_view = ob_get_clean();
		return $content . $contributors_list_view;
	}

	/**
	 * Get Contributor Wp_Users result.
	 *
	 * @param int $post_id current post's id.
	 * @return array array of contributor User.
	 */
	public function get_contrubutor_users( $post_id = null ) {
		if ( empty( $post_id ) ) {
			$post_id = get_post()->ID;
		}
		$contributors_ids = get_post_meta( $post_id, 'ktpc_contributors', true );
		$user_query       = new WP_User_Query( array( 'include' => $contributors_ids ) );
		return $user_query->get_results();
	}

}
