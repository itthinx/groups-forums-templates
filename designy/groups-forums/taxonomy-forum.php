<?php
/**
 * taxonomy-forum.php
 * 
 * This is the template for Forums (forum taxonomy) when using
 * the Designy theme.
 * 
 * To modify this template:
 * - Create a groups-forums subfolder in your theme's root folder.
 * - Copy this file there and adjust it as desired.
 *
 * @author itthinx
 */
?>
<?php
function gf_designy() {
	// title & New Topic link
	if ( is_tax() ) {
		global $wp_query;
		if ( $forum = $wp_query->get_queried_object() ) {
			if ( $forum && !is_wp_error( $forum ) ) {
				$user_id  = get_current_user_id();
				if ( Groups_Forums::user_can_post( $user_id, $forum->term_id ) ) {
					$edit_topic_post_id = Groups_Options::get_option( 'groups-forums-edit-topic-post-id', null );
					if ( $edit_topic_post_id ) {
						$link = add_query_arg( 'forum_id', $forum->term_id, get_permalink( $edit_topic_post_id ) );
						echo '<div class="new-topic">';
						echo sprintf( '<a href="%s">%s</a>', $link, __( 'Post a new Topic', GROUPS_FORUMS_PLUGIN_DOMAIN ) );
						echo '</div>';
					}
				}
			}
		}
	}
}
?>
<?php get_header(); ?>
<?php $general_options = get_option( 'meanthemes_theme_general_options_designy' ); ?>
<?php $content_options = get_option ( 'meanthemes_theme_content_options_designy' ); ?>
<div class="wrapper content">
<?php if( (isset($general_options[ 'hide_archive_title' ])) && ($general_options[ 'hide_archive_title' ])) { ?>
	<h1 class="searching">
	<?php if ( is_day() ) : ?>
		<?php printf( __( "%s" , "meanthemes" ), get_the_date() ); ?>
	<?php elseif ( is_month() ) : ?>
		<?php printf( __( "%s" , "meanthemes" ), get_the_date('F Y') ); ?>
	<?php elseif ( is_year() ) : ?>
		<?php printf( __( "%s" , "meanthemes" ), get_the_date('Y') ); ?>
	<?php else : ?>
		<?php echo single_cat_title(); ?>
	<?php endif; ?>
	</h1>
	
<?php } else { ?>
	<h1 class="searching">
	<?php if ( is_day() ) : ?>
		<?php printf( __( "Daily Forums: <span>%s</span>" , "meanthemes" ), get_the_date() ); ?>
	<?php elseif ( is_month() ) : ?>
		<?php printf( __( "Monthly Forums: <span>%s</span>" , "meanthemes" ), get_the_date('F Y') ); ?>
	<?php elseif ( is_year() ) : ?>
		<?php printf( __( "Yearly Forums: <span>%s</span>" , "meanthemes" ), get_the_date('Y') ); ?>
	<?php else : ?>
		<?php _e( "Forum: " , "meanthemes" ); ?><span><?php echo single_cat_title(); ?></span>
	<?php endif; ?>
	</h1>
<?php } ?>
<style type="text/css">
div.new-topic { margin-top: 1em; }
div.new-topic a:hover { color: #fff; }
</style>
<?php gf_designy(); ?>
<div class="divider"><div class="divide"></div></div>
	<div class="posts">
		<?php
		rewind_posts();
		if (have_posts()) :
		while (have_posts()) : the_post();
		if(!get_post_format()) {
			get_template_part('format', 'standard');
		} else {
			get_template_part('format', get_post_format());
		}
		endwhile;
		endif;
		?>
		<?php if ( $wp_query->max_num_pages > 1 ) : ?>
		<div class="navigation">
			<nav class='pagination'>
				<ul>
					<li><span class="hyphen">-</span></li>
					<?php meanthemes_pagination(); ?>
				</ul>
			</nav>
			<div class="prev-next">
				<span class="nav-previous"><?php previous_posts_link( __( 'Previous &gt;', 'meanthemes' ) ); ?></span>
				<span class="nav-next"><?php next_posts_link( __( '&lt; Next', 'meanthemes' ) ); ?></span>
			</div>
		</div><!-- /navigation -->
<?php endif; ?>
</div>
<?php if( (isset($general_options[ 'show_nav' ])) && ($general_options[ 'show_nav' ])) { ?>
		<div class="sidebar">
			<?php get_sidebar(); ?>
		</div>
<?php } ?>
</div>
<?php get_footer(); ?>
