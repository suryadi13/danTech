<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-danger">
			<div class="panel-heading">FORM HAPUS KATEGORI</div>
			<div class="panel-body">
<form id="content-form" method="post" action="<?=site_url('cmskanal/kategori/hapuskategori_aksi');?>" enctype="multipart/form-data">
<div class="table-responsive">
<table class="table table-striped">
        <tr bgcolor="#99CCCC">
          <td>Kanal</td>
          <td colspan="3"><b><?=strtoupper($kanal);?></b></td>
        </tr>
        <tr>
          <td>Komponen</td>
          <td colspan="3"><div class='ipt_text' style="width:200px;"><b><?=$komponen;?></b></div></td>
        </tr>
        <tr>
          <td width="150">Nama Rubrik</td></b>
          <td colspan="3"><div class='ipt_text' style="width:400px;"><b><?=$nama_kategori;?></div></td>
        </tr>
        <tr>
          <td>Keterangan</td>
          <td colspan="3"><div class='ipt_text' style="width:400px;"><b><?=$keterangan;?></b></div></td>
        </tr>
       <tr id="tombol">
			<td>&nbsp;</td>
			<td colspan="3">
				<input type=hidden name='idd' id='idd' value=<?=$idd;?>>
				<input type="hidden" id="id_kanal" name="id_kanal" value="<?=$id_kanal;?>">
				<div onclick="simpan();" class='btn btn-danger btn-sm' id="btAct"><i class="fa fa-trash fa-fw"></i> Hapus</div>
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
	var kpn = "<?=$komponen;?>";
	$.ajax({
		type:"POST",
		data:{"idd": <?=$idd;?>,"custom":"hapus" },
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
}
////////////////////////////////////////////////////////////////////////////
</script>