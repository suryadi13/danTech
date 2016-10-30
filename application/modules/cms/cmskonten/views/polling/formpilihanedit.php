<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header">POLLING</h3>
	</div>
	<!-- /.col-lg-12 -->
</div>

          <div class='row'>
            <div class='col-md-12'>
              <div class='panel panel-info'>
                <div class='panel-heading'>
                  <b>FORM PENGATURAN PILIHAN POLLING</b>
				  <div class="btn btn-warning btn-xs pull-right" onclick="batal(); return false;"><i class="fa fa-close fa-fw"></i></div>
                </div><!-- /.box-header -->
                <div class='panel-body'>

    <form id="content-form" method="post" action="<?=site_url('cmskonten/polling/edit_pilihan_aksi');?>" enctype="multipart/form-data">
			<div class="table-responsive">
<table class="table table-striped">
<?php
			$i=0;
			$jml = count($pil);
			foreach($pil AS $key=>$val){
?>
				<tr>
				<td>Pilihan <span class="no_label"><?=($key+1);?></span></td>
				<td colspan=3>
				<input type='hidden' id='id_label_<?=($key+1)?>' name='id_label[]' value="<?=$val->id_appe;?>">
				<input type=hidden id=urutan_<?=$val->urutan_appe;?> name=urutan[] value='<?=$val->urutan_appe;?>'>
				<input type="text" id="label_<?=($key+1);?>" name="label[]" value="<?=$val->judul_appe;?>" class="ipt_text" style="width:400px;float:left;">
				<div class="btn btn-default btn-xs" onclick="hapus_atr('<?=$pil[$i]->id_appe;?>');" title='Klik untuk menghapus label' style="float:left;margin-left:5px;"><i class='fa fa-trash fa-fw'></i></div>
				<?php if($i!=0){ ?>
				<div class="btn btn-default btn-xs" onclick="urut_atr('<?=$pil[$i]->id_appe;?>','<?=$pil[$i]->urutan_appe;?>','<?=$pil[($i-1)]->id_appe;?>','<?=$pil[($i-1)]->urutan_appe;?>');" title='Klik untuk menaikkan urutan label' style="float:left;margin-left:5px;"><i class='fa fa-upload fa-fw'></i></div>
				<?php } ?>
				<?php if($i!=($jml-1)){ ?>
				<div class="btn btn-default btn-xs" onclick="urut_atr('<?=$pil[$i]->id_appe;?>','<?=$pil[$i]->urutan_appe;?>','<?=$pil[($i+1)]->id_appe;?>','<?=$pil[($i+1)]->urutan_appe;?>');" title='Klik untuk menurunkan urutan label' style="float:left;margin-left:5px;"><i class='fa fa-download fa-fw'></i></div>
				<?php } ?>
				</td>
				</tr>
<?php
			$i++;
			}
?>
				<tr class="row_tombol">
				<td>&nbsp;</td>
				<td colspan=3><div class="btn btn-warning btn-xs" onClick="tambah_label();"><i class="fa fa-plus fa-fw"></i> Tambah Pilihan</div></td>
				</tr>
			   <tr id="tombol">
					<td>&nbsp;</td>
					<td colspan="3">
						<input type=hidden name='idd' id='idd' value=<?=$idd;?>>
					<div class="btn btn-success btn-xl" onclick="simpan(); return false;"><i class="fa fa-edit fa-fw"></i> Simpan</div>
					<div class="btn btn-warning btn-xl" onclick="batal();"><i class="fa fa-close fa-fw"></i> Batal...</div>
					</td>
				</tr>
</table>
		</div>
                  </form>



                </div>
              </div><!-- /.box -->
			</div>
		  </div>
<form id="sb_act" method="post"></form>
<script type="text/javascript">
function simpan(){
	var hasil=validasi_pengikut();
	if (hasil!=false) {
			var status= $('#notification-artikel');
			var interval;
            jQuery.post($("#content-form").attr('action'),$("#content-form").serialize(),function(data){
				var arr_result = data.split("#");
				//alert(data);
                if(arr_result[0]=='success'){
					if(arr_result[1] == 'add'){
						jQuery('#back-button').click();
					}
//					gopaging();
					batal();
                } else {
					status.html('');
					status.html('<ul><li>' + arr_result[1] + '</li></ul>');
					alert('Data gagal disimpan! \n Lihat pesan diatas form');
                }
            });
			return false;
	} //endif Hasil
}
////////////////////////////////////////////////////////////////////////////
function validasi_pengikut(opsi){
	var data="";
	var dati="";
		$("[id^='urutan']").each(function(index,item) {
			var idx = item.value;
			var jdl = $("#label_"+idx+"").val();
			data=data+jdl;
			if( jdl ==""){	dati=dati+"PILIHAN No."+idx+" tidak boleh kosong\n";	}
		});

	if( data ==""){
		alert("PILIHAN POLLING TIDAK BOLEH KOSONG");
		return false;
	}
	if( dati !=""){
		alert(dati);
		return false;
	} else {return data;}
}

	function tambah_label(){
		var yu = $(".no_label").last().html();
		var ya = parseInt(yu)+1;
		$('.row_tombol').hide();
		var tmb = '<tr class="row_tambah"><td>Pilihan <span class="no_label">'+ya+'</span></td><td colspan=3>';
		tmb = tmb +'<input type="text" id="baru" name="baru" value="" class="ipt_text" style="width:400px;float:left;">';
		tmb = tmb +'<div class="btn btn-primary btn-xs" onClick="jadi('+ya+');" style="margin-left:10px;float:left;">OK</div>';
		tmb = tmb +'<div class="btn btn-default btn-xs" onClick="gajadi();" style="margin-left:5px;float:left;">Batal</div></td></tr>';
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
				url:"<?=site_url();?>cmskonten/polling/tambah_pilihan_satu_aksi/",
				data:{"label": isi, "urutan": ya, "idd":<?=$idd;?>},
//				beforeSend:function(){	loadDialogBuka(); },
				success:function(data){
					loadForm();	
//					gopaging();
//					loadDialogTutup();
				}, 
		        dataType:"html"});
		} // end if
	}

function urut_atr(id_ini,urutan_ini,id_lawan,urutan_lawan){
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>cmskonten/polling/reurut_pilihan",
//		beforeSend:function(){	loadDialogBuka(); },
		data:{"id_ini": id_ini, "urutan_ini": urutan_ini, "id_lawan": id_lawan, "urutan_lawan": urutan_lawan},
		success:function(data){	
			loadForm();	
//			gopaging();
//			loadDialogTutup();
		}, 
	dataType:"html"});
}
function hapus_atr(id_ini){
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>cmskonten/polling/hapus_pilihan_aksi",
//		beforeSend:function(){	loadDialogBuka(); },
		data:{"id_atr": id_ini,"id_kat":<?=$idd;?>},
		success:function(data){	
			loadForm();
//			gopaging();
//			loadDialogTutup();
		}, 
	dataType:"html"});
}
function batal(){
	$('#sb_act').attr('action','<?=site_url();?>admin/module/cmskonten/polling');
	var tab = '<input type="hidden" name="cari" value="<?=$cari;?>">';
	var tab = tab + '<input type="hidden" name="batas" value="<?=$batas;?>">';
	var tab = tab + '<input type="hidden" name="hal" value="<?=$hal;?>">';	
	var tab = tab + '<input type="hidden" name="id_kat" value="<?=$id_kat;?>">';
	$('#sb_act').html(tab).submit();
}
function loadForm(){
	$('#sb_act').attr('action','<?=site_url();?>admin/module/cmskonten/polling/formpilihanedit');
	var tab = '<input type="hidden" name="cari" value="<?=$cari;?>">';
	var tab = tab + '<input type="hidden" name="batas" value="<?=$batas;?>">';
	var tab = tab + '<input type="hidden" name="hal" value="<?=$hal;?>">';	
	var tab = tab + '<input type="hidden" name="id_kat" value="<?=$id_kat;?>">';
	var tab = tab + '<input type="hidden" name="id_konten" value="<?=$idd;?>">';	
	$('#sb_act').html(tab).submit();
}

</script>
