<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header">Grup Pengguna</h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div class="row" id="gridUsergroup">
	<div class="col-lg-12">
		<div class="panel panel-warning" id="panel_utama">
			<div class="panel-heading">
						<div class="row">
								<div class="col-lg-12">
									<div class="dropdown"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-book fa-fw"></span></button>
										<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
											<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="loadForm('formtambahgroup','xx','0','0');"><i class="fa fa-plus fa-fw"></i> Tambah Grup Pengguna</a></li>
										</ul>
										Daftar Grup Pengguna
									</div>
								</div><!---/.col-lg-12 -->
						</div><!---/.row -->
			</div>
			<div class="panel-body">


			<div class="table-responsive">
<table class="table table-striped table-hover">
<thead>
<tr height=35>
<th width=65>No.</th>
<th width=73><b>AKSI</b></th>
<th width=150><b>NAMA GRUP PENGGUNA</b></th>
<th width=120><b>THEME</b></th>
<th><b>JUDUL APLIKASI</b></th>
<th width=150><b>ALERT</b></th>
<th width=150><b>LOG OUT</b></th>
</tr>
</thead>
<tbody id=list>
<tr id=isi class=gridrow><td colspan=8 align=center><b>Isi Records</b></td></tr>
</tbody>
</table>
			</div><!-- table-responsive --->



			</div><!---/.panel-body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div id="formUsergroup" style="display:none">Ini Form</div>
<script type="text/javascript"> 
function loadForm(tujuan,id_grup){	
	$("#formUsergroup").html('');
	$("#gridUsergroup").hide();
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>cmsadmin/user/"+tujuan+"/",
				data:{"group_id": id_grup },
				success:function(data){
					$("#formUsergroup").html(data);
					}, 
				dataType:"html"});
	$("#formUsergroup").show();
	return false;
}	
function batal(){
	$("#formUsergroup").hide();
	$("#gridUsergroup").show();
	return false;
}
</script>
<script type="text/javascript"> 
$("#bt_table").click(function() {
	$("#isiGrid").toggle( "slow" );
	if($(this).html()=="s"){
		$(this).removeClass("ui-icon-circle-triangle-s").addClass("ui-icon-circle-triangle-n").html("n");
	} else {
		$(this).removeClass("ui-icon-circle-triangle-n").addClass("ui-icon-circle-triangle-s").html("s");
	}
});

$(document).ready(function(){
	loadIsiGrid();
});
function loadIsiGrid(){
var mulai=0;
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>cmsadmin/user/getusergroup/",
				data:{"hal": "hal" },
				success:function(data){
		if((data.length)>0){
			var table="";
			var no=(mulai*1)+1;
			$.each( data, function(index, item){
				if((no % 2) == 1){var seling="odd";}else{var seling="even";}
				table = table+ "<tr>";
				table = table+ "<td><b>"+no+"</b></td>";
				table = table+ "<td>";
//tombol aksi-->
						table = table+ '<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>';
						table = table+ '<ul class="dropdown-menu" role="menu">';
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="loadForm(\'formeditgroup\',\''+ item.group_id +'\');\"><i class="fa fa-pencil fa-fw"></i> Edit data</a></li>';
						if(item.cek=="kosong"){
							table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick=\"loadForm(\'formhapusgroup\',\''+ item.group_id +'\');"><i class="fa fa-trash fa-fw"></i> Hapus data</a></li>';
						}
						table = table+ "</ul>";
						table = table+ "</div>";
//tombol aksi<--
				table = table+ "</td>";
				table = table+ "<td>" +item.group_name+"</td>";
				table = table+ "<td>" +item.theme+"</td>";
				table = table+ "<td><b>" +item.judul_app+"</b><br/>"+item.sub_judul+"</td>";
				table = table+ "<td>" +item.alertafter+"</td>";
				table = table+ "<td>" +item.logoutafter+"</td>";
				table = table+ "</tr>";       
			no++;
			}); //endeach
				$('#list').html(table);
		} else {
			$('#list').html("<tr id=isi><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
		}
		}, 

        dataType:"json"});
}
</script>
<style>
table th {	color:#fff; background-color:#ccc; line-height:35px; padding:0px;	}
</style>
