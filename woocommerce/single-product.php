<?php get_header(); ?>
<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<?php while(have_posts()){the_post(); ?>
  <?php global $woocommerce, $product, $post; ?>


  <article class="singleProductMain">
      <div class="singleProductMainImg">
        <img class="lazy" data-url="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="">
        <div class="singleProductsgalleryBtnsContainer">
          <button class="singleProductsGalleryBtns">
            <svg class="singleProductArrowSVG" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M18.5455 21.18L9.77992 12L18.5455 2.82L15.8469 0L4.36365 12L15.8469 24L18.5455 21.18Z" fill="currentColor"/>
            </svg>
          </button>
          <button class="singleProductsGalleryBtns">
            <svg class="singleProductArrowSVG" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M5 21.18L14.2713 12L5 2.82L7.85425 0L20 12L7.85425 24L5 21.18Z" fill="currentColor"/>
            </svg>
          </button>
        </div>
      </div>

      <div class="SingleProductInteraction">
        <p class="singleSideTitle"><?php the_title(); ?></p>
        <p class="singleSidePrice"><?php echo $product->get_price_html(); ?></p>
        <button class="thinBtn btnWhite singleProductSizeBtn">S/M</button>
        <!-- <button class="thinBtn">Add to Cart</button> -->
        <?php // if ( $product->is_in_stock() ) : ?>

        <?php // do_action( 'woocommerce_before_add_to_cart_form' ); ?>

        <!-- <form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'> -->
          <?php
          // do_action( 'woocommerce_before_add_to_cart_button' );
          ?>

          <?php
          // do_action( 'woocommerce_before_add_to_cart_quantity' );
          //
          // woocommerce_quantity_input( array(
          //   'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
          //   'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
          //   'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
          // ) );
          //
          // do_action( 'woocommerce_after_add_to_cart_quantity' );
          ?>

          <!-- <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="thinBtn"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button> -->

          <?php // do_action( 'woocommerce_after_add_to_cart_button' ); ?>
        <!-- </form> -->

        <?php // do_action( 'woocommerce_after_add_to_cart_form' ); ?>

      <?php // endif; ?>
      <?php // $add_to_cart = do_shortcode('[add_to_cart_url id="'.$product->get_id().'"]'); ?>
      <!-- <a class="thinBtn" href="<?php echo $add_to_cart; ?>">Buy It Now</a> -->
    </div>

      <figcaption class="singleProductDescription">
        <h1 class="singleProductTitle"><?php the_title(); ?></h1>
        <h2 class="singleProductSubtitle"><?php echo get_the_excerpt(); ?></h2>
        <p class="singleProductTxt"><?php echo get_the_content(); ?></p>
      </figcaption>
  </article>

  <div class="relatedProducts">
    <?php
    $args = array(
      'post_type'=>'product',
      'posts_per_page'=>4,
    );
    $blogPosts=new WP_Query($args); ?>

    <h3 class="sliderTitle title">RELATED PRODUCTS</h3>
    <?php while($blogPosts->have_posts()){$blogPosts->the_post(); ?>
      <?php global $product; ?>

      <figure class="card">
        <a class="cardImg" href="<?php echo get_permalink(); ?>">
          <img class="cardImg lazy" data-url="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="">
        </a>
        <figcaption class="cardCaption">
          <p class="cardTitle"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></p>
          <p class="productCardPrice"><a href="<?php echo get_permalink(); ?>"> <?php echo $product->get_price_html(); ?> </a></p>
        </figcaption>
      </figure>
    <?php } ?>
  </div>


<?php } wp_reset_query(); ?>
<?php get_footer(); ?>
