<?php
/**
 * single-topic.php
 *
 * This is the default template for Topics (topic custom post type)
 * when using themes based on the Genesis framework.
 *
 * To modify this template:
 * - Create a groups-forums subfolder in your theme's root folder.
 * - Copy this file there and adjust it as desired.
 *
 * @author itthinx
 */

add_action( 'genesis_after_post_content', 'gf_genesis_after_post_content' );

function gf_genesis_after_post_content() {
	$forums = get_the_term_list( get_the_ID(), 'forum', '', ', ', '' );
	if ( !empty( $forums ) ) {
		echo '<div class="forums">';
		echo sprintf( __( 'Posted in %s', GROUPS_FORUMS_PLUGIN_DOMAIN ) , $forums );
		echo '</div>';
	}

	$tags = get_the_term_list( get_the_ID(), 'topic_tag', '', ', ', '' );
	if ( !empty( $tags ) ) {
		echo '<div class="tags">';
		echo sprintf( __( 'Tags %s', GROUPS_FORUMS_PLUGIN_DOMAIN ) , $tags );
		echo '</div>';
	}
}

genesis();
