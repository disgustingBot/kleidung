<?php get_header(); ?>
<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<?php while(have_posts()){the_post(); ?>
  <?php global $woocommerce, $product, $post; ?>
  <?php $categories = get_the_terms( get_the_ID(), 'product_cat' ); ?>
  <?php function selection($v){return $v->slug;}if($categories){$cates=array_map('selection',$categories);} ?>

  <!-- <h1>single-product.php</h1> -->

  <article class="singlePage">

    <div class="singleSide singleSide1">
      <?php
      // $newness_days = 1;
      // $created = strtotime( $product->get_date_created() );
      $created = strtotime( get_the_date() );
      if ( ( time() - ( 60 * 60 * 24 * $newness_days ) ) < $created ) { ?>
        <span class="newArrival"><i>New arrival</i></span>
      <?php } ?>
      <?php
      // get all the categories on the product
      // $categories = get_the_terms( get_the_ID(), 'product_cat' );
      // if it finds sometthing
      if ($categories) {
        // for each category
        foreach ($categories as $cat) {
          // get the slug of parent cattegory
          $parent=get_term_by('id', $cat->parent, 'product_cat', 'ARRAY_A')['slug'];
          if ($parent=="year-bikes") {$yearBike = $cat->name;}
          if ($parent=="brand") {$brand = $cat->name;}
        }
      }
      ?>


      <!-- OLD TITLE -->
      <h1 class="singleSideTitle onlyDesktopF"><?php the_title(); ?></h1>
      <?php if($brand){ ?><span class="singleSideAnoMarca onlyDesktopF"><?php echo $brand; ?></span><?php } ?>
      <?php if($yearBike){ ?><span class="singleSideAnoMarca onlyDesktopF"><?php echo $yearBike; ?></span><?php } ?>


      <!-- NEW TITLE -->
      <h1 class="singleSideTitle onlyMobileG">
        <?php the_title(); ?>
        <?php if($brand){ ?><span class="singleSideAnoMarca"> <?php echo $brand; ?></span><?php } ?>
        <?php if($yearBike){ ?><span class="singleSideAnoMarca"> <?php echo $yearBike; ?></span><?php } ?>
      </h1>



      <p class="singleSidePrice"><?php echo $product->get_price_html(); ?></p>
      <?php $stockNumber = get_post_meta( $product->id, 'stockNumber' )[0]; ?>
      <?php if($stockNumber){ ?>
        <p class="singleSideStock">
          Stock # <?php echo $stockNumber; ?>
          <?php if (method_exists($product,'get_condition')) { ?>
            <br>Condition: <?php echo esc_html( $product->get_condition() ); ?>
          <?php } ?>
        </p>
      <?php } ?>


      <!-- <p class="singleSideData onlyDesktopG"><?php echo excerpt(140); ?></p> -->
      <div class="singleSideData onlyDesktopG"><?php the_excerpt(); ?></div>

      <?php $video = get_post_meta( $product->id, 'video' )[0]; ?>
      <?php if($video){ ?>
          <!-- <iframe class="singleSideVideo onlyDesktopG" src="https://www.youtube.com/embed/<?php echo $video; ?>"></iframe> -->
          <div class="singleSideVideo onlyDesktopG"  onclick="altClassFromSelector('video','#gallery')">
            <img class="singleSideVideoImg rowcol1" src="https://img.youtube.com/vi/<?php echo $video; ?>/mqdefault.jpg" alt="">
            <svg class="rowcol1" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 100 100" viewBox="0 0 100 100">
              <g fill="#fff">
                <path d="m88.9 30.9c-.4-3.5-3.7-6.9-7.2-7.3-21.1-2.6-42.4-2.6-63.4 0-3.5.4-6.8 3.8-7.2 7.3-1.5 12.8-1.5 25.3 0 38.1.4 3.5 3.7 6.9 7.2 7.3 21.1 2.6 42.4 2.6 63.4 0 3.5-.4 6.8-3.8 7.2-7.3 1.5-12.8 1.5-25.2 0-38.1zm-6.6 37.4c-.1.5-.9 1.4-1.4 1.5-10.2 1.2-20.6 1.9-30.9 1.9s-20.7-.7-30.9-1.9c-.4-.1-1.3-1-1.4-1.5-1.4-12.3-1.4-24.2 0-36.6.1-.5.9-1.4 1.4-1.5 10.2-1.2 20.6-1.9 30.9-1.9s20.7.6 30.9 1.9c.4.1 1.3 1 1.4 1.5 1.4 12.3 1.4 24.3 0 36.6z"/>
                <path d="m43.3 36.7v26.7l20-13.3z"/>
              </g>
            </svg>
          </div>
      <?php } ?>





      <div class="singleSideSocialCont socialMedia onlyDesktopF">

        <a href="https://es-la.facebook.com/gpmotorbikes/" target="_blank" class="socialMediaLink socialMediaFace">
          <svg viewBox="0 0 313 500" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M272.598 281.25L286.484 190.762H199.658V132.041C199.658 107.285 211.787 83.1543 250.674 83.1543H290.146V6.11328C290.146 6.11328 254.326 0 220.078 0C148.574 0 101.836 43.3398 101.836 121.797V190.762H22.3535V281.25H101.836V500H199.658V281.25H272.598Z" fill="currentColor"/>
          </svg>
        </a>

        <a href="tel:+34 938 364 911" target="_blank" class="socialMediaLink socialMediaFono">
          <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M8.04444 17.3111C11.2444 23.6 16.4 28.7333 22.6889 31.9556L27.5778 27.0667C28.1778 26.4667 29.0667 26.2667 29.8444 26.5333C32.3333 27.3556 35.0222 27.8 37.7778 27.8C39 27.8 40 28.8 40 30.0222V37.7778C40 39 39 40 37.7778 40C16.9111 40 0 23.0889 0 2.22222C0 1 1 0 2.22222 0H10C11.2222 0 12.2222 1 12.2222 2.22222C12.2222 5 12.6667 7.66667 13.4889 10.1556C13.7333 10.9333 13.5556 11.8 12.9333 12.4222L8.04444 17.3111Z" fill="currentColor"/>
          </svg>
        </a>

        <a href="https://wa.me/15551234567" target="_blank" class="socialMediaLink socialMediaWhatsapp">
          <svg viewBox="0 0 500 500" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M425.112 72.6563C378.348 25.7812 316.071 0 249.888 0C113.281 0 2.12054 111.161 2.12054 247.768C2.12054 291.406 13.5045 334.04 35.1563 371.652L0 500L131.362 465.513C167.522 485.268 208.259 495.647 249.777 495.647H249.888C386.384 495.647 500 384.487 500 247.879C500 181.696 471.875 119.531 425.112 72.6563V72.6563ZM249.888 453.906C212.835 453.906 176.562 443.973 144.978 425.223L137.5 420.759L59.5982 441.183L80.3571 365.179L75.4464 357.366C54.7991 324.554 43.9732 286.719 43.9732 247.768C43.9732 134.263 136.384 41.8527 250 41.8527C305.022 41.8527 356.696 63.2812 395.536 102.232C434.375 141.183 458.259 192.857 458.147 247.879C458.147 361.496 363.393 453.906 249.888 453.906V453.906ZM362.835 299.665C356.696 296.54 326.228 281.585 320.536 279.576C314.844 277.455 310.714 276.451 306.585 282.701C302.455 288.951 290.625 302.79 286.942 307.031C283.371 311.161 279.688 311.719 273.549 308.594C237.165 290.402 213.281 276.116 189.286 234.933C182.924 223.996 195.647 224.777 207.478 201.116C209.487 196.987 208.482 193.415 206.92 190.29C205.357 187.165 192.969 156.696 187.835 144.308C182.813 132.254 177.679 133.929 173.884 133.705C170.313 133.482 166.183 133.482 162.054 133.482C157.924 133.482 151.228 135.045 145.536 141.183C139.844 147.433 123.884 162.388 123.884 192.857C123.884 223.326 146.094 252.79 149.107 256.92C152.232 261.049 192.746 323.549 254.911 350.446C294.196 367.411 309.598 368.862 329.241 365.96C341.183 364.174 365.848 351.004 370.982 336.496C376.116 321.987 376.116 309.598 374.554 307.031C373.103 304.241 368.973 302.679 362.835 299.665Z" fill="currentColor"/>
          </svg>
        </a>



        <a class="socialMediaLink socialMediaMail" href="" target="_blank">
          <svg viewBox="0 0 55 40" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path d="M49.6053 0H5.13158C2.29745 0 0 2.23854 0 5V35C0 37.7615 2.29745 40 5.13158 40H49.6053C52.4394 40 54.7368 37.7615 54.7368 35V5C54.7368 2.23854 52.4394 0 49.6053 0ZM49.6053 5V9.25052C47.2082 11.1525 43.3866 14.11 35.2169 20.3432C33.4164 21.7231 29.85 25.0382 27.3684 24.9996C24.8873 25.0386 21.3197 21.7226 19.52 20.3432C11.3515 14.1109 7.52899 11.1528 5.13158 9.25052V5H49.6053ZM5.13158 35V15.6665C7.58127 17.5676 11.0552 20.2354 16.3503 24.2754C18.687 26.0676 22.7791 30.024 27.3684 29.9999C31.9352 30.024 35.9755 26.125 38.3856 24.2762C43.6805 20.2364 47.1555 17.5678 49.6053 15.6666V35H5.13158Z" fill="currentColor"/>
          </svg>
        </a>
      </div>

      <div class="singleSideContactContainer onlyDesktopG">
        <button class="singleSideContact" onclick="altClassFromSelector('alt','#singleRequestInfo')">REQUEST MORE INFO</button>
        <button class="singleSideContact" onclick="altClassFromSelector('alt','#singleMakeOffer')">MAKE OFFER</button>
        <?php if($product->is_type( 'auction' )){ ?>
          <a class="singleSideContact" href="<?php echo site_url('auctions-information');  ?>">AUCTION INFO</a>
        <?php } else if($cates) { ?>
          <?php if(!in_array('parts-racing-products', $cates)) { ?>
            <button class="singleSideContact" onclick="altClassFromSelector('alt','#singleTrade')">TRADE</button>
          <?php } ?>
        <?php } ?>
      </div>


      <?php function testimonial( $clase ){ ?>

            <div class="testimonialsContainer <?php echo $clase; ?>">
              <?php
              $args = array(
                'post_type'=>'testimonials',
                'orderby'=>'rand',
                'posts_per_page'=>'1'
              );
              $testimonials=new WP_Query($args);
              while($testimonials->have_posts()){$testimonials->the_post();?>
                <quote class="testimonial">
                  <svg class="testiQuote testiQuote1" width="576" height="448" viewBox="0 0 576 448" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M504 192H448V184C448 161.9 465.9 144 488 144H496C522.5 144 544 122.5 544 96V48C544 21.5 522.5 0 496 0H488C386.5 0 304 82.5 304 184V376C304 415.7 336.3 448 376 448H504C543.7 448 576 415.7 576 376V264C576 224.3 543.7 192 504 192ZM528 376C528 389.2 517.2 400 504 400H376C362.8 400 352 389.2 352 376V184C352 109 413 48 488 48H496V96H488C439.5 96 400 135.5 400 184V240H504C517.2 240 528 250.8 528 264V376ZM200 192H144V184C144 161.9 161.9 144 184 144H192C218.5 144 240 122.5 240 96V48C240 21.5 218.5 0 192 0H184C82.5 0 0 82.5 0 184V376C0 415.7 32.3 448 72 448H200C239.7 448 272 415.7 272 376V264C272 224.3 239.7 192 200 192ZM224 376C224 389.2 213.2 400 200 400H72C58.8 400 48 389.2 48 376V184C48 109 109 48 184 48H192V96H184C135.5 96 96 135.5 96 184V240H200C213.2 240 224 250.8 224 264V376Z" fill="black"/>
                  </svg>
                  <div class="testimonialTxt mainTxtType1">
                    <h4 class="testimonialAuthor"><?php the_title(); ?></h4>
                    <div class="testimonialQuote"><?php the_content(); ?></div>
                  </div>
                  <svg class="testiQuote testiQuote2" width="576" height="448" viewBox="0 0 576 448" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M72 256H128V264C128 286.1 110.1 304 88 304H80C53.5 304 32 325.5 32 352V400C32 426.5 53.5 448 80 448H88C189.5 448 272 365.5 272 264V72C272 32.3 239.7 0 200 0H72C32.3 0 0 32.3 0 72V184C0 223.7 32.3 256 72 256ZM48 72C48 58.8 58.8 48 72 48H200C213.2 48 224 58.8 224 72V264C224 339 163 400 88 400H80V352H88C136.5 352 176 312.5 176 264V208H72C58.8 208 48 197.2 48 184V72ZM376 256H432V264C432 286.1 414.1 304 392 304H384C357.5 304 336 325.5 336 352V400C336 426.5 357.5 448 384 448H392C493.5 448 576 365.5 576 264V72C576 32.3 543.7 0 504 0H376C336.3 0 304 32.3 304 72V184C304 223.7 336.3 256 376 256ZM352 72C352 58.8 362.8 48 376 48H504C517.2 48 528 58.8 528 72V264C528 339 467 400 392 400H384V352H392C440.5 352 480 312.5 480 264V208H376C362.8 208 352 197.2 352 184V72Z" fill="black"/>
                  </svg>
                </quote>
              <?php } wp_reset_postdata(); ?>
            </div>


      <?php } ?>

      <?php if( $product->is_type( 'auction' ) ){ ?>
      <?php } ?>
      <?php testimonial( 'onlyDesktopG' ); ?>

    </div>


    <div class="singleMain">

      <div class="gallery" id="gallery">
        <?php $attachment_ids = $product->get_gallery_attachment_ids(); ?>

        <div class="galleryMainCarousel">
          <iframe class="galleryMainVideo" src="https://www.youtube.com/embed/<?php echo $video; ?>"></iframe>

          <img class="galleryMain galleryCarousel" onclick="altClassFromSelector('alt','#gallery')" src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="">
          <?php $count=0; foreach( $attachment_ids as $attachment_id ) { ?>
            <img class="galleryMain galleryCarousel" onclick="altClassFromSelector('alt','#gallery')" src="<?php echo $image_link = wp_get_attachment_url( $attachment_id ); ?>" alt="">
          <?php $count++; } ?>
        </div>
        <button class="slideButton rowcol1 slideLeft" onclick="plusImgs(-1)"></button>
        <button class="slideButton rowcol1 slideRight" onclick="plusImgs(+1)"></button>

        <button class="fullscreenButton rowcol1" onclick="altClassFromSelector('alt','#gallery')">
          <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="expand" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-expand fa-w-14 fa-3x"><path fill="currentColor" d="M0 180V56c0-13.3 10.7-24 24-24h124c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H64v84c0 6.6-5.4 12-12 12H12c-6.6 0-12-5.4-12-12zM288 44v40c0 6.6 5.4 12 12 12h84v84c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12V56c0-13.3-10.7-24-24-24H300c-6.6 0-12 5.4-12 12zm148 276h-40c-6.6 0-12 5.4-12 12v84h-84c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h124c13.3 0 24-10.7 24-24V332c0-6.6-5.4-12-12-12zM160 468v-40c0-6.6-5.4-12-12-12H64v-84c0-6.6-5.4-12-12-12H12c-6.6 0-12 5.4-12 12v124c0 13.3 10.7 24 24 24h124c6.6 0 12-5.4 12-12z" class=""></path></svg>
        </button>

        <button class="fullscreenButton close rowcol1" onclick="altClassFromSelector('alt','#gallery')">
      			<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512">
      				<path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path>
      			</svg>
        </button>



        <div class="galleryStock" id="galleryStock">
          <img class="galleryImgs" onclick="selectImgs(0)" src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="">
          <?php $count=1; foreach( $attachment_ids as $attachment_id ) { ?>
            <img class="galleryImgs" onclick="selectImgs(<?php echo $count; ?>)" src="<?php echo $image_link = wp_get_attachment_url( $attachment_id ); ?>" alt="">
          <?php $count++; } ?>
          <div class="galleryFade"></div>
        </div>
        <button class="galleryMore" onclick="altClassFromSelector('alt', '#galleryStock')">More photos</button>
      </div>

      <div class="singleSideMobileSchema onlyMobileG">

        <!-- <p class="singleSideData onlyMobileG"><?php echo excerpt(140); ?></p> -->
        <div class="singleSideData onlyMobileG"><?php the_excerpt(); ?></div>


        <div class="singleSideSocialCont socialMedia onlyMobileF">

          <a href="https://es-la.facebook.com/gpmotorbikes/" target="_blank" class="socialMediaLink socialMediaFace">
            <svg viewBox="0 0 313 500" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M272.598 281.25L286.484 190.762H199.658V132.041C199.658 107.285 211.787 83.1543 250.674 83.1543H290.146V6.11328C290.146 6.11328 254.326 0 220.078 0C148.574 0 101.836 43.3398 101.836 121.797V190.762H22.3535V281.25H101.836V500H199.658V281.25H272.598Z" fill="currentColor"/>
            </svg>
          </a>

          <a href="tel:+34 938 364 911" target="_blank" class="socialMediaLink socialMediaFono">
            <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M8.04444 17.3111C11.2444 23.6 16.4 28.7333 22.6889 31.9556L27.5778 27.0667C28.1778 26.4667 29.0667 26.2667 29.8444 26.5333C32.3333 27.3556 35.0222 27.8 37.7778 27.8C39 27.8 40 28.8 40 30.0222V37.7778C40 39 39 40 37.7778 40C16.9111 40 0 23.0889 0 2.22222C0 1 1 0 2.22222 0H10C11.2222 0 12.2222 1 12.2222 2.22222C12.2222 5 12.6667 7.66667 13.4889 10.1556C13.7333 10.9333 13.5556 11.8 12.9333 12.4222L8.04444 17.3111Z" fill="currentColor"/>
            </svg>
          </a>

          <a href="https://wa.me/15551234567" target="_blank" class="socialMediaLink socialMediaWhatsapp">
            <svg viewBox="0 0 500 500" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path d="M425.112 72.6563C378.348 25.7812 316.071 0 249.888 0C113.281 0 2.12054 111.161 2.12054 247.768C2.12054 291.406 13.5045 334.04 35.1563 371.652L0 500L131.362 465.513C167.522 485.268 208.259 495.647 249.777 495.647H249.888C386.384 495.647 500 384.487 500 247.879C500 181.696 471.875 119.531 425.112 72.6563V72.6563ZM249.888 453.906C212.835 453.906 176.562 443.973 144.978 425.223L137.5 420.759L59.5982 441.183L80.3571 365.179L75.4464 357.366C54.7991 324.554 43.9732 286.719 43.9732 247.768C43.9732 134.263 136.384 41.8527 250 41.8527C305.022 41.8527 356.696 63.2812 395.536 102.232C434.375 141.183 458.259 192.857 458.147 247.879C458.147 361.496 363.393 453.906 249.888 453.906V453.906ZM362.835 299.665C356.696 296.54 326.228 281.585 320.536 279.576C314.844 277.455 310.714 276.451 306.585 282.701C302.455 288.951 290.625 302.79 286.942 307.031C283.371 311.161 279.688 311.719 273.549 308.594C237.165 290.402 213.281 276.116 189.286 234.933C182.924 223.996 195.647 224.777 207.478 201.116C209.487 196.987 208.482 193.415 206.92 190.29C205.357 187.165 192.969 156.696 187.835 144.308C182.813 132.254 177.679 133.929 173.884 133.705C170.313 133.482 166.183 133.482 162.054 133.482C157.924 133.482 151.228 135.045 145.536 141.183C139.844 147.433 123.884 162.388 123.884 192.857C123.884 223.326 146.094 252.79 149.107 256.92C152.232 261.049 192.746 323.549 254.911 350.446C294.196 367.411 309.598 368.862 329.241 365.96C341.183 364.174 365.848 351.004 370.982 336.496C376.116 321.987 376.116 309.598 374.554 307.031C373.103 304.241 368.973 302.679 362.835 299.665Z" fill="currentColor"/>
            </svg>
          </a>



          <a class="socialMediaLink socialMediaMail" href="" target="_blank">
            <svg viewBox="0 0 55 40" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M49.6053 0H5.13158C2.29745 0 0 2.23854 0 5V35C0 37.7615 2.29745 40 5.13158 40H49.6053C52.4394 40 54.7368 37.7615 54.7368 35V5C54.7368 2.23854 52.4394 0 49.6053 0ZM49.6053 5V9.25052C47.2082 11.1525 43.3866 14.11 35.2169 20.3432C33.4164 21.7231 29.85 25.0382 27.3684 24.9996C24.8873 25.0386 21.3197 21.7226 19.52 20.3432C11.3515 14.1109 7.52899 11.1528 5.13158 9.25052V5H49.6053ZM5.13158 35V15.6665C7.58127 17.5676 11.0552 20.2354 16.3503 24.2754C18.687 26.0676 22.7791 30.024 27.3684 29.9999C31.9352 30.024 35.9755 26.125 38.3856 24.2762C43.6805 20.2364 47.1555 17.5678 49.6053 15.6666V35H5.13158Z" fill="currentColor"/>
            </svg>
          </a>


        </div>

        <div class="singleSideContactContainer onlyMobileG">
          <button class="singleSideContact" onclick="altClassFromSelector('alt','#singleRequestInfo')">REQUEST MORE INFO</button>
          <button class="singleSideContact" onclick="altClassFromSelector('alt','#singleMakeOffer')">MAKE OFFER</button>
          <?php if($product->is_type( 'auction' )){ ?>
            <a class="singleSideContact" href="<?php echo site_url('auctions-information');  ?>">AUCTION INFO</a>
          <?php } else if(!in_array('parts-racing-products', $cates)) { ?>
            <button class="singleSideContact" onclick="altClassFromSelector('alt','#singleTrade')">TRADE</button>
          <?php } ?>
          <!-- <button class="singleSideContact" onclick="altClassFromSelector('alt','#singleFinance')">FINANCE</button> -->
        </div>



      </div>



      <?php $video = get_post_meta( $product->id, 'video' )[0]; ?>
      <?php if($video){ ?>
          <div class="singleSideVideo onlyMobileG"  onclick="altClassFromSelector('video','#gallery')">
            <iframe class="singleSideVideoImg onlyMobileG" src="https://www.youtube.com/embed/<?php echo $video; ?>"></iframe>
            <!-- <img class="singleSideVideoImg rowcol1" src="https://img.youtube.com/vi/<?php echo $video; ?>/mqdefault.jpg" alt="">
            <svg class="rowcol1" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 100 100" viewBox="0 0 100 100">
              <g fill="#fff">
                <path d="m88.9 30.9c-.4-3.5-3.7-6.9-7.2-7.3-21.1-2.6-42.4-2.6-63.4 0-3.5.4-6.8 3.8-7.2 7.3-1.5 12.8-1.5 25.3 0 38.1.4 3.5 3.7 6.9 7.2 7.3 21.1 2.6 42.4 2.6 63.4 0 3.5-.4 6.8-3.8 7.2-7.3 1.5-12.8 1.5-25.2 0-38.1zm-6.6 37.4c-.1.5-.9 1.4-1.4 1.5-10.2 1.2-20.6 1.9-30.9 1.9s-20.7-.7-30.9-1.9c-.4-.1-1.3-1-1.4-1.5-1.4-12.3-1.4-24.2 0-36.6.1-.5.9-1.4 1.4-1.5 10.2-1.2 20.6-1.9 30.9-1.9s20.7.6 30.9 1.9c.4.1 1.3 1 1.4 1.5 1.4 12.3 1.4 24.3 0 36.6z"/>
                <path d="m43.3 36.7v26.7l20-13.3z"/>
              </g>
            </svg> -->
          </div>
      <?php } ?>


      <?php
        // AUCTION INFORRMATION HERE
        // var_dump(get_post_meta( $product->id));
        // var_dump($product->auction_bid_count);
        // echo $product->auction_bid_count;
        /**
         * Auction bid
         *
         */

        if ( ( $product && $product->is_type( 'auction' ) ) ) {
        	// return;
          $product_id       = $product->get_id();
          $user_max_bid     = $product->get_user_max_bid( $product_id, get_current_user_id() );
          $max_min_bid_text = $product->get_auction_type() === 'reverse' ? esc_html__( 'Your min bid is', 'auctions-for-woocommerce' ) : esc_html__( 'Your max bid is', 'auctions-for-woocommerce' );
          $gmt_offset       = get_option( 'gmt_offset' ) > 0 ? '+' . get_option( 'gmt_offset' ) : get_option( 'gmt_offset' );
      ?>


          <!-- <div class="singleSideContactContainer onlyMobileG">
            <button class="singleSideContact" onclick="altClassFromSelector('alt','#singleRequestInfo')">REQUEST MORE INFO</button>
            <button class="singleSideContact" onclick="altClassFromSelector('alt','#singleMakeOffer')">MAKE OFFER</button>
            <?php if($product->is_type( 'auction' )){ ?>
              <a class="singleSideContact" href="<?php echo site_url('auctions-information');  ?>">AUCTION INFO</a>
            <?php } else if(!in_array('parts-racing-products', $cates)) { ?>
              <button class="singleSideContact" onclick="altClassFromSelector('alt','#singleTrade')">TRADE</button>
            <?php } ?>
          </div> -->

          <!-- <p class="auction-condition"><?php echo wp_kses_post( apply_filters( 'conditiond_text', esc_html__( 'Item condition:', 'auctions-for-woocommerce' ), $product ) ); ?><span class="curent-bid"> <?php echo esc_html( $product->get_condition() ); ?></span></p> -->

          <?php if ( ( false === $product->is_closed ) && ( true === $product->is_started ) ) : ?>


          	<div class='auction-ajax-change auctionData' >

          		<?php if ( 'yes' !== $product->get_auction_sealed() ) { ?>
              <div class="auctionTitle">
                <h2>Auction info:</h2>
                <?php do_action( 'woocommerce_after_bid_form' ); ?>
              </div>

              <p class="auctionDetails">
                <span class="auctionDetailsTitle">
                  <?php echo wp_kses_post( apply_filters( 'time_left_text', esc_html__( 'Auction ends:', 'auctions-for-woocommerce' ), $product ) ); ?>
                </span>
                <span class="auctionDetailsValue">
                  <?php echo esc_html( date_i18n( get_option( 'date_format' ), strtotime( $product->get_auction_end_time() ) ) ); ?>
                </span>
              </p>

            	<p class="auctionDetails" id="countdown">
                <span class="auctionDetailsTitle">
                  <?php echo wp_kses_post( apply_filters( 'time_text', esc_html__( 'Time left:', 'auctions-for-woocommerce' ), $product_id ) ); ?>
                </span>
            		<span class="auctionDetailsValue main-auction auction-time-countdown notMet" data-time="<?php echo esc_attr( $product->get_seconds_remaining() ); ?>" data-auctionid="<?php echo intval( $product_id ); ?>" data-format="<?php echo esc_attr( get_option( 'auctions_for_woocommerce_countdown_format' ) ); ?>"></span>
            	</p>

        			<p class="auctionDetails">
                <?php if ($product->auction_current_bid){ ?>
                  <span class="auctionDetailsTitle">Current bid:</span>
                  <?php // echo wp_kses_post( $product->get_price_html() ); ?>
                  <span class="auctionDetailsValue bluTxt">€ <?php echo number_format($product->auction_current_bid,0,",","."); ?></span>
                  <!-- <span class="auctionDetailsValue">€ <?php echo $product->auction_current_bid; ?></span> -->
                <?php } else { ?>
                  <span class="auctionDetailsTitle">Starting bid:</span>
                  <span class="auctionDetailsValue bluTxt">€ <?php echo number_format($product->auction_start_price,0,",","."); ?></span>
                <?php } ?>



              </p>

              <p class="auctionDetails">
                <span class="auctionDetailsTitle">Reserve price:</span>
                <?php if ( ( $product->is_reserved() === true ) && ( $product->is_reserve_met() === false ) ) : ?>
                  <span class="auctionDetailsValue reserve notMet"  data-auction-id="<?php echo intval( $product_id ); ?>" >has not been met</span>
                <?php endif; ?>
                <?php if ( ( $product->is_reserved() === true ) && ( $product->is_reserve_met() === true ) ) : ?>
                  <span class="auctionDetailsValue reserve yesMet"  data-auction-id="<?php echo intval( $product_id ); ?>" >has been met</span>
                <?php endif; ?>
              </p>




          		<?php } elseif ( 'yes' === $product->get_auction_sealed() ) { ?>
        				<p class="sealed-text"><?php echo wp_kses_post( apply_filters( 'sealed_bid_text', __( "This auction is <a href='#'>sealed</a>.", 'auctions-for-woocommerce' ) ) ); ?>
        					<span class='sealed-bid-desc' style="display:grid;"><?php esc_html_e( 'In this type of auction all bidders simultaneously submit sealed bids so that no bidder knows the bid of any other participant. The highest bidder pays the price they submitted. If two bids with same value are placed for auction the one which was placed first wins the auction.', 'auctions-for-woocommerce' ); ?></span>
        				</p>
        				<?php if ( ! empty( $product->get_auction_start_price() ) ) { ?>
        					<?php if ( 'reverse' === $product->get_auction_type() ) : ?>
      							<p class="sealed-min-text">
      								<?php
      									echo wp_kses_post(
      										apply_filters(
      											'sealed_min_text',
      											sprintf(
      												// translators: 1) bid value
      												esc_html__( 'Maximum bid for this auction is %s.', 'auctions-for-woocommerce' ),
      												wc_price( $product->get_auction_start_price() )
      											)
      										)
      									);
      								?>
    								</p>
        					<?php else : ?>
      							<p class="sealed-min-text">
      								<?php
        								echo wp_kses_post(
        									apply_filters(
        										'sealed_min_text',
        										sprintf(
        											// translators: 1) bid value
        											esc_html__( 'Minimum bid for this auction is %s.', 'auctions-for-woocommerce' ),
        											wc_price( $product->get_auction_start_price() )
        										)
        									)
        								);
      								?>
    								</p>
        					<?php endif; ?>
        				<?php } ?>
          		<?php } ?>

          		<?php if ( 'reverse' === $product->get_auction_type() ) : ?>
          			<p class="reverse"><?php echo wp_kses_post( apply_filters( 'reverse_auction_text', esc_html__( 'This is reverse auction.', 'auctions-for-woocommerce' ) ) ); ?></p>
          		<?php endif; ?>
          		<?php if ( 'yes' !== $product->get_auction_sealed() ) { ?>
          			<?php if ( $product->get_auction_proxy() && $product->get_auction_max_current_bider() && get_current_user_id() === $product->get_auction_max_current_bider() ) { ?>
          				<p class="max-bid"><?php echo esc_html( $max_min_bid_text ); ?> <?php echo wp_kses_post( wc_price( $product->get_auction_max_bid() ) ); ?>
          			<?php } ?>
          		<?php } elseif ( $user_max_bid > 0 ) { ?>
          			<p class="max-bid"><?php echo esc_html( $max_min_bid_text ); ?> <?php echo wp_kses_post( wc_price( $user_max_bid ) ); ?>
          		<?php } ?>

          		<?php do_action( 'woocommerce_before_bid_form' ); ?>


              <?php if (is_user_logged_in()) { ?>

            		<form class="auction_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo intval( $product_id ); ?>">

            			<?php do_action( 'woocommerce_before_bid_button' ); ?>

            			<input type="hidden" name="bid" value="<?php echo esc_attr( $product_id ); ?>" />
            				<div class="quantity buttons_added">
            					<input type="button" value="-" class="minus" />
            					<input type="text" name="bid_value" data-auction-id="<?php echo intval( $product_id ); ?>"
          							<?php if ( 'yes' !== $product->get_auction_sealed() ) { ?>
          								value="<?php echo esc_attr( $product->bid_value() ); ?>"
          								<?php if ( 'reverse' === $product->get_auction_type() ) : ?>
          									max="<?php echo esc_attr( $product->bid_value() ); ?>"
          								<?php else : ?>
          									min="<?php echo esc_attr( $product->bid_value() ); ?>"
          								<?php endif; ?>
          							<?php } ?>
          							step="100" size="<?php echo intval( strlen( $product->get_curent_bid() ) ) + 6; ?>" title="bid"  class="input-text qty  bid text left">
                      <input type="button" value="+" class="plus" />
            				</div>
            			<button type="submit" class="bid_button button alt"><?php echo wp_kses_post( apply_filters( 'bid_text', esc_html__( 'Bid', 'auctions-for-woocommerce' ), $product ) ); ?></button>
            			<input type="hidden" name="place-bid" value="<?php echo intval( $product_id ); ?>" />
            			<input type="hidden" name="product_id" value="<?php echo intval( $product_id ); ?>" />
            			<?php if ( is_user_logged_in() ) { ?>
            				<input type="hidden" name="user_id" value="<?php echo intval( get_current_user_id() ); ?>" />
            			<?php } ?>

            			<?php // do_action( 'woocommerce_after_bid_button' ); ?>
            		</form>

              <?php } else { ?>
                <p class="mustLogin">you must <span class="mustLoginButton" onclick="altClassFromSelector('alt','#logForm')">login</span> to place a bid</p>
              <?php } ?>



          	</div>

          <?php elseif ( ( false === $product->is_closed ) && ( false === $product->is_started ) ) : ?>
            <div class='auctionData' >

              <div class="auctionTitle">
                <h2>Auction info:</h2>
                <?php do_action( 'woocommerce_after_bid_form' ); ?>
              </div>

        			<p class="auctionDetails">
                <span class="auctionDetailsTitle"><?php echo wp_kses_post( apply_filters( 'auction_starts_text', esc_html__( 'Auction starts in:', 'auctions-for-woocommerce' ), $product ) ); ?></span>
                <span class="auctionDetailsValue auction-time-countdown future notMet" data-time="<?php echo esc_attr( $product->get_seconds_to_auction() ); ?>" data-format="<?php echo esc_attr( get_option( 'auctions_for_woocommerce_countdown_format' ) ); ?>"></span>
              </p>
              <p class="auctionDetails">
                <span class="auctionDetailsTitle"><?php echo wp_kses_post( apply_filters( 'time_text', esc_html__( 'Auction starts:', 'auctions-for-woocommerce' ), $product_id ) ); ?></span>
                <span class="auctionDetailsValue"><?php echo esc_html( date_i18n( get_option( 'date_format' ), strtotime( $product->get_auction_start_time() ) ) ); ?></span>
                <?php // echo esc_html( date_i18n( get_option( 'time_format' ), strtotime( $product->get_auction_start_time() ) ) ); ?>
              </p>
            	<p class="auctionDetails">
                <span class="auctionDetailsTitle"><?php echo wp_kses_post( apply_filters( 'time_text', esc_html__( 'Auction ends:', 'auctions-for-woocommerce' ), $product_id ) ); ?></span>
                <span class="auctionDetailsValue"><?php echo esc_html( date_i18n( get_option( 'date_format' ), strtotime( $product->get_auction_end_time() ) ) ); ?></span>
                <?php // echo esc_html( date_i18n( get_option( 'time_format' ), strtotime( $product->get_auction_end_time() ) ) ); ?>
              </p>
              <p class="auctionDetails">
                <span class="auctionDetailsTitle">Starting bid:</span>
                <span class="auctionDetailsValue">€ <?php echo number_format($product->auction_start_price,0,",","."); ?></span>
              </p>


            </div>

        <?php endif; } ?>






        <?php if (!in_array('parts-racing-products', $cates)) { ?>
          <div class="singleFeatures">


            <figure class="singleFeature">

              <svg class="singleFeatureIcon" width="136" height="75" viewBox="0 0 136 75" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M131.733 21.9984C122.975 15.9739 114.232 9.13225 105.445 3.15198C102.791 1.34578 99.799 0.266651 96.5724 0.187768C90.8486 0.0475806 85.1217 -0.0227386 79.3961 0.00656101C69.6885 0.0556942 59.9808 0.181457 50.2741 0.322996C46.0888 0.383849 41.8805 0.514569 38.2324 2.9834C38.2324 2.9834 11.335 19.2537 4.46984 33.8205C0.724447 41.767 -0.959603 52.067 0.552707 64.934C0.170911 66.655 1.2293 71.9528 1.2293 71.9528C1.33072 73.7527 2.3526 74.5907 4.16467 74.8012C5.27129 74.9297 6.39054 75.0013 7.50392 75C35.3728 74.968 63.2412 74.9283 91.1105 74.8778C103.782 74.8548 116.455 74.8296 129.126 74.7588C132.651 74.7394 133.607 73.7306 133.731 70.2309C134.218 56.5539 134.652 42.875 135.219 29.2011C135.348 26.0607 134.258 23.7352 131.733 21.9984ZM94.5859 6.99339C95.6245 6.99339 96.4665 7.83496 96.4665 8.87307C96.4665 9.91162 95.6245 10.7532 94.5859 10.7532C93.5478 10.7532 92.7062 9.91162 92.7062 8.87307C92.7062 7.83541 93.5478 6.99339 94.5859 6.99339ZM87.7379 6.99339C88.776 6.99339 89.6176 7.83496 89.6176 8.87307C89.6176 9.91162 88.776 10.7532 87.7379 10.7532C86.6998 10.7532 85.8582 9.91162 85.8582 8.87307C85.8582 7.83541 86.6998 6.99339 87.7379 6.99339ZM80.5978 6.99339C81.6364 6.99339 82.478 7.83496 82.478 8.87307C82.478 9.91162 81.6364 10.7532 80.5978 10.7532C79.5597 10.7532 78.7182 9.91162 78.7182 8.87307C78.7182 7.83541 79.5597 6.99339 80.5978 6.99339ZM73.7494 6.99339C74.7875 6.99339 75.6291 7.83496 75.6291 8.87307C75.6291 9.91162 74.7875 10.7532 73.7494 10.7532C72.7108 10.7532 71.8693 9.91162 71.8693 8.87307C71.8693 7.83541 72.7113 6.99339 73.7494 6.99339ZM66.8644 6.99339C67.903 6.99339 68.7446 7.83496 68.7446 8.87307C68.7446 9.91162 67.903 10.7532 66.8644 10.7532C65.8263 10.7532 64.9848 9.91162 64.9848 8.87307C64.9848 7.83541 65.8263 6.99339 66.8644 6.99339ZM60.0164 6.99339C61.0546 6.99339 61.8961 7.83496 61.8961 8.87307C61.8961 9.91162 61.0546 10.7532 60.0164 10.7532C58.9779 10.7532 58.1363 9.91162 58.1363 8.87307C58.1363 7.83541 58.9779 6.99339 60.0164 6.99339ZM53.058 6.99339C54.0966 6.99339 54.9382 7.83496 54.9382 8.87307C54.9382 9.91162 54.0966 10.7532 53.058 10.7532C52.0199 10.7532 51.1783 9.91162 51.1783 8.87307C51.1783 7.83541 52.0199 6.99339 53.058 6.99339ZM46.21 6.99339C47.2481 6.99339 48.0897 7.83496 48.0897 8.87307C48.0897 9.91162 47.2481 10.7532 46.21 10.7532C45.1715 10.7532 44.3299 9.91162 44.3299 8.87307C44.3299 7.83541 45.1715 6.99339 46.21 6.99339ZM118.796 58.997C118.796 62.0523 116.317 64.5301 113.26 64.5301H14.3528C11.2948 64.5301 8.81744 62.0523 8.81744 58.997C8.81744 22.5654 47.7665 18.9287 50.8231 18.9287H109.108C115.738 18.9287 118.796 24.0246 118.796 28.2505V58.997H118.796ZM130.454 59.9495C130.454 60.4588 130.041 60.8722 129.531 60.8722H125.658C125.148 60.8722 124.735 60.4588 124.735 59.9495V56.0756C124.735 55.5658 125.148 55.1529 125.658 55.1529H129.531C130.041 55.1529 130.454 55.5658 130.454 56.0756V59.9495ZM130.454 53.5743C130.454 54.0841 130.041 54.497 129.531 54.497H125.658C125.148 54.497 124.735 54.0841 124.735 53.5743V49.7005C124.735 49.1906 125.148 48.7778 125.658 48.7778H129.531C130.041 48.7778 130.454 49.1906 130.454 49.7005V53.5743ZM130.454 47.1996C130.454 47.709 130.041 48.1223 129.531 48.1223H125.658C125.148 48.1223 124.735 47.709 124.735 47.1996V43.3258C124.735 42.8164 125.148 42.4031 125.658 42.4031H129.531C130.041 42.4031 130.454 42.8164 130.454 43.3258V47.1996ZM130.454 40.8065C130.454 41.3158 130.041 41.7292 129.531 41.7292H125.658C125.148 41.7292 124.735 41.3158 124.735 40.8065V36.9331C124.735 36.4232 125.148 36.0103 125.658 36.0103H129.531C130.041 36.0103 130.454 36.4232 130.454 36.9331V40.8065ZM130.454 34.4313C130.454 34.9411 130.041 35.354 129.531 35.354H125.658C125.148 35.354 124.735 34.9407 124.735 34.4313V30.5579C124.735 30.0481 125.148 29.6348 125.658 29.6348H129.531C130.041 29.6348 130.454 30.0481 130.454 30.5579V34.4313Z" fill="#2E353A"/>
              </svg>

              <?php $dashboard = get_post_meta( $product->id, 'dashboard' )[0]; ?>
              <?php if($dashboard){ ?>
                <p class="singleFeatureDesc"><?php echo $dashboard; ?></p>
              <?php } ?>
            </figure>

              <figure class="singleFeature">
                <svg class="singleFeatureIcon" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                width="300px" height="300px" viewBox="0 0 300 300" enable-background="new 0 0 300 300" xml:space="preserve">
                <g>
                  <path fill="#2E353A" d="M98.516,203.783c4.092,4.102,7.219,8.83,9.42,13.87L150,173.951l42.068,43.702c2.197-5.04,5.324-9.769,9.416-13.87c4.102-4.102,8.826-7.224,13.881-9.425l-44.523-42.073l40.045-41.602c-2.553-2.957-5.451-6.093-8.848-9.485c-3.387-3.392-6.523-6.29-9.477-8.853L150,132.578l-42.563-40.232c-2.961,2.563-6.088,5.461-9.484,8.853c-3.389,3.392-6.285,6.528-8.85,9.485l40.055,41.602l-44.521,42.073C89.689,196.56,94.414,199.682,98.516,203.783z"/>
                  <path fill="#2E353A" d="M121.047,235.557l-3.059,3.054l-6.445-6.445c0.711,9.311-1.441,18.851-6.646,27.205c1.24,4.023,0.221,8.491-2.889,11.59c-3.094,3.095-7.557,4.134-11.59,2.889c-8.35,5.205-17.889,7.361-27.209,6.643l6.449,6.449l-3.053,3.059l7.822,7.823l3.053-3.054l2.143,2.133l48.332-48.33l-2.135-2.129l3.055-3.053L121.047,235.557z"/>
                  <path fill="#2E353A" d="M28.445,211.881c-1.24-4.032-0.215-8.496,2.879-11.6c3.109-3.099,7.572-4.129,11.596-2.879c8.369-5.21,17.898-7.361,27.205-6.646l-6.445-6.445l3.059-3.059l-7.828-7.827l-3.059,3.049l-2.129-2.124l-48.33,48.321l2.139,2.129l-3.063,3.063l7.832,7.827l3.053-3.058l6.449,6.454C21.098,229.771,23.24,220.235,28.445,211.881z"/>
                  <path fill="#2E353A" d="M89.992,268.946c2.814,1.726,6.527,1.396,8.959-1.039c2.443-2.436,2.773-6.157,1.043-8.963c11.143-15.885,9.654-37.922-4.537-52.104c-14.189-14.19-36.23-15.678-52.102-4.541c-2.816-1.726-6.533-1.396-8.963,1.044c-2.445,2.431-2.775,6.152-1.031,8.954c-11.141,15.889-9.654,37.921,4.523,52.107C52.076,278.591,74.107,280.079,89.992,268.946zM46.816,255.479c-10.965-10.968-10.965-28.747,0-39.716c10.963-10.958,28.746-10.958,39.719,0c10.955,10.969,10.955,28.748,0,39.716C75.563,266.442,57.779,266.442,46.816,255.479z"/>
                  <polygon fill="#2E353A" points="300,74.694 227.568,2.262 221.727,8.105 294.164,80.54 	"/>
                  <path fill="#2E353A" d="M205.906,96.351c18.088,18.095,23.406,30.656,23.26,42.178l3.502,3.507l48.916-48.917l-72.441-72.43l-48.912,48.91l3.498,3.5C175.246,72.955,187.82,78.265,205.906,96.351z M210.811,74.973c4.555-4.552,11.938-4.552,16.488,0c4.549,4.543,4.549,11.93,0,16.475c-4.551,4.56-11.934,4.56-16.488,0C206.264,86.903,206.264,79.517,210.811,74.973z"/>
                  <polygon fill="#2E353A" points="289.824,84.87 217.387,12.436 213.482,16.359 285.906,88.789 	"/>
                  <path fill="#2E353A" d="M209.582,273.849c-4.031,1.245-8.496,0.206-11.6-2.889c-3.107-3.099-4.119-7.566-2.879-11.59c-5.213-8.354-7.355-17.895-6.656-27.205l-6.445,6.445l-3.053-3.054l-7.822,7.833l3.053,3.053l-2.133,2.129l48.33,48.33l2.133-2.133l3.053,3.054l7.834-7.823l-3.063-3.059l6.449-6.449C227.473,281.21,217.932,279.054,209.582,273.849z"/>
                  <path fill="#2E353A" d="M294.607,222.671l-48.34-48.321l-2.129,2.124l-3.049-3.049l-7.836,7.827l3.059,3.059l-6.445,6.445c9.305-0.715,18.85,1.437,27.199,6.646c4.029-1.25,8.5-0.22,11.6,2.879c3.096,3.104,4.129,7.567,2.879,11.6c5.215,8.354,7.357,17.89,6.648,27.205l6.453-6.454l3.053,3.058l7.834-7.827l-3.072-3.063L294.607,222.671z"/>
                  <path fill="#2E353A" d="M265.617,203.344c-2.439-2.439-6.156-2.77-8.973-1.044c-15.879-11.137-37.91-9.649-52.102,4.541c-14.182,14.182-15.674,36.219-4.537,52.104c-1.73,2.806-1.4,6.527,1.035,8.963s6.152,2.765,8.967,1.039c15.875,11.133,37.908,9.645,52.1-4.541c14.189-14.187,15.674-36.219,4.531-52.107C268.373,209.496,268.043,205.774,265.617,203.344z M253.176,255.479c-10.963,10.964-28.748,10.964-39.701,0c-10.973-10.968-10.973-28.747,0-39.716c10.953-10.958,28.738-10.958,39.701,0C264.148,226.731,264.148,244.511,253.176,255.479z"
                  />
                  <polygon fill="#2E353A" points="78.264,8.105 72.432,2.262 0,74.694 5.836,80.54 	"/>
                  <path fill="#2E353A" d="M67.332,142.036l3.502-3.507c-0.146-11.522,5.16-24.083,23.25-42.178c18.096-18.086,30.67-23.396,42.18-23.252l3.496-3.5l-48.902-48.91l-72.432,72.43L67.332,142.036z M72.703,74.973c4.559-4.552,11.934-4.552,16.479,0c4.545,4.543,4.545,11.93,0,16.475c-4.545,4.56-11.92,4.56-16.479,0C68.152,86.903,68.152,79.517,72.703,74.973z"/>
                  <polygon fill="#2E353A" points="14.086,88.789 86.527,16.359 82.613,12.436 10.176,84.87 	"/>
                </g>
              </svg>

              <?php $engine = get_post_meta( $product->id, 'engine' )[0]; ?>
              <?php if($engine){ ?>
                <p class="singleFeatureDesc"><?php echo $engine; ?></p>
              <?php } ?>
            </figure>


            <figure class="singleFeature">
              <svg class="singleFeatureIcon" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="300px" height="300px" viewBox="0 0 300 300" enable-background="new 0 0 300 300" xml:space="preserve">
                <g>
                  <path fill="#2E353A" d="M59.37,112.018c1.639-1.575,1.688-4.185,0.11-5.827c-1.576-1.64-4.183-1.688-5.82-0.114c-1.641,1.578-1.688,4.178-0.112,5.817C55.126,113.536,57.73,113.595,59.37,112.018z"/>
                  <path fill="#2E353A" d="M167.802,58.197c-1.573-1.636-4.192-1.684-5.833-0.108c-1.631,1.569-1.684,4.186-0.111,5.822c1.577,1.642,4.19,1.686,5.823,0.118C169.319,62.453,169.38,59.838,167.802,58.197z"/>
                  <path fill="#2E353A" d="M199.955,212.889c-1.639,1.576-1.689,4.189-0.114,5.826c1.572,1.639,4.187,1.689,5.825,0.113c1.635-1.57,1.687-4.186,0.113-5.82C204.204,211.369,201.591,211.316,199.955,212.889z"/>
                  <path fill="#2E353A" d="M87.815,226.828c1.643-1.578,1.696-4.188,0.124-5.824c-1.58-1.643-4.193-1.695-5.834-0.117c-1.636,1.572-1.687,4.188-0.109,5.828C83.57,228.354,86.182,228.4,87.815,226.828z"/>
                  <path fill="#2E353A" d="M104.819,68.556c1.636-1.572,1.687-4.173,0.111-5.813c-1.58-1.643-4.182-1.694-5.815-0.122c-1.642,1.578-1.693,4.18-0.114,5.822C100.577,70.083,103.18,70.133,104.819,68.556z"/>
                  <path fill="#2E353A" d="M212.472,95.326c-1.64,1.576-1.688,4.18-0.112,5.818c1.577,1.641,4.182,1.695,5.819,0.12c1.642-1.577,1.689-4.183,0.114-5.822C216.718,93.802,214.112,93.748,212.472,95.326z"/>
                  <path fill="#2E353A" d="M52.725,174.775c1.636-1.57,1.692-4.184,0.119-5.82c-1.577-1.641-4.19-1.686-5.825-0.115c-1.64,1.576-1.697,4.189-0.12,5.83C48.473,176.307,51.086,176.352,52.725,174.775z"/>
                  <path fill="#2E353A" d="M142.384,238.479c-1.634,1.572-1.686,4.18-0.11,5.818c1.575,1.641,4.185,1.691,5.818,0.121c1.648-1.586,1.693-4.188,0.116-5.826C146.633,236.951,144.032,236.895,142.384,238.479z"/>
                  <path fill="#2E353A" d="M248.464,218.602H231.55v-21.299c-1.075,2.137-2.188,4.254-3.376,6.32c-3.544,6.166-8.753,7.529-15.399,5.07c-0.924-0.342-2.224-1.258-2.224-1.258c3.793-6.264,6.623-11.018,9.921-17.752c3.238-6.609,5.464-12.762,7.874-19.047c-0.501-1.338-0.998-2.861-1.454-4.643c-0.673-0.35-1.311-0.811-1.886-1.383c-2.895-2.9-2.783-7.604,0.239-10.564c0.04-0.039,0.082-0.07,0.122-0.107c0.253-5.254,1.865-10.143,4.501-14.333c-0.641-3.805-1.364-7.498-2.409-11.843c-1.742-7.255-3.991-13.475-6.172-19.945c0,0,2.101-0.5,3.396-0.673c0.299-0.04,0.593-0.064,0.887-0.086c-0.023-0.47-0.06-0.936-0.06-1.412c0-0.595,0.022-1.187,0.057-1.774h-0.004c0.004-0.039,0.009-0.074,0.013-0.113c0.093-1.487,0.293-2.944,0.598-4.364c2.413-14.151,7.742-15.52,5.582-22.72v-29.45C179.288-0.45,95.865-1.846,41.782,50.774c-54.918,53.438-55.833,141.134-1.949,196.58c52.521,54.049,140.787,55.146,195.068,2.42c7.548-7.248,14.063-15.201,19.604-23.623C252.701,222.436,251.113,219.877,248.464,218.602z M220.982,173.658c-2.566,9.17-6.682,17.643-12.271,25.334c-3.344,4.596-7.066,4.699-10.949,0.703c-0.886-0.908-1.757-1.828-2.639-2.744c-0.966-1.006-1.946-1.988-2.877-3.006c-2.47-2.701-2.73-5.701-1.113-8.885c2.651-5.209,5.245-10.445,7.714-15.738c1.657-3.557,3.909-5.189,7.85-4.939c2.988,0.186,5.989,0.471,8.951,0.957C220.053,166.041,222.2,169.326,220.982,173.658zM168.191,183.641c-19.729,16.486-47.811,13.797-63.613-5.225c-17.204-20.727-12.19-48.052,4.956-62.82c19.733-16.997,48.076-13.386,63.344,4.546C189.977,139.474,186.269,168.527,168.191,183.641z M179.063,191.061c-1.399,1.652-4.361,1.688-5.858,0.215c-1.803-1.99-2.013-4.123-0.257-6.176c1.455-1.711,4.771-1.705,6.193,0.01C180.739,187.033,180.676,189.16,179.063,191.061z M127.021,204.051c-1.445,1.432-4.768,1.461-6.101-0.234c-1.518-1.936-1.49-4.09,0.109-5.949c1.498-1.738,4.643-1.639,6.144,0.148C128.787,199.932,128.726,201.971,127.021,204.051zM89.112,110.675c-2.718,2.66-5.718,3.207-9.117,1.543c-2.474-1.208-4.967-2.397-7.423-3.648c-3.866-1.967-5.157-6.02-2.608-9.485c2.997-4.084,6.031-8.188,9.59-11.609c3.561-3.413,7.521-6.072,11.425-8.685c3.809-2.548,7.812-1.227,9.72,2.819c1.175,2.49,2.278,5.024,3.331,7.568c1.46,3.538,0.778,6.406-2,9.062C97.713,102.365,93.383,106.494,89.112,110.675zM89.994,165.408c-1.733,1.715-4.074,1.596-5.996,0.002c-1.672-1.383-1.582-4.848,0.157-6.213c1.979-1.555,4.025-1.615,6.174,0.662C91.937,161.508,91.685,163.736,89.994,165.408z M56.221,127.543c0.407-1.636,0.194-4.083,2.327-5.531c1.792-1.223,4.58-0.657,6.672-0.068c2.94,0.827,5.707,2.403,8.435,3.888c3.509,1.923,4.492,4.674,3.945,8.772c-0.741,5.592-1.318,11.223-1.79,16.844c-0.329,3.814-2.026,6.238-5.733,7.291c-2.658,0.756-5.348,1.471-8.052,2.039c-4.934,1.045-8.119-1.426-8.474-6.443C52.917,145.25,54.039,136.331,56.221,127.543z M51.165,114.294c-3.042-3.089-3.082-7.558-0.114-10.513c3.091-3.083,7.9-3.053,10.84,0.066c2.666,2.828,2.568,7.521-0.2,10.395C58.799,117.234,54.073,117.254,51.165,114.294z M105,108.132c1.54,1.803,1.606,3.763,0.009,5.581c-1.669,1.901-4.382,1.957-6.11,0.166c-1.842-1.916-1.533-3.904-0.387-5.494C100.606,106.277,103.399,106.273,105,108.132zM118.351,66.549c9.813-2.613,19.828-3.197,29.906-2c1.28,0.15,2.759,0.639,3.756,1.646c0.995,1.011,1.685,2.59,1.449,3.544c-1.175,4.756-2.321,9.6-4.33,14.025c-0.668,1.482-3.782,2.346-5.887,2.601c-5.591,0.683-11.265,0.775-16.887,1.312c-3.802,0.355-6.621-0.754-8.364-4.142c-1.415-2.763-2.662-5.631-3.776-8.53C112.769,71.206,114.438,67.602,118.351,66.549zM179.721,101.587c-3.241-2.874-7.02-5.173-10.658-7.571c-3.348-2.198-4.662-4.93-3.686-8.799c0.676-2.678,1.465-5.331,2.313-7.964c1.55-4.809,5.318-6.677,9.687-4.067l21.304,15.121c5.282,5.489,4.945,8.723-1.339,12.92c-0.381,0.253-0.703,0.602-1.101,0.843C190.057,105.98,188.136,109.072,179.721,101.587z M187.774,133.739c1.338-1.669,4.917-1.68,6.248,0.002c1.547,1.968,1.593,4.239-0.197,5.983c-1.792,1.753-3.947,1.665-5.886-0.085C186.086,137.728,186.206,135.677,187.774,133.739zM224.311,143.322c0.319,4.107-2.661,7.154-6.785,6.969c-3.226-0.143-6.462-0.426-9.646-0.967c-3.418-0.578-5.345-2.881-6.144-6.232c-1.326-5.599-2.638-11.207-4.111-16.771c-0.883-3.319-0.553-6.159,2.128-8.571c2.858-1.923,5.625-4.029,8.611-5.743c3.345-1.914,7.277-0.46,8.926,3.231C221.313,124.168,223.542,133.581,224.311,143.322zM220.58,103.604c-2.934,2.919-7.604,2.874-10.58-0.108c-2.944-2.953-2.925-7.594,0.04-10.591c2.903-2.919,7.575-2.867,10.555,0.123C223.537,95.981,223.535,100.666,220.58,103.604z M226.173,65.844c1.572,1.635,1.521,4.248-0.122,5.826c-1.635,1.571-4.245,1.518-5.817-0.118c-1.575-1.638-1.527-4.25,0.108-5.822C221.983,64.153,224.598,64.205,226.173,65.844z M212.946,41.727c1.64-1.576,4.251-1.526,5.823,0.11c1.579,1.642,1.521,4.25-0.117,5.825c-1.635,1.572-4.242,1.526-5.822-0.116C211.259,45.91,211.312,43.298,212.946,41.727zM210.141,86.792c-0.501,0.856-1.633,1.969-1.633,1.969c-5.498-4.834-9.682-8.447-15.739-12.879c-6.012-4.418-11.741-7.717-17.588-11.24c0,0,1.275-1.746,2.149-2.698c4.09-4.506,9.704-5.79,14.922-2.49c5.431,3.415,10.698,7.165,15.6,11.294C213.291,75.316,213.721,80.684,210.141,86.792z M187.211,41.549c1.642-1.579,4.243-1.521,5.817,0.117c1.58,1.642,1.531,4.241-0.111,5.819c-1.639,1.575-4.242,1.528-5.822-0.115C185.522,45.732,185.572,43.124,187.211,41.549z M172.123,21.507c1.64-1.574,4.24-1.523,5.815,0.116c1.577,1.639,1.53,4.247-0.108,5.821c-1.642,1.578-4.248,1.52-5.824-0.119C170.431,25.688,170.481,23.087,172.123,21.507zM159.344,55.745c2.971-2.821,7.771-2.745,10.558,0.161c2.776,2.9,2.728,7.752-0.104,10.632c-2.885,2.939-7.55,2.901-10.453-0.077C156.195,63.234,156.193,58.746,159.344,55.745z M156.699,101.348c-1.928,1.388-4.001,1.601-5.478,0.085c-2.13-2.253-2.136-4.973-0.242-6.483c1.965-1.558,4.099-1.375,5.937,0.193C158.512,96.504,158.386,100.132,156.699,101.348zM148.437,30.633c1.642-1.578,4.248-1.529,5.822,0.11c1.577,1.641,1.527,4.249-0.113,5.828c-1.643,1.578-4.248,1.522-5.826-0.118C146.744,34.813,146.796,32.21,148.437,30.633z M126.908,17.089c1.637-1.577,4.245-1.52,5.821,0.12c1.573,1.637,1.527,4.244-0.111,5.819c-1.641,1.577-4.247,1.521-5.822-0.116C125.221,21.273,125.267,18.665,126.908,17.089zM122.019,46.487c6.344-0.912,12.787-1.467,19.19-1.508c7.111-0.048,10.916,3.76,12.158,10.736c0.17,0.966,0.028,2.558,0.028,2.558c-7.325-0.115-12.848-0.156-20.331,0.394c-7.448,0.541-13.952,1.753-20.677,2.849c0,0-0.159-2.154-0.122-3.455C112.461,51.991,115.902,47.375,122.019,46.487z M107.911,33.268c1.641-1.578,4.24-1.523,5.813,0.113c1.581,1.645,1.533,4.244-0.109,5.822c-1.641,1.577-4.242,1.526-5.824-0.12C106.22,37.447,106.271,34.845,107.911,33.268zM96.622,60c3.029-2.858,7.827-2.771,10.526,0.182c2.877,3.146,2.728,8.125-0.32,10.894c-2.86,2.602-7.996,2.339-10.665-0.546C93.366,67.509,93.572,62.886,96.622,60z M83.124,27.947c1.641-1.578,4.252-1.522,5.829,0.118c1.575,1.637,1.523,4.247-0.116,5.824c-1.637,1.572-4.246,1.52-5.82-0.117C81.44,32.131,81.488,29.52,83.124,27.947z M70.598,49.585c1.647-1.584,4.257-1.532,5.828,0.104c1.578,1.641,1.526,4.248-0.121,5.832c-1.633,1.569-4.239,1.518-5.817-0.123C68.915,53.763,68.966,51.154,70.598,49.585z M59.883,81.222c4.277-4.765,8.972-9.216,13.87-13.365c4.712-3.99,10.45-3.502,15.118,0.385c1.007,0.83,2.518,2.377,2.518,2.377c-5.3,4.313-10.514,8.368-15.861,13.578c-5.364,5.239-9.008,9.397-13.775,14.954c0,0-1.282-0.945-1.896-1.717C55.457,91.877,55.137,86.5,59.883,81.222z M45.662,52.543c1.643-1.578,4.246-1.524,5.822,0.115c1.579,1.642,1.523,4.241-0.117,5.817c-1.64,1.575-4.238,1.528-5.815-0.113C43.976,56.723,44.024,54.119,45.662,52.543z M40.937,78.101c1.639-1.575,4.25-1.526,5.822,0.11c1.577,1.641,1.522,4.25-0.115,5.825c-1.641,1.578-4.248,1.528-5.826-0.114C39.245,82.286,39.297,79.678,40.937,78.101zM19.013,89.58c1.643-1.579,4.256-1.526,5.832,0.114c1.576,1.638,1.521,4.25-0.119,5.828c-1.634,1.568-4.245,1.52-5.819-0.118C17.331,93.764,17.381,91.149,19.013,89.58z M6.253,133.079c1.633-1.572,4.25-1.524,5.826,0.115c1.573,1.638,1.519,4.254-0.117,5.825c-1.639,1.575-4.251,1.525-5.824-0.111C4.562,137.267,4.612,134.655,6.253,133.079zM14.923,184.053c-1.637,1.574-4.245,1.52-5.82-0.121c-1.575-1.637-1.523-4.238,0.114-5.814c1.639-1.576,4.245-1.529,5.82,0.109C16.614,179.865,16.563,182.479,14.923,184.053z M24.354,160.6c-1.639,1.574-4.244,1.521-5.82-0.119c-1.575-1.637-1.527-4.244,0.111-5.818c1.64-1.578,4.248-1.521,5.822,0.115C26.042,156.416,25.992,159.021,24.354,160.6zM23.175,120.429c-1.572-1.635-1.521-4.238,0.12-5.816c1.638-1.575,4.24-1.523,5.813,0.113c1.581,1.645,1.53,4.247-0.107,5.821C27.357,122.125,24.757,122.074,23.175,120.429z M34.205,200.279c-1.631,1.57-4.242,1.525-5.822-0.115c-1.574-1.639-1.516-4.25,0.117-5.82c1.641-1.578,4.253-1.533,5.828,0.104C35.907,196.09,35.848,198.703,34.205,200.279zM34.095,147.953c0.294-6.397,1.111-12.822,2.271-19.125c1.116-6.064,5.871-9.326,11.942-9.283c1.308,0.009,3.455,0.253,3.455,0.253c-1.373,6.688-2.834,13.133-3.675,20.56c-0.838,7.45-1.015,12.971-1.182,20.288c0,0-1.594,0.076-2.556-0.129C37.42,159.01,33.771,155.055,34.095,147.953z M44.512,166.162c3.079-2.908,7.529-2.777,10.506,0.326c2.851,2.971,2.769,7.797-0.184,10.59c-2.876,2.709-7.907,2.555-10.691-0.334C41.337,173.836,41.511,168.998,44.512,166.162zM50.97,234.271c-1.574-1.637-1.527-4.248,0.111-5.824c1.639-1.574,4.252-1.521,5.827,0.115c1.573,1.637,1.521,4.248-0.118,5.824C55.152,235.961,52.542,235.908,50.97,234.271z M64.761,258.281c-1.638,1.574-4.245,1.525-5.817-0.111c-1.58-1.645-1.528-4.252,0.11-5.826c1.639-1.576,4.245-1.523,5.825,0.119C66.452,254.1,66.399,256.705,64.761,258.281zM73.808,217.912c-6.204,3.441-11.558,2.877-16.003-2.662c-3.995-5.004-7.623-10.365-10.909-15.865c-3.165-5.303-1.751-10.889,2.843-14.863c0.985-0.854,2.76-2.094,2.76-2.094c3.38,5.928,6.541,11.742,10.811,17.865c4.288,6.152,7.802,10.424,12.5,16.035C75.809,216.328,74.658,217.439,73.808,217.912z M90.085,258.406c-1.634,1.568-4.25,1.52-5.823-0.117c-1.574-1.639-1.518-4.25,0.115-5.82c1.641-1.578,4.256-1.533,5.83,0.105C91.78,254.211,91.726,256.828,90.085,258.406z M89.895,229.197c-3.081,2.906-7.616,2.801-10.534-0.242c-2.945-3.063-2.885-7.637,0.141-10.547c3.05-2.932,7.555-2.816,10.528,0.283C93.012,221.793,92.949,226.318,89.895,229.197zM86.701,208.289c-2.51,3.064-6.606,3.117-9.413,0.381c-0.748-0.725-1.516-1.432-2.163-2.246c-4.006-5.057-14.034-21.635-14.034-21.635c-2.322-4.264-0.327-8.037,4.303-9.352c2.767-0.795,5.574-1.475,8.391-2.031c3.961-0.795,6.446,0.67,8.584,4.109c2.961,4.779,6.104,9.461,9.406,14.01c2.055,2.848,2.586,5.672,0.733,8.627C90.735,202.963,88.807,205.717,86.701,208.289z M105.245,278.25c-1.641,1.578-4.248,1.527-5.822-0.109c-1.574-1.641-1.522-4.248,0.117-5.824c1.637-1.572,4.246-1.525,5.821,0.113C106.938,274.068,106.881,276.678,105.245,278.25zM128.863,269.443c-1.641,1.578-4.248,1.525-5.826-0.115c-1.574-1.639-1.523-4.248,0.118-5.824c1.639-1.576,4.249-1.527,5.824,0.111C130.558,265.258,130.504,267.867,128.863,269.443z M132.916,244.16c-2.611,6.59-7.107,9.555-14.06,8.082c-6.266-1.328-12.473-3.164-18.5-5.332c-5.809-2.09-8.258-7.307-7.229-13.295c0.226-1.289,0.803-3.365,0.803-3.365c6.38,2.434,12.508,4.926,19.692,6.947c7.227,2.043,12.643,3.113,19.833,4.471C133.456,241.668,133.278,243.246,132.916,244.16z M129.329,234.514c-9.711-1.059-19.021-3.65-27.755-8.086c-3.983-2.023-4.848-6.305-2.238-9.936c1.541-2.156,3.108-4.295,4.69-6.42c0.23-0.311,0.545-0.561,0.436-0.438c3.112-3.287,5.976-3.393,9.362-2.246c5.117,1.723,10.335,3.191,15.573,4.512c3.802,0.932,6.18,3.023,6.625,6.91c0.356,2.977,0.577,5.977,0.604,8.98C136.676,232.201,133.725,234.988,129.329,234.514z M150.247,282.816c-1.641,1.578-4.247,1.527-5.824-0.111c-1.577-1.641-1.525-4.248,0.116-5.824c1.636-1.572,4.243-1.523,5.821,0.117C151.936,278.639,151.883,281.244,150.247,282.816z M150.145,246.727c-3.183,2.936-7.583,2.777-10.477-0.373c-2.911-3.162-2.717-7.502,0.47-10.508c2.94-2.768,7.563-2.729,10.344,0.07C153.522,238.979,153.369,243.758,150.145,246.727zM151.542,225.031c-0.689-11.621-1.794-12.994,10.393-16.813c2.92-0.916,5.64-2.521,8.357-4.012c5.711-3.123,7.962-2.85,12.422,1.793c0.56,0.58,1.118,1.162,1.68,1.744c8.709,7.727,4.946,12.076-2.299,15.607c-6.687,3.258-13.596,6.146-20.619,8.611C155.339,234.115,151.921,231.463,151.542,225.031z M169.693,266.723c-1.643,1.578-4.254,1.533-5.831-0.107c-1.575-1.637-1.521-4.254,0.121-5.832c1.632-1.57,4.25-1.521,5.824,0.117C171.385,262.541,171.324,265.152,169.693,266.723z M194.252,272.156c-1.636,1.572-4.25,1.527-5.827-0.115c-1.579-1.643-1.522-4.256,0.112-5.828c1.646-1.582,4.255-1.529,5.833,0.113C195.947,267.967,195.896,270.574,194.252,272.156zM189.525,241.26c-5.672,2.967-11.627,5.514-17.657,7.693c-5.803,2.098-11.015-0.359-14.045-5.627c-0.647-1.135-1.52-3.109-1.52-3.109c6.461-2.195,12.768-4.176,19.598-7.201c6.859-3.035,11.714-5.668,18.123-9.213c0,0,0.873,1.336,1.175,2.27C197.395,232.813,195.817,237.971,189.525,241.26z M207.052,250.332c-1.644,1.58-4.248,1.537-5.827-0.104c-1.576-1.641-1.521-4.25,0.124-5.83c1.639-1.576,4.242-1.521,5.818,0.117C208.744,246.158,208.691,248.756,207.052,250.332z M207.675,221.326c-3.115,2.85-7.783,2.643-10.534-0.467c-2.879-3.232-2.617-7.516,0.636-10.461c3.184-2.883,7.711-2.715,10.511,0.393C211.072,213.881,210.801,218.473,207.675,221.326zM232.079,247.213c-1.64,1.576-4.251,1.531-5.831-0.113c-1.575-1.637-1.515-4.248,0.124-5.822c1.637-1.572,4.247-1.531,5.82,0.107C233.773,243.029,233.714,245.641,232.079,247.213z"/>
                  <path fill="#2E353A" d="M299.983,81.74c0.186-4.309-1.234-7.617-3.157-13.215c-0.313-0.906-4.17-10.331-4.601-11.189c-4.938-9.882-10.188-18.257-15.995-27.277c-2.01-3.126-4.919-4.558-8.526-4.378c-2.961,0.142-5.627,1.058-7.116,4.033c-4.23,8.388-5.725,13.875-10.048,15.955h-15.705v31.007c2.159,7.2-3.17,8.569-5.583,22.72c-0.304,1.42-0.505,2.877-0.598,4.364c-0.004,0.039-0.008,0.074-0.013,0.113h0.005c-0.035,0.588-0.057,1.179-0.057,1.774c0,6.807,2.297,13.069,6.143,18.082l-0.034-0.022c0,0,0.06,0.066,0.155,0.18c0.143,0.184,0.277,0.372,0.425,0.552c0.785,1.093,2.098,3.317,2.098,6.008c0,3.398-2.678,6.613-2.678,6.613l0.033-0.021c-3.97,5.055-6.349,11.418-6.349,18.344c0,0.596,0.022,1.186,0.058,1.773h-0.005c0.004,0.039,0.01,0.074,0.013,0.113c0.094,1.488,0.295,2.945,0.598,4.365c2.413,14.15,7.743,15.52,5.583,22.719v31.008h15.704c4.326,2.08,5.818,7.566,10.049,15.953c1.489,2.977,4.155,3.891,7.116,4.033c3.606,0.18,6.518-1.252,8.527-4.377c5.806-9.02,11.056-17.395,15.996-27.277c0.429-0.859,4.287-10.281,4.598-11.189c1.923-5.598,3.344-8.904,3.159-13.215c0.016-3.502-12.013-6.213-12.013-20.219l-0.1-0.002c0.15-1.209,0.236-2.438,0.236-3.686c0-3.811-0.722-7.451-2.028-10.799c0-0.004,0.002-0.01,0-0.014c-0.906-2.657,0.098-4.956,1.06-6.374l1.827,2.419l1.479-1.116l-2.085-2.761c0.028-0.024,0.053-0.046,0.063-0.053c2.432-1.028,4.137-3.435,4.137-6.239c0-2.804-1.704-5.21-4.135-6.238c-0.064-0.027-0.131-0.046-0.194-0.071c-0.006-0.004-0.011-0.009-0.018-0.013c-0.087-0.055-0.168-0.112-0.249-0.167l2.481-3.288l-1.479-1.116l-2.368,3.136c-2.028-2.608-0.519-5.718-0.519-5.718l-0.014,0.016c1.443-3.495,2.247-7.322,2.247-11.34c0-1.249-0.086-2.478-0.235-3.687l0.099-0.003C287.971,87.953,300,85.24,299.983,81.74z M271.221,33.583c3.032,0,5.491,2.458,5.491,5.492s-2.459,5.492-5.491,5.492c-3.034,0-5.492-2.458-5.492-5.492S268.187,33.583,271.221,33.583zM262.227,52.598c5.612,0,4.724,10.604,4.724,13.727c0,3.124-2.533,5.657-5.657,5.657s-5.657-2.533-5.657-5.657C255.636,63.201,257.026,52.598,262.227,52.598z M262.021,208.432c-5.2,0-6.591-10.602-6.591-13.727s2.532-5.658,5.658-5.658c3.123,0,5.655,2.533,5.655,5.658S267.632,208.432,262.021,208.432z M271.221,227.311c-3.034,0-5.492-2.457-5.492-5.49c0-3.035,2.458-5.492,5.492-5.492c3.032,0,5.491,2.457,5.491,5.492C276.712,224.854,274.253,227.311,271.221,227.311zM287.696,130.524c0,3.033-2.46,5.492-5.491,5.492c-3.035,0-5.493-2.459-5.493-5.492c0-3.033,2.458-5.492,5.493-5.492C285.236,125.032,287.696,127.491,287.696,130.524z"/>
                </g>
              </svg>
              <?php $brake = get_post_meta( $product->id, 'brake' )[0]; ?>
              <?php if($brake){ ?>
                <p class="singleFeatureDesc"><?php echo $brake; ?></p>
              <?php } ?>
            </figure>

            <figure class="singleFeature">
              <svg class="singleFeatureIcon" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="300px" height="300px" viewBox="0 0 300 300" enable-background="new 0 0 300 300" xml:space="preserve">
                <path fill="#2E353A" d="M262.026,2.175c-20.434,0.266-37.379,17.215-37.451,37.458c-0.021,5.982,1.541,11.773,4.254,16.964l-7.171,7.038l-15.922-15.92l-18.009,19.354l-24.909-25.626l-18.101,18.816l34.677,34.677l-5.466,4.569l-9.05-10.394l-7.168,7.348l-34.647-15.293l-18.638,18.638l34.288,34.288l-5.375,5.376l-9.559-9.318l-6.452,6.451l-34.287-15.89l-18.638,18.638l33.93,33.931l-5.138,5.136l-9.678-9.198l-6.332,6.33l-34.417-14.325l-18.15,18.15l24.373,23.894L33.46,218.08c0,0,6.882,6.811,15.302,15.184l-7.733,7.588c-3.587-1.542-7.517-2.378-11.616-2.324c-16.048,0.208-29.356,13.52-29.412,29.418c-0.056,15.675,13.637,29.73,29.103,29.881c15.452,0.15,29.942-13.808,30.129-29.02c0.052-4.199-0.789-8.225-2.333-11.894l7.846-7.698c7.925,7.947,14.264,14.388,14.353,14.743c0.239,0.955,8.602-8.603,8.602-8.603l-14.576-14.576l6.93-5.733c0,0,38.23,38.947,38.23,39.664c0,0.718,18.398-18.398,18.398-18.398L112.072,231.7l5.019-5.019l-17.205-7.406l6.452-6.452l52.686,22.58l17.683-17.681l-25.089-25.09l6.094-6.093l-16.249-7.646l4.063-5.019l53.284,22.222l18.397-18.399l-24.73-24.729l5.137-5.139l-16.964-7.885l6.212-6.212l52.21,22.819l18.04-18.042l-24.373-24.85l19.475-19.473l-14.587-14.588l6.845-6.715c5.205,2.981,11.076,4.736,17.163,4.795c19.674,0.191,38.127-17.582,38.365-36.95C300.257,19.597,282.831,1.905,262.026,2.175zM29.517,273.988c-3.031-0.029-5.714-2.785-5.705-5.857c0.012-3.117,2.62-5.726,5.766-5.767c3.201-0.042,5.885,2.682,5.844,5.937C35.386,271.282,32.545,274.018,29.517,273.988z M262.074,52.232c-6.418-0.063-12.1-5.896-12.077-12.4c0.022-6.599,5.546-12.123,12.205-12.209c6.782-0.088,12.46,5.678,12.377,12.566C274.501,46.501,268.487,52.293,262.074,52.232z"/>
              </svg>

              <?php $suspension = get_post_meta( $product->id, 'suspension' )[0]; ?>
              <?php if($suspension){ ?>
                <p class="singleFeatureDesc"><?php echo $suspension; ?></p>
              <?php } ?>
            </figure>




          </div>
        <?php } ?>

      </div>









      <div class="singleSide singleSide2">


        <?php if(!$product->is_type( 'auction' )){ ?>
          <?php // testimonial( 'none' ); ?>
        <?php } ?>

        <div class="superFicha">
          <div>
            <p class="singleSideStock2">STOCK #</p>


            <?php if($stockNumber){ ?>
              <p class="singleStock2ID"><?php echo $stockNumber; ?></p>
            <?php } ?>
          </div>
          <figure class="singleSideSintBox">
            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="">
            <figcaption class="singleSideSintBoxCaption">
              <h4 class="singleSideAnoMarca">
                <?php
                // get all the categories on the product
                // $categories = get_the_terms( get_the_ID(), 'product_cat' );
                // for each category
                if($categories){ ?>
                  <h4 class="singleSideAnoMarca">
                    <?php foreach ($categories as $cat) {
                      // get the parent category
                      $parent=get_term_by('id', $cat->parent, 'product_cat', 'ARRAY_A')['slug'];
                      // check if parent is either year or brand
                      if ($parent=="year-bikes" OR $parent=="brand") { ?>
                        <span><?php echo $cat->name; ?></span>
                      <?php }
                    } ?>
                  </h4>
                <?php }
                ?>
              </h4>
              <h4 class="singleSideTitle"><?php the_title(); ?></h4>
              <p class="singleSidePrice"><?php echo $product->get_price_html(); ?></p>
              <!-- <p class="singleSideData"><?php echo excerpt(140); ?></p> -->

              <a class="singleSideContact" href="tel:+34-938-364-911">Contact Us:<br>(704) 445-9105</a>


              <div class="singleSideSocialCont socialMedia">

                <a href="https://www.instagram.com/gpmotorbikes/?hl=es" target="_blank" class="socialMediaLink socialMediaInst">
                  <svg viewBox="0 0 501 500" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M250.112 121.806C179.153 121.806 121.918 179.042 121.918 250C121.918 320.958 179.153 378.194 250.112 378.194C321.07 378.194 378.305 320.958 378.305 250C378.305 179.042 321.07 121.806 250.112 121.806ZM250.112 333.343C204.256 333.343 166.769 295.967 166.769 250C166.769 204.033 204.145 166.657 250.112 166.657C296.078 166.657 333.454 204.033 333.454 250C333.454 295.967 295.967 333.343 250.112 333.343V333.343ZM413.45 116.563C413.45 133.186 400.061 146.463 383.549 146.463C366.925 146.463 353.648 133.075 353.648 116.563C353.648 100.05 367.037 86.6618 383.549 86.6618C400.061 86.6618 413.45 100.05 413.45 116.563ZM498.354 146.91C496.458 106.856 487.309 71.3768 457.966 42.1455C428.735 12.9142 393.256 3.76548 353.202 1.75722C311.921 -0.585741 188.19 -0.585741 146.91 1.75722C106.968 3.65391 71.4883 12.8026 42.1455 42.0339C12.8026 71.2652 3.76548 106.744 1.75722 146.798C-0.585741 188.079 -0.585741 311.81 1.75722 353.09C3.65391 393.144 12.8026 428.623 42.1455 457.855C71.4883 487.086 106.856 496.234 146.91 498.243C188.19 500.586 311.921 500.586 353.202 498.243C393.256 496.346 428.735 487.197 457.966 457.855C487.197 428.623 496.346 393.144 498.354 353.09C500.697 311.81 500.697 188.19 498.354 146.91V146.91ZM445.024 397.384C436.322 419.251 419.475 436.098 397.495 444.912C364.582 457.966 286.483 454.954 250.112 454.954C213.74 454.954 135.529 457.855 102.728 444.912C80.8602 436.21 64.0132 419.363 55.1992 397.384C42.1455 364.471 45.1579 286.372 45.1579 250C45.1579 213.628 42.2571 135.418 55.1992 102.616C63.9016 80.7486 80.7486 63.9016 102.728 55.0876C135.641 42.0339 213.74 45.0463 250.112 45.0463C286.483 45.0463 364.694 42.1455 397.495 55.0876C419.363 63.79 436.21 80.6371 445.024 102.616C458.078 135.529 455.065 213.628 455.065 250C455.065 286.372 458.078 364.582 445.024 397.384Z" fill="currentColor"/>
                  </svg>
                </a>

                <a href="https://es-la.facebook.com/gpmotorbikes/" target="_blank" class="socialMediaLink socialMediaFace">
                  <svg viewBox="0 0 313 500" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M272.598 281.25L286.484 190.762H199.658V132.041C199.658 107.285 211.787 83.1543 250.674 83.1543H290.146V6.11328C290.146 6.11328 254.326 0 220.078 0C148.574 0 101.836 43.3398 101.836 121.797V190.762H22.3535V281.25H101.836V500H199.658V281.25H272.598Z" fill="currentColor"/>
                  </svg>
                </a>

                <a href="https://www.youtube.com/" target="_blank" class="socialMediaLink socialMediaYouT">
                  <svg viewBox="0 0 547 384" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M534.722 60.083C528.441 36.433 509.935 17.807 486.438 11.486C443.848 0 273.067 0 273.067 0C273.067 0 102.287 0 59.696 11.486C36.199 17.808 17.693 36.433 11.412 60.083C0 102.95 0 192.388 0 192.388C0 192.388 0 281.826 11.412 324.693C17.693 348.343 36.199 366.193 59.696 372.514C102.287 384 273.067 384 273.067 384C273.067 384 443.847 384 486.438 372.514C509.935 366.193 528.441 348.343 534.722 324.693C546.134 281.826 546.134 192.388 546.134 192.388C546.134 192.388 546.134 102.95 534.722 60.083ZM217.212 273.591V111.185L359.951 192.39L217.212 273.591Z" fill="currentColor"/>
                  </svg>
                </a>

                <a href="https://wa.me/15551234567" target="_blank" class="socialMediaLink socialMediaWhatsapp">
                  <svg viewBox="0 0 500 500" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M425.112 72.6563C378.348 25.7812 316.071 0 249.888 0C113.281 0 2.12054 111.161 2.12054 247.768C2.12054 291.406 13.5045 334.04 35.1563 371.652L0 500L131.362 465.513C167.522 485.268 208.259 495.647 249.777 495.647H249.888C386.384 495.647 500 384.487 500 247.879C500 181.696 471.875 119.531 425.112 72.6563V72.6563ZM249.888 453.906C212.835 453.906 176.562 443.973 144.978 425.223L137.5 420.759L59.5982 441.183L80.3571 365.179L75.4464 357.366C54.7991 324.554 43.9732 286.719 43.9732 247.768C43.9732 134.263 136.384 41.8527 250 41.8527C305.022 41.8527 356.696 63.2812 395.536 102.232C434.375 141.183 458.259 192.857 458.147 247.879C458.147 361.496 363.393 453.906 249.888 453.906V453.906ZM362.835 299.665C356.696 296.54 326.228 281.585 320.536 279.576C314.844 277.455 310.714 276.451 306.585 282.701C302.455 288.951 290.625 302.79 286.942 307.031C283.371 311.161 279.688 311.719 273.549 308.594C237.165 290.402 213.281 276.116 189.286 234.933C182.924 223.996 195.647 224.777 207.478 201.116C209.487 196.987 208.482 193.415 206.92 190.29C205.357 187.165 192.969 156.696 187.835 144.308C182.813 132.254 177.679 133.929 173.884 133.705C170.313 133.482 166.183 133.482 162.054 133.482C157.924 133.482 151.228 135.045 145.536 141.183C139.844 147.433 123.884 162.388 123.884 192.857C123.884 223.326 146.094 252.79 149.107 256.92C152.232 261.049 192.746 323.549 254.911 350.446C294.196 367.411 309.598 368.862 329.241 365.96C341.183 364.174 365.848 351.004 370.982 336.496C376.116 321.987 376.116 309.598 374.554 307.031C373.103 304.241 368.973 302.679 362.835 299.665Z" fill="currentColor"/>
                  </svg>
                </a>
              </div>
            </figcaption>
          </figure>
        </div>
      </div>

      <main class="singleDescription"><?php echo the_content(); ?></main>

      <?php if($product->is_type( 'auction' )){ ?>
        <?php testimonial('onlyMobileG'); ?>
      <?php } ?>
    </article>




    <div class="singleFormContainer" id="singleRequestInfo">
      <form action="index.php" class="singleContact " action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
        <label  class="formLabelBig">More Info</label>
        <input type="hidden" name="action" value="lt_form_handler">
        <input type="hidden" name="link" value="<?php echo home_url( $wp->request ); ?>">
        <p class="SingleContactCloseButton" onclick="altClassFromSelector('alt','#singleRequestInfo')">+</p>
        <label  class="formLabel">CONTACT DETAILS</label>
        <input type="text"   placeholder="Name*"   class="formInput100 formInput" name="a01" required>
        <input type="email"  placeholder="Email*"        class="formInput100 formInput" name="a03" required>
        <input type="number" placeholder="Phone"        class="formInput100 formInput" name="a04">
        <input type="text"   placeholder="Country*"      class="formInput100 formInput" name="a05" required>

        <label  class="formLabel">SUBJECT</label>
        <textarea class="singleFormTxtArea" value="SUBJECT" placeholder="" name="a08"></textarea>
        <div class="formTermsAndConditions">
           <input type="checkbox" required>
           <a href="<?php echo site_url('privacy-policy'); ?>" target="_blank" class="linkTermAndConditionsForm">I accept terms and conditions</a>
        </div>
        <button class="singleContactButton contactButton" type="submit">SEND</button>
      </form>
    </div>



    <div class="singleFormContainer" id="singleMakeOffer">
      <form class="singleContact" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
        <input type="hidden" name="action" value="lt_form_handler">
        <input type="hidden" name="link" value="<?php echo home_url( $wp->request ); ?>">
        <p class="SingleContactCloseButton" onclick="altClassFromSelector('alt','#singleMakeOffer')">+</p>
        <label  class="formLabelBig">Make An Offer</label>
        <label  class="formLabel"><?php the_title(); ?></label>
        <label  class="formLabel">OFFER AMOUNT</label>
        <div class="offerAmmountIcon">
          <input class="offerAmmountIconInput euro" type="radio" id="euro" name="a10" value="euro">
          <label class="offerAmmountIconLabel" for="euro">€</label>
          <input class="offerAmmountIconInput dollar" type="radio" id="dollar" name="a10" value="dollar">
          <div class="offerAmmountIconSignal"></div>
          <label class="offerAmmountIconLabel" for="dollar">$</label><br>
        </div>
        <input type="number" placeholder="Offer"        name="a01" class="formInput100 formInput offerAmmount">
        <input type="text"   placeholder="Name"         name="a02" class="formInput100 formInput" required>
        <input type="email"  placeholder="Email"        name="a04" class="formInput100 formInput" required>
        <input type="number" placeholder="Phone"        name="a03" class="formInput100 formInput">
        <input type="text"   placeholder="Country"      name="a05" class="formInput100 formInput" required>

        <label  class="formLabel">SUBJECT</label>
        <textarea class="singleFormTxtArea" value="" placeholder="SUBJECT" name="a08"></textarea>
        <div class="formTermsAndConditions">
           <input type="checkbox">
           <a href="<?php echo site_url('privacy-policy'); ?>" target="_blank" class="linkTermAndConditionsForm">I accept terms and conditions</a>
        </div>
        <button class="singleRequestInfoButton contactButton" type="submit">SUBMIT OFFER</button>
      </form>
    </div>

    <div class="singleFormContainer" id="singleTrade">
      <form class="singleContact" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
        <input type="hidden" name="action" value="lt_form_handler">
        <input type="hidden" name="link" value="<?php echo home_url( $wp->request ); ?>">
        <p class="SingleContactCloseButton" onclick="altClassFromSelector('alt','#singleTrade')">+</p>
        <label  class="formLabelBig">Trade this <?php the_title(); ?></label>
        <p class="singleFormTxt mainTxtType1">We are always looking for new inventory. If you are interested in trading your high quality bike for one of ours, simply fill out this form.<br>A member of our sales department will be in touch within 24 hours. No one makes the trade-in process easier than <a href="amatumoto.com" target="_blank">amatumoto.com</a>. (Amatumoto Grand Prix Motorbikes)</p>
        <input type="text"   placeholder="Name"       class="formInput50 formInput" name="a01" required>
        <input type="email"  placeholder="Email"      class="formInput50 formInput" name="a05" required>
        <input type="number" placeholder="Phone"      class="formInput50 formInput" name="a07">
        <input type="number" placeholder="Year"       class="formInput50 formInput" name="a02" required>
        <input type="text"   placeholder="Make"       class="formInput50 formInput" name="a04">
        <input type="text"   placeholder="Model"      class="formInput50 formInput" name="a06" required>
        <input type="text"   placeholder="VIN"        class="formInput50 formInput" name="a08">
        <label  class="formLabel">Upload photos here</label>
        <input type="file" placeholder="upload files" class="formInput50 formInput" name="a09">
        <textarea class="singleFormTxtArea formInput50" value="comments" placeholder="your comments" name="a10"></textarea>
        <div class="formTermsAndConditions">
           <input type="checkbox">
           <a href="<?php echo site_url('privacy-policy'); ?>" class="linkTermAndConditionsForm">I accept terms and conditions</a>
        </div>
        <button class="singleRequestInfoButton contactButton" type="submit">REQUEST TRADE IN</button>
      </form>
    </div>

    <!-- <div class="singleFormContainer" id="singleFinance">
      <form class="singleContact" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
        <input type="hidden" name="action" value="lt_form_handler">
        <input type="hidden" name="link" value="<?php echo home_url( $wp->request ); ?>">
        <p class="SingleContactCloseButton" onclick="altClassFromSelector('alt','#singleFinance')">+</p>
        <label  class="formLabelBig">finance this <?php the_title(); ?></label>
        <p class="singleFormTxt mainTxtType1">Please enter the information below to begin the financing process.</p>
        <input type="number" placeholder="INTEREST RATE"  class="formInput50 formInput" name="a01">
        <input type="text" placeholder="NAME"  class="formInput50 formInput" name="a02">
        <select class="formInput50 formInput" id="rkm-vdp-loan-term" class="form-control" name="a03">
          <option value="36">3 Years (36 Months)</option>
          <option value="48">4 Years (48 Months)</option>
          <option value="60">5 Years (60 Months)</option>
          <option value="72">6 Years (72 Months)</option>
          <option value="84">7 Years (84 Months)</option>
          <option value="96">8 Years (96 Months)</option>
          <option value="108">9 Years (108 Months)</option>
          <option selected="selected" value="120">10 Years (120 Months)</option>
          <option value="132">11 Years (132 Months)</option>
          <option value="144">12 Years (144 Months)</option>
        </select>
        <input name="a04" type="text"   placeholder="LAST NAME"      class="formInput50 formInput">
        <input name="a05" type="text"   placeholder="PURCHASE PRICE" class="formInput50 formInput">
        <input name="a06" type="number" placeholder="PHONE"          class="formInput50 formInput">
        <input name="a07" type="number" placeholder="DOWN PAYMENT"   class="formInput50 formInput">
        <input name="a08" type="email"  placeholder="EMAIL"          class="formInput50 formInput">
        <button class="singleRequestInfoButton contactButton formInput50" type="">CALCULATE RATE</button>
        <input name="a09" type="text"   placeholder="COUNTRY"        class="formInput50 formInput lastCountryInput">
        <input name="a10" type="number" placeholder="0.00"           class="formInput50 formInput colorfulInput">
        <select name="a11" value="time-preference"   class="formInput50 formInput" id="bestTimeToCall">
          <option value="any_time" class="form">Any Time</option>
          <option value="from-9-to-13">9:00 a.m. - 1:00 p.m.</option>
          <option value="from-13-to-17">1:00 p.m. - 5:00 p.m.</option>
          <option value="from-17-to-20">5:00 p.m. - 8:00 p.m.</option></select>
        </select>
        <textarea class="singleFormTxtArea" value="comments" placeholder="your comments" name="a12"></textarea>
        <div class="formTermsAndConditions">
           <input type="checkbox">
           <a href="#" class="linkTermAndConditionsForm">I accept terms and conditions</a>
        </div>
        <button class="singleRequestInfoButton contactButton" type="submit">SEND</button>
      </form>
    </div> -->

    <!-- <form class="" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
      <input type="hidden" name="action" value="lt_new_user">
      <input type="hidden" name="url" value="<?php echo home_url( $wp->request ); ?>">
      <input type="email" name="mail" value="" placeholder="user@example.com">
      <input type="text" name="pass" value="" placeholder="password">
      <button type="submit" name="button">Crear</button>
    </form> -->


<?php } wp_reset_query(); ?>
<?php get_footer(); ?>
