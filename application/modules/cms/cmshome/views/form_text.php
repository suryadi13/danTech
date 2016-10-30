<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-success">
			<div class="panel-heading">FORM IDENTITAS APLIKASI</div>
			<div class="panel-body">
    <form id="content-form" method="post" action="<?=site_url('cmshome/edit_text_aksi');?>" enctype="multipart/form-data">
				<div class="table-responsive">
				<table class="table table-striped">
				<tr>
				  <td width="150"><?=$label;?></td>
				  <td colspan="3"><input type="text" id="nama_kategori" name="nama_kategori" class="form-control" value="<?=$nilai;?>" onblur="if(this.value=='') this.value='Wajib diisi';" onfocus="if(this.value=='Wajib diisi') this.value='';"></td>
				</tr>
			   <tr id="tombol">
					<td>&nbsp;</td>
					<td colspan="3">
						<input type="hidden" name="idd" value="<?=$idd;?>">
						<div class="btn btn-primary btn-sm" onclick="simpan();" id="btAct"><i class="fa fa-save fa-fw"></i> Simpan</div>
						<div class="btn btn-default btn-sm" onclick="batal();"><i class="fa fa-close fa-fw"></i> Batal...</div>
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
			var status= $('#notification-artikel');
			var interval;
			$.ajax({
			type:"POST",
			url: $("#content-form").attr('action'),
			data:	$("#content-form").serialize(),
			beforeSend:function(){	
					$('#btAct').replaceWith('<span id="btAct"><i class="fa fa-spinner fa-spin fa-2x"></i></span>');
			},
			success:function(data){
					var arr_result = data.split("#");
					//alert(data);
					if(arr_result[0]=='sukses'){
						location.reload();
					} else {
						status.html('');
						status.html('<ul><li>' + arr_result[1] + '</li></ul>');
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
			var nama = $.trim($("#nama_kategori").val());
			data=data+""+nama+"**";
			if( nama =="Wajib diisi"){	dati=dati+"<?=strtoupper($label);?> tidak boleh kosong\n";	}
	if( dati !=""){
		alert(dati);
		return false;
	} else {return data;}
}
</script>