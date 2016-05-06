<!DOCTYPE html>
<!-- This site was created in Webflow. http://www.webflow.com-->
<!-- Last Published: Tue May 03 2016 14:20:28 GMT+0000 (UTC) -->
<html data-wf-site="570cdf23fb4e011d1cf72234" data-wf-page="570cdf23fb4e011d1cf72238">
<?php $this->load->view('header') ?>

<body>
  <div class="w-section w-clearfix nav-section">
    <div class="w-clearfix sharing-and-register">
      <div class="w-widget w-widget-facebook facebook-sharing">
        <iframe src="https://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.pronos-foot.com&amp;layout=button_count&amp;locale=en_US&amp;action=like&amp;show_faces=false&amp;share=false" scrolling="no" frameborder="0" allowtransparency="true" style="border: none; overflow: hidden; width: 90px; height: 20px;"></iframe>
      </div>
      <a href="#" data-ix="open-lightbox" class="w-inline-block w-clearfix facebook-link header">
        <div class="w-clearfix facebook-button header"><img width="20" src="assets/images/facebook-logo.png" class="fecebook-logo small">
          <div class="facebook-text">Se Connecter avec Facebook</div>
        </div>
      </a>
    </div>
    <div data-collapse="medium" data-animation="default" data-duration="400" class="w-nav navbar">
      <a href="index.html" class="w-nav-brand w-clearfix"><img alt="Pronostics Foot Gratuit" width="80" src="assets/images/Logo.png" class="logo-image header">
      </a>
      <div class="w-nav-button menu-button home">
        <div class="w-icon-nav-menu"></div>
      </div>
      <nav role="navigation" class="w-nav-menu w-clearfix nav-menu"><a href="#anchor1" class="nav-links">Comment Jouer</a><a href="#anchor2" class="nav-links">Prix à Gagner</a><a href="#anchor3" class="nav-links">Règles</a><a href="#anchor4" class="nav-links">Calendrier des Matchs</a>
      </nav>
    </div>
  </div>
  <div id="anchor1" class="anchor"></div>
  <!-- header Section -->
  <?php $this->load->view('section_header') ?>
	
  <!-- CHAGE ti to DYNAMIC  -->
	<?php $this->load->view('home') ?>


<!-- footer -->
<?php $this->load->view('footer') ?>
</html>
