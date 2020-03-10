

  <footer class="footer" id="footer">
    <!-- <h2>Maria Lebredo</h2> -->
    <h2 class="footerBrand"><?php echo get_bloginfo( 'name' ); ?></h2>

    <!-- NAVIGATION BAR -->
  	<?php
    	$args = array(
    	  'theme_location' => 'footerNav',
    	  'depth' => 0,
    	  'container'	=> false,
    	  'fallback_cb' => false,
    	  'menu_class' => 'footerNav',
    	);
    	wp_nav_menu($args);
  	?>

    <form class="suscribe" action="">
      <p class="suscribeTitle">Suscríbete a nuestro newsletter</p>
      <input class="suscribeInput" type="email" placeholder="E-MAIL">
      <button class="btn suscribeButton"></button>
    </form>


    <p class="headerSocial">social media</p>

    <signature class="signature"><p>&#60;&#47;&#62; with ❤ by <a href="https://lattedev.com/" target="_blank" class="latteLink">Latte</a></p></signature>
  </footer>
  <?php wp_footer(); ?>
</body>
</html>
