<?php
//pre($_SESSION);
?>
    <div class="header-div">
      <div class="w-container header-container">
        <div class="w-row header-row1">
          <div class="w-col w-col-3 w-col-small-3 pronos-foot-column1"><img alt="Pronostics Foot Gratuit" width="187" src="<?php echo base_url();?>assets/images/Euro-2016.jpg" class="logo-image top">
          </div>
          <div class="w-col w-col-9 w-col-small-9 header-column2">
            <h1 class="header-title">PRONOS-FOOT.com</h1>
            <h1 class="header-title2">Site de Pronostics de Football 100% Gratuit</h1>
          </div>
        </div>
        <div class="mes-points-title">Mes Points:&nbsp;<span class="mes-points-number"><?php echo $_SESSION['profile']['points'];?> Pts</span>
        </div>
        <div class="mes-points-title">Mon Classement:&nbsp;<span class="mes-points-number"><?php echo $_SESSION['profile']['rank']; ?></span>
        </div>
        <div class="div-share">
          <a href="<?php echo site_url(); ?>" onclick="return shareOnFacebook(jQuery(this));" class="w-inline-block facebook-link partager">
            <div class="w-clearfix facebook-button partager"><img width="30" src="<?php echo base_url();?>assets/images/facebook-logo.png" class="fecebook-logo share">
              <div class="facebook-text partager">Partager sur Facebook</div>
            </div>
          </a>
        </div>
      </div>
    </div>