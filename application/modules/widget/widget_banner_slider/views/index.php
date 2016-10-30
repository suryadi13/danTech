            <div id="myCarousel_<?=$idd;?>" class="carousel slide" data-ride="carousel" style="margin-top:<?=$margin_top;?>;">
              <div class="carousel-inner">

	<?php
		$i=0;
		foreach($daftar as $key=>$val){
		$cls = ($i==0)?'active':'';
	?>
                <div class="item <?=$cls;?>">
                    <div class="thumbnail">

					
					<?php if($val->link=="") { ?>
                      <img src="<?=base_url();?><?=$val->foto;?>">
					<?php } else { ?>
                      <a href="http://<?=$val->link;?>" target=_blank border=0><img src="<?=base_url();?><?=$val->foto;?>"></a>
					<?php } ?>
					
					
                    </div>        
                </div><!-- End Item -->
	<?php
		$i++;
		}
	?>
			</div>
		</div>
<script>
	$('#myCarousel_<?=$idd;?>').carousel({
		interval:   <?=$durasi;?>
	});
</script>
<style>
#myCarousel<?=$idd;?> .thumbnail {
	margin-bottom:0;
}
#myCarousel<?=$idd;?> .carousel-inner .item img {
	width:100%;
	height:100%;
}
</style>