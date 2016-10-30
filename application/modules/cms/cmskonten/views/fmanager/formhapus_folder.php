<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-success">
			<div class="panel-heading">FORM HAPUS FOLDER</div>
			<div class="panel-body">
    <form>
    <div style="statussave"></div>
			<div class="table-responsive">
<table class="table table-striped">
        <tr>
          <td width=170>Nama Folder</td>
          <td colspan="3">
		  <input type="text" id="folder_name" name="folder_name" value="<?=$isi->judul_appe;?>" class="form-control" disabled>
		  </td>
        </tr>
        <tr>
          <td>Keterangan</td>
          <td colspan="3">
		  <input type="text" id="keterangan" name="keterangan" value="<?=$isi->keterangan_appe;?>" class="form-control" disabled>
		  </td>
        </tr>
       <tr >
			<td>&nbsp;</td>
			<td colspan="3">
				<div onclick="hapus_folder();" class='btn btn-danger btn-sm'><i class="fa fa-trash fa-fw"></i> Hapus</div>
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
	function hapus_folder(){
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>cmskonten/fmanager/hapus_folder_aksi/",
				data:{	"idparent":"<?=$idp;?>"	},
				success:function(data){
					location.reload();
				},//tutup::success
				dataType:"html"
			});//tutup ajax
	} //tutup::simpan
</script>