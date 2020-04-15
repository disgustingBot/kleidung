<?php get_header(); ?>

<main class="contactMain">

  <div class="contactATF ATF">
    <img class="contactBanner lazy" data-url="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
  </div>

  <div class="contactBox">
    <form class="form contactForm" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="POST">
      <input type="hidden" name="action" value="lt_form_handler">
      <input type="hidden" name="link" value="<?php echo home_url( $wp->request ); ?>">
      <input type="text" name="a00" value="" placeholder="jeje" hidden>
      <h3 class="formTitle">Contáctanos</h3>
      <label for="name">Nombre</label>
      <input type="text" id="name" name="a01">
      <label for="email">Email</label>
      <input type="text" id="email" name="mail">
      <label for="review">Review</label>
      <textarea id="review" name="a03"></textarea>
      <input class="btn btnWhite" type="submit" name="a04" value="Submit">
    </form>
    <div class="contactInformation">
      <!-- <div class="contactInformationItem">
        <h4 class="contactInformationItemTitle">Dirección</h4>
        <i><p class="contactInformationItemTxt"><?php echo get_post_meta( get_the_id(), 'calleNumero' )[0]; ?></p></i>
        <i><p class="contactInformationItemTxt"><?php echo get_post_meta( get_the_id(), 'barrio' )[0]; ?></p></i>
        <i><p class="contactInformationItemTxt"><?php echo get_post_meta( get_the_id(), 'codPostal' )[0]; ?></p></i>
      </div>
      <div class="contactInformationItem">
        <h4 class="contactInformationItemTitle">Llámanos</h4>
        <i><p class="contactInformationItemTxt"><?php echo get_post_meta( get_the_id(), 'telefono' )[0]; ?></p></i>
      </div> -->
      <div class="contactInformationItem">
        <h4 class="contactInformationItemTitle">SUPPORT</h4>
        <i><p class="contactInformationItemTxt"><?php echo get_post_meta( get_the_id(), 'mail' )[0]; ?></p></i>
      </div>
      <div class="contactInformationItem">
        <h4 class="contactInformationItemTitle">Horarios</h4>
        <i><p class="contactInformationItemTxt">Lun a Vier</p></i>
        <i><p class="contactInformationItemTxt" style="margin-bottom: .5rem"><?php echo get_post_meta( get_the_id(), 'horarioLunesaViernes' )[0]; ?></p></i>
        <i><p class="contactInformationItemTxt">Sábados</p></i>
        <i><p class="contactInformationItemTxt"><?php echo get_post_meta( get_the_id(), 'horarioSabados' )[0]; ?></p></i>
      </div>
    </div>
  </div>

  <div class="contactSocialBox">
    <a href="https://www.instagram.com/marialebredo/" target="blank" class="contactSocialBoxTitle">INSTAGRAM</a>
  </div>





</main>

<?php get_footer(); ?>
