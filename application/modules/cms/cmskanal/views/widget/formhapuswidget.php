<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-danger">
			<div class="panel-heading">FORM HAPUS WIDGET</div>
			<div class="panel-body">
    <form id="content-form" method="post" action="<?=site_url('cmskanal/widget/hapuswidget_aksi');?>" enctype="multipart/form-data">
			<div class="table-responsive">
<table class="table table-striped">
        <tr>
          <td width="20%">Widget</td>
          <td colspan="3"><?=$widget->nama_widget;?><input type="hidden" name="id_widget" id="id_widget" value="<?=$widget->id_widget;?>" disabled></td>
        </tr>
        <tr>
          <td width="20%">Nama Wrapper</td>
          <td colspan="3"><input type="text" name="nama_wrapper" id="nama_wrapper" class="form-control" value="<?=$widget->nama_wrapper;?>" disabled></td>
        </tr>
        <tr>
          <td>Keterangan</td>
          <td colspan="3"><input type="text" name="keterangan" id="keterangan" class="form-control"  value="<?=@$widget->keterangan;?>" disabled></td>
        </tr>
        <tr id="pilmenu">
			<td colspan=4>&nbsp;</td>
        </tr>
<?php
foreach($widget->opsi AS $key=>$val){
?>
        <tr>
          <td valign=top><?=$val->label;?></td>
          <td colspan=3>
		  <input type="hidden" name="nama[<?=$key;?>]" value="<?=$val->nama;?>">
		  <input type="hidden" name="label[<?=$key;?>]" value="<?=$val->label;?>">
		  <input type="text" name="nilai[<?=$key;?>]" value="<?=$val->nilai;?>" class="form-control">
		  </td>
        </tr>
<?php
}
?>
       <tr >
			<td>&nbsp;</td>
			<td colspan="3">
				  <input type="hidden" id="nama_widget" value="<?=$widget->nama_widget;?>">
				<input type=hidden name="idk" id="idk" value="<?=$id_kanal;?>">
				<input type=hidden name="idd" id="idd" value="<?=$idd;?>">
				<input type=hidden name="lokasi" id="lokasi" value="<?=$posisi;?>">
				<div onclick="hapus_n_widget();" class='btn btn-danger btn-sm' id="btAct"><i class="fa fa-trash fa-fw"></i> Hapus...</div>
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
function hapus_n_widget(){
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
