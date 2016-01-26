<?php
/**
 * taxonomy-forum.php
 * 
 * This is the adjusted template for Forums (forum taxonomy) for the
 * Twenty Sixteen theme and derived child-themes.
 * 
 * To use or modify this template:
 * - Create a groups-forums subfolder in your theme's root folder.
 * - Copy this file there and adjust it as desired.
 *
 * @author itthinx
 */

get_header();

echo '<div id="primary" class="content-area forum">';
echo '<main id="main" class="site-main" role="main">';

// title & New Topic link
if ( is_tax() ) {
	global $wp_query;
	if ( $forum = $wp_query->get_queried_object() ) {
		if ( $forum && !is_wp_error( $forum ) ) {
			echo sprintf( '<h1 class="forum-title %s">%s</h1>', $forum->slug, wp_strip_all_tags( $forum->name ) );
			echo '<br/>';
			$user_id  = get_current_user_id();
			if ( Groups_Forums::user_can_post( $user_id, $forum->term_id ) ) {
				$edit_topic_post_id = Groups_Options::get_option( 'groups-forums-edit-topic-post-id', null );
				if ( $edit_topic_post_id ) {
					$link = add_query_arg( 'forum_id', $forum->term_id, get_permalink( $edit_topic_post_id ) );
					echo '<div class="new-topic">';
					echo sprintf( '<a href="%s">%s</a>', $link, __( 'Post a new Topic', GROUPS_FORUMS_PLUGIN_DOMAIN ) );
					echo '</div>';
					echo '<br/>';
				}
			}
		}
	}
}

// forum topics
while ( have_posts() ) {
	the_post();
	get_template_part( 'template-parts/content', get_post_format() );
}

// pagination
global $wp_query;
$paginate_links = paginate_links( array(
	'base'    => str_replace( PHP_INT_MAX, '%#%', esc_url( get_pagenum_link( PHP_INT_MAX ) ) ),
	'format'  => '?paged=%#%',
	'current' => max( 1, get_query_var('paged') ),
	'total'   => $wp_query->max_num_pages
) );
if ( strlen( $paginate_links ) > 0 ) {
	echo '<div class="paginate-links">';
	echo $paginate_links;
	echo '</div>';
}

echo '</main>';
echo '</div>';

get_sidebar();
get_footer();
