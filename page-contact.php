<?php get_header(); ?>

<main class="contactMain">

  <div class="contactATF ATF">
    <img class="contactBanner lazy" data-url="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
  </div>

  <div class="contactBox">
    <form class="form contactForm" action="/action_page.php">
      <h3 class="formTitle">Contáctanos</h3>
      <label for="name">Nombre</label>
      <input type="text" name="text">
      <label for="email">Email</label>
      <input type="text" name="fname">
      <label for="email">Review</label>
      <textarea name="" id=""></textarea>
      <input class="btn btnWhite" type="submit" value="Submit">
    </form>
    <div class="contactInformation">
      <div class="contactInformationItem">
        <h4 class="contactInformationItemTitle">Dirección</h4>
        <p class="contactInformationItemTxt">Calle 1234</p>
        <p class="contactInformationItemTxt">Barrio tanto</p>
        <p class="contactInformationItemTxt">Cod Postal</p>
      </div>
      <div class="contactInformationItem">
        <h4 class="contactInformationItemTitle">Llámanos</h4>
        <p class="contactInformationItemTxt">123 45 67 89</p>
      </div>
      <div class="contactInformationItem">
        <h4 class="contactInformationItemTitle">Mail</h4>
        <p class="contactInformationItemTxt">mailejemplo@marialebredo.com</p>
      </div>
      <div class="contactInformationItem">
        <h4 class="contactInformationItemTitle">Horarios</h4>
        <p class="contactInformationItemTxt">Lun a Vier</p>
        <p class="contactInformationItemTxt" style="margin-bottom: .5rem">9:00 a 20:00</p>
        <p class="contactInformationItemTxt">Sábados</p>
        <p class="contactInformationItemTxt">9:00 a 13:00</p>
      </div>
    </div>
  </div>





</main>

<?php get_footer(); ?>
