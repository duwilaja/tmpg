<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$bu=base_url()."adminlte310";

$data["title"]="Filter";
$data["menu"]="filters";
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
              <li class="breadcrumb-item active">Filter</li>
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
					<button class="btn btn-success btn-sm" onclick="reloadTable()"><i class="fas fa-sync"></i></button>
					<button class="btn btn-primary btn-sm" onclick="openf()"><i class="fas fa-plus"></i></button>
				</div>
			</div>
			<div class="card-body table-responsive">
                <table id="example1" class="table table-sm table-bordered table-striped">
                  <thead>
					  <tr>
						<th>Filter</th>
						<th>Description</th>
						<th>Group</th>
						<!--th>Access</th>
						<th>Group</th-->
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

  <div class="modal fade" id="modal-frm">
	<div class="modal-dialog">
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
				<label for="" class="col-sm-4 col-form-label">Filter</label>
				<div class="col-sm-8 input-group">
				  <input type="text" name="probid" class="form-control form-control-sm" id="probid" placeholder="...">
				</div>
			  </div>
			  <div class="form-group row">
				<label for="" class="col-sm-4 col-form-label">Description</label>
				<div class="col-sm-8 input-group">
				  <input type="text" name="probname" class="form-control form-control-sm" id="probname" placeholder="...">
				</div>
			  </div>
			  <div class="form-group row">
				<label for="" class="col-sm-4 col-form-label">Group</label>
				<div class="col-sm-8 input-group">
				  <input type="text" name="grping" class="form-control form-control-sm" id="grping" placeholder="...">
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
		  probid: {
			required: true
		  },
		  upwd: {
			required: function(element){
					if($("#rowid").val()==0) return true;
					
					return false;
				}
		  },
		  probname: {
			required: true
		  },
		  ugrp: {
			required: function(element){
					//if($("#uaccess").val()=="USR") return true;
					
					return false;
				}
		  },
		  grping: {
			required: true
		  },
		  umail: {
			  required: false,
			  email: true
		  }
		}
	});
	
	//getCombo("md/gets",'#kanwil','','--- All ---');
	//initDatePicker(["#idate"]);
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
