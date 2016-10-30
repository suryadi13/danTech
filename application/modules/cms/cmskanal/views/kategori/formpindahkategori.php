<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-success">
			<div class="panel-heading">FORM PINDAH KATEGORI</div>
			<div class="panel-body">
<form id="content-form" method="post" action="<?=site_url('cmskanal/kategori/pindahkategori_aksi');?>" enctype="multipart/form-data">
<div class="table-responsive">
<table class="table table-striped">
        <tr bgcolor="#99CCCC">
          <td>Kanal</td>
          <td colspan="3">
					  <select name="kanal_baru" id="kanal_baru"  class="form-control">
					  <option value="<?=$default_kanal->id_item;?>" <?=($default_kanal->id_item==$idd)?"selected":"";?>><?=$default_kanal->nama_item;?></option>
						<?=$kanal;?>
					  </select>
		  </td>
        </tr>
        <tr>
          <td>Komponen</td>
          <td colspan="3"><?=$komponen;?></td>
        </tr>
        <tr>
          <td width="150">Nama Rubrik</td>
          <td colspan="3">
		  <input type="text" id="nama_kategori" name="nama_kategori" class="form-control" value="<?=$nama_kategori;?>" disabled>
		  </td>
        </tr>
        <tr>
          <td>Keterangan</td>
          <td colspan="3">
		  <input type="text" id="keterangan" name="keterangan" class="form-control" value="<?=$keterangan;?>" disabled>
		  </td>
        </tr>
       <tr id="tombol">
			<td>&nbsp;</td>
			<td colspan="3">
				<input type=hidden name='idd' id='idd' value=<?=$idd;?>>
				<input type=hidden name='idd_kanal' id='idd_kanal' value=<?=$id_kanal;?>>
				<div onclick="simpan();" class='btn btn-primary btn-sm' id="btAct"><i class="fa fa-save fa-fw"></i> Simpan</div>
				<div onclick="batal();" class='btn btn-default btn-sm'><i class="fa fa-close fa-fw"></i> Batal...</div>
			</td>
        </tr>
</table>
</div>
</form>
			</div><!--/.panel-body-->
		</div>
	</div>
</div>
<script type="text/javascript">
function simpan(){
			var idb=$('#kanal_baru').val();
			var status= $('#notification-artikel');
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
						loadC('kategori',idb,'kategori');
						loadC('kategori','<?=$id_kanal;?>','kategori');
						batal();
					} else {
						status.html('');
						status.html('<ul><li>' + arr_result[1] + '</li></ul>');
						alert('Data gagal disimpan! \n Lihat pesan diatas form');
					}
			},
			dataType:"html"});
			return false;
}
</script>