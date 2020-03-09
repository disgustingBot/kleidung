<?php get_header(); ?>
<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<?php while(have_posts()){the_post(); ?>
  <?php global $woocommerce, $product, $post; ?>


  <article class="singlePage">



      <img class="cardImg lazy" data-url="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="">
      <h1 class="singleSideTitle"><?php the_title(); ?></h1>
      <p class="singleSidePrice"><?php echo $product->get_price_html(); ?></p>
      <div class="singleSideData"><?php the_excerpt(); ?></div>

      <main class="singleDescription"><?php echo the_content(); ?></main>

    </article>



<?php } wp_reset_query(); ?>
<?php get_footer(); ?>
