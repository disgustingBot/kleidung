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
        <i><p class="contactInformationItemTxt">Calle 1234</p></i>
        <i><p class="contactInformationItemTxt">Barrio tanto</p></i>
        <i><p class="contactInformationItemTxt">Cod Postal</p></i>
      </div>
      <div class="contactInformationItem">
        <h4 class="contactInformationItemTitle">Llámanos</h4>
        <i><p class="contactInformationItemTxt">123 45 67 89</p></i>
      </div>
      <div class="contactInformationItem">
        <h4 class="contactInformationItemTitle">Mail</h4>
        <i><p class="contactInformationItemTxt">mailejemplo@marialebredo.com</p></i>
      </div>
      <div class="contactInformationItem">
        <h4 class="contactInformationItemTitle">Horarios</h4>
        <i><p class="contactInformationItemTxt">Lun a Vier</p></i>
        <i><p class="contactInformationItemTxt" style="margin-bottom: .5rem">9:00 a 20:00</p></i>
        <i><p class="contactInformationItemTxt">Sábados</p></i>
        <i><p class="contactInformationItemTxt">9:00 a 13:00</p></i>
      </div>
    </div>
  </div>

  <div class="contactSocialBox">
    <h3 class="contactSocialBoxTitle"><i>Follow us</i></h3>
    <?php include 'socialMedia.php' ?>
  </div>





</main>

<?php get_footer(); ?>
