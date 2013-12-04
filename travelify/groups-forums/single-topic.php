<?php
/**
 * single-topic.php
 *
 * This is the default template for Topics (topic custom post type)
 * when using the Travelify theme.
 *
 * To modify this template:
 * - Create a groups-forums subfolder in your theme's root folder.
 * - Copy this file there and adjust it as desired.
 *
 * @author itthinx
 */
?>
<?php
add_action( 'travelify_after_post_content', 'gf_after_post_content', 10 );
function gf_after_post_content() {
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
?>
<?php get_header(); ?>
<style type="text/css">
article div.forums,
article div.tags {
padding: 0 1em;
}
</style>
<?php
	/**
	 * travelify_before_main_container hook
	 */
	do_action( 'travelify_before_main_container' );
?>

<div id="container">
	<?php
		/**
		 * travelify_main_container hook
		 *
		 * HOOKED_FUNCTION_NAME PRIORITY
		 *
		 * travelify_content 10
		 */
		do_action( 'travelify_main_container' );
	?>
</div><!-- #container -->

<?php
	/**
	 * travelify_after_main_container hook
	 */
	do_action( 'travelify_after_main_container' );
?>

<?php get_footer(); ?>