<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header">Direktori</h3>
	</div>
	<!-- /.col-lg-12 -->
</div>

          <div class='row'>
            <div class='col-md-12'>
              <div class='panel panel-info'>
                <div class='panel-heading'>
                  <b>FORM TAMBAH ITEM DIREKTORI</b>
				  <div class="btn btn-warning btn-xs pull-right" onclick="batal(); return false;"><i class="fa fa-close fa-fw"></i></div>
                </div><!-- /.box-header -->
                <div class='panel-body'>


    <form id="content-form" method="post" action="<?=site_url();?>cmskonten/direktori/tambah_aksi" enctype="multipart/form-data">
			<div class="table-responsive">
<table class="table table-striped">
        <tr bgcolor="#99CCCC">
          <td>Kategori</td>
          <td colspan="3"><?=$pilrb;?></td>
        </tr>
        <tr>
          <td>Nama Item Direktori</td>
          <td colspan="3">
		  <input type="text" id="nama_direktori" name="nama_direktori"  class="form-control" onblur="if(this.value=='') this.value='Wajib diisi';" onfocus="if(this.value=='Wajib diisi') this.value='';">
		  </td>
        </tr>
<?php
$urutan=1;
foreach($atribut as $key=>$val){
?>
        <tr>
          <td  id='label_atribut_<?=$urutan;?>'><?=$val->judul_appe;?></td>
          <td colspan="3">
		  <input type="text" id='isi_atribut_<?=$urutan;?>' name="isi_atribut[]" class="form-control" onblur="if(this.value=='') this.value='Wajib diisi';" onfocus="if(this.value=='Wajib diisi') this.value='';">
		  <input type='hidden' id='label_<?=$urutan;?>'  name="label[]" value="<?=$val->id_appe;?>">
		  <input type='hidden' id='no_atribut_<?=$urutan;?>'  value="<?=$urutan;?>">
		  </td>
        </tr>
<?php
$urutan++;
}
?>
       <tr >
			<td>&nbsp;</td>
			<td colspan="3">
					<div class="btn btn-success btn-xl" onclick="simpan(); return false;" id="btAct"><i class="fa fa-save fa-fw"></i> Simpan</div>
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
			$.ajax({
			type:"POST",
			url:	$("#content-form").attr('action'),
			data:$("#content-form").serialize(),
			beforeSend:function(){	
				$('#btAct').replaceWith('<span id="btAct"><i class="fa fa-spinner fa-spin fa-2x"></i></span>');
			},
			success:function(data){
					var arr_result = data.split("#");
					if(arr_result[0]=='sukses'){
						batal();
					} else {
						alert('Data gagal disimpan! \n Lihat pesan diatas form');
					}
			},
			dataType:"html"});
			return false;
	} //endif Hasil
}
////////////////////////////////////////////////////////////////////////////
function validasi_pengikut(opsi){
	var data="";
	var dati="";
		var nama = $("#nama_direktori").val();
		data=data+nama;
		if( nama =="Wajib diisi"){	dati=dati+"NAMA ITEM DIREKTORI tidak boleh kosong\n";	}
		$("[id^='no_atribut_']").each(function(index,item) {
			var idx = item.value;
			var jdl_nm = $("#label_atribut_"+idx+"").html();
			var jdl = $("#isi_atribut_"+idx+"").val();
			data=data+jdl;
			if( jdl =="Wajib diisi"){	dati=dati+jdl_nm+" tidak boleh kosong\n";	}
		});
	if( dati !=""){
		alert(dati);
		return false;
	} else {return data;}
}
function batal(){
	$('#sb_act').attr('action','<?=site_url();?>admin/module/cmskonten/direktori');
	var tab = '<input type="hidden" name="cari" value="<?=$cari;?>">';
	var tab = tab + '<input type="hidden" name="batas" value="<?=$batas;?>">';
	var tab = tab + '<input type="hidden" name="hal" value="<?=$hal;?>">';	
	var tab = tab + '<input type="hidden" name="id_kat" value="<?=$id_kat;?>">';
	$('#sb_act').html(tab).submit();
}
</script>