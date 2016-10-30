<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header">Dashboard</h3>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row"  id="settingGrid">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
						<div class="row">
								<div class="col-lg-6">
									<div class="dropdown"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-tags fa-fw"></span></button>
										<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
											<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-tags fa-fw"></i> Pengelola Aplikasi</a></li>
										</ul>
										Identitas Aplikasi
									</div>
								</div>
						</div>
			</div>
			<div class="panel-body">

<div class="row">
	<div class="col-lg-3">
		<div class="panel panel-primary">
			<div class="panel-heading">LOGO APLIKASI</div>
			<div class="panel-body">
					<div class="thumbnail" style="width:120px;"><img src='<?=base_url();?>assets/media/logo_kanal/<?=$logo;?>' height=80 border=0></div>
			</div>
		</div>
	</div><!--/.col-lg-3-->
	<div class="col-lg-9">
				<div class="table-responsive">
				<table class="table table-striped">
				<thead id=gridhead>
					<tr height=35>
						<th width=45>No.</th>
						<th width=35><b>AKSI</b></th>
						<th width=250><b>PARAMETER</b></th>
						<th><b>NILAI</b></th>
						<th width=70><b>STATUS</b></th>
					</tr>
				</thead>
				<tbody>
				<?php
				foreach($id_app AS $key=>$val){
				?>
					<tr>
						<td align=righ><?=($key+1);?></td>
						<td><div class="btn btn-default btn-xs" onclick="loadForm('<?=$val->tipe;?>','<?=$val->id;?>');" title='Klik untuk mengedit data'><i class='fa fa-pencil fa-fw'></i></div></td>
						<td><?=$val->label;?></td>
						<td><?=$val->nilai;?></td>
						<td>...</td>
					</tr>
				<?php
				}
				?>
				</tbody>
				<tr height=20>
				<td align=right colspan=8>&nbsp;</td>
				</tr>
				</table>
				</div>
	</div><!--/.col-lg-9-->
</div><!--/.row-->





			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<div id="settingForm" style="display:none;">nkkjj</div>
<script type="text/javascript">
function loadForm(tujuan,idd){	
	$("#settingForm").html('');
	$("#settingGrid").hide();
	var rubrik = $("#rubrik").val();
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>cmshome/form_"+tujuan+"/",
				data:{"idd": idd },
				beforeSend:function(){	 },
				success:function(data){
					$("#settingForm").html(data);
//					loadDialogTutup();
					}, 
				dataType:"html"});
	$("#settingForm").show();
	return false;
}	
function batal(){
	$("#settingForm").hide();
	$("#settingGrid").show();
	return false;
}

</script>
<style>
.thumbnail {	position:relative;	overflow:hidden; margin-bottom:0px;	}
.caption {    position:absolute;    top:0;    right:0;    background:rgba(66, 139, 202, 0.75);    width:100%;    height:100%;    padding:2%;    display: none;    text-align:center;    color:#fff !important;	z-index:2;	}
</style>
