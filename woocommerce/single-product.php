<?php get_header(); ?>
<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<?php while(have_posts()){the_post(); ?>
  <?php global $woocommerce, $product, $post; ?>


  <article class="singleProductMain">
      <div class="gallery" id="gallery">





        <!-- <img class="lazy" data-url="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt=""> -->

        <!-- <div class="gallery" id="gallery"> -->
          <?php $attachment_ids = $product->get_gallery_attachment_ids(); ?>

          <!-- <div class="galleryMainCarousel"> -->

            <img class="element rowcol1 lazy" onclick="altClassFromSelector('alt','#gallery')" data-url="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="">
            <?php $count=0; foreach( $attachment_ids as $attachment_id ) { ?>
              <img class="element rowcol1 lazy" onclick="altClassFromSelector('alt','#gallery')" data-url="<?php echo $image_link = wp_get_attachment_url( $attachment_id ); ?>" alt="">
            <?php $count++; } ?>
          <!-- </div> -->
          <!-- <button class="slideButton rowcol1 slideLeft" onclick="plusImgs(-1)"></button> -->
          <!-- <button class="slideButton rowcol1 slideRight" onclick="plusImgs(+1)"></button> -->

        <!-- </div> -->







        <div class="singleProductsgalleryBtnsContainer">
          <button class="singleProductsGalleryBtns" id="nextButton">
            <svg class="singleProductArrowSVG" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M18.5455 21.18L9.77992 12L18.5455 2.82L15.8469 0L4.36365 12L15.8469 24L18.5455 21.18Z" fill="currentColor"/>
            </svg>
          </button>
          <button class="singleProductsGalleryBtns" id="prevButton">
            <svg class="singleProductArrowSVG" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M5 21.18L14.2713 12L5 2.82L7.85425 0L20 12L7.85425 24L5 21.18Z" fill="currentColor"/>
            </svg>
          </button>
        </div>
      </div>

      <div class="SingleProductInteraction">
        <h3 class="singleSideTitle"><?php the_title(); ?></h3>
        <?php $product->get_attributes( 'Talla' ); ?>
        <p class="singleSidePrice"><?php echo $product->get_price_html(); ?></p>
        <button class="thinBtn btnWhite singleProductSizeBtn">S/M</button>

        <!-- esto tiene un bug, testear extensivamente y asegurarse de que anda bien antes de poner en produccion -->
        <!-- <input class="addToCartQnt" placeholder="Cantidad" type="number" id="addToCartQantity" onchange="addToCartControler(this)"> -->

        <div class="addToCart"><?php
         echo sprintf( '<a href="%s" id="addToCartA" data-quantity="1" class="%s" %s>%s</a>',
             esc_url( $product->add_to_cart_url() ),
             esc_attr( implode( ' ', array_filter( array(
                 'button', 'product_type_' . $product->get_type(),
                 $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                 $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
             ) ) ) ),
             wc_implode_html_attributes( array(
                 'data-product_id'  => $product->get_id(),
                 // 'data-product_sku' => $product->get_sku(),
                 'aria-label'       => $product->add_to_cart_description(),
                 'rel'              => 'nofollow',
             ) ),
             esc_html( $product->add_to_cart_text() )
         );
        ?></div>

    </div>

      <div class="singleProductDescription">
        <h1 class="singleProductTitle"><?php the_title(); ?></h1>
        <h2 class="singleProductSubtitle"><?php echo get_the_excerpt(); ?></h2>
        <div class="singleProductTxt"><?php echo get_the_content(); ?></div>
      </div>
  </article>

  <div class="relatedProducts">
    <?php

    $meta_query  = WC()->query->get_meta_query();
    $tax_query   = WC()->query->get_tax_query();
    $tax_query[] = array(
                              'taxonomy' => 'product_visibility',
                              'field'    => 'name',
                              'terms'    => 'featured',
                              'operator' => 'IN',
                          );

    $args = array(
      'post_type'=>'product',
      'posts_per_page'=>4,
      'meta_query'          => $meta_query,
      'tax_query'           => $tax_query,
    );

    $blogPosts=new WP_Query($args); ?>

    <h3 class="sliderTitle title">OTHER FEATURED PRODUCTS</h3>
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
