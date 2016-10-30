<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-success">
			<div class="panel-heading">FORM TAMBAH KANAL</div>
			<div class="panel-body">
    <form id="content-form" method="post" action="<?=site_url('cmskanal/kanal/tambahkanal_aksi');?>" enctype="multipart/form-data">
    <div style="statussave"></div>
			<div class="table-responsive">
<table class="table table-striped">
        <tr>
          <td width="150">Nama Kanal</td>
          <td colspan="3">
		  <input type="text" id="nama_kanal" name="nama_kanal"  class="form-control" value="Wajib diisi" onblur="if(this.value=='') this.value='Wajib diisi';" onfocus="if(this.value=='Wajib diisi') this.value='';">
		  </td>
        </tr>
        <tr>
          <td>Keterangan</td>
          <td colspan="3">
		  <input type="text" id="keterangan" name="keterangan"  class="form-control" value="Wajib diisi" onblur="if(this.value=='') this.value='Wajib diisi';" onfocus="if(this.value=='Wajib diisi') this.value='';">
		  </td>
        </tr>
        <tr>
          <td>Tipe</td>
          <td colspan="3">
		  <select name=tipe id=tipe  class="form-control">
		  <option value='biasa' selected>Biasa</option>
		  <option value='liputan'>Liputan</option>
		  </select>
		  </td>
        </tr>
        <tr>
          <td>Theme</td>
          <td colspan="3"><?=$theme;?></td>
        </tr>
       <tr >
			<td>&nbsp;</td>
			<td colspan="3">
				<input type="hidden" name='idparent' value="<?=$idparent;?>" />
				<input type="hidden" name='root' value="<?=$root;?>" />
				<input type="hidden" name='level' value="<?=$level;?>" />
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
					location.reload();
			},
			dataType:"html"});
			return false;
	} //endif Hasil
}
////////////////////////////////////////////////////////////////////////////
function validasi_pengikut(opsi){
	var data="";
	var dati="";
			var nama = $.trim($("#nama_kanal").val());
			var kket = $.trim($("#keterangan").val());
			data=data+""+nama+"*"+kket+"**";
			if( nama =="Wajib diisi"){	dati=dati+"NAMA KANAL tidak boleh kosong\n";	}
			if( kket =="Wajib diisi"){	dati=dati+"KETERANGAN tidak boleh kosong\n";	}
	if( dati !=""){
		alert(dati);
		return false;
	} else {return data;}
}
</script>