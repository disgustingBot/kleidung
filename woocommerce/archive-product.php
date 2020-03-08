<?php get_header(); ?>

<div class="shopFront">




  <?php while (have_posts()){the_post(); ?>

  <figure class="product">
    <a class="productImg" href="<?php echo get_permalink(); ?>"><img class="productImg lazy" data-url="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt=""></a>
    <figcaption class="productCaption">
      <h5 class="productTitle"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h5>
      <p class="productTxt"><a href="<?php echo get_permalink(); ?>"><?php echo excerpt(70); ?></a></p>
      <p class="productPrice">
        <?php
        // $product = wc_get_product( $product_id );
        echo $product->get_price_html(); ?>
      </p>
    </figcaption>
  </figure>
  <?php } ?>

</div>
<?php echo latte_pagination($blogPosts->max_num_pages); ?>


<?php get_footer(); ?>
