<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-success">
			<div class="panel-heading">FORM EDIT MENU</div>
			<div class="panel-body">
    <form>
    <div style="statussave"></div>
			<div class="table-responsive">
<table class="table table-striped">
        <tr>
          <td width=170>Nama Menu</td>
          <td colspan="3">
		  <input type="text" id="menu_name" name="menu_name" value="<?=$hslquery[0]->menu_name; ?>" onblur="if(this.value=='') this.value='Wajib diisi';" onfocus="if(this.value=='Wajib diisi') this.value='';" class="form-control">
		  </td>
        </tr>
        <tr>
          <td>Icon Menu</td>
          <td colspan="3"><input type="text" name="icon_menu" id="icon_menu" value="<?=$hslquery[0]->icon_menu; ?>" class="form-control" /></td>
        </tr>
        <tr>
          <td>Path Menu</td>
          <td colspan="3">
		  <input type="text" id="menu_path" name="menu_path" value="<?=$hslquery[0]->menu_path; ?>" onblur="if(this.value=='') this.value='Wajib diisi';" onfocus="if(this.value=='Wajib diisi') this.value='';" class="form-control">
		  </td>
        </tr>
        <tr>
          <td>Keterangan</td>
          <td colspan="3">
		  <input type="text" id="keterangan" name="keterangan" value="<?=$hslquery[0]->keterangan; ?>" onblur="if(this.value=='') this.value='Wajib diisi';" onfocus="if(this.value=='Wajib diisi') this.value='';"  class="form-control">
		  </td>
        </tr>
       <tr >
			<td>&nbsp;</td>
			<td colspan="3">
				<input type="hidden" name='idd' id='idd' value='<?=$idd;?>'>
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
function validasi_pengikut(opsi){
	var data="";
	var dati="";
			var nnm = $.trim($("#menu_name").val());
			var icn = $.trim($("#icon_menu").val());
			var nnp = $.trim($("#menu_path").val());
			var kket = $.trim($("#keterangan").val());
			data=data+""+nnm+"*"+icn+"*"+nnp+"*"+kket+"**";
			if( nnm =="Wajib diisi"){	dati=dati+"NAMA MENU tidak boleh kosong\n";	}
			if( nnp =="Wajib diisi"){	dati=dati+"PATH MENU tidak boleh kosong\n";	}
			if( kket =="Wajib diisi"){	dati=dati+"KETERANGAN MENU tidak boleh kosong\n";	}
	if( dati !=""){
		alert(dati);
		return false;
	} else {return data;}
}
////////////////////////////////////////////////////////////////////////////
	function simpan(){
		var hasil=validasi_pengikut();

		if (hasil!=false) {
			var idd = $("#idd").val();
			var PENGIKUT = hasil;
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>cmsadmin/menu/edit_menu_aksi/",
				data:{	"idd":idd,"nama_menu":hasil	},
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
		} //tutup if::hasil
	} //tutup::simpan
</script>