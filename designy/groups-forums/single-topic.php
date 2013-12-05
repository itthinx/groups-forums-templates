<?php
/**
 * single-topic.php
 *
 * This is the default template for Topics (topic custom post type)
 * when using the Designy theme.
 *
 * To modify this template:
 * - Create a groups-forums subfolder in your theme's root folder.
 * - Copy this file there and adjust it as desired.
 *
 * @author itthinx
 */
?>
<?php
	add_filter( 'the_content', 'gf_designy_the_content' );
	function gf_designy_the_content( $content ) {
		$forums = get_the_term_list( get_the_ID(), 'forum', '', ', ', '' );
		if ( !empty( $forums ) ) {
			$content .= '<div class="forums">';
			$content .= sprintf( __( 'Posted in %s', GROUPS_FORUMS_PLUGIN_DOMAIN ) , $forums );
			$content .= '</div>';
		}
	
		$tags = get_the_term_list( get_the_ID(), 'topic_tag', '', ', ', '' );
		if ( !empty( $tags ) ) {
			$content .= '<div class="tags">';
			$content .= sprintf( __( 'Tags %s', GROUPS_FORUMS_PLUGIN_DOMAIN ) , $tags );
			$content .= '</div>';
		}
		return $content;
	}
?>
<?php get_template_part( 'single','topic' ); ?>
<style type="text/css">
ul.meta.bottom li.cats {
display:none;
}
</style>
