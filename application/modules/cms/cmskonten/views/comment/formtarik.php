<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header">Komentar Pengunjung</h3>
	</div>
	<!-- /.col-lg-12 -->
</div>

          <div class='row'>
            <div class='col-md-12'>
              <div class='panel panel-info'>
                <div class='panel-heading'>
                  <b>FORM TURUNKAN KOMENTAR</b>
				  <div class="btn btn-warning btn-xs pull-right" onclick="batal(); return false;"><i class="fa fa-close fa-fw"></i></div>
                </div><!-- /.box-header -->
                <div class='panel-body'>
    <form id="content-form" method="post" action="<?=base_url();?>cmskonten/comment/tarik_aksi" enctype="multipart/form-data">
			<div class="table-responsive">
<table class="table table-striped">
        <tr>
          <td width="150">Komentar</td>
          <td colspan="3">
		  <input type="text" id="isi_komentar" name="isi_komentar" class="form-control" value="<?=@$isi->isi_komentar;?>" disabled>
		  </td>
        </tr>
       <tr >
			<td>&nbsp;</td>
			<td colspan="3">
				<input type=hidden name=id_komentar value='<?=@$isi->id_komentar;?>'>
					<div class="btn btn-danger btn-xl" onclick="simpan(); return false;"><i class="fa fa-download fa-fw"></i> Turunkan</div>
					<div class="btn btn-default btn-xl" onclick="batal();"><i class="fa fa-close fa-fw"></i> Batal...</div>
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
//	loadDialogBuka();
			var interval;
            jQuery.post($("#content-form").attr('action'),$("#content-form").serialize(),function(data){
				var arr_result = data.split("#");
				//alert(data);
                if(arr_result[0]=='sukses'){
					if(arr_result[1] == 'add'){
						jQuery('#back-button').click();
					}
//					gridpaging("end");
					batal();
                } else {
					alert('Data gagal disimpan! \n Lihat pesan diatas form');
                }
//				loadDialogTutup();
            });
			return false;
}
////////////////////////////////////////////////////////////////////////////
function batal(){
	$('#sb_act').attr('action','<?=site_url();?>admin/module/cmskonten/comment');
	var tab = '<input type="hidden" name="cari" value="<?=$cari;?>">';
	var tab = tab + '<input type="hidden" name="batas" value="<?=$batas;?>">';
	var tab = tab + '<input type="hidden" name="hal" value="<?=$hal;?>">';	
	$('#sb_act').html(tab).submit();
}
</script>