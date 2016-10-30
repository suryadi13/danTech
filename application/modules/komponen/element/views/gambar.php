<?php
if(!empty($gambar)){
?>
	<div class="row" style="margin-bottom:40px;">
    	<div class="col-lg-12">
            <!-- Carousel
            ================================================== -->
            <div id="myCarousel" class="carousel slide">        
                <div class="carousel-inner">           
			<?php
				$i=0;
				foreach($gambar AS $key=>$val){
				$cls = ($i==0)?' active':'';
			?>
                    <div class="item <?=$cls;?>"> 
                    	<a href="#"><img class="thumbnail" src="<?=base_url();?><?=$val->foto;?>"></a>
                        <div class="caption">
                            <p><b><?=@$val->judul_appe;?></b><br />
                            <?=@$val->keterangan_appe;?></p>
                        </div>
                    </div>
			<?php
				$i++;
				}
			?>
                </div>
                 <!-- Indicators -->
                  <ol class="carousel-indicators">
			<?php
				$i=0;
				foreach($gambar AS $key=>$val){
				$cls = ($i==0)?'class="active"':'';
			?>
                    <li data-target="#myCarousel" data-slide-to="<?=$i;?>" <?=$cls;?>></li>
			<?php
				$i++;
				}
			?>
                  </ol>                                                                 
            </div><!-- End Carousel -->  
    	</div>
    </div>
<?php
}
?>
<style>
.carousel-indicators {
	bottom:-40px;
	left:0;
	width:100%;
	background:#ccc;
	padding: 6px 0px;
	margin-left:0;
	border-top:2px solid #fff;
}
.carousel-indicators li {
	width:12px;
	height:12px;	
	background:#fff;
	border-color:#fff;

}
.carousel-indicators .active {
	width:14px;
	height:14px;
	background:#428bca;
	border-color:#428bca;
}
.carousel-inner .thumbnail {
	margin-bottom:0;
	border-bottom-left-radius:0;
	border-bottom-right-radius:0;
}
.carousel-inner .caption {
	background:#ddd;
	padding: 10px;
}
</style>
<script type="text/javascript">
	$('#myCarousel').carousel({
		interval:   4000
	});
</script>
