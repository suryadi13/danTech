<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-success">
			<div class="panel-heading">FORM EDIT FOLDER</div>
			<div class="panel-body">
    <form>
    <div style="statussave"></div>
			<div class="table-responsive">
<table class="table table-striped">
        <tr>
          <td width=170>Nama Folder</td>
          <td colspan="3">
		  <input type="text" id="folder_name" name="folder_name" value="<?=$isi->judul_appe;?>" onblur="if(this.value=='') this.value='Wajib diisi';" onfocus="if(this.value=='Wajib diisi') this.value='';" class="form-control">
		  </td>
        </tr>
        <tr>
          <td>Keterangan</td>
          <td colspan="3">
		  <input type="text" id="keterangan" name="keterangan" value="<?=$isi->keterangan_appe;?>" onblur="if(this.value=='') this.value='Wajib diisi';" onfocus="if(this.value=='Wajib diisi') this.value='';" class="form-control">
		  </td>
        </tr>
       <tr >
			<td>&nbsp;</td>
			<td colspan="3">
				<div onclick="simpan();" class='btn btn-primary btn-sm'><i class="fa fa-save fa-fw"></i> Simpan</div>
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
			var nnm = $.trim($("#folder_name").val());
			var kket = $.trim($("#keterangan").val());
			data=data+""+nnm+"*"+kket+"**";
			if( nnm =="Wajib diisi"){	dati=dati+"NAMA FOLDER tidak boleh kosong\n";	}
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
				url:"<?=site_url();?>cmskonten/fmanager/edit_folder_aksi/",
				data:{	"idparent":"<?=$idp;?>","nama_folder":hasil	},
				success:function(data){
					loadIsiGrid(0,0);
					batal();
				},//tutup::success
				dataType:"html"
			});//tutup ajax
		} //tutup if::hasil

	} //tutup::simpan
</script>