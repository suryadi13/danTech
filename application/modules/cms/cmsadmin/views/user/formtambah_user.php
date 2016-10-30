<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-success">
			<div class="panel-heading">FORM TAMBAH PENGGUNA</div>
			<div class="panel-body">
    <form id="content-form" method="post" action="" enctype="multipart/form-data">
			<div class="table-responsive">
<table class="table table-striped">
        <tr>
          <td width="20%">Nama Pengguna</td>
          <td colspan="3">
		  <input type="text" id="nm_pengguna" name="nm_pengguna" class="form-control ipt_text" value="Wajib diisi" onblur="if(this.value=='') this.value='Wajib diisi';" onfocus="if(this.value=='Wajib diisi') this.value='';">
		  </td>
        </tr>
        <tr>
          <td>Username</td>
          <td colspan="3">
		  <input type="text" id="user_name" name="user_name" class="form-control ipt_text"  value="Wajib diisi" onblur="if(this.value=='') this.value='Wajib diisi';" onfocus="if(this.value=='Wajib diisi') this.value='';">
		  </td>
        </tr>
        <tr>
          <td>Grup Pengguna</td>
          <td colspan="3"><?=$pilgr;?></td>
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
			var nnm = $.trim($("#nm_pengguna").val());
			var icn = $.trim($("#user_name").val());
			var nnp = $.trim($("#group_id").val());
			data=data+""+nnm+"*"+icn+"*"+nnp+"**";
			if( nnm =="Wajib diisi"){	dati=dati+"NAMA PENGGUNA tidak boleh kosong\n";	}
			if( icn =="Wajib diisi"){	dati=dati+"USERNAME tidak boleh kosong\n";	}
			if( nnp ==""){	dati=dati+"GRUP PENGGUNA tidak boleh kosong\n";	}
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
				url:"<?=base_url();?>cmsadmin/user/tambah_aksi/",
				data:{	"nama_user":hasil	},
				beforeSend:function(){	
						$('#btAct').replaceWith('<span id="btAct"><i class="fa fa-spinner fa-spin fa-2x"></i></span>');
				},
				success:function(data){
						if(data=="sukses"){
								gridpagingA("end");
								batal();
						} else {
							alert("Tnput Data Gagal. Coba username lain..!!")
						}
				},//tutup::success
				dataType:"html"
			});//tutup ajax
		} //tutup if::hasil
	} //tutup::simpan
</script>
