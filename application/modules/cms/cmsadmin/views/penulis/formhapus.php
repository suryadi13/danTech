<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-success">
			<div class="panel-heading">FORM HAPUS PENULIS BERITA</div>
			<div class="panel-body">
    <form id="content-form" method="post" action="" enctype="multipart/form-data">
			<div class="table-responsive">
<table class="table table-striped">
        <tr>
          <td width="20%">Nama Penulis</td>
          <td colspan="3">
		  <input type="text" id="nama_penulis" name="nama_penulis" class="form-control ipt_text" value="<?=$isi->nama_item;?>" disabled>
		  </td>
        </tr>
        <tr>
          <td>Keterangan</td>
          <td colspan="3">
		  <input type="text" id="keterangan" name="keterangan" class="form-control ipt_text"  value="<?=$isi->meta_value;?>" disabled>
		  </td>
        </tr>
       <tr >
          <td>&nbsp;</td>
          <td colspan="3">
		  		<input type=hidden id="idd" name="idd" value="<?=$isi->id_item;?>">
				<div onclick="simpan();" class='btn btn-danger btn-sm' id="btAct"><i class="fa fa-trash fa-fw"></i> Hapus</div>
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
			var idd = $.trim($("#idd").val());
			data=data+idd;
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
				url:"<?=base_url();?>cmsadmin/penulis/hapus_aksi/",
				data:{	"nama_user":hasil	},
				beforeSend:function(){	
						$('#btAct').replaceWith('<span id="btAct"><i class="fa fa-spinner fa-spin fa-2x"></i></span>');
				},
				success:function(data){
						if(data=="sukses"){
								gridpagingA("end");
								batal();
						} else {
							alert("Tnput Data Gagal. Coba yang lain..!!")
						}
				},//tutup::success
				dataType:"html"
			});//tutup ajax
		} //tutup if::hasil
	} //tutup::simpan
</script>
