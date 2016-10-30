<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header">QUOTE</h3>
	</div>
	<!-- /.col-lg-12 -->
</div>

          <div class='row'>
            <div class='col-md-12'>
              <div class='panel panel-danger'>
                <div class='panel-heading'>
                  <b>FORM HAPSU ITEM QUOTE</b>
				  <div class="btn btn-warning btn-xs pull-right" onclick="batal(); return false;"><i class="fa fa-close fa-fw"></i></div>
                </div><!-- /.box-header -->
                <div class='panel-body'>
    <form id="content-form" method="post" action="<?=site_url();?>cmskonten/sekilasinfo/hapus_aksi" enctype="multipart/form-data">
			<div class="table-responsive">
<table class="table table-striped">
        <tr>
          <td width="150">Judul Sekilas Info</td>
          <td colspan="3">
		  <input type="text" id="judul" name="judul" class="ipt_text" style="width:400px;" value="<?=$isi[0]->judul_appe;?>" disabled>
		  </td>
        </tr>
        <tr>
          <td>Isi Sekilas Info</td>
          <td colspan="3">
		  <input type="text" id="isi" name="isi" class="form-control" value="<?=$isi[0]->keterangan_appe;?>" disabled>
		  </td>
        </tr>
        <tr>
          <td>Rubrik Sekilas Info</td>
          <td colspan="3"><?=$pilrb;?></td>
        </tr>
       <tr >
			<td>&nbsp;</td>
			<td colspan="3">
				<input type=hidden name=idd value='<?=@$isi[0]->id_appe;?>'>
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
////////////////////////////////////////////////////////////////////////////
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
function validasi_pengikut(opsi){
	var data="";
	var dati="";
			var nama = $.trim($("#judul").val());
			var kket = $.trim($("#isi").val());
			var rbrk = $.trim($("#id_kategori").val());
			data=data+""+nama+"*"+kket+"**";
			if( nama =="Wajib diisi"){	dati=dati+"JUDUL SEKILAS INFO tidak boleh kosong\n";	}
			if( kket =="Wajib diisi"){	dati=dati+"ISI SEKILAS INFO tidak boleh kosong\n";	}
			if( rbrk ==""){	dati=dati+"RUBRIK SEKILAS INFO tidak boleh kosong\n";	}
	if( dati !=""){
		alert(dati);
		return false;
	} else {return data;}
}
function batal(){
	$('#sb_act').attr('action','<?=site_url();?>admin/module/cmskonten/sekilasinfo');
	var tab = '<input type="hidden" name="cari" value="<?=$cari;?>">';
	var tab = tab + '<input type="hidden" name="batas" value="<?=$batas;?>">';
	var tab = tab + '<input type="hidden" name="hal" value="<?=$hal;?>">';	
	var tab = tab + '<input type="hidden" name="id_kat" value="<?=$id_kat;?>">';
	$('#sb_act').html(tab).submit();
}
</script>