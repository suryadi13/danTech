<?php
			$i=0;
			$jml = count($jj);
			foreach($jj AS $key=>$val){
?>
				<tr>
				<td>Label <span class="no_label"><?=($key+1);?></span></td>
				<td colspan=3>
				<input type='hidden' id='id_label_<?=($key+1)?>' name='id_label[]' value="<?=$val->id_appe;?>">
				<input type="text" id="label_<?=($key+1);?>" name="label[]" value="<?=$val->judul_appe;?>" class="ipt_text" style="width:400px;float:left;">
				<div class="btn btn-default btn-xs" onclick="hapus_atr('<?=$jj[$i]->id_appe;?>');" title='Klik untuk menghapus label' style="float:left;margin-left:5px;"><i class="fa fa-trash fa-fw"></i></div>
				<?php if($i!=0){ ?>
				<div class="btn btn-default btn-xs" onclick="urut_atr('<?=$jj[$i]->id_appe;?>','<?=$jj[$i]->urutan_appe;?>','<?=$jj[($i-1)]->id_appe;?>','<?=$jj[($i-1)]->urutan_appe;?>');" title='Klik untuk menaikkan urutan label' style="float:left;margin-left:5px;"><i class="fa fa-upload fa-fw"></i></div>
				<?php } ?>
				<?php if($i!=($jml-1)){ ?>
				<div class="btn btn-default btn-xs" onclick="urut_atr('<?=$jj[$i]->id_appe;?>','<?=$jj[$i]->urutan_appe;?>','<?=$jj[($i+1)]->id_appe;?>','<?=$jj[($i+1)]->urutan_appe;?>');" title='Klik untuk menurunkan urutan label' style="float:left;margin-left:5px;"><i class="fa fa-download fa-fw"></i></div>
				<?php } ?>
				</td>
				</tr>
<?php
			$i++;
			}
?>
				<tr class="row_tombol">
				<td>&nbsp;</td>
				<td colspan=3><div class="btn btn-warning btn-xs" onClick="tambah_label();">Tambah Label</div></td>
				</tr>
<script type="text/javascript">
	function tambah_label(){
		var yu = $(".no_label").last().html();
		var ya = parseInt(yu)+1;
		$('.row_tombol').hide();
		var tmb = '<tr class="row_tambah"><td>Label <span class="no_label">'+ya+'</span></td><td colspan=3>';
		tmb = tmb +'<input type="text" id="baru" name="baru" value="" class="ipt_text" style="width:400px;float:left;">';
		tmb = tmb +'<div class="btn btn-warning btn-xs" onClick="jadi('+ya+');" style="margin-left:10px;float:left;">OK</div>';
		tmb = tmb +'<div class="btn btn-warning btn-xs" onClick="gajadi();" style="margin-left:5px;float:left;">Batal</div></td></tr>';
		$(tmb).insertBefore('.row_tombol');
	}
	function gajadi(){
		$('.row_tombol').show();
		$('.row_tambah').remove();
	}
	function jadi(ya){
		var isi = $('#baru').val();
		if(isi==""){
			alert("Nama Label Baru harus diisi!!");
		} else {
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>cmskonten/direktori/tambah_atribut_aksi/",
				data:{"label": isi, "urutan": ya, "idd":<?=$idd;?>},
				beforeSend:function(){	 },
				success:function(data){
					loadForm3('formeditkategori','<?=$idd;?>','kategori');	
					
				}, 
		        dataType:"html"});


		} // end if
	}

function urut_atr(id_ini,urutan_ini,id_lawan,urutan_lawan){
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>cmskonten/direktori/reurut_atribut",
		beforeSend:function(){	 },
		data:{"id_ini": id_ini, "urutan_ini": urutan_ini, "id_lawan": id_lawan, "urutan_lawan": urutan_lawan},
		success:function(data){	
//			loadForm('formeditkategori/tidak','<?=$idd;?>');	
			loadForm3('formeditkategori/tidak','<?=$idd;?>','kategori');	
		}, 
	dataType:"html"});
}
	function hapus_atr(id_ini){
		$("<div id='dialog-loadC'  style=\"text-align:center\"></div>").appendTo("body");
			var isian = '<div class="tombol_aksi2" onClick="hapus_atr_jadi('+id_ini+');">Hapus</div>';
			isian = isian + '<div class="tombol_aksi2" onClick="loadDialogTutupC();">Batal</div>';
		$('#dialog-loadC').html(isian);
		$("#dialog-loadC").dialog({	autoOpen: false, height: 100, width: 250, modal: true, });
		$(".ui-dialog-titlebar").hide();
		$(".ui-resizable-se").remove();
		$('#dialog-loadC').dialog('open');	
	}
	function loadDialogTutupC(){ 
		$( "#dialog-loadC" ).remove();
		$( "#dialog-loadC" ).dialog( "close" );
	}



function hapus_atr_jadi(id_ini){
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>cmskonten/direktori/hapus_atribut_aksi",
		beforeSend:function(){	 },
		data:{"id_atr": id_ini,"id_kat":<?=$idd;?>},
		success:function(data){	
			loadForm3('formeditkategori/tidak','<?=$idd;?>','kategori');	
			
			loadDialogTutupC();
		}, 
	dataType:"html"});
}

</script>
