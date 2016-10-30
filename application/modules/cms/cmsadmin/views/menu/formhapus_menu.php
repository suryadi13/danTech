<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-danger">
			<div class="panel-heading">FORM HAPUS MENU</div>
			<div class="panel-body">
    <form>
    <div style="statussave"></div>
			<div class="table-responsive">
<table class="table table-striped">
        <tr>
          <td width="150">Nama Menu</td>
          <td colspan="3"><div class="ipt_text" style="width:200px;"><b><?=$hslquery[0]->menu_name; ?></b></div></td>
        </tr>
        <tr>
          <td>Icon Menu</td>
          <td colspan="3"><div class="ipt_text" style="width:200px;"><b><?=$hslquery[0]->icon_menu; ?></b></div></td>
        </tr>
        <tr>
          <td>Path Menu</td>
          <td colspan="3"><div class="ipt_text" style="width:200px;"><b><?=$hslquery[0]->menu_path; ?></b></div></td>
        </tr>
        <tr>
          <td>Keterangan Menu</td>
          <td colspan="3"><div class="ipt_text" style="width:200px;"><b><?=$hslquery[0]->keterangan; ?></b></div></td>
        </tr>
       <tr >
			<td>&nbsp;</td>
			<td colspan="3">
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
				url:"<?=site_url();?>cmsadmin/menu/hapus_menu_aksi/",
				data:{	"idd":<?=$idd;?>,"idparent":"<?=$idparent;?>"	},
				beforeSend:function(){	
						$('#btAct').replaceWith('<span id="btAct"><i class="fa fa-spinner fa-spin fa-2x"></i></span>');
				},
				success:function(data){
					$("[id^='row_<?=$rowparent;?>']").remove();
					loadIsiGrid("<?=$parent;?>",<?=$level;?>);
					batal();
				},//tutup::success
				dataType:"html"
			});//tutup ajax
	} //tutup::simpan
</script>