<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-success">
			<div class="panel-heading">FORM TAMBAH JENIS WIDGET</div>
			<div class="panel-body">
    <form id="content-form" method="post" action="" enctype="multipart/form-data">
			<div class="table-responsive">
<table class="table table-striped">
        <tr>
          <td width="20%">Nama Jenis Widget</td>
          <td colspan="3">
		  <input type="text" id="nama_widget" name="nama_widget" class="form-control pt_text" value="Wajib diisi" onblur="if(this.value=='') this.value='Wajib diisi';" onfocus="if(this.value=='Wajib diisi') this.value='';">
		  </td>
        </tr>
        <tr>
          <td>Keterangan</td>
          <td colspan="3">
		  <input type="text" id="keterangan" name="keterangan" class="form-control pt_text"  value="Wajib diisi" onblur="if(this.value=='') this.value='Wajib diisi';" onfocus="if(this.value=='Wajib diisi') this.value='';">
		  </td>
        </tr>
        <tr>
          <td>Lokasi Jenis Widget</td>
          <td colspan="3">
		  <select name="lokasi" id="lokasi" class="form-control pt_text">
		  <?=$pil;?>
		  </select>
		  </td>
        </tr>
       <tr >
          <td>&nbsp;</td>
          <td colspan="3">
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
function validasi_tambah(){
	var data="";
	var dati="";
			var nnm = $.trim($("#nama_widget").val());
			var icn = $.trim($("#keterangan").val());
			var lok = $.trim($("#lokasi").val());
			data=data+""+nnm+"*"+icn+"*"+lok;
			if( nnm =="Wajib diisi"){	dati=dati+"NAMA JENIS WIDGET tidak boleh kosong\n";	}
			if( icn =="Wajib diisi"){	dati=dati+"KETERANGAN tidak boleh kosong\n";	}
	if( dati !=""){
		alert(dati);
		return false;
	} else {return data;}
}
////////////////////////////////////////////////////////////////////////////
	function simpan(){
		var hasil=validasi_tambah();
		if (hasil!=false) {
			$.ajax({
				type:"POST",
				url:"<?=base_url();?>cmsadmin/widget/tambah_aksi/",
				data:{	"nama_user":hasil	},
				beforeSend:function(){	
						$('#btAct').replaceWith('<span id="btAct"><i class="fa fa-spinner fa-spin fa-2x"></i></span>');
				},
				success:function(data){
						if(data=="sukses"){
							location.reload("<?=site_url();?>admin/module/cmsadmin/widget")								
						} else {
							alert("Tnput Data Gagal. Coba yang lain..!!")
						}
				},//tutup::success
				dataType:"html"
			});//tutup ajax
		} //tutup if::hasil
	} //tutup::simpan
</script>
