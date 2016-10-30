<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-success">
			<div class="panel-heading">FORM IDENTITAS APLIKASI</div>
			<div class="panel-body">
    <form id="content-form" method="post" action="<?=site_url();?>cmsbome/edit_upload" enctype="multipart/form-data">
				<div class="table-responsive">
				<table class="table table-striped">
				<tr>
				  <td width="20%"><?=$label;?></td>
				  <td colspan="3"><img src="<?=base_url();?>assets/media/logo_kanal/<?=$nilai;?>"></td>
				</tr>
				<tr id="rUpload">
				  <td width="20%"><b>Ganti <?=$label;?></b></td>
				  <td colspan="3">
						<input type=hidden name=idd value='<?=$idd;?>'>
		<div id="stuploader" style="float:left; margin:5px 5px 0px 0px; font-weight:800"></div>
		<div id="uploader" class="btn btn-primary btn-xs" onClick="uppl('uploader','stuploader','negara_peserta');"><i class="fa fa-upload fa-fw"></i>  Upload file</div>
		<div class="btn btn-warning btn-xs" onClick="batal();"><i class="fa fa-fast-backward fa-sw"></i> Kembali</div>
				  </td>
				</tr>
			  </table>
	</form>
			</div>
		</div>
	</div>
</div>
<script language="JavaScript" type="text/javascript" src="<?=base_url();?>assets/js/ajaxupload.3.5.js"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
		uppl("uploader","stuploader","negara_peserta");
});

function uppl(bttn,stts,dokumen){	
		var btnUpload=$('#'+bttn+'') , interval;
		var status=$('#'+stts+'');
		new AjaxUpload(btnUpload, {
			action: '<?=site_url();?>cmshome/saveupload',
			name: 'artikel_file',
			data: { "id_kategori": <?=$idd;?>  },
			onSubmit: function(file, ext){
				status.html('');
				 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
                    // extension is not allowed 
					status.text('Hanya File dengan ext JPG, PNG or GIF yang dapat diupload !');
					return false;
				}
				//status.text('Uploading...'); tambahan anim proses
				btnUpload.text('Uploading');
				interval = window.setInterval(function(){
					var text = btnUpload.text();
					if (text.length < 19){
						btnUpload.text(text + '.');					
					} else {
						btnUpload.text('Uploading');				
					}
				}, 200);
			},
			onComplete: function(file, response){
				btnUpload.text("Upload file");
				status.html('');
				window.clearInterval(interval);
				status.text('');
				 var arr_result = response.split("-");
				//Add uploaded file to list
				if(arr_result[0]==="success"){
					status.removeClass('notification-error');
					file = file.replace(/%20/g, "");
					location.reload();
				} else{
					status.html(file  + ", gagal di upload ! <br />" + arr_result[1] );					
				}
			}
		});
}
</script>