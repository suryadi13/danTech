<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-danger">
			<div class="panel-heading">FORM HAPUS KANAL</div>
			<div class="panel-body">
    <form id="content-form" method="post" action="<?=site_url('cmskanal/kanal/hapuskanal_aksi');?>" enctype="multipart/form-data">
    <div style="statussave"></div>
			<div class="table-responsive">
<table class="table table-striped">
        <tr>
          <td width="150">Nama Kanal</td>
          <td colspan="3">
		  <input type="text" id="nama_kanal" name="nama_kanal"  class="form-control" value="<?=$kanal->nama_kanal;?>" disabled>
		  </td>
        </tr>
        <tr>
          <td>Keterangan</td>
          <td colspan="3">
		  <input type="text" id="keterangan" name="keterangan"  class="form-control"  value="<?=$kanal->keterangan;?>" disabled>
		  </td>
        </tr>
        <tr>
          <td>Tipe</td>
          <td colspan="3">
		  <select name=tipe id=tipe  class="form-control" disabled>
		  <option value='biasa' <?=($kanal->keterangan=="biasa")?"selected":"";?>>Biasa</option>
		  <option value='liputan' <?=($kanal->keterangan=="liputan")?"selected":"";?>>Liputan</option>
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
				<input type="hidden" name='idk' value="<?=$kanal->id_kanal;?>" />
				<input type="hidden" name='id_parent' value="<?=$id_parent;?>" />
				<input type="hidden" name='level' value="<?=$level;?>" />
				<div onclick="simpan();" class='btn btn-danger btn-sm' id="btAct"><i class="fa fa-save fa-fw"></i> Hapus</div>
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
}
</script>