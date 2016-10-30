<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-success">
			<div class="panel-heading">FORM EDIT PENGGUNA</div>
			<div class="panel-body">
    <form id="content-form" method="post" action="" enctype="multipart/form-data">
			<div class="table-responsive">
<table class="table table-striped">
        <tr>
          <td width="20%">Nama Pengguna</td>
          <td colspan="3">
		  <input type="text" id="nm_pengguna" name="nm_pengguna" class="form-control ipt_text" value="<?=$hslquery[0]->nama_user;?>" onblur="if(this.value=='') this.value='Wajib diisi';" onfocus="if(this.value=='Wajib diisi') this.value='';">
		  </td>
        </tr>
        <tr>
          <td>Username</td>
          <td colspan="3">
		  <input type="text" id="user_name" name="user_name" class="form-control ipt_text" value="<?=$hslquery[0]->username;?>" onblur="if(this.value=='') this.value='Wajib diisi';" onfocus="if(this.value=='Wajib diisi') this.value='';">
		  </td>
        </tr>
        <tr>
          <td>Grup Pengguna</td>
          <td colspan="3">
		  <select id='group_id' name='gorup_id' class="form-control ipt_text">
		  	<option value="">-- Pilih --</option>
			<?php
			foreach($hslqueryb as $key=>$val){
				if($val->group_id==$hslquery[0]->group_id){
					echo "<option value='".$val->group_id."' selected id='gr_".$val->group_id."'>".$val->group_name."</option>";
				} else {
					echo "<option value='".$val->group_id."' id='gr_".$val->group_id."'>".$val->group_name."</option>";
				}
			}
			?>  
		  </select>
		  </td>
       <tr >
          <td>&nbsp;</td>
          <td colspan="3">
				<input type="hidden" name='user_id' id='user_id' value='<?=$user_id;?>'>
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
			var user_id = $("#user_id").val();
			$.ajax({
				type:"POST",
				url:"<?=base_url();?>cmsadmin/user/edit_aksi/",
				data:{	"user_id":user_id, "nama_user":hasil	},
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
	function langsung(){
			var user_id = $("#user_id").val();
			var nnm = $.trim($("#nm_pengguna").val());
			var icn = $.trim($("#user_name").val());
			var nnp = $.trim($("#group_id").val());
			var nnk = $("#gr_"+nnp+"").html();
		$( "#nm_pengguna_"+user_id+"" ).html(nnm);
		$( "#user_name_"+user_id+"" ).html(icn);
		$( "#group_name_"+user_id+"" ).html(nnk);
	}
</script>
