<ul class="media-list">
	
	<?php 
	//print_r($startup['meta']['related_articles']);
	
	$meta_articles = $startup['meta']['related_articles'];
	
		for($i = 0; $i < count($meta_articles); $i++){
			if(count($meta_articles) == 1)
				$article = json_decode($meta_articles);
			else {
				$article = json_decode($meta_articles[$i]);
			}
	?>
	<li class="media">
	  <a href="<?php echo feed_url($article->url); ?>" target="_blank" class="pull-left">
	    <?php 
	    	$image = $article->featured_image;
	    	$imageName = explode(".",$image);
	    	$filename = "";
	    	for($j=0; $j < count($imageName);$j++){
	    			
	    		if($filename == ""){
	    			$filename .= $imageName[$j];
	    		}else
				{
					$filename .= ".".$imageName[$j];
				}
	    		
	    		if($j == (count($imageName) - 2)){
	    			$filename .= "-110x110";
	    		}
	    		
	    	}
			
			if(is_url_exist($filename)){
			
				$image = $filename;	
			}else{
				$image = $article->featured_image;	
			}
			
			if($image != NULL && $image != ""){
	    	?>
	    <img alt="64x64" data-src="holder.js/64x64" class="media-object" style="width: 64px; height: 64px;" 
	    src="<?php echo $image ?>">
	    <?php } ?>
	  </a>
	  <div class="media-body">
	    <h4 class="media-heading bold">
	    	<a href="<?php echo feed_url($article->url); ?>" style="color:#565656;" class="pull-left media-heading bold"><?php echo $article->title ?></a>
	    </h4><br/>
	   <!--  <p><?php echo $article->content ?></p> -->
	 
	  </div>
	</li>
	<?php } ?>
</ul>