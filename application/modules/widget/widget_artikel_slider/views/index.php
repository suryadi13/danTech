<div class="container">
    <div id="myCarousela" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
<?php
	$i=0;
	foreach($daftar as $key=>$val){
		$cls = ($i==0)?'class="active"':'';
		echo '<li data-target="#myCarousel" data-slide-to="'.$i.'" '.$cls.'></li>';
		$i++;
	}
 ?>
      </ol>
      <!-- Wrapper for slides -->
      <div class="carousel-inner">
<?php
	$i=0;
	foreach($daftar as $key=>$val){
	$cls = ($i==0)?' active':'';
?>
        <div class="item <?=$cls;?>">
			<?php echo "<img src=\"".site_url().$val->imgslider."\" alt='natural' width='100%' />"; ?>
           <div class="carousel-caption">
            <h3><?=$val->judul;?></h3>
			<?php echo "<a href=\"".site_url()."read/artikel/".$val->id_konten."/".$val->kat_seo."/".$val->seo."\">"; ?>
            <p><?=$val->sub;?></p>
			<?php echo "</a>";	?>
          </div>
        </div><!-- End Item -->
<?php
	$i++;
	}
?>
      </div><!-- End Carousel Inner -->
    

      <!-- Controls -->
      <div class="carousel-controls">
          <a class="carousel-control left" href="#myCarousela" data-slide="prev">
            <span class="fa fa-angle-double-left"></span>
          </a>
          <a class="carousel-control right" href="#myCarousela" data-slide="next">
            <span class="fa fa-angle-double-right"></span>
          </a>
      </div>
    </div><!-- End Carousel -->
</div>
<script>
	$('#myCarousela').carousel({
		interval:   <?=$durasi;?>
	});
</script>
<style>
/*#####################
Additional Styles (required)
#####################*/
#myCarousela .carousel-control.left,#myCarousela  .carousel-control.right {
	background-image:none !important;
}
#myCarousela .carousel-inner .item img {
	width:100%;
	height:100%;
}
#myCarousela .carousel-indicators {
	bottom:5px;
	left:0;
	width:auto;
	padding:5px 25px 5px 25px;
	margin-left:0;
	background:rgba(0,0,0,0.7);
}
#myCarousela .carousel-indicators li {
	border-radius:0;
	width:8px;
	height:8px;
	background:#fff;
}
#myCarousela .carousel-indicators .active {
	width:10px;
	height:10px;
	background:#39b3d7;
	border-color:#39b3d7;
}

#myCarousela .carousel-control {
	background:	#39b3d7;
	color:#fff;
	padding: 4px 0;
	width:26px;
	top:auto;	
	left:auto;
	bottom:12px;
	opacity:0.85;
}
#myCarousela .carousel-control.right {
	right:10px;
}

#myCarousela .carousel-control.left {
	right: 46px;
}
#myCarousela .carousel-caption {
	top:auto;
	width:auto;
	right:auto;
	bottom:0px;
	left:5px;
	padding: 0px 10px 0px 10px;
	background:rgba(0,0,0,0.70);
	text-align:left;
  	height:auto;
	max-width:90%;
}
</style>