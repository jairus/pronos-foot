  <div class="w-section footer-section">
    <div class="w-container footer-container">
      <div class="w-row">
        <div class="w-col w-col-5 w-clearfix footer-column1"><img alt="Pronostics Foot Gratuit" width="80" src="<?php echo base_url();?>assets/images/Logo.png" class="logo-image">
          <div class="footer-text disclaimer">© 2016 PRONOS-FOOT.COM&nbsp;Tous droits réservés.
            <br>Site de Pronostics de Football 100% Gratuit</div>
        </div>
        <div class="w-col w-col-4">
		  <?php
		  if(!$_SESSION['profile']['id']){
			  ?>
			  <div class="footer-text middle">INSCRIVEZ-VOUS MAINTENANT !</div>
			  <a href="<?php echo $_SESSION['fbloginurl']; ?>" data-ix="open-lightbox" class="w-inline-block w-clearfix facebook-link footer">
				<div class="w-clearfix facebook-button small footer"><img width="20" src="<?php echo base_url();?>assets/images/facebook-logo.png" class="fecebook-logo footer">
				  <div class="facebook-text footer">Se Connecter avec Facebook</div>
				</div>
			  </a>
			  <?php
		  }
		  ?>
        </div>
        <div class="w-col w-col-3">
          <div class="footer-company">PRONOS-FOOT.COM
            <br>le service est édité par la société :
            <br> Ecashcontent Limited
            <br> Unit 1109, 11/F Dominion CTR
            <br> 43-59 Queen’s RD East Wanchai
            <br> HONG KONG</div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/webflow.js"></script>
  <!--[if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]-->
  <div id="fb-root"></div>
  <script>
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=225457374225135";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  </script>