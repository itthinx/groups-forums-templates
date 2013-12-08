<?php
/**
 * taxonomy-forum.php
 * 
 * This is the template for Forums (forum taxonomy) when using
 * the Dixit theme.
 * 
 * To modify this template:
 * - Create a groups-forums subfolder in your theme's root folder.
 * - Copy this file there and adjust it as desired.
 *
 * @author itthinx
 */
?>
<?php
function gf_dixit_forum_head() {
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
}
?>
<?php get_header();
	$pagebuilder = get_default_pb_settings();
	the_pb_custom_bg_and_color( $pagebuilder );
	$current_page_sidebar = $pagebuilder['settings']['layout-sidebars'];
?>
<div class="content_wrapper <?php echo ((isset($pagebuilder['settings']['show_breadcrumb']) && $pagebuilder['settings']['show_breadcrumb'] == "yes" && get_theme_option("show_breadcrumb") !== "off") ? 'withbreadcrumb' : 'withoutbreadcrumb') ?>">
    <div class="page_title_block">
        <div class="container">
            <?php if (function_exists('the_breadcrumb') && $pagebuilder['settings']['show_breadcrumb'] !== "no" && get_theme_option("show_breadcrumb") !== "off") {the_breadcrumb();} ?>
        </div>
    </div>
    <div class="container">
        <div class="content_block <?php echo $pagebuilder['settings']['layout-sidebars'] ?> row">
            <div class="fl-container <?php echo (($pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "span9" : "span12"); ?>">
                <div class="row">
                    <div class="posts-block <?php echo (($pagebuilder['settings']['layout-sidebars'] == "left-sidebar" || $pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "span9" : "span12"); ?>">
                        <div class="contentarea">
                            <?php
                            gf_dixit_forum_head();
                            if (!post_password_required()) { the_pb_parser((isset($pagebuilder['modules']) ? $pagebuilder['modules'] : array())); }
                                echo '<div class="row-fluid"><div class="span12">';
                                while (have_posts()) : the_post();
                                    get_template_part("bloglisting");
                                endwhile; get_pagination();
                                echo '</div><div class="clear"></div></div>';
                            ?>
                        </div>
                    </div>
                    <?php get_sidebar('left'); ?>
                </div>
            </div>
            <?php get_sidebar('right'); ?>
            <div class="clear"></div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
