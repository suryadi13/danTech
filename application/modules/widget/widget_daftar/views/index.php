<div class='row' style="margin-top:<?=$margin_top;?>;">
<div class="col-lg-12">
<div class="panel panel-success" style="margin-bottom:0px;">
<div class='panel-heading'><?=strtoupper($nama_wrapper);?></div>
<div class="panel-body" style="padding:5px;">

	<div id='fr_daftar_<?=$idx;?>'>
					<?php
					foreach($hslquery AS $key=>$val){
						$seling=($key%2==0)?"even":"odd";
						echo "<a href='".site_url()."read/direktori/".$val->id_konten."/".$val->katseo."/".$val->seo."'>";
						echo "<div class=\"widget-sidebox item ada ".$seling."\">".($key+1).". ".$val->judul."</div>";
						echo "</a>";
					}
					?>
	</div>
</div>
<!--//panel-body-->
<div class="panel-footer" id="paging_<?=$idx;?>"><?=$pager;?></div>        	
</div>
<!--//panel-->
</div>
<!--//col-lg-12-->
</div>
<!--//row-->
<style>
#paging_<?=$idx;?>{padding-top:2px;padding-bottom:2px;text-align:right;	}
#paging_<?=$idx;?> .btn{padding:2px 8px 2px 8px;}
#paging_<?=$idx;?> .btn{padding:2px 8px 2px 8px;}
</style>

<script type="text/javascript">
$(document).ready(function(){
	repaging_<?=$idx;?>();
});
function repaging_<?=$idx;?>(){
	$( "#paging_<?=$idx;?> .pagingframe div" ).addClass("btn btn-default");
	$( "#paging_<?=$idx;?> .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	griddaftar_<?=$idx;?>(inu);	}
	});
}
function griddaftar_<?=$idx;?>(hal){
$('#fr_daftar_<?=$idx;?>').html("<img src='<?=base_url();?>assets/images/loading1.gif'>");
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>widget_daftar/getdaftar/",
				data:{ "hal": hal,"batas": <?=$batas;?>,"count": <?=$count;?>,"ini": "<?=$ini;?>","id_wrapper": "<?=$id_kat;?>"},
				success:function(data){
							if((data.hslquery.length)>0){
										var table=""; var nomor=data.mulai;
										$.each( data.hslquery, function(index, item){
									if(nomor%2==1){ var bgc="even";}else{ var bgc="odd";}
									table = table+ "<a href='<?=site_url();?>read/direktori/"+item.id_konten+"/"+item.kat_seo+"/"+item.seo+"'>";
									table = table+ "<div class=\"widget-sidebox item ada "+bgc+"\">"+nomor+". "+item.judul+"</div>";
									table = table+ "</a>";
										nomor++;
										}); //endeach
											$('#fr_daftar_<?=$idx;?>').html(table);
											$('#paging_<?=$idx;?>').html(data.pager);
											repaging_<?=$idx;?>();
									} else {
										$('#fr_daftar').html("Tidak ada komentar");
									}
							}, 
        dataType:"json"});
}
</script>