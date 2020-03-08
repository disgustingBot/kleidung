<?php get_header(); ?>

<!-- INFO DEL QUERIED OBJECT -->
<?php // var_dump(get_queried_object()); ?>


<figure class="pageBanner">
  <img class="pageBannerImg rowcol1" src="<?php echo wp_get_attachment_url(get_woocommerce_term_meta(get_queried_object()->term_id, 'thumbnail_id', true )); ?>" alt="">
  <figcaption class="pageBannerCaption rowcol1">
    <h2><?php echo get_queried_object()->name; ?></h2>
  </figcaption>
</figure>

<?php if (category_has_children( get_queried_object()->term_id, 'product_cat' )) { ?>





<div class="subCatArchive">

  <?php
  $args = array(
   'hierarchical' => 1,
   'show_option_none' => '',
   'hide_empty' => 0,
   'parent' => get_queried_object()->term_id,
   'taxonomy' => 'product_cat'
  );
  $subcats = get_categories($args);
  foreach ($subcats as $sc) {
    $link = get_term_link( $sc->slug, $sc->taxonomy );
    $thumbnail_id = get_woocommerce_term_meta( $sc->term_id, 'thumbnail_id', true );
  ?>

    <figure class="subcatCard">
      <a class="subcatImg rowcol1" href="<?php echo $link; ?>">
        <img class="sucatImg lazy" data-url="<?php echo wp_get_attachment_url($thumbnail_id); ?>" alt="">
      </a>
      <figcaption class="subcatCaption rowcol1">
        <h5 class="subcatTitle"><a href="<?php echo $link; ?>"><?php echo $sc->name; ?></a></h5>
      </figcaption>
    </figure>
  <?php } ?>
</div>



<?php } else { ?>

  <div class="shopArchive">



    <?php

    //   $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    //   $args = array(
    //     'post_type'=>'product',
    //     'posts_per_page'=>9,
    //     'paged' => $paged,
    //   );
    //   if (isset($_GET['filter_year']) AND $_GET['filter_year']!=0) {
    //     $args['tax_query'] = array(
    //         array(
    //             'taxonomy' => 'product_cat',
    //             'field'    => 'slug',
    //             'terms'    => $_GET['filter_year'],
    //         ),
    //     );
    //   }
    //   if (isset($_GET['filter_search']) AND $_GET['filter_search']!='') {
    //     $args['s'] = $_GET['filter_search'];
    //   }
    //
    // $blogPosts=new WP_Query($args);
    // while($blogPosts->have_posts()){$blogPosts->the_post();$product_id = get_the_ID(); ?>

    <?php while (have_posts()){the_post(); ?>

    <figure class="productCard">
      <?php
      global $product;
      // $newness_days = 1;
      $created = strtotime( $product->get_date_created() );
      if ( ( time() - ( 60 * 60 * 24 * $newness_days ) ) < $created ) { ?>
        <span class="newArrival"><i>New arrival</i></span>
      <?php } ?>
      <!-- <span class="newArrival"><i>New arrival</i></span> -->
      <a class="productCardImg" href="<?php echo get_permalink(); ?>"><img class="productCardImg lazy" data-url="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt=""></a>
      <figcaption class="productCardCaption">
        <h5 class="productCardTitle"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h5>
        <p class="productCardTxt"><a href="<?php echo get_permalink(); ?>"><?php echo excerpt(70); ?></a></p>
        <p class="productCardPrice">
          <?php
          // $product = wc_get_product( $product_id );
          echo $product->get_price_html(); ?>
        </p>
      </figcaption>
    </figure>
    <?php } ?>

  </div>

<?php } ?>

<?php echo latte_pagination($blogPosts->max_num_pages); ?>

<?php get_footer(); ?>
