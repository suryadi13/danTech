<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header">Penulis Berita</h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->



<div class="row gridUser">
	<div class="col-lg-12">
		<div class="panel panel-warning" id="panel_utama">
			<div class="panel-heading">
						<div class="row">
								<div class="col-lg-12">
									<div class="dropdown"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-book fa-fw"></span></button>
										<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
											<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="loadForm('formtambah','xx');"><i class="fa fa-plus fa-fw"></i> Tambah Penulis</a></li>
										</ul>
										Daftar Penulis Berita
									</div>
								</div><!---/.col-lg-12 -->
						</div><!---/.row -->
			</div>
			<div class="panel-body">

<div class="row">
	<div class="col-lg-6" style="margin-bottom:5px;">
<div style="float:left;">
<select class="form-control input-sm" id="item_lengthA" style="width:70px;" onchange="gridpagingA('end')">
<option value="10" <?=($batas==10)?"selected":"";?>>10</option>
<option value="25" <?=($batas==25)?"selected":"";?>>25</option>
<option value="50" <?=($batas==50)?"selected":"";?>>50</option>
<option value="100" <?=($batas==100)?"selected":"";?>>100</option>
</select>
</div>
<div style="float:left;padding-left:5px;margin-top:6px;">item per halaman</div>
	</div>
	<!-- /.col-lg-6 -->
	<div class="col-lg-6" style="margin-bottom:5px;">
                            <div class="input-group" style="width:240px; float:right; padding:0px 2px 0px 2px;">
                                <input id="caripagingA" onchange="gridpagingA('end')" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
<div style="float:right; margin:7px 0px 0px 0px;">Cari:</div>
	</div>
	<!-- /.col-lg-6 -->
</div>
<!-- /.row -->


			<div class="table-responsive">
<table class="table table-striped table-hover">
<thead>
<tr height=35>
<th width=65>No.</th>
<th width=73><b>AKSI</b></th>
<th width=130><b>PENULIS</b></th>
<th><b>KETERANGAN</b></th>
<th width=70><b>STATUS</b></th>
</tr>
</thead>
<tbody id=list>
<tr id=isi class=gridrow><td colspan=8 align=center><b>Isi Records</b></td></tr>
</tbody>
</table>
			</div><!-- table-responsive --->

	<div id="pagingA"></div>

			</div><!---/.panel-body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div id="formUser" style="display:none">Ini Form</div>
<script type="text/javascript"> 
$(document).ready(function(){
	gridpagingA('<?=$hal;?>');
});
function repagingA(){
	$( "#pagingA .pagingframe div" ).addClass("btn btn-default");
	$( "#pagingA .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpagingA(inu);	}
	});
}
function gopagingA(){
	$("#pagingA #inputpaging").change(function() {
		var ini = $( this ).val();
		gridpagingA(ini);
	});
}

function gridpagingA(hal){
var cari = $('#caripagingA').val();
var batas = $('#item_lengthA').val();
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>cmsadmin/penulis/getpenulis/",
				data:{"hal": hal, "batas": 10,"cari":cari},
				success:function(data){

			var table="";
			var j=0;
			var no=data.mulai;
			$.each( data.hslquery, function(index, item){
				table = table+ "<tr id=row_"+ item.user_id +">";
				table = table+ "<td><b>"+no+"</b></td>";
				table = table+ "<td>";
//tombol aksi-->
						table = table+ '<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>';
						table = table+ '<ul class="dropdown-menu" role="menu">';
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="loadForm(\'formedit\',\''+ item.id_item +'\');\"><i class="fa fa-pencil fa-fw"></i> Edit data</a></li>';
						if(item.cek=="kosong" && item.user_id!=1){
							table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick=\"loadForm(\'formhapus\',\''+ item.id_item +'\');"><i class="fa fa-trash fa-fw"></i> Hapus data</a></li>';
						}
						table = table+ "</ul>";
						table = table+ "</div>";
//tombol aksi<--
				table = table+ "</td>";
				table = table+ "<td><div id='user_name_"+item.id_item+"'>" +item.nama_item+"</div></td>";
				table = table+ "<td><div id='user_name_"+item.id_item+"'>"+item.meta_value+"</div></td>";
					if(item.STATUS==1){
						table = table+ "<td>Belum</td>";
					} else {
						table = table+ "<td>Sudah</td>";
					}
				table = table+ "</tr>";       
			no++;
			j++;
			}); //endeach

				$('#list').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#pagingA').html("<input type='hidden' id='inputpaging' value='1'>");
			if(j!=0){$('#list').html(table);$('#pagingA').html(data.pager);repagingA();gopagingA();}

            }, //tutup::success
        dataType:"json"});
        return false;
}

function loadForm(tujuan,idd){	
	$("#formUser").html('');
	$(".gridUser").hide();
var cari = $('#caripagingA').val();
var batas = $('#item_lengthA').val();
var hal = $("#pagingA #inputpaging").val();
	var grup = $("#group_pil").val();
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>cmsadmin/penulis/"+tujuan+"/",
				data:{"id_penulis": idd,"cari":cari,"batas":batas,"hal":hal },
				success:function(data){
					$("#formUser").html(data);
					}, 
				dataType:"html"});
	$("#formUser").show();
	return false;
}	
function batal(){
	$("#formUser").hide();
	$(".gridUser").show();
	return false;
}
</script>
<style>
table th {	color:#fff; background-color:#ccc; line-height:35px; padding:0px;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}
</style>
