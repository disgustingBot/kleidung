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
        <button class="thinBtn">Add to Cart</button>
        <button class="thinBtn">Buy It Now</button>
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
