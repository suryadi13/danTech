<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-success">
			<div class="panel-heading">FORM EDIT GRUP PENGGUNA</div>
			<div class="panel-body">
    <form id="content-form" method="post" action="<?=site_url('cmsadmin/user/edit_group_aksi');?>" enctype="multipart/form-data">
    <div style="statussave"></div>
			<div class="table-responsive">
<table class="table table-striped">
        <tr>
          <td width="20%">Nama Grup Pengguna</td>
          <td colspan="3">
		  <input type="text" id="nama_grup" name="nama_grup"  class="form-control" value="<?=$group_name;?>" onblur="if(this.value=='') this.value='Wajib diisi';" onfocus="if(this.value=='Wajib diisi') this.value='';">
		  </td>
        </tr>
        <tr>
          <td>Theme</td>
          <td colspan="3"><?=$theme;?></td>
        </tr>
        <tr>
          <td>Back Office</td>
          <td colspan="3"><b>admin</b><input type="hidden" id="backoffice" name="backoffice" value="admin"></td>
        </tr>
        <tr>
          <td>Judul aplikasi</td>
          <td colspan="3">
		  <input type="text" id="judul_app" name="judul_app"  class="form-control" value="<?=$judul_app;?>" onblur="if(this.value=='') this.value='Wajib diisi';" onfocus="if(this.value=='Wajib diisi') this.value='';">
		  </td>
        </tr>
        <tr>
          <td>Sub judul</td>
          <td colspan="3">
		  <input type="text" id="sub_judul" name="sub_judul"  class="form-control" value="<?=$sub_judul;?>" onblur="if(this.value=='') this.value='Wajib diisi';" onfocus="if(this.value=='Wajib diisi') this.value='';">
		  </td>
        </tr>
        <tr>
          <td>Keterangan</td>
          <td colspan="3">
		  <input type="text" id="keterangan" name="keterangan"  class="form-control" value="<?=$keterangan;?>" onblur="if(this.value=='') this.value='Wajib diisi';" onfocus="if(this.value=='Wajib diisi') this.value='';">
		  </td>
        </tr>
        <tr>
          <td>Alert</td>
          <td colspan="3">
		  <?=form_dropdown('alertafter',$pil_alertafter,(!isset($alertafter))?'':$alertafter,(isset($hapus))?'id="alertafter" class="form-control" style="padding-left:2px; padding-right:2px; float:left;" disabled':'id="alertafter" class="form-control" style="padding-left:2px; padding-right:2px; float:left;"');?>
		  </td>
        </tr>
        <tr>
          <td>Logout</td>
          <td colspan="3">
		  <?=form_dropdown('logoutafter',$pil_logoutafter,(!isset($logoutafter))?'':$logoutafter,(isset($hapus))?'id="logoutafter" class="form-control" style="padding-left:2px; padding-right:2px; float:left;" disabled':'id="logoutafter" class="form-control" style="padding-left:2px; padding-right:2px; float:left;"');?>
		  </td>
        </tr>
       <tr >
			<td>&nbsp;</td>
			<td colspan="3">
				<input type="hidden" name=idd value="<?=$group_id;?>"/>
				<div onclick="simpan();" class='btn btn-primary btn-sm' id="btAct"><i class="fa fa-save fa-fw"></i> Simpan</div>
				<div onclick="batal();" class='btn btn-default btn-sm'><i class="fa fa-close fa-fw"></i> Batal...</div>
			</td>
        </tr>
</table>
		</div>
	</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
////////////////////////////////////////////////////////////////////////////
function simpan(){
	var hasil=validasi_pengikut();
	if (hasil!=false) {
			$.ajax({
			type:"POST",
			url: $("#content-form").attr('action'),
			data:	$("#content-form").serialize(),
			beforeSend:function(){	
					$('#btAct').replaceWith('<span id="btAct"><i class="fa fa-spinner fa-spin fa-2x"></i></span>');
			},
			success:function(data){
					var arr_result = data.split("#");
					if(arr_result[0]=='sukses'){
						batal();
						loadIsiGrid();
					}else{
						var status=arr_result[1];
						alert('Data gagal disimpan! \n '+status+'');
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
			var nama = $.trim($("#nama_grup").val());
			var nmsc = $.trim($("#nama_section").val());
			var bbck = $.trim($("#backoffice").val());
			var kket = $.trim($("#keterangan").val());
			data=data+""+nama+"*"+kket+"**";
			if( nama =="Wajib diisi"){	dati=dati+"NAMA GROUP tidak boleh kosong\n";	}
			if( nmsc =="Wajib diisi"){	dati=dati+"NAMA SECTION tidak boleh kosong\n";	}
			if( bbck =="Wajib diisi"){	dati=dati+"BACK OFFICE tidak boleh kosong\n";	}
			if( kket =="Wajib diisi"){	dati=dati+"KETERANGAN tidak boleh kosong\n";	}
	if( dati !=""){
		alert(dati);
		return false;
	} else {return data;}
}
</script>