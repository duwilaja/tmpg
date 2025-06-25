  <div class="modal fade" id="modal-batch">
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
		<div id="batchovl" class="overlay" style="display:none;">
			<i class="fas fa-2x fa-sync fa-spin"></i>
		</div>
		<div class="modal-header">
		  <h4 class="modal-title">Batch <?php echo $title?></h4>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		  </button>
		</div>
		<div class="modal-body">
		  
		  <div class="card">
		  <!-- form start -->
		  <form id="myfbatch" class="form-horizontal">
		  <input type="hidden" name="bmenu" value="<?php echo $menu?>">
		  <input type="hidden" id="bacti" name="bacti" value="">
		  
			<div class="card-body">
			Copy from <a target="_blank" href="<?php echo $batchsample?>">sample</a> and paste to form below<br /><br />
			  <div class="form-group row">
				<label for="" class="col-md-2 col-form-label">Header</label>
				<div class="col-md-10 input-group">
					<input type="text" class="form-control form-control-sm input-sm" name="heads" id="heads" placeholder="...">
				</div>
			  </div>
			  <div class="form-group row">
				<label for="" class="col-md-2 col-form-label">Data</label>
				<div class="col-md-10 input-group">
					<textarea class="form-control form-control-sm input-sm" rows="8" name="datas" id="datas" placeholder="..."></textarea>
				</div>
			  </div>
			</div>
		  </form>
		  </div>
		</div>
		<div class="modal-footer pull-right">
		  <button type="button" class="btn btn-danger" onclick="$('#bacti').val('DEL');sendDataFile('#myfbatch','../batch/dobatch','#batchovl','#modal-batch');">Delete</button>
		  <button type="button" class="btn btn-warning" onclick="$('#bacti').val('UPD');sendDataFile('#myfbatch','../batch/dobatch','#batchovl','#modal-batch');">Update</button>
		  <button type="button" class="btn btn-info" onclick="$('#bacti').val('ADD');sendDataFile('#myfbatch','../batch/dobatch','#batchovl','');">Add</button>
		  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	  </div>
	  <!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
  </div>
