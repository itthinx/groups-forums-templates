<?php
/**
 * taxonomy-forum.php
 * 
 * This is the template for Forums (forum taxonomy) when using
 * themes based on the Genesis framework.
 * 
 * To modify this template:
 * - Create a groups-forums subfolder in your theme's root folder.
 * - Copy this file there and adjust it as desired.
 *
 * @author itthinx
 */
get_header(); 
?>


<div id="main-content">
	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">
<?php

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
	if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		$post_format = et_pb_post_format(); ?>

		<article id="post-<?php the_ID(); ?>" class="et_pb_post type-post" style="margin-bottom: 60px;">

		<?php
			$thumb = '';
			$width = (int) apply_filters( 'et_pb_index_blog_image_width', 1080 );
			$height    = (int) apply_filters( 'et_pb_index_blog_image_height', 675 );
			$classtext = 'et_pb_post_main_image';
			$titletext = get_the_title();
			$alttext   = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true );
			$thumbnail = get_thumbnail( $width, $height, $classtext, $alttext, $titletext, false, 'Blogimage' );
			$thumb     = $thumbnail["thumb"];

			et_divi_post_format_content();

			if ( ! in_array( $post_format, array( 'link', 'audio', 'quote' ) ) ) {
				if ( 'video' === $post_format && false !== ( $first_video = et_get_first_video() ) ) :
					printf(
						'<div class="et_main_video_container">
							%1$s
						</div>',
						et_core_esc_previously( $first_video )
					);
				elseif ( ! in_array( $post_format, array( 'gallery' ) ) && 'on' === et_get_option( 'divi_thumbnails_index', 'on' ) && '' !== $thumb ) : ?>
					<a class="entry-featured-image-url" href="<?php the_permalink(); ?>">
						<?php print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height ); ?>
					</a>
			<?php
				elseif ( 'gallery' === $post_format ) :
					et_pb_gallery_images();
				endif;
			} ?>

		<?php if ( ! in_array( $post_format, array( 'link', 'audio', 'quote' ) ) ) : ?>
			<?php if ( ! in_array( $post_format, array( 'link', 'audio' ) ) ) : ?>
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php endif; ?>

			<?php
				et_divi_post_meta();

				if ( 'on' !== et_get_option( 'divi_blog_style', 'false' ) || ( is_search() && ( 'on' === get_post_meta( get_the_ID(), '_et_pb_use_builder', true ) ) ) ) {
					truncate_post( 270 );
				} else {
					the_content();
				}
			?>
		<?php endif; ?>

	</article> <!-- .et_pb_post -->
		<?php
				endwhile;

				if ( function_exists( 'wp_pagenavi' ) )
					wp_pagenavi();
				else
					get_template_part( 'includes/navigation', 'index' );
			else :
				get_template_part( 'includes/no-results', 'index' );
			endif;
		?>
		
	</div> <!-- div id="left-area"> --> 
	<?php
	get_sidebar(); ?>
		</div> <!-- #content-area -->
	</div> <!-- .container -->
</div> <!-- #main-content -->

<?php

get_footer();

