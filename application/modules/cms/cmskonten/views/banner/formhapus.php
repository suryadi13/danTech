<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header">BANNER</h3>
	</div>
	<!-- /.col-lg-12 -->
</div>

          <div class='row'>
            <div class='col-md-12'>
              <div class='panel panel-danger'>
                <div class='panel-heading'>
                  <b>FORM HAPUS ALBUM BANNER</b>
				  <div class="btn btn-warning btn-xs pull-right" onclick="batal(); return false;"><i class="fa fa-close fa-fw"></i></div>
                </div><!-- /.box-header -->
                <div class='panel-body'>


    <form id="content-form" method="post" action="<?=site_url();?>cmskonten/banner/hapus_aksi" enctype="multipart/form-data">
			<div class="table-responsive">
<table class="table table-striped">
        <tr>
          <td width="20%">Nama Album</td>
          <td colspan="3">
		  <input type="text" id="nama_kategori" name="nama_kategori" class="form-control" value="<?=@$hslquery->nama_kategori;?>" disabled>
		  </td>
        </tr>
        <tr>
          <td>Keterangan</td>
          <td colspan="3">
		  <input type="text" id="keterangan" name="keterangan" class="form-control" value="<?=@$hslquery->keterangan;?>" disabled>
		  </td>
        </tr>
       <tr >
			<td>&nbsp;</td>
			<td colspan="3">
				<input type="hidden" name=idd value='<?=$idd;?>'/>
					<div class="btn btn-danger btn-xl" onclick="simpan(); return false;" id="btAct"><i class="fa fa-trash fa-fw"></i> Hapus</div>
					<div class="btn btn-warning btn-xl" onclick="batal();"><i class="fa fa-close fa-fw"></i> Batal...</div>
			</td>
        </tr>
</table>
		</div>
                  </form>



                </div>
              </div><!-- /.box -->
			</div>
		  </div>
<form id="sb_act" method="post"></form>
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
					var arr_result = data.split("#");
					if(arr_result[0]=='sukses'){
						batal();
					} else {
						alert('Data gagal disimpan! \n Lihat pesan diatas form');
					}
			},
			dataType:"html"});
			return false;
}
////////////////////////////////////////////////////////////////////////////
function batal(){
	$('#sb_act').attr('action','<?=site_url();?>admin/module/cmskonten/banner');
	var tab = '<input type="hidden" name="cari" value="<?=$cari;?>">';
	var tab = tab + '<input type="hidden" name="batas" value="<?=$batas;?>">';
	var tab = tab + '<input type="hidden" name="hal" value="<?=$hal;?>">';	
	$('#sb_act').html(tab).submit();
}
</script>