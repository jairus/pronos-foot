<?php
@session_start();
require(dirname(__FILE__).'/../../facebook-php-sdk-v4-5.0.0/src/Facebook/autoload.php');

$fb = new Facebook\Facebook([
  'app_id' => '186223105106083',
  'app_secret' => 'cdf304ba57a032c0754ca1fae0e2de63',
  'default_graph_version' => 'v2.5',
]);

$helper = $fb->getRedirectLoginHelper();

try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (isset($accessToken)) {
  // Logged in!
	$_SESSION['facebook_access_token'] = (string) $accessToken;
	$fb->setDefaultAccessToken($accessToken);
	try {
		$response = $fb->get('/me?fields=location,id,name,birthday,first_name,last_name,email,picture.width(300).height(300)');
		$userNode = $response->getGraphUser();
	} 
	catch(Facebook\Exceptions\FacebookResponseException $e) {
		// When Graph returns an error
		echo 'Graph returned an error: ' . $e->getMessage();
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		// When validation fails or other local issues
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}
	$profile = $response->getDecodedBody();
	$_SESSION['fbprofile'] = $profile;
	

	/*
	[id] => 10153633752299646
    [name] => Jairus Bondoc
    [email] => jairus@nmgresources.ph
    [picture] => Array
        (
            [data] => Array
                (
                    [height] => 320
                    [is_silhouette] => 
                    [url] => https://scontent.xx.fbcdn.net/v/t1.0-1/p320x320/12744210_10153421633164646_8195268512010431991_n.jpg?oh=e1695aadbdd55add8eac1309e818211e&oe=57D9A921
                    [width] => 320
                )

        )
	*/	
}
//force 
if($_SERVER['HTTP_HOST']=="pronos-foot.co"){
	$_SESSION['fbprofile']['id'] = '869963073149613';
	$_SESSION['fbprofile']['name'] = "Jerome Lee";
}
if(!$_SESSION['fbprofile']){
	$permissions = ['email', 'user_likes', 'user_birthday', 'user_location']; // optional
	$loginUrl = $helper->getLoginUrl('http://pronos-foot.com/', $permissions);
	$_SESSION['fbloginurl'] = $loginUrl;
}
else if(!$_SESSION['profile']){
	$fbprofile = $_SESSION['fbprofile'];
	$sql = "select * from `profiles` where `fbid`='".db_escape($fbprofile['id'])."' limit 1";
	$profile = $this->db->query($sql)->result_array();
	$profile = $profile[0];
	if($profile['id']){
		$sql = "update `profiles` set
		`name` = '".db_escape($fbprofile['name'])."'
		";
		if($fbprofile['email']){
			$sql .= " , `email` = '".db_escape($fbprofile['email'])."'";
		}
		if($fbprofile['picture']['data']['url']){
			$sql .= " , `image` = '".db_escape($fbprofile['picture']['data']['url'])."'";
		}
		$sql .= " where `fbid` = '".db_escape($fbprofile['id'])."'";
		$this->db->query($sql);
	}
	else{
		$sql = "insert into `profiles` set
		`name` = '".db_escape($fbprofile['name'])."'
		, `fbid` = '".db_escape($fbprofile['id'])."'
		";
		if($fbprofile['email']){
			$sql .= " , `email` = '".db_escape($fbprofile['email'])."'";
		}
		if($fbprofile['picture']['data']['url']){
			$sql .= " , `image` = '".db_escape($fbprofile['picture']['data']['url'])."'";
		}
		$sql .= " , `dateadded` = NOW()";
		$this->db->query($sql);
	}
	$sql = "select * from `profiles` where `fbid`='".db_escape($fbprofile['id'])."' limit 1";
	$profile = $this->db->query($sql)->result_array();
	$profile = $profile[0];
	$_SESSION['profile'] = $profile;
	redirect(site_url(), "refresh");
	exit();
}
?>
<!DOCTYPE html>
<!-- This site was created in Webflow. http://www.webflow.com-->
<!-- Last Published: Tue May 10 2016 14:21:46 GMT+0000 (UTC) -->
<html data-wf-site="570cdf23fb4e011d1cf72234" data-wf-page="572c9bb1c23ef15860a555bc">
<?php $this->load->view("partial_layouts/header")?>
<body>
  <?php $this->load->view('partial_layouts/nav') ?>
  <div class="w-section header-section">
    <!-- header div -->
    <?php $this->load->view('partial_layouts/section_header') ?>
    <div class="w-container inscription-container">
      <h1 class="header-title2">Inscrivez-vous Maintenant avec Facebook !</h1>
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