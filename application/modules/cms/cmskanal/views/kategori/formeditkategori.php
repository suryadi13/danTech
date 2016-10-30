<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-success">
			<div class="panel-heading">FORM EDIT KATEGORI</div>
			<div class="panel-body">
<form id="content-form" method="post" action="<?=site_url('cmskanal/kategori/editkategori_aksi');?>" enctype="multipart/form-data">
<div class="table-responsive">
<table class="table table-striped">
        <tr bgcolor="#99CCCC">
          <td>Kanal</td>
          <td colspan="3"><b><?=strtoupper($kanal);?></b></td>
        </tr>
        <tr>
          <td>Komponen</td>
          <td colspan="3"><?=$komponen;?></td>
        </tr>
        <tr>
          <td width="150">Nama Rubrik</td>
          <td colspan="3">
		  <input type="text" id="nama_kategori" name="nama_kategori" class="form-control ipt_text" value="<?=$nama_kategori;?>" onblur="if(this.value=='') this.value='Wajib diisi';" onfocus="if(this.value=='Wajib diisi') this.value='';">
		  </td>
        </tr>
        <tr>
          <td>Keterangan</td>
          <td colspan="3">
		  <input type="text" id="keterangan" name="keterangan" class="form-control ipt_text" value="<?=$keterangan;?>" onblur="if(this.value=='') this.value='Wajib diisi';" onfocus="if(this.value=='Wajib diisi') this.value='';">
		  </td>
        </tr>
        <tr>
          <td>Paging Index</td>
          <td colspan="3"><?=$pg_index;?></td>
        </tr>
        <tr>
          <td>Paging Arsip</td>
          <td colspan="3"><?=$pg_arsip;?></td>
        </tr>
       <tr id="tombol">
			<td>&nbsp;</td>
			<td colspan="3">
				<input type=hidden name='idd' id='idd' value=<?=$idd;?>>
				<input type=hidden name='idd_kanal' id='idd_kanal' value=<?=$id_kanal;?>>
				<div onclick="simpan();" class='btn btn-primary btn-sm' id="btAct"><i class="fa fa-save fa-fw"></i> Simpan</div>
				<div onclick="batal();" class='btn btn-default btn-sm'><i class="fa fa-close fa-fw"></i> Batal...</div>
			</td>
        </tr>
</table>
</div>
</form>
			</div><!--/.panel-body-->
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	lanjut();
});

function lanjut(){
	var kpn = $("#komponen").val();
	$.ajax({
		type:"POST",
		data:{"idd": <?=$idd;?>,"custom":"edit" },
		url:"<?=site_url();?>cmskonten/"+kpn+"/custom_kategori/",
		beforeSend:function(){	$(".custom").remove(); },
		success:function(data){	
			if(data!=""){
				$('<input type="hidden" id="custom" name="custom" value="'+kpn+'">').insertBefore('#idd_kanal');
			}
			$(data).insertBefore("#tombol");
		}, 
	dataType:"html"});
}
function simpan(){
	var hasil=validasi_pengikut();
	if (hasil!=false) {
			var status= $('#notification-artikel');
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
						loadC('kategori','<?=$idgh;?>','kategori');
						batal();
					} else {
						status.html('');
						status.html('<ul><li>' + arr_result[1] + '</li></ul>');
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
			var nama = $.trim($("#nama_kategori").val());
			var kket = $.trim($("#keterangan").val());
			data=data+""+nama+"*"+kket+"**";
			if( nama =="Wajib diisi"){	dati=dati+"NAMA RUBRIK tidak boleh kosong\n";	}
			if( kket =="Wajib diisi"){	dati=dati+"KETERANGAN tidak boleh kosong\n";	}
	if( dati !=""){
		alert(dati);
		return false;
	} else {return data;}
}
</script>