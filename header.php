<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">


<link href="https://fonts.googleapis.com/css?family=Roboto:100&display=swap" rel="stylesheet">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

	<view id="load" class="load">
			<div class="circle"></div>
	</view>

  <header class="header" id="header">


    <!-- NAVIGATION BAR -->
  	<?php
    	$args = array(
    	  'theme_location' => 'header',
    	  'depth' => 0,
    	  'container'	=> false,
    	  'fallback_cb' => false,
    	  'menu_class' => 'navBar',
    	);
    	wp_nav_menu($args);
  	?>

    <h2 class="brand"><a href="<?php echo site_url('');  ?>"><?php echo get_bloginfo( 'name' ); ?></a></h2>

    <p class="headerSocial">social media</p>
  </header>
