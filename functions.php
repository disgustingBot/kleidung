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
	wp_register_script( 'main', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery') );
	wp_localize_script( 'main', 'lt_data', array(
		'home' => site_url(), // WordPress home
		'ajaxUrl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
		// 'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
		// 'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		// 'max_page' => $wp_query->max_num_pages,
		// 'first_page' => get_pagenum_link(1) // here it is
	) );
	wp_enqueue_script( 'main' );
	// wp_enqueue_script ( 'main', get_theme_file_uri('/js/custom.js'), array( 'jquery' ), microtime(), true);






  wp_enqueue_style('style', get_stylesheet_uri(), NULL, microtime(), 'all');
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

function lt_pagination($max){
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







































































// REMOVES WORDPRESS URL PAGINATION
remove_action('template_redirect', 'redirect_canonical');
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
	if ($current_page != 1)
		$pagination.= '<a class="paginationLink prev" data-pagination="prev">prev</a>';


	// loop page links in the middle between "..." and "..."
	for($i = $first_link_in_the_middle; $i <= $last_link_in_the_middle; $i++) {
		if($i == $current_page) {
			$pagination.= '<span class="paginationCurrent">'.$i.'</span>';
		} else {
			$pagination .= '<a class="paginationLink" data-pagination="'.$i.'">'.$i.'</a>';
		}
	}

	// arrow right (next page)
	if ($current_page != $last_link_in_the_middle )
		$pagination.= '<a class="paginationLink next" data-pagination="next">next</a>';


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
add_action( 'wp_ajax_latte_pagination', 'latte_pagination' );
// We allow non-logged in users to access our pagination
add_action( 'wp_ajax_nopriv_latte_pagination', 'latte_pagination' );
function latte_pagination() {
	//gets the global query var object
	global $wp_query;

  if(isset($_POST['page'])){
		$args = json_decode( stripslashes( $_POST['query'] ), true );
		// var_dump($args['term']);
		unset($args->term);
		$args['term'] = null;
		// foreach ($args as $key => $value) {
		// 	// code...
		// 	echo $key;
		// }
		// echo 'tax_query solicitada';
		// echo '<br><br>';
		// var_dump($args['tax_query']);
		$oldArgs = $args;

		// Sanitize the received page
		if($_POST['type']=='story'){$story=true;}else{$story=false;}
		$page = sanitize_text_field($_POST['page']);
		$args['paged'] = $page;
		$args['post_status'] = 'publish';


		query_posts( $args );


		if( have_posts() ) :

			// run the loop
			while( have_posts() ): the_post();
			if(get_post_type()=='product'){
				$_pf = new WC_Product_Factory();
				$_product = $_pf->get_product(get_the_ID());
			}

			?>
				<figure class="card" id="card<?php echo get_the_id();?>">
					<a class="cardImg" href="<?php echo get_permalink(); ?>">
						<img class="cardImg" src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="">
					</a>
				<?php if ($story) { ?>
		        <p class="cardStorieDate">
		          <?php echo get_the_date( 'j' ); ?>
		          <br>
		          <?php echo get_the_date( 'M' ); ?>
		        </p>
		        <figcaption class="cardCaption">
		          <h3 class="cardTitle">
		            <?php the_title(); ?>
		          </h3>
		          <p class="cardDescription">
		            <?php echo excerpt(100); ?>
		          </p>
		          <a class="btn" href="<?php the_permalink(); ?>">
		            <span class="readMore">Read More
		            <svg width="40" height="16" viewBox="0 0 20 8" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
		              <path d="M15 4.95825H0V3.04175H15C13.9217 2.11072 13.5163 1.39965 12.9269 0C15.8187 2.44648 17.3769 3.46462 19.9269 4C17.3769 4.53538 15.8187 5.55352 12.9269 8C13.5163 6.60035 13.9217 5.88928 15 4.95825Z" fill="currentColor"/>
		            </svg>
		            </span>
		          </a>
				<?php } else { ?>
						<figcaption class="cardCaption">
							<p class="cardTitle"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></p>
							<?php if (get_post_type()=='product'){ ?>
								<p class="productCardPrice"><a href="<?php echo get_permalink(); ?>"> <?php echo $_product->get_price_html(); ?> </a></p>
							<?php } ?>
				<?php } ?>
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

add_action( 'wp_ajax_nopriv_lt_slider', 'lt_slider' );
add_action( 'wp_ajax_lt_slider', 'lt_slider' );
function lt_slider(){
	// echo 'hoa el mundo de los pibes';
	$page = sanitize_text_field($_POST['page']);



	  $args = array(
	    'post_type'=>'product',
	    'posts_per_page'=>4,
	  );
		$args['paged'] = $page;
	  $blogPosts=new WP_Query($args);
		if ($page > $blogPosts->max_num_pages) {
			echo 'no_more';
			exit();
		}
		?>

	  <?php while($blogPosts->have_posts()){$blogPosts->the_post(); ?>
	    <?php global $product; ?>

	    <figure class="card"  id="card<?php echo get_the_id();?>">
	      <a class="cardImg" href="<?php echo get_permalink(); ?>">
	        <img class="cardImg" src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="">
	      </a>
	      <figcaption class="cardCaption">
	        <p class="cardTitle"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></p>
	        <p class="productCardPrice"><a href="<?php echo get_permalink(); ?>"> <?php echo $product->get_price_html(); ?> </a></p>
	      </figcaption>
	    </figure>

	  <?php }



	exit();
}

























add_action( 'wp_ajax_nopriv_woocommerce_add_variation_to_cart', 'so_27270880_add_variation_to_cart' );
add_action( 'wp_ajax_woocommerce_add_variation_to_cart', 'so_27270880_add_variation_to_cart' );

function so_27270880_add_variation_to_cart() {
	// echo WC()->cart->get_cart_contents_count();

    // ob_start();

    $product_id        = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );
		// echo $product_id;
    $quantity          = empty( $_POST['quantity'] ) ? 1 : wc_stock_amount( $_POST['quantity'] );

    $variation_id      = isset( $_POST['variation_id'] ) ? absint( $_POST['variation_id'] ) : '';
    $variations        =  ! empty( $_POST['variation'] ) ? (array) $_POST['variation'] : '';

    $passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity, $variation_id, $variations, $cart_item_data );
		// echo WC()->cart->get_cart_contents_count();

    if ( $passed_validation && WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variations ) ) {

        do_action( 'woocommerce_ajax_added_to_cart', $product_id );

        if ( get_option( 'woocommerce_cart_redirect_after_add' ) == 'yes' ) {
            wc_add_to_cart_message( $product_id );
        }

        // Return fragments
        // WC_AJAX::get_refreshed_fragments();
				// echo WC()->cart->get_cart_contents_count();

    } else {

        // If there was an error adding to the cart, redirect to the product page to show any errors
        // $data = array(
        //     'error' => true,
        //     'product_url' => apply_filters( 'woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id )
        // );
				//
        // wp_send_json( $data );

    }
		echo WC()->cart->get_cart_contents_count();

    // die();
}

















function misha_added_to_cart_ajax_handler(){
	echo WC()->cart->get_cart_contents_count();
}
add_action('wp_ajax_added_to_cart', 'misha_added_to_cart_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_added_to_cart', 'misha_added_to_cart_ajax_handler'); // wp_ajax_nopriv_{action}






























add_action('pre_get_posts','alter_query');

function alter_query($query) {
	//gets the global query var object
	global $wp_query;
	$max_page = $query->max_num_pages;
	// var_dump($max_page);

	//gets the front page id set in options
	$front_page_id = get_option('page_on_front');

	if ( !$query->is_main_query() )
		return;

		// $args['paged'] = $page;
		// if (isset($_GET['page']) AND $_GET['page'] <= $max_page ) {
		if (isset($_GET['page'])) {
		$query-> set('paged' , $_GET['page']);
	} else {
		$query-> set('paged' , 1);
	}

	if (isset($_GET['tipo'])) {
		$query->query_vars['tax_query']['tipo'] = array(
			'taxonomy' => 'product_cat',
			'field'    => 'slug',
			'terms'    => $_GET['tipo'],
		);
	}

	if (isset($_GET['motivo'])) {
		$query->query_vars['tax_query']['motivo'] = array(
			'taxonomy' => 'product_cat',
			'field'    => 'slug',
			'terms'    => $_GET['motivo'],
		);
	}
	// $query-> set('post__in' ,$front_page_id-);
	// $query-> set('post__in' ,array( $front_page_id , [YOUR SECOND PAGE ID]  ));
	// $query-> set('orderby' ,'post__in');
	// $query-> set('p' , null);
	// $query-> set( 'page_id' ,null);

	//we remove the actions hooked on the '__after_loop' (post navigation)
	remove_all_actions ( '__after_loop');
}












add_action(        'admin_post_lt_form_handler', 'lt_form_handler');
add_action( 'admin_post_nopriv_lt_form_handler', 'lt_form_handler');
function lt_form_handler() {

	if($_POST['a00'] != ""){
		$link=$_POST['link'];

		$link = add_query_arg( array(
			'email' => 'nope',
			// 'mensaje' => $message,
			// 'status' => $status,
			// 'resultado' => username_exists( $mail ),
		), $link );
	  // header( "Location: https://www.idemomotors.com/?mail=nope" . $_POST['a9'] );
	  // exit;
	} else {
		// $mail=$_POST['mail'];
		$mail='molinerozadkiel@gmail.com';

		$subject='Form from '.$link;
		$message='';

		if(isset($_POST['a01'])){$a01=$_POST['a01'];$message=$message.'<strong>Data 01:</strong> '.$a01.' - </br>';}
		if(isset($_POST['a02'])){$a02=$_POST['a02'];$message=$message.'<strong>Data 02:</strong> '.$a02.' - </br>';}
		if(isset($_POST['a03'])){$a03=$_POST['a03'];$message=$message.'<strong>Data 03:</strong> '.$a03.' - </br>';}
		if(isset($_POST['a04'])){$a04=$_POST['a04'];$message=$message.'<strong>Data 04:</strong> '.$a04.' - </br>';}
		if(isset($_POST['a05'])){$a05=$_POST['a05'];$message=$message.'<strong>Data 05:</strong> '.$a05.' - </br>';}
		if(isset($_POST['a06'])){$a06=$_POST['a06'];$message=$message.'<strong>Data 06:</strong> '.$a06.' - </br>';}
		if(isset($_POST['a07'])){$a07=$_POST['a07'];$message=$message.'<strong>Data 07:</strong> '.$a07.' - </br>';}
		if(isset($_POST['a08'])){$a08=$_POST['a08'];$message=$message.'<strong>Data 08:</strong> '.$a08.' - </br>';}
		if(isset($_POST['a09'])){$a09=$_POST['a09'];$message=$message.'<strong>Data 09:</strong> '.$a09.' - </br>';}
		if(isset($_POST['a10'])){$a10=$_POST['a10'];$message=$message.'<strong>Data 10:</strong> '.$a10.' - </br>';}
		if(isset($_POST['a11'])){$a11=$_POST['a11'];$message=$message.'<strong>Data 11:</strong> '.$a11.' - </br>';}
		if(isset($_POST['a12'])){$a12=$_POST['a12'];$message=$message.'<strong>Data 12:</strong> '.$a12.' - </br>';}
		if(isset($_POST['a13'])){$a13=$_POST['a13'];$message=$message.'<strong>Data 13:</strong> '.$a13.' - </br>';}
		if(isset($_POST['a14'])){$a14=$_POST['a14'];$message=$message.'<strong>Data 14:</strong> '.$a14.' - </br>';}
		if(isset($_POST['a15'])){$a15=$_POST['a15'];$message=$message.'<strong>Data 15:</strong> '.$a15.' - </br>';}
		if(isset($_POST['a16'])){$a16=$_POST['a16'];$message=$message.'<strong>Data 16:</strong> '.$a16.' - </br>';}
		if(isset($_POST['a17'])){$a17=$_POST['a17'];$message=$message.'<strong>Data 17:</strong> '.$a17.' - </br>';}
		if(isset($_POST['a18'])){$a18=$_POST['a18'];$message=$message.'<strong>Data 18:</strong> '.$a18.' - </br>';}
		if(isset($_POST['a19'])){$a19=$_POST['a19'];$message=$message.'<strong>Data 19:</strong> '.$a19.' - </br>';}
		if(isset($_POST['a20'])){$a20=$_POST['a20'];$message=$message.'<strong>Data 20:</strong> '.$a20.' - </br>';}


	 // echo $message;


	 // $cosa = var_dump(wp_mail( $mail , $subject , $message ));
	 if (wp_mail( $mail , $subject , $message )) {
		 // code...
				$link = add_query_arg( array(
					'email' => 'sent',
					// 'mensaje' => $message,
					// 'resultado' => username_exists( $mail ),
				), $link );
	 } else {

				$link = add_query_arg( array(
					'email' => 'error',
					// 'mensaje' => $message,
					// 'status' => $status,
					// 'resultado' => username_exists( $mail ),
				), $link );
	 }
		// wp_mail( $mail , $subject , $message );


		// $a2 = $_POST['a2'];
		// $a3 = $_POST['a3'];
		// $a4 = $_POST['a4'];
		// $a5 = $_POST['a5'];
		// $a6 = $_POST['a6'];

		// $link = add_query_arg( array(
		//   'email' => 'sent',
		//   // 'status' => $status,
		//   // 'resultado' => username_exists( $mail ),
		// ), $link );



	}
	wp_redirect($link);
}
