<!DOCTYPE html>
<!-- This site was created in Webflow. http://www.webflow.com-->
<!-- Last Published: Tue May 10 2016 14:21:45 GMT+0000 (UTC) -->
<html data-wf-site="570cdf23fb4e011d1cf72234" data-wf-page="5719e33447140e34379df356">
<head>
  <meta charset="utf-8">
  <title>PRONOS-FOOT.com | Site de Pronostics de Football 100% Gratuit avec Prix a Gagner</title>
  <meta name="description" content="Site de Pronostics de Football 100% Gratuit.
Inscription Simple et Rapide.
Collectez des Points en Trouvant les Résultats des Matchs de L&#39;EURO 2016.
Devenez le Champion de Pronos-Foot.com et Gagnez un iPhone 6.">
  <meta property="og:title" content="PRONOS-FOOT.com | Site de Pronostics de Football 100% Gratuit avec Prix a Gagner">
  <meta property="og:description" content="Site de Pronostics de Football 100% Gratuit.
Inscription Simple et Rapide.
Collectez des Points en Trouvant les Résultats des Matchs de L&#39;EURO 2016.
Devenez le Champion de Pronos-Foot.com et Gagnez un iPhone 6.">
  <meta property="og:image" content="https://daks2k3a4ib2z.cloudfront.net/570cdf23fb4e011d1cf72234/5719de9f6324c106760c3392_facebook-og.jpg">
  <meta name="twitter:card" content="summary">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="generator" content="Webflow">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/normalize.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/webflow.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/pronos-football.webflow.css">
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
  <script>
    WebFont.load({
      google: {
        families: ["Montserrat:400,700","Arimo:regular,italic,700,700italic","Raleway:regular,700,800"]
      }
    });
  </script>
  <script type="text/javascript" src="js/modernizr.js"></script>
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>assets/images/pronos-foot-logo-small.png">
  <link rel="apple-touch-icon" href="<?php echo base_url();?>assets/images/pronos-foot-logo-large.png">
</head>
<body>
  <!-- NAVIGATION -->
  <div class="w-section nav-section">
    <div data-collapse="medium" data-animation="default" data-duration="400" class="w-nav navbar">
      <a href="index.html" class="w-nav-brand w-clearfix"><img alt="Pronostics Foot Gratuit" width="80" src="<?php echo base_url();?>assets/images/Logo.png" class="logo-image header">
      </a>
      <div class="w-clearfix picture-profile">
        <div class="w-widget w-widget-facebook facebook-sharing account">
          <iframe src="https://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.pronos-foot.com&amp;layout=button_count&amp;locale=en_US&amp;action=like&amp;show_faces=false&amp;share=false" scrolling="no" frameborder="0" allowtransparency="true" style="border: none; overflow: hidden; width: 90px; height: 20px;"></iframe>
        </div><img width="50" src="<?php echo base_url();?>assets/images/picture-profile.jpg" class="image-profile"><a href="index.html" class="link-header">Logout</a>
      </div>
    </div>
  </div>
  <div class="w-section header-section">
    <?php $this->load->view('accounts/sec_header') ?>
  </div>
  <div class="w-section grille-section calendar version2 account">
    <!-- CONTENT -->
    <?php $this->load->view($yield) ?>
  </div>
  <?php $this->load->view('partial_layouts/prices') ?>
  <!-- FOOTER -->
  <div class="w-section footer-section">
    <div class="w-container footer-container">
      <div class="w-row">
        <div class="w-col w-col-5 w-clearfix footer-column1"><img alt="Pronostics Foot Gratuit" width="80" src="<?php echo base_url();?>assets/images/Logo.png" class="logo-image">
          <div class="footer-text disclaimer">© 2016 PRONOS-FOOT.COM&nbsp;Tous droits réservés.
            <br>Site de Pronostics de Football 100% Gratuit</div>
        </div>
        <div class="w-col w-col-4"></div>
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
  <script type="text/javascript" src="<?php echo base_url();?>js/webflow.js"></script>
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
</body>
</html>