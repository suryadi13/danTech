<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-success">
			<div class="panel-heading">FORM <?=strtoupper($aksi);?> THEME WEBSITE</div>
			<div class="panel-body">
    <form id="content-form">
    <div style="statussave"></div>
			<div class="table-responsive">
<table class="table table-striped">
        <tr>
          <td width=170>Nama Theme</td>
          <td colspan="3">
		  <input type="text" id="theme_name" name="theme_name" size="70" value="<?=(isset($isi->nama_theme))?$isi->nama_theme:'Wajib diisi';?>" onblur="if(this.value=='') this.value='Wajib diisi';" onfocus="if(this.value=='Wajib diisi') this.value='';" class="form-control" <?=($aksi=="tambah")?"":"disabled";?>>
		  </td>
        </tr>
        <tr>
          <td>Keterangan</td>
          <td colspan="3">
		  <input type="text" id="keterangan" name="keterangan" size="70" value="<?=(isset($isi->keterangan))?$isi->keterangan:'Wajib diisi';?>" onblur="if(this.value=='') this.value='Wajib diisi';" onfocus="if(this.value=='Wajib diisi') this.value='';" class="form-control" <?=(isset($hapus))?"disabled":"";?>>
		  </td>
        </tr>
       <tr >
			<td>&nbsp;</td>
			<td colspan="3">
				<input type="hidden" name="idd" id="idd" value="<?=(isset($idd))?$idd:"";?>">
				<div onclick="simpan();" class='btn btn-<?=(isset($hapus))?"danger":"primary";?> btn-sm' id="btAct"><i class="fa fa-<?=(isset($hapus))?"trash":"save";?> fa-fw"></i> <?=(isset($hapus))?"Hapus":"Simpan";?></div>
				<div onclick="batal();" class='btn btn-default btn-sm'><i class="fa fa-close fa-fw"></i> Batal</div>
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
function validasi_pengikut(opsi){
	var data="";
	var dati="";
			var nnm = $.trim($("#theme_name").val());
			var icn = $.trim($("#icon_theme").val());
			var nnp = $.trim($("#theme_path").val());
			var kket = $.trim($("#keterangan").val());
			data=data+""+nnm+"*"+icn+"*"+nnp+"*"+kket+"**";
			if( nnm =="Wajib diisi"){	dati=dati+"NAMA THEME tidak boleh kosong\n";	}
			if( kket =="Wajib diisi"){	dati=dati+"KETERANGAN tidak boleh kosong\n";	}
	if( dati !=""){
		alert(dati);
		return false;
	} else {return data;}
}
////////////////////////////////////////////////////////////////////////////
	function simpan(){
		var hasil=validasi_pengikut();

		if (hasil!=false) {
			var PENGIKUT = hasil;
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>cmsadmin/theme/<?=(isset($aksi))?$aksi:'tambah';?>_aksi/",
				data:	$("#content-form").serialize(),
				beforeSend:function(){	
						$('#btAct').replaceWith('<span id="btAct"><i class="fa fa-spinner fa-spin fa-2x"></i></span>');
				},
				success:function(data){
						location.reload("<?=site_url();?>admin/module/cmsadmin/theme")								
				},//tutup::success
				dataType:"html"
			});//tutup ajax
		} //tutup if::hasil

	} //tutup::simpan
</script>