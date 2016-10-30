<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-warning">
			<div class="panel-heading">
			<div style="display:none;" id="id_konten_ini"><?=$id_konten;?></div>
			GAMBAR KONTEN
			<div class="btn btn-warning btn-xs pull-right" onClick="kembali();"><i class="fa fa-close fa-sw"></i></div>
			</div>
			<div class="panel-body">
					<div class="row">
						<div class="col-lg-8">
									<div><h4><?=$ini->nama_kategori;?></h4></div>
									<div class="table-responsive" id="list_foto">
									<table class="table table-striped table-hover" width=800>
										<thead>
											<tr>
												<th width=40>AKSI</th>
												<th width=100>GAMBAR</th>
												<th>LINK</th>
											</tr>
										</thead>
									<tbody id="list-gambar"><?=$isi;?></tbody>
									</table>
									</div><!-- table-responsive --->

									  <div class='panel panel-danger' id="panel_foto" style="display:none;">
										<div class='panel-heading'>
											Hapus gambar
											<div class="btn btn-warning btn-xs pull-right" onclick="batal_hapus_foto();"><i class="fa fa-close fa-fw"></i></div>
										</div><!-- /.box-header -->
										<div class='panel-body' style="padding:5px;">
											<div style="display:none;" id="id_media"></div>
											<div id="ini_foto"></div>
											<div style="padding-top:10px;">
												<div class="btn btn-danger btn-sm" onclick="ok_hapus_foto();"><i class="fa fa-trash fa-fw"></i> Hapus</div>
												<div class="btn btn-default btn-sm" onclick="batal_hapus_foto();"><i class="fa fa-close fa-fw"></i> Batal...</div>
											</div>
										</div><!--//panel-body-->
									  </div><!--//panel-success-->


						</div><!-- /.col-lg-8 -->
						<div class="col-lg-4">
									  <div class='panel panel-success' id="panel_media">
										<div class='panel-heading'>Koleksi Media</div><!-- /.box-header -->
										<div class='panel-body' style="padding:5px;">
											<div id="tblmedia" class="hdmedia" onclick="bukamedia();"><i class="fa fa-folder fa-fw"></i> assets/media/upload</div>
											<div id="isimedia"></div>
										</div><!--//panel-body-->
									  </div><!--//panel-success-->
						</div><!-- /.col-lg-4 -->
					</div><!-- /.row -->
			</div><!-- /.PANEL-BODY -->
		</div><!-- /.PANEL -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<script type="text/javascript">
function kembali(){
	$('#appe_post').hide();
	$('.content_post').show();
	var ss = $("#pagingA #inputpaging").val();
	gridpagingA(1);
}
function bukamedia(){
		$.ajax({
        type:"POST",
		url:"<?=site_url();?>cmskonten/fmanager/pickmedia/",
		beforeSend:function(){	
			$('#isimedia').html('<i class="fa fa-spinner fa-spin fa-2x"></i>');
		},
        success:function(data){
			$('#tblmedia').removeAttr('onclick').attr('onclick','tutupmedia();').html('<i class="fa fa-folder-open fa-fw"></i> assets/media/upload');
			$('#isimedia').html(data);
		},
        dataType:"html"});
}
function tutupmedia(){
		$('#tblmedia').removeAttr('onclick').attr('onclick','bukamedia();').html('<i class="fa fa-folder fa-fw"></i> assets/media/upload');
		$('#isimedia').html('');
}
function pilih_ini(idd,pth){
var id_konten = $('#id_konten_ini').html();
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>cmskonten/artikel/banner_insert",
				data:{"path":pth,"idd":idd,"id_konten":id_konten},
				beforeSend:function(){	
					$('#list-gambar').html('<tr><td colspan=8 align=center><i class="fa fa-spinner fa-spin fa-5x"></i></td></tr>');
				},
				success:function(data){
					$('#list-gambar').html(data);
				}, // end success
			dataType:"html"}); // end ajax
}
////////////////////////////////////////////////////////////////////////////
function hapus_foto(idd){
	var fotonya = $("#kolom_foto_"+idd).html();
	$("#panel_media").hide();	
	$("#list_foto").hide();	
	$("#panel_foto").show();	
	$("#ini_foto").html(fotonya);
	$("#id_media").html(idd);
}
function batal_hapus_foto(){
	$("#panel_media").show();	
	$("#panel_foto").hide();	
	$("#ini_foto").html();	
	$("#list_foto").show();	
	$("#id_media").html('');
}
function ok_hapus_foto(idd){
var id_konten = $('#id_konten_ini').html();
var idd = $('#id_media').html();
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>cmskonten/artikel/banner_hapus",
				data:{"idd":idd,"id_konten":id_konten},
				beforeSend:function(){	
					batal_hapus_foto();
					$('#list-gambar').html('<tr><td colspan=8 align=center><i class="fa fa-spinner fa-spin fa-5x"></i></td></tr>');
				},
				success:function(data){
					$('#list-gambar').html(data);
				}, // end success
			dataType:"html"}); // end ajax
}
function urutan_foto(id_ini,urutan_ini,id_lawan,urutan_lawan){
var id_konten = $('#id_konten_ini').html();
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>cmskonten/artikel/banner_urutan",
				data:{"id_konten":id_konten,"id_ini":id_ini,"urutan_ini":urutan_ini,"id_lawan":id_lawan,"urutan_lawan":urutan_lawan},
				beforeSend:function(){	
					$('#list-gambar').html('<tr><td colspan=8 align=center><i class="fa fa-spinner fa-spin fa-5x"></i></td></tr>');
				},
				success:function(data){
					$('#list-gambar').html(data);
				}, // end success
			dataType:"html"}); // end ajax
}
////////////////////////////////////////////////////////////////////////////
function edit_judul_appe(idd,kolom){
	var isi_judul = $('#judul_appe_'+idd).text();
	if(isi_judul=="..."){	var val_judul = "";	} else {	var val_judul = isi_judul;	}
	$('#judul_appe_'+idd).replaceWith('<input type="text" class="form-control" value="'+val_judul+'" onblur="satuket('+idd+',\''+kolom+'\');" id="isian_judul_appe_'+idd+'">');
	$('#isian_judul_appe_'+idd).focus();
}
function satuket(idd,kolom){
	var ii_judul = $('#isian_judul_appe_'+idd).val();
	if(ii_judul==""){	var isi_judul="...";	} else {	var isi_judul=ii_judul;	}
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>cmskonten/artikel/banner_link_aksi",
				data:{"isian":isi_judul,"idd":idd,"kolom":kolom},
				beforeSend:function(){	
					$('#isian_judul_appe_'+idd).replaceWith('<div id="bener_judul_appe_'+idd+'"><i class="fa fa-spinner fa-spin fa-2x"></i></div>');
				},
				success:function(data){
					$('#bener_judul_appe_'+idd).replaceWith('<div id="judul_appe_'+idd+'" onclick="edit_judul_appe('+idd+',\''+kolom+'\');">'+isi_judul+'</div>');
				}, // end success
			dataType:"html"}); // end ajax
}
</script>
<style>
.hdmedia {	color:#fff; background-color:#ccc; line-height:35px; padding:0px 0px 0px 5px;cursor:pointer;	}
</style>