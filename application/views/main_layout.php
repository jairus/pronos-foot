<!DOCTYPE html>
<!-- This site was created in Webflow. http://www.webflow.com-->
<!-- Last Published: Tue May 10 2016 14:21:46 GMT+0000 (UTC) -->
<html data-wf-site="570cdf23fb4e011d1cf72234" data-wf-page="572c9bb1c23ef15860a555bc">
<?php $this->load->view("partial_layouts/header")?>
<body>
  <?php $this->load->view('partial_layouts/nav') ?>
  <div id="anchor1" class="anchor"></div>
  <div class="w-section header-section">
    <!-- header div -->
    <?php $this->load->view('partial_layouts/section_header') ?>
    <div class="w-container inscription-container">
      <h1 class="header-title2">Inscrivez-vous Maintenant !</h1>
      <!-- LOAD signin_form if not applicable to Login through Facebook -->
      <?php
        //$this->load->view('users/signin_form')
        if (!empty($signin)) {
          $this->load->view($signin);
        } else {
          $this->load->view('partial_layouts/fb_connect');
        }
      ?>
    </div>
  </div>
  <!-- Display PRICES - section  -->
  <?php $this->load->view('partial_layouts/prices') ?>
  <!-- Display RULES and Price & Points - section  -->
  <?php $this->load->view('partial_layouts/rules') ?>
  <div class="w-section grille-section calendar">
    <div id="anchor4" class="anchor number4"></div>
    <!-- LOAD CONTENT HERE-->
    <?php $this->load->view($yield) ?>
  </div>
  <!-- FOOTER SECTION -->
  <?php $this->load->view('partial_layouts/footer') ?>
</body>
</html>