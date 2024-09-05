<?php
/**
 * Template part for displaying posts
 *
 * @subpackage Modern Ecommerce
 * @since 1.0
 */
?>

<?php

$audio = modern_ecommerce_get_media(array('audio','iframe'));

?>
<?php $modern_ecommerce_post_option = get_theme_mod( 'modern_ecommerce_grid_column','3_column');
    if($modern_ecommerce_post_option == '1_column'){ ?>
    <div class="col-lg-12 col-md-12">
<?php }else if($modern_ecommerce_post_option == '2_column'){ ?>
    <div class="col-lg-6 col-md-6">
<?php }else if($modern_ecommerce_post_option == '3_column'){ ?>
    <div class="col-lg-4 col-md-4">
<?php }else if($modern_ecommerce_post_option == '4_column'){ ?>
    <div class="col-lg-3 col-md-3">
<?php }?>
	<div id="Category-section" class="entry-content w-100">
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="postbox smallpostimage p-3 wow zoomIn">
				<?php $blog_archive_ordering = get_theme_mod('archieve_post_order', array('title', 'image', 'meta','excerpt','btn'));
				foreach ($blog_archive_ordering as $post_data_order) :
					if ('title' === $post_data_order) :?>
					    <h3 class="text-center"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
					<?php elseif ('image' === $post_data_order) :?>
				        <?php
				      		if ( ! is_single() ) {
				        	// If not a single post, highlight the audio file.
				        		if ( ! empty( $audio ) ) {
				          			foreach ( $audio as $audio_html ) {
				            			echo '<div class="entry-audio">';
				            			echo $audio_html;
				            			echo '</div><!-- .entry-audio -->';
				          			}
				        		};
				      		};
				      	?>
					<?php elseif ('meta' === $post_data_order) :?>
					    <div class="date-box mb-2 text-center">
					    	<?php if ( is_sticky() ) { ?>
				    			<span class="me-2"><i class="<?php echo esc_attr(get_theme_mod('modern_ecommerce_sticky_icon','fas fa-thumb-tack')); ?> me-2"></i><?php echo esc_html('Sticky','modern-ecommerce'); ?></span>
				    		<?php } ?>
							<?php if( get_option('modern_ecommerce_date',false) != 'off'){ ?>
								<span class="me-2"><i class="<?php echo esc_attr(get_theme_mod('modern_ecommerce_date_icon','far fa-calendar-alt')); ?> me-2"></i><?php the_time( get_option( 'date_format' ) ); ?></span>
							<?php } ?>
							<?php if( get_option('modern_ecommerce_admin',false) != 'off'){ ?>
								<span class="entry-author me-2"><i class="<?php echo esc_attr(get_theme_mod('modern_ecommerce_author_icon','fas fa-user')); ?> me-2"></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?></a></span>
							<?php }?>
							<?php if( get_option('modern_ecommerce_comment',false) != 'off'){ ?>
								<span class="entry-comments me-2"><i class="<?php echo esc_attr(get_theme_mod('modern_ecommerce_comment_icon','fas fa-comments')); ?> me-2"></i> <?php comments_number( __('0 Comments','modern-ecommerce'), __('0 Comments','modern-ecommerce'), __('% Comments','modern-ecommerce')); ?></span>
							<?php }?>
							<?php if( get_option('modern_ecommerce_tag',false) != 'off'){ ?>
								<span class="tags"><i class="<?php echo esc_attr(get_theme_mod('modern_ecommerce_tag_icon','fas fa-tags')); ?> me-2"></i> <?php modern_ecommerce_display_post_tag_count(); ?></span>
							<?php }?>
						</div>
					<?php elseif ('excerpt' === $post_data_order) :?>
					    <p class="text-center"><?php modern_ecommerce_custom_excerpt(); ?></p>
					<?php elseif ('btn' === $post_data_order) :?>
					    <div class="link-more mb-2 text-center">
							<a class="more-link" href="<?php echo esc_url( get_permalink() );?>"><?php echo esc_html(get_theme_mod('modern_ecommerce_read_more_text',__('Read More','modern-ecommerce'))); ?></a>
				  		</div>
					<?php endif;
				endforeach;
				?>       
			  	<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>