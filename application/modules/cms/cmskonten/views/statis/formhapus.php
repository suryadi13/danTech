<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header">Statis</h3>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<form role="form" id="form_tt" action="<?=site_url();?>cmskonten/statis/hapus_aksi">
          <div class='row'>
            <div class='col-md-12'>
              <div class='panel panel-info'>
                <div class='panel-heading'>
                  <b>Form Hapus Artikel</b>
				  <div class="btn btn-warning btn-xs pull-right" onclick="batal(); return false;"><i class="fa fa-close fa-fw"></i></div>
                </div><!-- /.box-header -->
                <div class='panel-body'>
					<div class="row"><div class="col-lg-12">
											<div class="form-group">
												<label>Judul:</label>
												<input type='text' id="judul" name="judul" class="form-control" value="<?=$isi->judul;?>" disabled>
											</div>
					</div></div><!---/.row.col-lg-12--->
					<div class="row"><div class="col-lg-12">
											<div class="form-group">
												<label>Sub-judul:</label>
												<input type='text' id="sub_judul" name="sub_judul" class="form-control" value="<?=$isi->sub_judul;?>" disabled>
											</div>
					</div></div><!---/.row.col-lg-12--->
					<div class="row">
										<div class="col-lg-4">
											<div class="form-group">
												<label>Kategori:</label>
												  <select name="id_kategori" id="id_kategori"  class="form-control" disabled>
													<option  value="">--Pilih kategori--</option>
													<?=$kategori_options;?>
												  </select>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label>Penulis:</label>
												  <select name="id_penulis" id="id_penulis"  class="form-control" disabled>
													<option  value="">--Pilih Penulis--</option>
													<?=$penulis_options;?>
												  </select>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label>Tanggal:</label>
												<input type='text' id="tanggal" name="tanggal" class="form-control" value="<?=$isi->tanggal;?>" disabled>
											</div>
										</div>
					</div><!---/.row.col-lg-12--->
					<div class="row"><div class="col-lg-12">
                    <textarea id="isi_konteni" name="isi_konteni" rows="10" cols="80" class="form-control" disabled>
                                            <?=$isi->isi_konten;?>
                    </textarea>
					</div></div><!---/.row.col-lg-12--->
					<div class="row" style="padding-top:15px;"><div class="col-lg-12">
					<input type="hidden" name="komponen" value="artikel">
					<input type="hidden" name="id_konten" value="<?=$id_konten;?>">
					<div class="btn btn-danger btn-xl" onclick="simpan_aksi(); return false;" id="btAct"><i class="fa fa-edit fa-fw"></i> Hapus</div>
					<div class="btn btn-warning btn-xl" onclick="batal();"><i class="fa fa-close fa-fw"></i> Batal...</div>
					</div></div><!---/.row.col-lg-12--->
                </div>
              </div><!-- /.box -->
			</div>
		  </div>
                  </form>



<form id="sb_act" method="post"></form>
<script type="text/javascript">
function simpan_aksi(){
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
	$('#sb_act').html(tab).submit();
}
</script>
