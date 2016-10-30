<style>
.carousel-inner .item img {
	width:100%;
	height:100%;
}
.item .thumbnail {
	margin-bottom:0;
}
.carousel-control.left, .carousel-control.right {
	background-image:none !important;
}
.carousel-control {
	background:	#ddd;
	color:#999;
	padding: 4px 0;
	width:26px;
	top:auto;	
	left:auto;
	bottom:0;
	opacity:1;
	text-shadow:none;
}
.carousel-control.right {
	right:10px;
}

.carousel-control.left {
	right: 40px;
}
</style>
<div class='row' style="margin-top:<?=$margin_top;?>;margin-bottom:<?=$margin_bottom;?>;">
<div class="col-lg-12">
<div class="panel panel-default" style="margin-bottom:0px;">
<div class='panel-heading'><?=strtoupper($nama_wrapper);?></div>
<div class="panel-body">
            <!-- Carousel
            ================================================== -->
            <div id="myCarousel_info" class="carousel slide">
                 <!-- Indicators -->         
                <div class="carousel-inner">           
<?php
$i=0;
foreach($daftar as $key=>$val){
$cls = ($i==0)?'active':'';
?>
                    <div class="item <?=$cls;?>">
                        <blockquote>
                          <p><?=$val->keterangan_appe;;?></p>
                          <small><?=$val->judul_appe;;?></small>
                        </blockquote>
                    </div>
<?php
$i++;
}
?>
                </div> 
               <div class="carousel-controls">
                  <a class="carousel-control left" href="#myCarousel" data-slide="prev"><span class="fa fa-angle-double-left"></span></a>
                  <a class="carousel-control right" href="#myCarousel" data-slide="next"><span class="fa fa-angle-double-right"></span></a>
              </div>               
                                                            
            </div><!-- End Carousel -->  
</div>
<!--//panel-body-->
</div>
<!--//panel-->
</div>
<!--//col-lg-12-->
</div>
<!--//row-->
<script>
	$('#myCarousel_info').carousel({
		interval:   <?=$durasi;?>
	});
</script>
