<div class='row' style="margin-top:<?=$margin_top;?>;">
<div class="col-lg-12">
<div class="panel panel-success" style="margin-bottom:0px;">
<div class='panel-heading'><?=strtoupper($nama_wrapper);?></div>
<div class="panel-body" style="padding:5px;">
	<div id='fr_polling'>
<?php
foreach($hslquery AS $key=>$val){
	echo '<form id="polling_'.$val->id_konten.'" method="post">';
	echo '<a href="'.site_url().'read/polling/'.$val->id_konten.'/'.$val->katseo.'/'.$val->seo.'">'.$val->judul.'</a><br/>';
		foreach($val->pil AS $ky=>$vl){
			echo '<input type="radio" name="pil_'.$val->id_konten.'" id="pil_'.$val->id_konten.'" value="'.$vl->id_appe.'">'.$vl->judul_appe.'<br/>';
		}
	echo '<button class="btn btn-primary btn-xs" type="button" onclick="iniPilih('.$val->id_konten.');" id="tb_pil_'.$val->id_konten.'"><i class="fa fa-save fa-fw"></i> Pilih</button>';
	echo '</form>';
}
?>
	</div>
</div>
<!--//panel-body-->
</div>
<!--//panel-->
</div>
<!--//col-lg-12-->
</div>
<!--//row-->
<script type="text/javascript">
function iniPilih(idd){
	var pilihan ="";
	$("[id^='pil_"+idd+"']").each(function(index,item) {
		var idx = item.checked;
		var idn = item.value;
		if(idx==true){	pilihan=pilihan+idn;	}
	});
	if(pilihan!=""){
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>web_polling/counter/",
				data:{"idd":idd,"pilihan":pilihan},
				beforeSend:function(){	
					$('#tb_pil_'+idd).replaceWith('<p class="text-center" id="tb_pil_'+idd+'"><i class="fa fa-spinner fa-spin fa-2x"></i><p>');
				},
				success:function(data){
					$('#tb_pil_'+idd).replaceWith('<p id="tb_pil_'+idd+'" class="text-center">Terimakasih atas partisipasi Anda dalam polling ini.<p>');
				},
				dataType:"html"
			});
	}
}
</script>