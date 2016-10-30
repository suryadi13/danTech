<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header">Statis</h3>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<form role="form" id="form_tt" action="<?=site_url();?>cmskonten/statis/edit_aksi">
          <div class='row'>
            <div class='col-md-8'>
              <div class='panel panel-info'>
                <div class='panel-heading'>
                  <b>Form <?=$label_aksi;?> Halaman Statis</b>
					<div class="btn btn-warning btn-xs pull-right" onclick="batal(); return false;"><i class="fa fa-close fa-fw"></i></div>
                </div><!-- /.box-header -->
                <div class='panel-body' style="padding:5px;">
					<div class="row"><div class="col-lg-12">
											<div class="form-group">
												<label>Judul:</label>
												<input type='text' id="judul" name="judul" class="form-control" value="<?=$isi->judul;?>">
											</div>
					</div></div><!---/.row.col-lg-12--->
					<div class="row"><div class="col-lg-12">
											<div class="form-group">
												<label>Sub-judul:</label>
												<input type='text' id="sub_judul" name="sub_judul" class="form-control" value="<?=$isi->sub_judul;?>">
											</div>
					</div></div><!---/.row.col-lg-12--->
					<div class="row">
										<div class="col-lg-4">
											<div class="form-group">
												<label>Kanal:</label>
												  <select name="id_kategori" id="id_kategori"  class="form-control">
												  <option value="<?=$default_kanal->id_item;?>" <?=($default_kanal->id_item==$isi->id_kategori)?"selected":"";?>><?=$default_kanal->nama_item;?></option>
													<?=$kategori_options;?>
												  </select>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label>Penulis:</label>
												  <select name="id_penulis" id="id_penulis"  class="form-control">
													<option  value="">--Pilih Penulis--</option>
													<?=$penulis_options;?>
												  </select>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label>Tanggal:</label>
												<input type='text' id="tanggal" name="tanggal" class="form-control" value="<?=$isi->tanggal;?>" placeholder="dd-mm-YYYY">
											</div>
										</div>
					</div><!---/.row.col-lg-12--->
                    <textarea id="isi_konteni" name="isi_konteni" rows="10" cols="80" class="form-control">
                                            <?=htmlentities($isi->isi_konten);?>
                    </textarea>
					
					<div class="row" style="padding-top:15px;"><div class="col-lg-12">
					<input type="hidden" name="komponen" value="artikel">
					<input type="hidden" name="id_konten" value="<?=$id_konten;?>">
					<div class="btn btn-success btn-xl" onclick="simpan(); return false;" id="btAct"><i class="fa fa-save fa-fw"></i> Simpan</div>
					<div class="btn btn-warning btn-xl" onclick="batal();"><i class="fa fa-close fa-fw"></i> Batal...</div>
					</div></div><!---/.row.col-lg-12--->


					</div></div><!---/.row.col-lg-12--->
                </div>
					            <div class='col-md-4'>
									  <div class='panel panel-success'>
										<div class='panel-heading'>Koleksi Media</div><!-- /.box-header -->
										<div class='panel-body' style="padding:5px;">
											<div id="tblmedia" class="hdmedia" onclick="bukamedia();"><i class="fa fa-folder fa-fw"></i> assets/media/upload</div>
											<div id="isimedia"></div>
										</div><!--//panel-body-->
									  </div><!--//panel-success-->
								</div><!-- /.col-md-4 -->
              </div><!-- /.box -->
			</div>
		  </div>
                  </form>



<form id="sb_act" method="post"></form>
<script src="<?=base_url();?>assets/js/plugins/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
$(document).ready(function(){
     CKEDITOR.replace('isi_konteni');
});
function simpan(){
	var data="";
	var dati="";
			var judl = $.trim($("#judul").val());
			var rbrk = $.trim($("#id_kategori").val());
			var tngl = $.trim($("#tanggal").val());
			var pnls = $.trim($("#id_penulis").val());
			data=data+""+judl+"";
			if( judl ==""){	dati=dati+"JUDUL ARTIKEL tidak boleh kosong\n";	}
			if( rbrk ==""){	dati=dati+"KANAL tidak boleh kosong\n";	}
			if( tngl ==""){	dati=dati+"TANGGAL tidak boleh kosong\n";	}
			if( pnls ==""){	dati=dati+"PENULIS tidak boleh kosong\n";	}
	if( dati !=""){
		alert(dati);
		return false;
	} else {	simpan_aksi();	}
}

function simpan_aksi(){
		for ( instance in CKEDITOR.instances ) {
			 CKEDITOR.instances[instance].updateElement();
		}

		$.ajax({
        type:"POST",
		url: $("#form_tt").attr('action'),
		data:	$("#form_tt").serialize(),
		beforeSend:function(){	
			$('#btAct').replaceWith('<span id="btAct"><i class="fa fa-spinner fa-spin fa-2x"></i></span>');
		},
        success:function(data){
					if(data.hasil=="sukses"){
						batal();
						return false;
					} else {
						alert(data.hasil);
						return false;
					}
		},
        dataType:"json"});
}

function batal(){
	$('#sb_act').attr('action','<?=site_url();?>admin/module/cmskonten/statis');
	var tab = '<input type="hidden" name="cari" value="<?=$cari;?>">';
	var tab = tab + '<input type="hidden" name="batas" value="<?=$batas;?>">';
	var tab = tab + '<input type="hidden" name="hal" value="<?=$hal;?>">';	
	var tab = tab + '<input type="hidden" name="id_kat" value="<?=$id_kat;?>">';
	$('#sb_act').html(tab).submit();
}
function bukamedia(){
		$.ajax({
        type:"POST",
		url:"<?=site_url();?>cmskonten/fmanager/getmedia/",
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
</script>
<style>
.hdmedia {	color:#fff; background-color:#ccc; line-height:35px; padding:0px 0px 0px 5px;cursor:pointer;	}
</style>