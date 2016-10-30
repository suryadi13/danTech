<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-success">
			<div class="panel-heading">FORM TAMBAH MENU</div>
			<div class="panel-body">
    <form>
    <div style="statussave"></div>
			<div class="table-responsive">
<table class="table table-striped">
        <tr>
          <td width=170>Nama Menu</td>
          <td colspan="3">
		  <input type="text" id="menu_name" name="menu_name" size="70" value="Wajib diisi" onblur="if(this.value=='') this.value='Wajib diisi';" onfocus="if(this.value=='Wajib diisi') this.value='';" class="form-control">
		  </td>
        </tr>
        <tr>
          <td>Icon Menu</td>
          <td colspan="3"><input type="text" name="icon_menu" id="icon_menu" size="70" value="" class="form-control" /></td>
        </tr>
        <tr>
          <td>Path Menu</td>
          <td colspan="3">
		  <input type="text" id="menu_path" name="menu_path" size="70" value="Wajib diisi" onblur="if(this.value=='') this.value='Wajib diisi';" onfocus="if(this.value=='Wajib diisi') this.value='';" class="form-control">
		  </td>
        </tr>
        <tr>
          <td>Keterangan</td>
          <td colspan="3">
		  <input type="text" id="keterangan" name="keterangan" size="70" value="Wajib diisi" onblur="if(this.value=='') this.value='Wajib diisi';" onfocus="if(this.value=='Wajib diisi') this.value='';" class="form-control">
		  </td>
        </tr>
       <tr >
			<td>&nbsp;</td>
			<td colspan="3">
				<div onclick="simpan();" class='btn btn-primary btn-sm' id="btAct"><i class="fa fa-save fa-fw"></i> Simpan</div>
				<div onclick="batal();" class='btn btn-default btn-sm'><i class="fa fa-close fa-fw"></i> Batal</div>
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
			var PENGIKUT = hasil;
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>cmsadmin/menu/tambah_menu_aksi/",
				data:{	"idparent":"<?=$idparent;?>","nama_menu":hasil	},
				beforeSend:function(){	
						$('#btAct').replaceWith('<span id="btAct"><i class="fa fa-spinner fa-spin fa-2x"></i></span>');
				},
				success:function(data){
					$("[id^='row_<?=$rowparent;?>']").remove();
					$("#tombol_hapus_<?=$parent;?>").hide();
					loadIsiGrid("<?=$parent;?>",<?=$level;?>);
					batal();
				},//tutup::success
				dataType:"html"
			});//tutup ajax
		} //tutup if::hasil

	} //tutup::simpan
</script>