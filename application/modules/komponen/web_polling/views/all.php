			<div class="row" style="margin-top:10px;"><div class="col-lg-12"><ol class="breadcrumb"><?=$jkanal;?></ol></div></div>
			<div class="row"><div class="col-lg-12">
		  	<div class="panel panel-default">
			<div class="panel-heading"><?=strtoupper($rubrik);?></div>
              <div class="panel-body">
	<?php
		if(empty($isi)){	echo "Tidak Ada Konten";	} else {
		foreach($isi as $key=>$val){
	?>
                 <div class="row" style="padding-bottom:10px;">
                    <div class="col-md-3">
                      <img class="img-responsive" src="<?=site_url();?>assets/media/foto/<?=$val->thumb;?>" />
                    </div> 
                    <div class="col-md-9">
                      <h3><?=$val->judul;?></h3>
                     <a class="btn-more right" href="<?=site_url()."read/polling/".$val->id_konten."/".$val->kat_seo."/".$val->seo?>">Selengkapnya</a>                        	
                    </div> 
                 </div>
	<?php
		}	}
	?>
              </div>
			  <div class="panel-footer" id="paging_all"><?=$pager;?></div>        	
			</div>
			</div></div>
<form id="sb_act" method="post"></form>
<script type="text/javascript">
$(document).ready(function(){
	repaging_all();
	gopaging_all();
});
function gopaging_all(){
	$("#paging_all #inputpaging").change(function() {
		var ini = $( this ).val();
		ppost(ini);
	});
}
function repaging_all(){
	$( "#paging_all .pagingframe div" ).addClass("btn btn-default");
}
function ppost(hal){
	$('#sb_act').attr('action','<?=site_url();?>all/polling/<?=$id_rubrik;?>/'+hal+'/<?=$kat_seo;?>');
	$('#sb_act').submit();
}
</script>
<style>
#paging_all.panel-footer{padding-top:2px;padding-bottom:2px;text-align:right;	}
#paging_all.panel-footer .btn{padding:2px 8px 2px 8px;}
#paging_all.panel-body .btn{padding:2px 8px 2px 8px;}
</style>
