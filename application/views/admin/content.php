<?php
$controller = $this->router->fetch_class();
$method = $this->router->fetch_method();
?>
<section id="main">
	<?php
	$this->load->view("admin/mainmenus");
	?>

	<section id="content">
		<div class="container">
			<?php
			echo $content;
			?>
		</div>
	</section>
</section>