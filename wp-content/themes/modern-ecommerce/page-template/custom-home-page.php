<?php
/**
 * Template Name: Custom Home Page
 */
get_header(); ?>

<main id="content">
<?php if( get_option('modern_ecommerce_slider_arrows') == '1'){ ?>
    <section id="slider">
      <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <?php
          for ( $modern_ecommerce_i = 1; $modern_ecommerce_i <= 4; $modern_ecommerce_i++ ) {
            $modern_ecommerce_mod =  get_theme_mod( 'modern_ecommerce_post_setting' . $modern_ecommerce_i );
            if ( 'page-none-selected' != $modern_ecommerce_mod ) {
              $modern_ecommerce_slide_post[] = $modern_ecommerce_mod;
            }
          }
           if( !empty($modern_ecommerce_slide_post) ) :
          $modern_ecommerce_args = array(
            'post_type' =>array('post'),
            'post__in' => $modern_ecommerce_slide_post,
            'ignore_sticky_posts'  => true, // Exclude sticky posts by default
          );

          // Check if specific posts are selected
          if (empty($modern_ecommerce_slide_post) && is_sticky()) {
              $modern_ecommerce_args['post__in'] = get_option('sticky_posts');
          }

          $modern_ecommerce_query = new WP_Query( $modern_ecommerce_args );
          if ( $modern_ecommerce_query->have_posts() ) :
            $modern_ecommerce_i = 1;
        ?>
        <div class="carousel-inner" role="listbox">
          <?php  while ( $modern_ecommerce_query->have_posts() ) : $modern_ecommerce_query->the_post(); ?>
          <div <?php if($modern_ecommerce_i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
            <div class="row">
              <div class="col-lg-6 col-md-6  image-content">
              <?php if(has_post_thumbnail()){ ?>
                <img src="<?php the_post_thumbnail_url('full'); ?>"/>
              <?php }else{?>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/slider.png" alt="" />
              <?php } ?>
              </div>
              <div class="col-lg-6 col-md-6  slide-content">
                <div class="carousel-caption slider-inner px-5 px-md-3">
                  <h2 class="slider-title"><?php the_title();?></h2>
                  <?php if( get_option('modern_ecommerce_slider_excerpt_show_hide',false) != 'off'){ ?>
                    <p class="slider-excerpt mb-0"><?php echo wp_trim_words(get_the_content(), get_theme_mod('modern_ecommerce_slider_excerpt_count',20) );?></p>
                  <?php } ?>
                  <div class="home-btn my-4">
                    <a class="py-sm-3 px-sm-4 py-2 px-3" href="<?php the_permalink(); ?>"><?php echo esc_html(get_theme_mod('modern_ecommerce_slider_read_more',__('Shop Now','modern-ecommerce'))); ?><i class="fas fa-shopping-bag ms-2"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php $modern_ecommerce_i++; endwhile;
          wp_reset_postdata();?>
        </div>
        <?php else : ?>
        <div class="no-postfound"></div>
          <?php endif;
        endif;?>
          <a class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
          </a>
          <a class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fas fa-chevron-right"></i></span>
          </a>
      </div>
      <div class="clearfix"></div>
    </section>
<?php }?>

<?php if( get_option('modern_ecommerce_service_show_hide') == '1'){ ?>
  <?php if( get_theme_mod('modern_ecommerce_category_setting') != ''){ ?>
    <section id="product-services">
      <div class="container">
        <div class="services-box">
          <div class="row">
            <?php $modern_ecommerce_catData1 =  get_theme_mod('modern_ecommerce_category_setting');
            if($modern_ecommerce_catData1){ 
              $args = array(
              'post_type' => 'post',
              'category_name' => esc_html($modern_ecommerce_catData1 ,'modern-ecommerce'),
              'posts_per_page' => get_theme_mod('modern_ecommerce_service_number')
                );
              $i=1; ?>
              <?php $query = new WP_Query( $args );
                if ( $query->have_posts() ) :
                while( $query->have_posts() ) : $query->the_post(); ?>
              <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="row">
                  <div class="col-lg-3 col-md-12 col-sm-12 icon-box align-self-center text-center">
                    <i class="<?php echo esc_attr(get_theme_mod('modern_ecommerce_service_icon' . $i, 'fas fa-truck')); ?> mb-2"></i>
                  </div>
                  <div class="col-lg-9 col-md-12 col-sm-12 text-center text-lg-start">
                    <a href="<?php the_permalink(); ?>"><h4 class="mb-2 mb-md-0"><?php the_title();?></h4></a>
                    <p class="mb-md-0"><?php echo esc_html(wp_trim_words(get_the_content(),'8') );?></p>
                  </div>
                </div>
              </div>
              <?php $i++; endwhile; 
                wp_reset_postdata(); ?>
              <?php else : ?>
                <div class="no-postfound"></div>
              <?php endif; ?>
            <?php }?>
          </div>
        </div>
      </div>
    </section>
  <?php }?>
<?php }?>

<?php if( get_option('modern_ecommerce_product_show_hide') == '1'){ ?>
    <section id="product-box" class="my-5">
      <div class="container">
        <?php if( get_theme_mod('modern_ecommerce_product_title') != '' || get_theme_mod('modern_ecommerce_product_text') != '' || get_theme_mod('modern_ecommerce_product_box_page') != ''){ ?>
          <div class="prod_head text-center mb-5">
            <?php if( get_theme_mod('modern_ecommerce_product_title') != '' ){ ?>
              <h3><?php echo esc_html(get_theme_mod('modern_ecommerce_product_title','')); ?></h3>
            <?php }?>
            <?php if( get_theme_mod('modern_ecommerce_product_text') != '' ){ ?>
              <p><?php echo esc_html(get_theme_mod('modern_ecommerce_product_text','')); ?></p>
            <?php }?>
          </div>
        <?php }?>
        <div class="row mt-5 mx-0">
            <?php
            $modern_ecommerce_catData = get_theme_mod('modern_ecommerce_category');
            $modern_ecommerce_count_catData = get_theme_mod('modern_ecommerce_category_number');
            if ( class_exists( 'WooCommerce' ) ) {
            $modern_ecommerce_args = array(
              'post_type' => 'product',
              'posts_per_page' => $modern_ecommerce_count_catData,
              'product_cat' => $modern_ecommerce_catData,
              'order' => 'ASC'
            );
            $loop = new WP_Query( $modern_ecommerce_args );
            while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
              <div class="col-lg-3 col-md-6 col-sm-6 text-center">
                <div class="product-img wrapper mb-3 wow swing" data-wow-duration="2s">
                  <?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, ''); else echo '<img src="'.esc_url(woocommerce_placeholder_img_src()).'" />'; ?>
                  <div class="box-content">
                    <?php if( $product->is_type( 'simple' ) ) { woocommerce_template_loop_add_to_cart(  $loop->post, $product );} ?>
                  </div>
                  <div class="sale-tag">
                    <span><?php woocommerce_show_product_sale_flash( $post, $product ); ?></span>
                  </div>
                  <div class="product-details text-center py-2">
                    <h4><a href="<?php echo esc_url(get_permalink( $loop->post->ID )); ?>"><?php the_title(); ?></a></h4>
                    <span><?php esc_attr( apply_filters( 'woocommerce_product_price_class', '' ) ); ?><?php echo ( $product->get_price_html()); ?></span>
                  </div>
                </div>
              </div>
            <?php endwhile; wp_reset_query(); ?>
            <?php } ?>
          </div>
      </div>
    </section>
<?php }?>

<section id="custom-page-content" <?php if ( have_posts() && trim( get_the_content() ) !== '' ) echo 'class="pt-3"'; ?>>
    <div class="container">
      <?php while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>
