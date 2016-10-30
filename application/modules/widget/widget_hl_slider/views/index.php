<div class="row" style="margin-top:<?=$margin_top;?>;">
<div class="col-lg-12" style="padding-right:0px;">

    <div id="myCarouseli" class="carousel slide" data-ride="carousel">
    
      <!-- Wrapper for slides -->
      <div class="carousel-inner">
<?php
	$i=0;
	foreach($daftar as $key=>$val){
	$cls = ($i==0)?' active':'';
?>
        <div class="item <?=$cls;?>">
           <img src="<?=site_url().$val->imgslider;?>">
           <div class="carousel-caption">
            <h4><a href="#"><?=$val->judul;?></a></h4>
            <p><?=$val->sub;?><a class="label label-primary" href="<?=site_url();?>read/artikel/<?=$val->id_konten;?>/<?=$val->kat_seo;?>/<?=$val->seo;?>">Selengkapnya...</a></p>
          </div>
        </div><!-- End Item -->
<?php
	$i++;
	}
?>
      </div><!-- End Carousel Inner -->


    <ul class="list-group col-sm-4">
<?php
	$i=0;
	foreach($daftar as $key=>$val){
		$cls = ($i==0)?'class="list-group-item active"':'class="list-group-item"';
		echo '<li data-target="#myCarouseli" data-slide-to="'.$i.'" '.$cls.'>'.$val->judul.'</li>';
		$i++;
	}
 ?>
    </ul>

      <!-- Controls -->
      <div class="carousel-controls">
          <a class="left carousel-control" href="#myCarouseli" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
          </a>
          <a class="right carousel-control" href="#myCarouseli" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
          </a>
      </div>

    </div><!-- End Carousel -->


</div>
<!--//col-lg-12-->
</div>
<!--//row-->
<style>
#myCarouseli .carousel-caption {
	left:0;
	right:0;
	bottom:0;
	text-align:left;
	padding:10px;
	background:rgba(0,0,0,0.6);
	text-shadow:none;
}

#myCarouseli .list-group {
	position:absolute;
	top:0;
	right:0;
}
#myCarouseli .list-group-item {
	border-radius:0px;
	cursor:pointer;
}
#myCarouseli .list-group .active {
	background-color:#eee;	
}
#myCarouseli .carousel-inner .item img {
	width:100%;
	height:100%;
}

@media (min-width: 992px) { 
	#myCarouseli {padding-right:33.3333%;}
	#myCarouseli .carousel-controls {display:none;} 	
}
@media (max-width: 991px) { 
	#myCarouseli .carousel-caption p,
	#myCarouseli .list-group {display:none;} 
}
</style>

<script>	
$(document).ready(function(){
    
	var clickEvent = false;
	$('#myCarouseli').carousel({
		interval:   <?=$durasi;?>
	}).on('click', '.list-group li', function() {
			clickEvent = true;
			$('.list-group li').removeClass('active');
			$(this).addClass('active');		
	}).on('slid.bs.carousel', function(e) {
		if(!clickEvent) {
			var count = $('.list-group').children().length -1;
			var current = $('.list-group li.active');
			current.removeClass('active').next().addClass('active');
			var id = parseInt(current.data('slide-to'));
			if(count == id) {
				$('.list-group li').first().addClass('active');	
			}
		}
		clickEvent = false;
	});
})

$(window).load(function() {
    var boxheight = $('#myCarouseli .carousel-inner').innerHeight();
    var itemlength = $('#myCarouseli .item').length;
    var triggerheight = Math.round(boxheight/itemlength+1);
	$('#myCarouseli .list-group-item').outerHeight(triggerheight);
});
</script>
