<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header">AGENDA</h3>
	</div>
	<!-- /.col-lg-12 -->
</div>

          <div class='row'>
            <div class='col-md-12'>
              <div class='panel panel-info'>
                <div class='panel-heading'>
                  <b>FORM EDIT ITEM AGENDA</b>
				  <div class="btn btn-warning btn-xs pull-right" onclick="batal(); return false;"><i class="fa fa-close fa-fw"></i></div>
                </div><!-- /.box-header -->
                <div class='panel-body'>
    <form id="content-form" method="post" action="<?=base_url();?>cmskonten/agenda/edit_aksi" enctype="multipart/form-data">
			<div class="table-responsive">
<table class="table table-striped">
        <tr>
          <td width="150">Judul Agenda</td>
          <td colspan="3">
		  <input type="text" id="judul" name="judul" class="form-control" value="<?=@$isi->judul;?>" onblur="if(this.value=='') this.value='Wajib diisi';" onfocus="if(this.value=='Wajib diisi') this.value='';">
		  </td>
        </tr>
        <tr>
          <td>Isi Agenda</td>
          <td colspan="3">
		  <input type="text" id="isi_agenda" name="isi_agenda" class="form-control" value="<?=@$detil->isi;?>" onblur="if(this.value=='') this.value='Wajib diisi';" onfocus="if(this.value=='Wajib diisi') this.value='';">
		  </td>
        </tr>
        <tr>
          <td>Tempat</td>
          <td colspan="3">
		  <input type="text" id="sub_judul" name="sub_judul" class="form-control" value="<?=@$isi->sub_judul;?>" onblur="if(this.value=='') this.value='Wajib diisi';" onfocus="if(this.value=='Wajib diisi') this.value='';">
		  </td>
        </tr>
        <tr>
          <td>Rubrik Agenda</td>
          <td colspan="3"><select name="id_kategori" id="id_kategori" class="form-control">
            <option  value="">--Pilih Rubrik--</option>
            <?=$pilrb;?>
          </select></td>
        </tr>
        <tr>
          <td>Tanggal Mulai</td>
          <td colspan="3">
		  <input type="text" id="tgl_mulai" name="tgl_mulai" class="form-control" value="<?=@$detil->tgl_mulai;?>" onblur="if(this.value=='') this.value='Wajib diisi';" onfocus="if(this.value=='Wajib diisi') this.value='';" placeholder="dd-mm-YYYY">
		  </td>
        </tr>
        <tr>
          <td>Tanggal Selesai</td>
          <td colspan="3">
		  <input type="text" id="tgl_selesai" name="tgl_selesai" class="form-control" value="<?=@$detil->tgl_selesai;?>" onblur="if(this.value=='') this.value='Wajib diisi';" onfocus="if(this.value=='Wajib diisi') this.value='';" placeholder="dd-mm-YYYY">
		  </td>
        </tr>
       <tr >
			<td>&nbsp;</td>
			<td colspan="3">
				<input type=hidden name=idd value='<?=@$isi->id_konten;?>'>
					<div class="btn btn-primary btn-xl" onclick="simpan(); return false;" id="btAct"><i class="fa fa-save fa-fw"></i> Simpan</div>
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
	var hasil=validasi_pengikut();
	if (hasil!=false) {
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
	} //endif Hasil
}
////////////////////////////////////////////////////////////////////////////
function validasi_pengikut(opsi){
	var data="";
	var dati="";
			var nama = $.trim($("#tema").val());
			var kket = $.trim($("#isi_agenda").val());
			var tmpt = $.trim($("#tempat").val());
			var tglb = $.trim($("#tgl_mulai").val());
			var tglc = $.trim($("#tgl_selesai").val());
			var rbrk = $.trim($("#id_kategori").val());
			data=data+""+nama+"*"+kket+"**";
			if( nama =="Wajib diisi"){	dati=dati+"JUDUL AGENDA tidak boleh kosong\n";	}
			if( kket =="Wajib diisi"){	dati=dati+"ISI AGENDA tidak boleh kosong\n";	}
			if( tmpt =="Wajib diisi"){	dati=dati+"TEMPAT tidak boleh kosong\n";	}
			if( rbrk ==""){	dati=dati+"RUBRIK AGENDA tidak boleh kosong\n";	}
			if( tglb =="Wajib diisi"){	dati=dati+"TANGGAL MULAI tidak boleh kosong\n";	}
			if( tglc =="Wajib diisi"){	dati=dati+"TANGGAL SELESAI tidak boleh kosong\n";	}
	if( dati !=""){
		alert(dati);
		return false;
	} else {return data;}
}
function batal(){
	$('#sb_act').attr('action','<?=site_url();?>admin/module/cmskonten/agenda');
	var tab = '<input type="hidden" name="cari" value="<?=$cari;?>">';
	var tab = tab + '<input type="hidden" name="batas" value="<?=$batas;?>">';
	var tab = tab + '<input type="hidden" name="hal" value="<?=$hal;?>">';	
	var tab = tab + '<input type="hidden" name="id_kat" value="<?=$id_kat;?>">';
	$('#sb_act').html(tab).submit();
}
</script>