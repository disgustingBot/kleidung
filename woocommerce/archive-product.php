<?php get_header(); ?>
<?php
global $wp_query;
global $wp;
// var_dump($wp_query['tax_query']);
// var_dump($wp_query);
// var_dump($wp_query->tax_query);
// foreach ($wp_query->tax_query as $key => $value) {
//   // code...
//   var_dump($value);
//   foreach ($value as $i => $x) {
//     echo '<br><br>';
//     var_dump($x);
//     echo '<br><br>';
//     // code...
//   }
//   echo '<br><br><br><br><br>';
// }
?>

  <div class="shopATF ATF">
    <img class="ShopBanner lazy" data-url="<?php echo get_the_post_thumbnail_url(119); ?>" alt="">
    <overlay class="ShopOverlay"></overlay>

    <hgroup class="ShopATFTxt">
      <h1 class="ShopATFTitle">The finest clothing</h1>
      <h5 class="ShopATFSubtitle">Fluid and comfortable clothing, with a pleasant touch. Designs with a character between modern and vintage.</h5>
    </hgroup>
  </div>


  <?php function woocommerce_subcats_from_parentcat($category){
    if (is_numeric($category)) {$term = get_term(           $category, 'product_cat');}
    else                       {$term = get_term_by('slug', $category, 'product_cat');}



    	if (isset($_GET[$category])) {
        // var_dump($_GET[$category]);
    		$parentArray = $_GET[$category];
    	  // foreach ($parentArray as $key => $value) {
  			$wp_query['query']['tax_query'][$key] = array(
  				'taxonomy' => 'product_cat',
  				'field'    => 'slug',
  				'terms'    => $parentArray,
  			);
    	  // }
    	}


    $args = array(
     'hierarchical' => 1,
     'show_option_none' => '',
     'hide_empty' => 0,
     'parent' => $term->term_id,
     'taxonomy' => 'product_cat'
    );
    $subcats = get_categories($args); ?>

    <div class="selectBox<?php if(isset($_GET[$term->slug])){ echo ' alt'; } ?>" tabindex="1" id="selectBox<?php echo $term->term_id; ?>">
      <div class="selectBoxButton">
        <p class="selectBoxPlaceholder"><?php echo $term->name; ?></p>
        <p class="selectBoxCurrent" id="selectBoxCurrent<?php echo $term->term_id; ?>">
          <?php if(isset($_GET[$term->slug])){ echo $_GET[$term->slug]; } ?>
        </p>
      </div>
      <div class="selectBoxList">
        <label for="nul<?php echo $term->term_id; ?>" class="selectBoxOption">
          <input
            class="selectBoxInput"
            id="nul<?php echo $term->term_id; ?>"
            type="radio"
            data-slug="0"
            data-parent="<?php echo $term->slug; ?>"
            name="filter_<?php echo $term->slug; ?>"
            onclick="selectBoxControler('','#selectBox<?php echo $term->term_id; ?>','#selectBoxCurrent<?php echo $term->term_id; ?>')"
            value="0"
            <?php if(!isset($_GET[$term->slug])){ ?>
              checked
            <?php } ?>
          >
          <!-- <span class="checkmark"></span> -->
          <p class="colrOptP"></p>
        </label>
        <?php foreach ($subcats as $sc) { ?>
          <label for="<?php echo $sc->slug; ?>" class="selectBoxOption">
            <input
              class="selectBoxInput"
              id="<?php echo $sc->slug; ?>"
              data-slug="<?php echo $sc->slug; ?>"
              data-parent="<?php echo $term->slug; ?>"
              type="radio"
              name="filter_<?php echo $term->slug; ?>"
              onclick="selectBoxControler('<?php echo $sc->name ?>', '#selectBox<?php echo $term->term_id; ?>', '#selectBoxCurrent<?php echo $term->term_id; ?>')"
              value="<?php echo $sc->slug; ?>"
              <?php if(isset($_GET[$term->slug]) && $_GET[$term->slug] == $sc->slug){ ?>
                checked
              <?php } ?>
            >
            <!-- <span class="checkmark"></span> -->
            <p class="colrOptP"><?php echo $sc->name ?></p>
          </label>
        <?php } ?>
      </div>
    </div>
  <?php } ?>

  <form class="shopFilterBar">
    <?php woocommerce_subcats_from_parentcat('tipo'); ?>
    <?php woocommerce_subcats_from_parentcat('motivo'); ?>
  </form>


  <h4 class="ShopTitle2">Current collections</h4>
  <section class="slider" id="slider">


  	<view id="load" class="load">
  			<div class="circle"></div>
  	</view>

  <?php while(have_posts()){the_post(); ?>
    <?php global $product; ?>

    <figure class="card" id="card<?php echo get_the_id();?>">
      <a class="cardImg" href="<?php echo get_permalink(); ?>">
        <img class="cardImg lazy" data-url="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="">
      </a>
      <figcaption class="cardCaption">
        <p class="cardTitle"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></p>
        <p class="productCardPrice"><a href="<?php echo get_permalink(); ?>"> <?php echo $product->get_price_html(); ?> </a></p>
      </figcaption>
    </figure>
  <?php } ?>
  <?php echo misha_paginator(get_pagenum_link()); ?>

  <!-- <button class="sliderArrow" type="button" name="button">&#62;</button> -->

</section>

<?php // echo latte_pagination($wp_query->max_num_pages); ?>


<?php get_footer(); ?>
