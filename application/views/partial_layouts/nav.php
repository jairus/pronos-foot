<?php

if(!$_SESSION['profile']){
	?>
	  <div class="w-section w-clearfix nav-section">
		<div class="w-clearfix sharing-and-register">
		  <div class="w-widget w-widget-facebook facebook-sharing">
			<iframe src="https://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.pronos-foot.com&amp;layout=button_count&amp;locale=en_US&amp;action=like&amp;show_faces=false&amp;share=false" scrolling="no" frameborder="0" allowtransparency="true" style="border: none; overflow: hidden; width: 90px; height: 20px;"></iframe>
		  </div>
		  <a href="<?php echo $_SESSION['fbloginurl']; ?>" data-ix="open-lightbox" class="w-inline-block facebook-link header">
			<div class="w-clearfix facebook-button header"><img width="20" src="<?php echo base_url();?>assets/images/facebook-logo.png" class="fecebook-logo small">
			  <div class="facebook-text">Se Connecter avec Facebook</div>
			</div>
		  </a>
		</div>
		<div data-collapse="medium" data-animation="default" data-duration="400" class="w-nav navbar">
		  <a href="<?php echo site_url(); ?>" class="w-nav-brand w-clearfix"><img alt="Pronostics Foot Gratuit" width="80" src="<?php echo base_url();?>assets/images/Logo.png" class="logo-image header">
		  </a>
		  <div class="w-nav-button menu-button home">
			<div class="w-icon-nav-menu"></div>
		  </div>
		  <nav role="navigation" class="w-nav-menu w-clearfix nav-menu"><a href="#anchor1" class="nav-links">Comment Jouer</a><a href="#anchor2" class="nav-links">Prix à Gagner</a><a href="#anchor3" class="nav-links">Règles</a><a href="#anchor4" class="nav-links">Calendrier des Matchs</a>
		  </nav>
		</div>
	  </div>
	  <div id="anchor1" class="anchor"></div>
	<?php
}
else{
	?>
	 <!-- NAVIGATION -->
	  <div class="w-section nav-section">
		<div data-collapse="medium" data-animation="default" data-duration="400" class="w-nav navbar">
		  <a href="<?php echo site_url(); ?>" class="w-nav-brand w-clearfix"><img alt="Pronostics Foot Gratuit" width="80" src="<?php echo base_url();?>assets/images/Logo.png" class="logo-image header">
		  </a>
		  <div class="w-clearfix picture-profile">
			<div class="w-widget w-widget-facebook facebook-sharing account">
			  <iframe src="https://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.pronos-foot.com&amp;layout=button_count&amp;locale=en_US&amp;action=like&amp;show_faces=false&amp;share=false" scrolling="no" frameborder="0" allowtransparency="true" style="border: none; overflow: hidden; width: 90px; height: 20px;"></iframe>
			</div><img width="50" src="<?php echo $_SESSION['profile']['image']; ?>" class="image-profile"><a href="<?php echo site_url("logout"); ?>" class="link-header">Se Deconnecter</a>
		  </div>
		</div>
	  </div>
	<?php
}
?>