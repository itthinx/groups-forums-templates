<?php
/**
 * taxonomy-forum.php
 *
 * This is the template for Forums (forum taxonomy) when using
 * the Sentient theme.
 *
 * To modify this template:
 * - Create a groups-forums subfolder in your theme's root folder.
 * - Copy this file there and adjust it as desired.
 *
 * @author itthinx
 */
?>
<?php
function gf_sentient_forum_head() {
	// title & New Topic link
	if ( is_tax() ) {
		global $wp_query;
		if ( $forum = $wp_query->get_queried_object() ) {
			if ( $forum && !is_wp_error( $forum ) ) {
				echo '<header class="forum_header">';
				echo sprintf( '<h1 class="forum-title %s">%s</h1>', $forum->slug, wp_strip_all_tags( $forum->name ) );
				echo '</header>';
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
// remove the link as it's filtered and only displayed as text
add_filter( 'groups_forums_author_edit_topic_link', 'gf_sentient_groups_forums_author_edit_topic_link' );
function gf_sentient_groups_forums_author_edit_topic_link( $link ) {
	return '';
}
?>
<?php get_header(); ?>
	<div id="content" class="col-full">
		<section id="main" class="col-left">
		<?php if ( isset( $woo_options['woo_breadcrumbs_show'] ) && ( $woo_options['woo_breadcrumbs_show'] == 'true' ) ) { ?>
			<section id="breadcrumbs">
			<?php woo_breadcrumbs(); ?>
			</section><!--/#breadcrumbs -->
		<?php } ?>
		<?php if (have_posts()) : $count = 0; ?>
		<?php gf_sentient_forum_head(); ?>
		<div class="fix"></div>
		<?php while (have_posts()) : the_post(); $count++; ?>
			<!-- Post Starts -->
			<article <?php post_class(); ?>>
				<header>
					<h1><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
					<?php //woo_post_meta(); ?>
				</header>
				<aside class="meta post-meta">
					<ul>
						<li class="date"><?php the_time('j F Y', '<time>', '</time>'); ?></li>
						<li class="category"><?php the_category(', '); ?></li>
						<li class="comments"><?php comments_popup_link(__( '0 Comments', 'woo themes' ), __( '1 Comment', 'woo themes' ), __( '% Comments', 'woo themes' )); ?></a></li>
						<?php the_tags( '<li class="tags">', ', ', '</li>' ); ?>
					</ul>
				</aside>
				<section class="entry">
					<?php if ( isset( $woo_options['woo_post_content'] ) && $woo_options['woo_post_content'] != 'content' ) woo_image( 'width=' . $woo_options['woo_thumb_w'].'&height=' . $woo_options['woo_thumb_h'] . '&class=thumbnail ' . $woo_options['woo_thumb_align'] ); ?>
					<?php if ( isset( $woo_options['woo_post_content'] ) && $woo_options['woo_post_content'] == 'content' ) { the_content( __( 'Read More...', 'woothemes' ) ); } else { the_excerpt(); } ?>
					<p class="post-more">
						<?php if ( isset( $woo_options['woo_post_content'] ) && $woo_options['woo_post_content'] == 'excerpt' ) { ?>
						<span class="read-more"><a href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'Continue Reading &rarr;', 'woothemes' ); ?>" class="button"><?php _e( 'Continue Reading &rarr;', 'woothemes' ); ?></a></span>
						<?php } ?>
					</p>
				</section><!-- /.entry -->
			</article><!-- /.post -->
		<?php endwhile; else: ?>
			<article <?php post_class(); ?>>
				<p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ); ?></p>
			</article><!-- /.post -->
		<?php endif; ?>
			<?php woo_pagenav(); ?>
		</section><!-- /#main -->
		<?php get_sidebar(); ?>
	</div><!-- /#content -->
<?php get_footer(); ?>
