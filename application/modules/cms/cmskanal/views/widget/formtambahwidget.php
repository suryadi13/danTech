<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-success">
			<div class="panel-heading">FORM TAMBAH WIDGET</div>
			<div class="panel-body">
    <form id="content-form" method="post" action="<?=site_url('cmskanal/widget/tambahwidget_aksi');?>" enctype="multipart/form-data">
			<div class="table-responsive">
<table class="table table-striped">
        <tr>
          <td width="20%">Jenis Widget</td>
          <td colspan="3">
		  	<select name="id_widget" id="id_widget" onchange="gridX('end')" class="form-control">
			<option value="0">Pilih..</option>
			<?=$widget;?>
			</select>
			</td>
        </tr>
        <tr>
          <td width="20%">Nama Widget</td>
          <td colspan="3"><input type="text" name="nama_wrapper" id="nama_wrapper" class="form-control"/></td>
        </tr>
        <tr>
          <td>Keterangan</td>
          <td colspan="3"><input type="text" name="keterangan" id="keterangan" class="form-control" /></td>
        </tr>
        <tr id="pilmenu" style="display:none;">
			<td colspan=4>&nbsp;</td>
        </tr>
       <tr >
			<td>&nbsp;</td>
			<td colspan="3">
				<input type=hidden name="idk" id="idk" value="<?=$id_kanal;?>">
				<input type=hidden name="lokasi" id="lokasi" value="<?=$posisi;?>">
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
function gridX(hal){
var idw = $('#id_widget').val();
var nama_widget = $("#id_widget option:selected").text();
	if(nama_widget=="Pilih.."){
			$("[id^='opsi_X_']").remove();
			$("#pilmenu").replaceWith('<tr id="pilmenu" style="display:none;"><td colspan=4>&nbsp;</td></tr>');
	} else {
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>widget_"+nama_widget+"/formadmin/tambah",
				data:{"id_widget":idw,"id_kategori":"<?=$id_kategori;?>","urutan":<?=$idd;?>},
				success:function(data){
					$("[id^='opsi_X_']").remove();
					$("#pilmenu").replaceWith(data);
				}, 
	        dataType:"html"});
	}
}
////////////////////////////////////////////////////////////////////////////
function simpan(){
	var data="";
	var dati="";
	var dasi=""

		$("[id^='widget_i']").each(function(index,item) {
			var idx = item.checked;
			var idn = item.value;
			if(idx==true){
				dasi=dasi+""+idn+"";
			}
		});


			var judl = $.trim($("#nama_wrapper").val());
			var rbrk = $.trim($("#keterangan").val());
			data=data+""+judl+"*"+dasi+"";
			if( judl ==""){	dati=dati+"NAMA WIDGET tidak boleh kosong\n";	}
			if( rbrk ==""){	dati=dati+"KETERANGAN tidak boleh kosong\n";	}
			if( dasi ==""){	dati=dati+"ISI WIDGET tidak boleh kosong\n";	}
	if( dati !=""){
		alert(dati);
		return false;
	} else { simpan_aksi();}
}
////////////////////////////////////////////////////////////////////////////
function simpan_aksi(){
			$.ajax({
			type:"POST",
			url:	$("#content-form").attr('action'),
			data:$("#content-form").serialize(),
			beforeSend:function(){	
				$('#btAct').replaceWith('<span id="btAct"><i class="fa fa-spinner fa-spin fa-2x"></i></span>');
			},
			success:function(data){
					batal();
					loadC('widget','<?=$idgh;?>','<?=$posisi;?>');
			},
			dataType:"html"});
			return false;
}
</script>
