<?php get_header(); ?>

<main class="contactMain">

  <div class="contactATF ATF">
    <img class="contactBanner lazy" data-url="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
  </div>

  <div class="contactBox">
    <form class="form contactForm dp-6" action="/action_page.php">
      <h3 class="formTitle">Contáctanos</h3>
      <label for="name">Nombre</label>
      <input type="text" name="text">
      <label for="email">Email</label>
      <input type="text" name="fname">
      <label for="email">Review</label>
      <textarea name="" id=""></textarea>
      <input class="btn" type="submit" value="Submit">
    </form>
    <div class="contactInformation">

    </div>
  </div>





</main>

<?php get_footer(); ?>
