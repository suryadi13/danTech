<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-danger">
			<div class="panel-heading">FORM HAPUS GRUP PENGGUNA</div>
			<div class="panel-body">
    <form id="content-form" method="post" action="<?=site_url('cmsadmin/user/hapus_group_aksi');?>" enctype="multipart/form-data">
    <div style="statussave"></div>
			<div class="table-responsive">
<table class="table table-striped">
        <tr>
          <td width="20%">Nama Grup Pengguna</td>
          <td colspan="3"><div class="ipt_text" style="width:400px;"><b><?=$group_name;?></b></div></td>
        </tr>
        <tr>
          <td>Theme</td>
          <td colspan="3"><div class="ipt_text" style="width:400px;"><b><?=$section_name;?></b></div></td>
        </tr>
        <tr>
          <td>Back Office</td>
          <td colspan="3"><div class="ipt_text" style="width:400px;"><b><?=$backoffice;?></b></div></td>
        </tr>
        <tr>
          <td>Keterangan</td>
          <td colspan="3"><div class="ipt_text" style="width:400px;"><b><?=$keterangan;?></b></div></td>
        </tr>
       <tr >
			<td>&nbsp;</td>
			<td colspan="3">
				<input type="hidden" name=idd value="<?=$group_id;?>"/>
				<div onclick="simpan();" class='btn btn-danger btn-sm' id="btAct"><i class="fa fa-save fa-fw"></i> Hapus</div>
				<div onclick="batal();" class='btn btn-default btn-sm'><i class="fa fa-close fa-fw"></i> Batal...</div>
			</td>
        </tr>
</table>
			</div>
	</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
////////////////////////////////////////////////////////////////////////////
function simpan(){
			$.ajax({
			type:"POST",
			url: $("#content-form").attr('action'),
			data:	$("#content-form").serialize(),
			beforeSend:function(){	
					$('#btAct').replaceWith('<span id="btAct"><i class="fa fa-spinner fa-spin fa-2x"></i></span>');
			},
			success:function(data){
					var arr_result = data.split("#");
					if(arr_result[0]=='sukses'){
						batal();
						loadIsiGrid();
					}else{
						var status=arr_result[1];
						alert('Data gagal disimpan! \n '+status+'');
					}
			},
			dataType:"html"});
			return false;
}
</script>