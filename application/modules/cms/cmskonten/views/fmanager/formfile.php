<div class="row" id="list_file">
	<div class="col-lg-12">
		<div class="panel panel-success">
			<div class="panel-heading">
			<i class="fa fa-gear fa-fw"></i> <?=str_replace($folder->judul_appe,"<b style='color:#0000FF;'>".$folder->judul_appe."</b>",$path);?>
			<div class="btn btn-warning btn-xs pull-right" onclick="batal();loadIsiGrid(0,0);"><i class="fa fa-close fa-fw"></i></div>
			</div>
			<div class="panel-body">
<div class="btn btn-primary btn-xs" id="uploader2" onClick="uppk('uploader2','stuploader2','negara_peserta');"><i class="fa fa-upload fa-fw"></i> Upload File</div>
<div class="table-responsive" style="padding-top:5px;">
<table class="table table-striped">
	<thead>
        <tr>
          <th width=50>No.</th>
          <th width=50>Aksi</th>
          <th width=300>Nama File</th>
          <th width=100>Tipe File</th>
          <th>Lokasi</th>
		  </tr>
	</thead>
	<tbody>
<?php
if(empty($isi)){	echo "<tr><td colspan=5 align=center>Tidak ada file</td></tr>";	} else {
foreach($isi AS $key=>$val){
?>
        <tr>
          <td><?=($key+1);?></td>
          <td>
<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>
<ul class="dropdown-menu" role="menu">
<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="loadFR('formfile_rename','<?=$path;?>','<?=$val->judul_appe;?>','<?=$val->id_appe;?>');"><i class="fa fa-pencil fa-fw"></i> Rename file</a></li>
<?php if($val->nilai==NULL || $val->nilai==0) { ?>
<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="loadFL('formfile_hapus','<?=$path;?>','<?=$val->judul_appe;?>','<?=$val->id_appe;?>');"><i class="fa fa-trash fa-fw"></i> Hapus file</a></li>
<?php } ?>
</div>
		  </td>
          <td><a href="<?=site_url().$path.$val->judul_appe;?>" target="_blank"><?=$val->judul_appe;?></a></td>
          <td><?=$val->keterangan_appe;?></td>
          <td style="padding:0px;"><input type='text' class='form-control' value='<?=$path.$val->judul_appe;?>'></td>
        </tr>
<?php
}	}
?>
	</tbody>
</table>
</div>
			</div>
		</div>
	</div>
</div>

<div class="row" id="hapus_file" style="display:none;">
	<div class="col-lg-6">
		<div class="panel panel-success">
			<div class="panel-heading">
			 <i class="fa fa-trash fa-fw"></i> FORM HAPUS FILE
			<div class="btn btn-warning btn-xs pull-right" onclick="batal_hapus();"><i class="fa fa-close fa-fw"></i></div>
			</div>
			<div class="panel-body">
<div>File:</div>
<div id='nmFile'></div>
<br><br>
<div class="btn btn-danger" id='btnHapus' onclick=""><i class="fa fa-trash fa-fw"></i> Hapus</div>
<div class="btn btn-default" onclick="batal_hapus();"><i class="fa fa-close fa-fw"></i> Batal</div>
			</div>
		</div>
	</div>
</div>
<div class="row" id="rename_file" style="display:none;">
	<div class="col-lg-6">
		<div class="panel panel-success">
			<div class="panel-heading">
			 FORM RENAME FILE
			<div class="btn btn-warning btn-xs pull-right" onclick="batal_rename();"><i class="fa fa-close fa-fw"></i></div>
			</div>
			<div class="panel-body">
<div>Nama lama:</div>
<div id='nmFileR'></div>
<br>
<div>Nama baru:</div>
<input type="text" name="baruF" id="baruF" class="form-control" placeholder="Nama File Tanpa Ekstensi...">
<br><br>
<div class="btn btn-primary" id='btnRename' onclick=""><i class="fa fa-save fa-fw"></i> Simpan</div>
<div class="btn btn-default" onclick="batal_rename();"><i class="fa fa-close fa-fw"></i> Batal</div>
			</div>
		</div>
	</div>
</div>

<script language="JavaScript" type="text/javascript" src="<?=base_url();?>assets/js/ajaxupload.3.5.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	uppk("uploader2","stuploader2","slider");
});

function uppk(bttn,stts,dokumen){
		var posisi = $('#d_posisi').html();
		var urutan = $('#d_urutan').html();
		var path_kanal = $('#d_path_kanal').html();

		var btnUpload=$('#'+bttn+'') , interval;
		var status=$('#'+stts+'');
		new AjaxUpload(btnUpload, {
			action: '<?=site_url();?>cmskonten/fmanager/saveupload',
			name: 'artikel_file',
			data: { "id_konten":"<?=$idd;?>","id_parent":"<?=$idp;?>","path":"<?=$path;?>"    },
			onSubmit: function(file, ext){
				status.html('');
				 if (! (ext && /^(jpg|png|gif|bmp|jpeg|pdf|xls|xlsx|doc|docx)$/.test(ext))){ 
                    // extension is not allowed 
					status.text('Hanya File dengan ext JPG, PNG or GIF yang dapat diupload !');
					return false;
				}
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
					loadForm('formfile','<?=$idp;?>',<?=$level;?>,'<?=$idp;?>');
				} else{
					status.html(file  + ", gagal di upload ! <br />" + arr_result[1] );					
				}
			}
		});
}

function hapusFL(tujuan,path,file,idd){	
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>cmskonten/fmanager/"+tujuan+"/",
				data:{"idd":idd,"path":path,"file":file },
				success:function(data){
					loadForm('formfile','<?=$idp;?>',<?=$level;?>,'<?=$idp;?>');
					batal_hapus();
				}, 
				dataType:"html"});
}	
function renameFL(tujuan,path,file,idd){
	var isi = $("#baruF").val();
	if(isi==""){ alert("NAMA BARU harus di-ISI!!!");
	} else {
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>cmskonten/fmanager/"+tujuan+"/",
				data:{"idd":idd,"path":path,"file":file,"isi":isi },
				success:function(data){
					loadForm('formfile','<?=$idp;?>',<?=$level;?>,'<?=$idp;?>');
					batal_hapus();
				}, 
				dataType:"html"});
	}
}	
function loadFL(tujuan,path,file,idd){
	$('#list_file').hide();
	$('#hapus_file').show();
	$('#nmFile').html(path+"<b style='color:#f00;'>"+file+"</b>");
	$('#btnHapus').attr('onclick','hapusFL(\''+tujuan+'\',\''+path+'\',\''+file+'\',\''+idd+'\');');
}
function loadFR(tujuan,path,file,idd){
	$('#list_file').hide();
	$('#rename_file').show();
	$('#baruF').val('');
	$('#nmFileR').html("<b style='color:#f00;'>"+file+"</b>");
	$('#btnRename').attr('onclick','renameFL(\''+tujuan+'\',\''+path+'\',\''+file+'\',\''+idd+'\');');
}
function batal_hapus(){
	$('#list_file').show();
	$('#hapus_file').hide();
}
function batal_rename(){
	$('#list_file').show();
	$('#rename_file').hide();
}
</script>
