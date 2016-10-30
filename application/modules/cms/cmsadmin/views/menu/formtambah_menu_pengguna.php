<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-success">
			<div class="panel-heading">
			FORM TAMBAH MENU PENGGUNA
			<div class="btn btn-xs pull-right btn-warning" onclick="batal();"><i class="fa fa-close fa-fw"></i></div>
			</div>
			<div class="panel-body">
    <form id="content-form" method="post" action="" enctype="multipart/form-data">
    <input type="hidden" name="id_konten" id="id_konten" value=""  />
    <div style="statussave"></div>
			<div class="table-responsive">
<table class="table">
        <tr>
          <td width="20%">Grup Pengguna</td>
          <td colspan="3"><div class="ipt_text" style="width:200px;"><b><?=$nama_group;?></b></div></td>
        </tr>
        <tr>
          <td valign=top>Menu Pengguna</td>
          <td colspan="3">
				<table class="table table-striped table-bordered table-hover">
				<thead id=gridhead>
					<tr height=35>
						<td width=50  class='kepTb left'><b>No.</b></td>
						<td width=25 class=kepTb><b>OPSI</b></td>
						<td width=230 class=kepTb><b>MENU</b></td>
						<td class=kepTb><b>KETERANGAN</b></td>
					</tr>
				</thead>
				<tbody id=pilmenu>

				</tbody>
				<tr><td colspan=4 class='gridcell left'>&nbsp;</td></tr>
			</table>
		</td>
        </tr>
       <tr >
          <td>&nbsp;</td>
          <td colspan="3">
				<div onclick="simpan();" class='btn btn-primary btn-sm' id="btAct"><i class="fa fa-save fa-fw"></i> Simpan</div>
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
$(document).ready(function(){
	loadmenuAll(0);
});
function loadmenuAll(idp){
	var group_id=$("#group_pil").val();
		$.ajax({
        type:"POST",
        url:"<?=site_url();?>cmsadmin/menu/getmenuuserAll/",
		data:{"idparent": idp,"id_setting":"<?=$id_setting;?>","id_setting_ref":"<?=$id_setting_ref;?>","group_id":"<?=$group_id;?>" },
        success:function(data){
			$("#pilmenu").html(data);
		},
        dataType:"html"});
}

function validasi_tambah(){
	var data="";
	var dati="";
		$("[id^='ccshdk']").each(function(index,item) {
			var idx = item.checked;
			var idn = item.value;
			if(idx==true){
				data=data+""+idn+"_";
			}
		});
	if( data ==""){
		alert("MENU tidak boleh kosong");
		return false;
	}
	if( dati !=""){
		alert(dati);
		return false;
	} else {return data;}
}
////////////////////////////////////////////////////////////////////////////
	function simpan(){
		var hasil=validasi_tambah();
		var group_id=$("#group_pil").val();
		if (hasil!=false) {
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>cmsadmin/menu/tambah_menu_pengguna_aksi/",
				data:{	"menu":hasil,"id_setting":"<?=$id_setting;?>","id_setting_ref":"<?=$id_setting_ref;?>","group_id":"<?=$group_id;?>"	},
				beforeSend:function(){	
						$('#btAct').replaceWith('<span id="btAct"><i class="fa fa-spinner fa-spin fa-2x"></i></span>');
				},
				success:function(data){
					$("[id^='row_']").remove();
					loadIsiGrid(0,0);
					batal();
				},//tutup::success
				dataType:"html"
			});//tutup ajax
		} //tutup if::hasil
	} //tutup::simpan
</script>
