<?php

require_once 'customPosts.php';

function lattte_setup(){

  // TOOOODO ESTO ES PARA AJAX
	global $wp_query;
	// In most cases it is already included on the page and this line can be removed
	wp_enqueue_script('jquery');
	// register our main script but do not enqueue it yet
	wp_register_script( 'my_loadmore', get_stylesheet_directory_uri() . '/js/myloadmore.js', array('jquery') );

	// now the most interesting part
	// we have to pass parameters to myloadmore.js script but we can get the parameters values only in PHP
	// you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script()
	wp_localize_script( 'my_loadmore', 'misha_loadmore_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
		'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages,
		'first_page' => get_pagenum_link(1) // here it is
	) );

 	wp_enqueue_script( 'my_loadmore' );
  // FIN DE PARA AJAX





	// OTRO AJAX
  // wp_enqueue_script( 'so_test', plugins_url( 'js/mycartButton.js', __FILE__ ) );
  // $i18n = array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'checkout_url' => get_permalink( wc_get_page_id( 'checkout' ) ) );
  // wp_localize_script( 'so_test', 'SO_TEST_AJAX', $i18n );
	// OTRO AJAX







  wp_enqueue_style('style', get_stylesheet_uri(), NULL, microtime(), 'all');
	wp_enqueue_script('main', get_theme_file_uri('/js/custom.js'), array( 'jquery' ), microtime(), true);
  wp_enqueue_script('main', get_theme_file_uri('/js/mycartButton.js'), array( 'jquery' ), microtime(), true);
  // wp_enqueue_script('custom-script', get_stylesheet_directory_uri() . '/js/custom_script.js', array( 'jquery' ));


}
add_action('wp_enqueue_scripts', 'lattte_setup');

// Adding Theme Support

function gp_init() {
  // add_theme_support('post-thumbnails');
  add_theme_support('title-tag');
  add_theme_support('html5',
    array('comment-list', 'comment-form', 'search-form')
  );
  add_theme_support( 'woocommerce' );
  add_theme_support( 'wc-product-gallery-zoom' );
  add_theme_support( 'wc-product-gallery-lightbox' );
  add_theme_support( 'wc-product-gallery-slider' );
  add_theme_support( 'post-thumbnails' );
}
add_action('after_setup_theme', 'gp_init');








// this removes the "Archive" word from the archive title in the archive page
add_filter('get_the_archive_title',function($title){
  if(is_category()){$title=single_cat_title('',false);
  }elseif(is_tag()){$title=single_tag_title('',false);
  }elseif(is_author()){$title='<span class="vcard">'.get_the_author().'</span>';
  }return $title;
});






function excerpt($charNumber){
  if(!$charNumber){$charNumber=1000000;}
  $excerpt = get_the_excerpt();
  if(strlen($excerpt)<=$charNumber){return $excerpt;}else{
    $excerpt = substr($excerpt, 0, $charNumber);
    $result  = substr($excerpt, 0, strrpos($excerpt, ' '));
    // $result .= $result . '(...)';
    // return var_dump($excerpt);
    return $result;
  }
}









 function register_menus() {
   register_nav_menu('header',__( 'Header' ));
   register_nav_menu('footerNav',__( 'Footer' ));
   register_nav_menu('navBarMobile',__( 'Mobile Header Menu' ));
   // add_post_type_support( 'page', 'excerpt' );
 }
 add_action( 'init', 'register_menus' );







// FUCTION FOR USER GENERATION
// https://tommcfarlin.com/create-a-user-in-wordpress/
add_action( 'admin_post_nopriv_lt_login', 'lt_login');
add_action(        'admin_post_lt_login', 'lt_login');
function lt_login(){
  $link=$_POST['link'];
  $name=$_POST['name'];
  $fono=$_POST['fono'];
  $mail=$_POST['mail'];
  $pass=$_POST['pass'];


  if( null == username_exists( $mail ) ) {

    // Generate the password and create the user for security
    // $password = wp_generate_password( 12, false );
    // $user_id = wp_create_user( $mail, $password, $mail );

    // user generated pass for local testing
    $user_id = wp_create_user( $mail, $pass, $mail );
    // Set the nickname and display_name
    wp_update_user(
      array(
        'ID'              =>    $user_id,
        'display_name'    =>    $name,
        'nickname'        =>    $name,
      )
    );
    update_user_meta( $user_id, 'phone', $fono );


    // Set the role
    $user = new WP_User( $user_id );
    $user->set_role( 'subscriber' );

    // Email the user
    wp_mail( $mail, 'Welcome '.$name.'!', 'Your Password: ' . $pass );
  // end if
  $action='register';
  $creds = array(
      'user_login'    => $mail,
      'user_password' => $pass,
      'remember'      => true
  );

  $status = wp_signon( $creds, false );
} else {

  $creds = array(
      'user_login'    => $mail,
      'user_password' => $pass,
      'remember'      => true
  );

  $status = wp_signon( $creds, false );

  // $status=wp_login($mail, $pass);

  $action='login';
}

  $link = add_query_arg( array(
    'action' => $action,
    // 'status' => $status,
    // 'resultado' => username_exists( $mail ),
  ), $link );
  wp_redirect($link);
}
















add_action( 'admin_post_nopriv_lt_new_pass', 'lt_new_pass');
add_action(        'admin_post_lt_new_pass', 'lt_new_pass');
function lt_new_pass(){
  $link=$_POST['link'];
  $oldp=$_POST['oldp'];
  $newp=$_POST['newp'];
  $cnfp=$_POST['cnfp'];



  // if(isset($_POST['current_password'])){
  if(isset($_POST['oldp'])){
    $_POST = array_map('stripslashes_deep', $_POST);
    $current_password = sanitize_text_field($_POST['oldp']);
    $new_password = sanitize_text_field($_POST['newp']);
    $confirm_new_password = sanitize_text_field($_POST['cnfp']);
    $user_id = get_current_user_id();
    $errors = array();
    $current_user = get_user_by('id', $user_id);
  }

  $link = add_query_arg( array(
    'action' => $action,
  ), $link );
  // Check for errors
  if($current_user && wp_check_password($current_password, $current_user->data->user_pass, $current_user->ID)){
  //match
  } else {
    $errors[] = 'Password is incorrect';

    $link = add_query_arg( array(
      'pass'  => 'incorrect',
    ), $link );
  }
  if($new_password != $confirm_new_password){
    $errors[] = 'Password does not match';

    $link = add_query_arg( array(
      'match'  => 'no',
    ), $link );
  }
  if(empty($errors)){
      wp_set_password( $new_password, $current_user->ID );
      $link = add_query_arg( array(
        'success'  => true,
      ), $link );
  }
  wp_redirect($link);
}



















/**
 * Change number of products that are displayed per page (shop page)
 */
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

function new_loop_shop_per_page( $cols ) {
  // $cols contains the current number of products per page based on the value stored on Options -> Reading
  // Return the number of products you wanna show per page.
  $cols = 4;
  return $cols;
}

function latte_pagination($max){
  // This part gets the current pagination
  if(get_query_var('paged')){$paged=get_query_var('paged');}elseif(get_query_var('page')){$paged=get_query_var('page');}else{$paged=1;}
  // $result.='<div class="paginationCont"><h5 class="paginationTitle">';
  // $result.=  'Page '.$paged.' of '.$max;
  // $result.='</h5>';
  $result.='<div class="pagination">';
  $next=$paged + 1;
  $prev=$paged - 1;

	// $url = add_query_arg( $wp->query_vars, home_url( $wp->request ) );
	var_dump($wp->query_vars);
	$result.= add_query_arg( $wp->query_vars, home_url( $wp->request ) );
	var_dump($wp->request);

  if($prev>=1){$result.='<a class="paginationLink" href="'.$url.'/'.$prev.'">Prev</a>';}
  else{$result.='<p class="paginationLink">Prev</p>';}

  for ( $i=1; $i <= $max; $i++ ) {
    if ( $i - $paged <= 2 ) {
      if ( $i != $paged ) {
        $result.='<a class="paginationLink" href="'.$url.'/'.$i.'">'.$i.'</a>';
      } else {
        $result.='<p class="paginationLink current">'.$i.'</p>';
      }
    }
  }

  if($next<=$max){$result.='<a class="paginationLink" href="'.$url.'/'.$next.'">Next</a>';}
  else{$result.='<p class="paginationLink">Next</p>';}

  $result.='</div>';
  // $result.='</div>';
  return $result;
}









































































// PAGINATION
// bloque inspirado en el comienzo de este post:
// https://rudrastyh.com/wordpress/load-more-and-pagination.html
function misha_paginator( $first_page_url ){

	// the function works only with $wp_query that's why we must use query_posts() instead of WP_Query()
	global $wp_query;

	// remove the trailing slash if necessary
	$first_page_url = untrailingslashit( $first_page_url );


	// it is time to separate our URL from search query
	$first_page_url_exploded = array(); // set it to empty array
	$first_page_url_exploded = explode("/?", $first_page_url);
	// by default a search query is empty
	$search_query = '';
	// if the second array element exists
	if( isset( $first_page_url_exploded[1] ) ) {
		$search_query = "/?" . $first_page_url_exploded[1];
		$first_page_url = $first_page_url_exploded[0];
	}

	// get parameters from $wp_query object
	// how much posts to display per page (DO NOT SET CUSTOM VALUE HERE!!!)
	$posts_per_page = (int) $wp_query->query_vars['posts_per_page'];
	// current page
	$current_page = (int) $wp_query->query_vars['paged'];
	// the overall amount of pages
	$max_page = $wp_query->max_num_pages;

	// we don't have to display pagination or load more button in this case
	if( $max_page <= 1 ) return;

	// set the current page to 1 if not exists
	if( empty( $current_page ) || $current_page == 0) $current_page = 1;

	// you can play with this parameter - how much links to display in pagination
	$links_in_the_middle = 4;
	$links_in_the_middle_minus_1 = $links_in_the_middle-1;

	// the code below is required to display the pagination properly for large amount of pages
	// I mean 1 ... 10, 12, 13 .. 100
	// $first_link_in_the_middle is 10
	// $last_link_in_the_middle is 13
	$first_link_in_the_middle = $current_page - floor( $links_in_the_middle_minus_1/2 );
	$last_link_in_the_middle = $current_page + ceil( $links_in_the_middle_minus_1/2 );

	// some calculations with $first_link_in_the_middle and $last_link_in_the_middle
	if( $first_link_in_the_middle <= 0 ) $first_link_in_the_middle = 1;
	if( ( $last_link_in_the_middle - $first_link_in_the_middle ) != $links_in_the_middle_minus_1 ) { $last_link_in_the_middle = $first_link_in_the_middle + $links_in_the_middle_minus_1; }
	if( $last_link_in_the_middle > $max_page ) { $first_link_in_the_middle = $max_page - $links_in_the_middle_minus_1; $last_link_in_the_middle = (int) $max_page; }
	if( $first_link_in_the_middle <= 0 ) $first_link_in_the_middle = 1;

	// begin to generate HTML of the pagination
	$pagination = '<nav class="pagination" role="navigation">';

	// when to display "..." and the first page before it
	if ($first_link_in_the_middle >= 3 && $links_in_the_middle < $max_page) {
		$pagination.= '<a class="paginationLink" data-pagination="1">1</a>';

		if( $first_link_in_the_middle != 2 )
			$pagination .= '<span class="page-numbers extend">...</span>';

	}

	// arrow left (previous page)
	// if ($current_page != 1)
		// $pagination.= '<a class="paginationLink prev" data-pagination="-1">prev</a>';


	// loop page links in the middle between "..." and "..."
	for($i = $first_link_in_the_middle; $i <= $last_link_in_the_middle; $i++) {
		if($i == $current_page) {
			$pagination.= '<span class="paginationCurrent">'.$i.'</span>';
		} else {
			$pagination .= '<a class="paginationLink" data-pagination="'.$i.'">'.$i.'</a>';
		}
	}

	// arrow right (next page)
	// if ($current_page != $last_link_in_the_middle )
		// $pagination.= '<a class="paginationLink next" data-pagination="+1">next</a>';


	// when to display "..." and the last page after it
	if ( $last_link_in_the_middle < $max_page ) {

		if( $last_link_in_the_middle != ($max_page-1) )
			$pagination .= '<span class="page-numbers extend">...</span>';

		$pagination .= '<a class="paginationLink" data-pagination="'. $max_page .'">'. $max_page .'</a>';
	}

	// end HTML
	// $pagination.= "</div></nav>\n";
	$pagination.= "</nav>\n";

	// haha, this is our load more posts link
	// if( $current_page < $max_page )
		// $pagination.= '<div id="misha_loadmore">More posts</div>';

	// replace first page before printing it
	echo str_replace(array("/page/1?", "/page/1\""), array("?", "\""), $pagination);
}





















































// Receive the Request post that came from AJAX
add_action( 'wp_ajax_latte_pagination', 'cvf_demo_pagination_load_posts' );
// We allow non-logged in users to access our pagination
add_action( 'wp_ajax_nopriv_latte_pagination', 'cvf_demo_pagination_load_posts' );
function cvf_demo_pagination_load_posts() {

  if(isset($_POST['page'])){
		$args = json_decode( stripslashes( $_POST['query'] ), true );
		// Sanitize the received page
		$page = sanitize_text_field($_POST['page']);
		// echo $page;
		if ($page==='+1') {
			// we need next page to be loaded
			$args['paged'] = $_POST['page'] + 1;
		} elseif ($page==='-1') {
			// we need prev page to be loaded
			$args['paged'] = $_POST['page'] - 1;
		} else {
			// we need a specific page to be loaded
			$args['paged'] = $page;
		}
		$args['post_status'] = 'publish';



		// TODO: conectar filtro con paginacion.
		// TIP: checkar el bloque siguiente:
		if (isset($_POST['parent'])) {
			$parentArray = $_POST['parent'];
			$categoryArray = $_POST['category'];
		  foreach ($parentArray as $key => $value) {
				$args['tax_query'][$key] = array(
					'taxonomy' => 'product_cat',
					'field'    => 'slug',
					'terms'    => $categoryArray[$key],
				);
		  }
		}
		// $all_blog_posts=new WP_Query($args);

		query_posts( $args );


		if( have_posts() ) :

			// run the loop
			while( have_posts() ): the_post();
	      ?>
	        <figure class="card">
	          <a class="cardImg" href="<?php echo get_permalink(); ?>">
	            <img class="cardImg" src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="">
	            <!-- <img class="cardImg lazy" data-url="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt=""> -->
	          </a>
	          <figcaption class="cardCaption">
	            <p class="cardTitle"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></p>
	          </figcaption>
	        </figure>
	      <?php

			endwhile;

		endif;

		// var_dump(misha_paginator(5));
		// echo latte_pagination(5);
		echo misha_paginator(get_pagenum_link());

  }
  // Always exit to avoid further execution
  exit();
}


















































































function misha_loadmore_ajax_handler(){

	// prepare our arguments for the query
	$args = json_decode( stripslashes( $_POST['query'] ), true );
	// $args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
	$args['post_status'] = 'publish';

	if (isset($_POST['parent'])) {
		$parentArray = $_POST['parent'];
		$categoryArray = $_POST['category'];
	  foreach ($parentArray as $key => $value) {
			$args['tax_query'][$key] = array(
				'taxonomy' => 'product_cat',
				'field'    => 'slug',
				'terms'    => $categoryArray[$key],
			);
	  }
	}
  $el_query=new WP_Query($args);

	// it is always better to use WP_Query but not here
	// why not?
	query_posts( $args );

	if( $el_query->have_posts() ) :

		// run the loop
		while( $el_query->have_posts() ): $el_query->the_post();

			// look into your theme code how the posts are inserted, but you can use your own HTML of course
			// do you remember? - my example is adapted for Twenty Seventeen theme
			// get_template_part( 'template-parts/post/content', get_post_format() );
			// for the test purposes comment the line above and uncomment the below one
			// the_title();
      // echo '<br>';
      ?>

        <figure class="card">
          <a class="cardImg" href="<?php echo get_permalink(); ?>">
            <img class="cardImg" src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="">
            <!-- <img class="cardImg lazy" data-url="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt=""> -->
          </a>
          <figcaption class="cardCaption">
            <p class="cardTitle"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></p>
          </figcaption>
        </figure>
      <?php


		endwhile;

	endif;
	die; // here we exit the script and even no wp_reset_query() required!
}



add_action('wp_ajax_loadmore', 'misha_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'misha_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}




function misha_added_to_cart_ajax_handler(){
	echo WC()->cart->get_cart_contents_count();
}
add_action('wp_ajax_added_to_cart', 'misha_added_to_cart_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_added_to_cart', 'misha_added_to_cart_ajax_handler'); // wp_ajax_nopriv_{action}











add_action( 'woocommerce_after_shop_loop_item', 'my_custom_quantity_field', 6 );

function my_custom_quantity_field() {
  global $product;

  if ( ! $product->is_sold_individually() )
    woocommerce_quantity_input( array(
      'min_value' => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
      'max_value' => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product )
    ) );
}




























// add_action('wp_ajax_myajax', 'myajax_callback');
// add_action('wp_ajax_nopriv_myajax', 'myajax_callback');
//
//     /**
//      * AJAX add to cart.
//      */
// function myajax_callback() {
//         ob_start();
//
//         //$product_id        = 264;
//         $product_id        = 34;
//         $quantity          = 1;
//         $passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );
//         $product_status    = get_post_status( $product_id );
//
//         if ( $passed_validation && WC()->cart->add_to_cart( $product_id, $quantity ) && 'publish' === $product_status ) {
//
//             do_action( 'woocommerce_ajax_added_to_cart', $product_id );
//
//             wc_add_to_cart_message( $product_id );
//
//         } else {
//
//             // If there was an error adding to the cart, redirect to the product page to show any errors
//             $data = array(
//                 'error'       => true,
//                 'product_url' => apply_filters( 'woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id )
//             );
//
//             wp_send_json( $data );
//
//         }
//
//         die();
//
// }
