<?php
/**
 * single-topic.php
 *
 * This is the adjusted template for Topics (topic custom post type) with
 * the Twenty Sixteen theme and derived child-themes.
 * 
 * To modify this template:
 * - Create a groups-forums subfolder in your theme's root folder.
 * - Copy this file there and adjust it as desired.
 *
 * @author itthinx
 */

get_header();

echo '<div id="primary" class="content-area topic">';
echo '<main id="main" class="site-main" role="main">';

while( have_posts() ) {

	the_post();
	get_template_part( 'template-parts/content', get_post_format() );
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

	// if you want to link to the previous / next topic ...

	//echo '<div class="previous">';
	//previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'twentytwelve' ) . '</span> %title' );
	//echo '</div>';

	//echo '<div class="next">';
	//next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentytwelve' ) . '</span>' );
	//echo '</div>';

	comments_template( '', true );
}

echo '</main>';
echo '</div>';

get_sidebar();
get_footer();
