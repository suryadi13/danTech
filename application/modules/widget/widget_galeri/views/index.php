<div class="row" style="margin-top:<?=$margin_top;?>;">
			<div class="col-lg-12">
							<div class="panel panel-info">
								<div class="panel-heading"><?=strtoupper($nama_wrapper);?></div>
								<div class="panel-body" style="padding-bottom:0px;">
            <!-- Carousel-->
            <div id="myCarouselG" class="carousel slide">
                <div class="carousel-inner">
<?php
for($i=0;$i<4;$i++){
$cls = ($i==0)?"active":"";
?>
                    <div class="item <?=$cls;?>" style="padding-bottom:0px;">
                        <div class="row">
<?php
	foreach($daftar as $key=>$val){
?>
                            <div class="col-md-3">
                                <div class="thumbnail">
								  <a href="<?=base_url();?>read/galeri/<?=$val->id_konten;?>/<?=$val->kat_seo;?>/<?=$val->seo;?>">
                                  <img src="<?=base_url();?><?=$val->foto;?>" title="<?=$val->judul;?>">
								  </a>
                                </div>        
                            </div>
<?php
	}
?>
                        </div>
                    </div>
<?php
	}
?>
            </div><!-- End Inner --> 
        </div><!-- End Carousel -->
								</div>
							</div>
    </div><!-- End col -->
</div><!-- row -->
<script>
	$('#myCarouselG').carousel({
		interval:   4000
	});
</script>
