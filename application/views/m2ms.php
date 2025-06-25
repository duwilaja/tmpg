<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$bu=base_url()."adminlte310";

$data["title"]="M2M";
$data["menu"]="m2ms";
$data["pmenu"]="master";
$data["session"]=$session;
$data["bu"]=$bu;

$this->load->view("_head",$data);
$this->load->view("_navbar",$data);
$this->load->view("_sidebar",$data);

$menu=$data['menu'];
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php echo $data["title"]?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item active">M2M</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
		<div class="card">
			<div class="card-header">
				<div class="card-tools">
					<button class="btn btn-warning btn-sm" onclick="$('#modal-batch').modal('show');"><i class="fas fa-upload"></i></button>
					<button class="btn btn-success btn-sm" onclick="reloadTable()"><i class="fas fa-sync"></i></button>
					<button class="btn btn-primary btn-sm" onclick="openf()"><i class="fas fa-plus"></i></button>
				</div>
			</div>
			<div class="card-body table-responsive">
                <table id="example1" class="table table-sm table-bordered table-striped">
                  <thead>
					  <tr>
						<th>Telp#</th>
						<th>IP</th>
						<th>SN</th>
						<th>Outlet ID</th>
						<th>Name</th>
						<th>Kanwil</th>
						<th>Status</th>
						<th>Penggunaan</th>
						<th>Jenis</th>
						<th>Outlet Pengguna</th>
						<th>Nama Pengguna</th>
						<th>Tiket#</th>
					  </tr>
                  </thead>
                  <tbody>
				  </tbody>
				</table>
			</div>
		</div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php
$data["batchsample"]=base_url()."sample_m2ms.xls";
$this->load->view("batch",$data);
?>
  <div class="modal fade" id="modal-frm">
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
		<div id="ovl" class="overlay" style="display:none;">
			<i class="fas fa-2x fa-sync fa-spin"></i>
		</div>
		<div class="modal-header">
		  <h4 class="modal-title"><?php echo $data['title']?> Form</h4>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		  </button>
		</div>
		<div class="modal-body">
		  
		  <div class="card">
		  <!-- form start -->
		  <form id="myf" class="form-horizontal">
		  <input type="hidden" name="rowid" id="rowid" value="0">
		  <input type="hidden" name="flag" id="flag" value="SAVE">
		  <input type="hidden" name="menu" value="<?php echo ($menu)?>">
		  
			<div class="card-body">
			  <div class="form-group row">
				<label for="" class="col-sm-2 col-form-label">No Telp</label>
				<div class="col-sm-4 input-group">
					<input type="text" class="form-control form-control-sm input-sm" name="notel" id="notel" placeholder="...">
				</div>
				<label for="" class="col-sm-2 col-form-label">IP</label>
				<div class="col-sm-4 input-group">
					<input type="text" class="form-control form-control-sm input-sm" name="iptel" id="iptel" placeholder="...">
				</div>
			  </div>
			  <div class="form-group row">
				<label for="" class="col-sm-2 col-form-label">S/N</label>
				<div class="col-sm-4 input-group">
					<input type="text" class="form-control form-control-sm input-sm" name="sn" id="sn" placeholder="...">
				</div>
				<label for="" class="col-sm-2 col-form-label">Jenis</label>
				<div class="col-sm-4 input-group">
					<input type="text" class="form-control form-control-sm input-sm" name="jenis" id="jenis" placeholder="...">
				</div>
			  </div>
			  <div class="form-group row">
				<label for="" class="col-sm-2 col-form-label">Outlet ID</label>
				<div class="col-sm-4 input-group">
					<input type="text" class="form-control form-control-sm input-sm" name="oid" id="oid" placeholder="...">
				</div>
				<label for="" class="col-sm-2 col-form-label">Outlet ID Pengguna</label>
				<div class="col-sm-4 input-group">
					<input type="text" class="form-control form-control-sm input-sm" name="oidx" id="oidx" placeholder="...">
				</div>
			  </div>
			  <div class="form-group row">
				<label for="" class="col-sm-2 col-form-label">Penggunaan</label>
				<div class="col-sm-4 input-group">
					<input type="text" class="form-control form-control-sm input-sm" name="guna" id="guna" placeholder="...">
				</div>
				<label for="" class="col-sm-2 col-form-label">Status</label>
				<div class="col-sm-4 input-group">
					<input type="text" class="form-control form-control-sm input-sm" name="stts" id="stts" placeholder="...">
				</div>
			  </div>
			  <div class="form-group row">
				<label for="" class="col-sm-2 col-form-label">Tiket#</label>
				<div class="col-sm-4 input-group">
					<input type="text" class="form-control form-control-sm input-sm" name="ticketno" id="ticketno" placeholder="...">
				</div>
				
			  </div>
			</div>
			<!-- /.card-body -->
		  </form>
		  </div>
		  <!-- /.card -->
		  
		</div>
		<div class="modal-footer pull-right">
		  <button type="button" id="btndel" class="btn btn-danger" onclick="savef(true)">Delete</button>
		  <button type="button" class="btn btn-primary" onclick="savef();">Save</button>
		  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	  </div>
	  <!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
  </div>

  
<?php
$this->load->view("_foot",$data);
$cc="distinct grpid as v,grpid as t";
$ct="t_usergrp";
$cw="1=1";
?>
<script>
var  mytbl;
$(document).ready(function(){
	document_ready();
	mytbl = $("#example1").DataTable({
		serverSide: false,
		processing: true,
		buttons: ["copy", "excel"],
		ajax: {
			type: 'POST',
			url: bu+'md/datatable',
			data: function (d) {
				d.m= '<?php echo ($menu); ?>';
			}
		},
		initComplete: function(){
			//filterDatatable(mytbl,[1,2]);
			mytbl.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
		}
	});
	$("#myf").validate({
		rules: {
		  notel: {
			required: true
		  },
		  upwd: {
			required: function(element){
					if($("#rowid").val()==0) return true;
					
					return false;
				}
		  },
		  sn: {
			required: true
		  },
		  ugrp: {
			required: function(element){
					//if($("#uaccess").val()=="USR") return true;
					
					return false;
				}
		  },
		  uaccess: {
			required: true
		  },
		  umail: {
			  required: false,
			  email: true
		  }
		}
	});
	
	getCombo("md/gets",'#kanwil','','-- Please Select --');
	getCombo("md/gets",'#user','','-- Please Select --');
	initDatePicker(["#idate"]);
});

function reloadTable(frm){
	mytbl.ajax.reload();
}

function openf(id=0){
	$("#rowid").val(id);
	openForm('#myf','#modal-frm','md/get','#ovl',id,'<?php echo ($menu)?>')
}
function savef(del=false){
	$("#flag").val('SAVE');
	if(del) $("#flag").val('DEL');
	saveForm('#myf','md/sv','#ovl',del,'#modal-frm');
}
</script>
</body>
</html>
