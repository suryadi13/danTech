<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header">Menu</h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->


<div class="row gridPost">
	<div class="col-lg-12">
		<div class="panel panel-warning" id="panel_utama">
			<div class="panel-heading">
						<div class="row">
								<div class="col-lg-6">
									<div class="dropdown"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-book fa-fw"></span></button>
										<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
											<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="loadForm('formtambah_menu','xx','0','0');"><i class="fa fa-plus fa-fw"></i> Tambah Menu</a></li>
										</ul>
										Daftar Menu
									</div>
								</div><!---/.col-lg-6 -->
								<div class="col-lg-6" style="text-align:right;">
									<a href="<?=site_url('admin/module/cmsadmin/menu');?>" class="btn btn-default btn-xs">Menu Utama</a>
									<div class="btn btn-warning btn-xs">Sub Menu</div>
								</div><!---/.col-lg-6 -->
						</div><!---/.row -->
			</div>
			<div class="panel-body">


			<div class="table-responsive">
<table class="table table-striped table-hover">
<thead id=gridhead>
<tr height=35>
		<th width=100><b>NO.</b></th>
		<th width=65><b>AKSI</b></th>
		<th width=230><b>NAMA MENU</b></th>
		<th width=300><b>PATH MENU</b></th>
		<th><b>KETERANGAN</b></th>
		<th width=130><b>ICON MENU</b></th>
</tr>
</thead>
<tbody id=gridisi>
<tr height=20>
<td align=right colspan=8 class='gridcell left'>&nbsp;</td>
</tr>
</tbody>
</table>
		</div>



			</div><!---/.panel-body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<div id="formPost" style="display:none">Ini Form</div>
<style>
table th {	color:#fff; background-color:#ccc; line-height:35px; padding:0px;	}
</style>
