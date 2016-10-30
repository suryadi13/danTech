<div class="row">
	<div class="col-lg-12" style="padding-bottom:5px;">
		<div class="btn btn-warning btn-xs pull-right" onClick="kembali();"><i class="fa fa-fast-backward fa-sw"></i> Kembali</div>
	</div><!--/.col-lg-8-->
</div>
<div class="row">
	<div class="col-lg-8">
				<div class="table-responsive">
				<table class="table table-striped">
				<tr>
				  <td width="100">&nbsp</td>
				  <td><small><?=$konten->hari;?>, <?=$konten->tanggal;?> :: <?=$konten->nama_kategori;?></small><div><h4 style="margin-top:0px;"><?=$konten->judul;?></h4></td>
				</tr>
				<tr>
				  <td>&nbsp</td>
				  <td><?=$gambar;?></td>
				</tr>
				<tr id="rUpload">
				  <td>&nbsp;</td>
				  <td>
						<div id="stuploader2" style="float:left; margin:5px 5px 0px 0px; font-weight:800"></div>
						<?php if($dcek=="ada"){ ?>
						<div class="btn btn-danger btn-xs" onClick="hapus_slider_minta();" id="tbl_hapus_artikel_slider"><i class="fa fa-trash fa-sw"></i> Hapus Slider</div>
						<div style="display:none;" id="konfirm_hapus_artikel_slider">
							<div class="btn btn-danger btn-xs" onClick="hapus_artikel_slider_jadi();"><i class="fa fa-trash fa-sw"></i> OK! Hapus Slider</div>
							<div class="btn btn-default btn-xs" onClick="hapus_slider_batal();" id="tbl_hapus_artikel_slider"><i class="fa fa-trash fa-sw"></i> Batal...</div>
						</div>
						<?php } ?>
				  </td>
				</tr>
			  </table>
			  </div>
	</div><!--/.col-lg-8-->
	<div class="col-lg-4">
									  <div class='panel panel-success' id="panel_media">
										<div class='panel-heading'>Koleksi Media</div><!-- /.box-header -->
										<div class='panel-body' style="padding:5px;">
											<div id="tblmedia" class="hdmedia" onclick="bukamedia();"><i class="fa fa-folder fa-fw"></i> assets/media/upload</div>
											<div id="isimedia"></div>
										</div><!--//panel-body-->
									  </div><!--//panel-success-->
									<div style="display:none;" id="id_konten_ini"><?=$idd;?></div>
	</div><!--/.col-lg-8-->
</div>


<script type="text/javascript">
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
		var posisi = $('#d_posisi').html();
		var urutan = $('#d_urutan').html();
		var path_kanal = $('#d_path_kanal').html();
		var id_konten = $('#id_konten_ini').html();

			$.ajax({
				type:"POST",
				url: '<?=site_url();?>widget_artikel_slider/formadmin/saveslider',
				data:{"path":pth,"idd":idd,"id_konten":id_konten},
				beforeSend:function(){	
//					$('#list-gambar').html('<tr><td colspan=8 align=center><i class="fa fa-spinner fa-spin fa-5x"></i></td></tr>');
				},
				success:function(data){
					loadFormCW(path_kanal,posisi,urutan);
				}, // end success
			dataType:"html"}); // end ajax
}
////////////////////////////////////////////////////////////////////////////
function hapus_slider_minta(){	
	$("#tbl_hapus_artikel_slider").hide();
	$("#konfirm_hapus_artikel_slider").show();
}
function hapus_slider_batal(){	
	$("#tbl_hapus_artikel_slider").show();
	$("#konfirm_hapus_artikel_slider").hide();
}
function hapus_artikel_slider_jadi(){	
		var posisi = $('#d_posisi').html();
		var urutan = $('#d_urutan').html();
		var path_kanal = $('#d_path_kanal').html();
		var id_konten = $('#id_konten_ini').html();

			$.ajax({
				type:"POST",
				url:'<?=site_url();?>widget_artikel_slider/formadmin/hapusslider',
				data:{"id_konten": id_konten },
				beforeSend:function(){	 

				},
				success:function(data){
					loadFormCW(path_kanal,posisi,urutan);
				}, 
				dataType:"html"});
}	
</script>
<style>
.hdmedia {	color:#fff; background-color:#ccc; line-height:35px; padding:0px 0px 0px 5px;cursor:pointer;	}
</style>