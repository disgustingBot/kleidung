<?php get_header(); ?>
<?php
global $wp_query;
?>

  <div class="shopATF ATF">
    <img class="ShopBanner lazy" data-url="<?php echo get_the_post_thumbnail_url(119); ?>" alt="">
    <overlay class="ShopOverlay"></overlay>

    <hgroup class="ShopATFTxt">
      <h3 class="ShopATFTitle">The finest clothing</h3>
      <h5 class="ShopATFSubtitle">Fluid and comfortable clothing, with a pleasant touch. Designs with a character between modern and vintage.</h5>
      <a class="btn btnWhite" href="#">See our Latest</a>
    </hgroup>
  </div>
  <form class="shopFilterBar">
    <select class="filterBarItem clothingType">
      <option value="Type" class="filterBarOption">Type</option>
      <option value="Dress" class="filterBarOption">Dress</option>
      <option value="Skirt" class="filterBarOption">Skirt</option>
      <option value="Jumpsuit" class="filterBarOption">Jumpsuit</option>
    </select>
    <select class="filterBarItem clothingSize">
      <option value="Size" class="filterBarOption">Size</option>
      <option value="S" class="filterBarOption">S</option>
      <option value="M" class="filterBarOption">M</option>
      <option value="L" class="filterBarOption">L</option>
      <option value="XL" class="filterBarOption">XL</option>
    </select>
    <select class="filterBarItem clothingColor">
      <option value="Color" class="filterBarOption">Color</option>
      <option value="Red" class="filterBarOption">Red</option>
      <option value="Green" class="filterBarOption">Green</option>
      <option value="Blue" class="filterBarOption">Blue</option>
    </select>
  </form>
  <section
    class="slider"
    data-page="<?= get_query_var('paged') ? get_query_var('paged') : 1; ?>"
    data-max="<?= $wp_query->max_num_pages; ?>"
  >

  <h4 class="ShopTitle2">Current collections</h4>
  <?php while(have_posts()){the_post(); ?>
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

  <button class="sliderArrow" type="button" name="button">&#62;</button>

</section>
<a class="btn shopBtn" href="">View all</a>

<?php get_footer(); ?>
