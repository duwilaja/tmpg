<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$bu=base_url()."adminlte310";

$data["title"]="Attendance";
$data["menu"]="attendance";
$data["pmenu"]="hr";
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
              <li class="breadcrumb-item">HR</li>
              <li class="breadcrumb-item active">Attendance</li>
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
					<button class="btn btn-primary btn-sm" onclick="openf()"><i class="fas fa-check"></i></button>
				</div>
			</div>
			<div class="card-body table-responsive">
                <table id="example1" class="table table-sm table-bordered table-striped">
                  <thead>
					  <tr>
						<th>Date</th>
						<th>NIK</th>
						<th>Name</th>
						<th>IN</th>
						<th>Note</th>
						<th>OUT</th>
						<th>Note</th>
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
				<label for="" class="col-md-2 col-form-label">Latitude</label>
				<div class="col-md-4 input-group">
				  <input type="text" readonly name="lat" class="form-control form-control-sm" id="lat" placeholder="...">
				</div>
				<label for="" class="col-md-2 col-form-label">Longitude</label>
				<div class="col-md-4 input-group">
				  <input type="text" readonly name="lng" class="form-control form-control-sm" id="lng" placeholder="...">
				</div>
			  </div>
			  <div class="form-group row">
				<label for="" class="col-md-2 col-form-label">Note</label>
				<div class="col-md-10 input-group">
				  <input type="text" name="reason" class="form-control form-control-sm" id="reason" placeholder="...">
				</div>
				<div class="col-md-4 hidden input-group">
				  <textarea name="photo" class="form-control form-control-sm" id="photo" placeholder="..."></textarea>
				</div>
			  </div>
			  <div class="form-group row">
				<div class="col-md-6 input-group">
				  <div id="my_camera">Please load the camera</div>
				</div>
				<div class="col-md-6 input-group">
				  <div id="results">Your captured image will appear here...</div>
				</div>
			  </div>
			</div>
			<!-- /.card-body -->
		  </form>
		  </div>
		  <!-- /.card -->
		  
		</div>
		<div class="modal-footer pull-right">
		  <button type="button" class="btn btn-warning" onclick="getLocation()">Get Coordinate</button>
		  <button type="button" class="btn btn-danger" onclick="load_camera();">Load Camera</button>
		  <button type="button" class="btn btn-success" onclick="take_snapshot()">Take Picture</button>
		  <button type="button" class="btn btn-primary" onclick="savef();">Check-In/Out</button>
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
<script type="text/javascript" src="vendor/js/webcam.min.js"></script>
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
			url: bu+'hratt/datatable',
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
		  dt: {
			required: true
		  },
		  upwd: {
			required: function(element){
					if($("#rowid").val()==0) return true;
					
					return false;
				}
		  },
		  ket: {
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
	
	//getCombo("md/gets",'<?php echo base64_encode($ct)?>','<?php echo base64_encode($cc)?>','<?php echo base64_encode($cw)?>','#ugrp');
	initDatePicker(["#idate"]);
});

function reloadTable(frm){
	mytbl.ajax.reload();
}

function openf(id=0){
	$("#rowid").val(id);
	$('#my_camera').html("Please load the camera");
	$("#results").html("Your captured image will appear here...");
	openForm('#myf','#modal-frm','hratt/get','#ovl',id,'<?php echo ($menu)?>')
}
function savef(del=false){
	$("#flag").val('SAVE');
	if(del) $("#flag").val('DEL');
	saveForm('#myf','hratt/sv','#ovl',del,'#modal-frm');
}
function load_camera(){
	Webcam.set({
		width: 320,
		height: 240,
		image_format: 'jpeg',
		jpeg_quality: 90
	});
	Webcam.attach( '#my_camera' );
}
function take_snapshot() {
	// take snapshot and get image data
	Webcam.snap( function(data_uri) {
		// display results in page
		document.getElementById('results').innerHTML = 
			//'<h2>Here is your image:</h2>' + 
			'<img src="'+data_uri+'"/>';
		$("#photo").val(data_uri);
	} );
}
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition,showError);
  } else {
    alrt("Geolocation is not supported by this browser.",'error');
  }
}

function showPosition(position) {
  $("#lat").val( position.coords.latitude );
  $("#lng").val( position.coords.longitude);
}
function showError(error) {
  switch(error.code) {
    case error.PERMISSION_DENIED:
      alrt("User denied the request for Geolocation.",'warning');
      break;
    case error.POSITION_UNAVAILABLE:
      alrt("Location information is unavailable.",'error');
      break;
    case error.TIMEOUT:
      alrt("The request to get user location timed out.",'error');
      break;
    case error.UNKNOWN_ERROR:
      alrt("An unknown error occurred.",'error');
      break;
  }
}
</script>
</body>
</html>
