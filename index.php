<html>
	<head>
		<title>Net Pay</title>

		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	</head>
	<body>
		    <!-- Main content -->
	    <section class="content">
	      	<div class="container-fluid">
				    <div class="row justify-content-center p-2">
			          <div class="col-6">
			            <!-- Custom Tabs -->
			            <div class="card" id="parentDiv">
							<div class="card-header d-flex p-0">
								<h3 class="card-title p-1">Multi Contact Form</h3>
								<ul class="nav nav-pills ml-auto p-2">
								  <li class="nav-item"><button class="btn btn-info" id="addMore" onclick="addMore()">Add Contact</button></li>&nbsp;
								  <li class="nav-item"><button class="btn btn-info" id="validateForm" onclick="validateForm()">Validate</button></li>&nbsp;
								  <li class="nav-item"><button class="btn btn-info" onclick="subForm()">Save Contact</button></li>
								</ul>
							</div><!-- /.card-header -->
							<!-- form start -->
							
					        <form class="form-horizontal form" id="form" method="post" name="submitForm">
					        	<?php
								if(!empty($_POST)) {
								
									include('control/submit.php');	
									if(!empty($message)) { 
										foreach($message as $msg) {
											if(!empty($msg)) {
								?>
										<div class="alert alert-danger alert-dismissible">
						                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						                  <h5><i class="icon fas fa-ban"></i> Alert!</h5>
						                  <?php echo $msg; ?>
						                </div>
								<?php 		}
										} 
									}
								} else {
									$data = unserialize(file_get_contents("db/data.txt"));
									!empty($data) ? $_POST = $data : $_POST['nameInput'][0] = '';
								}
									if(!empty($success['message'])) {
										?>
										<div class="alert alert-success  alert-dismissible">
						                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						                  <h5><i class="icon fas fa-ban"></i> Alert!</h5>
						                  <?php echo $success['message']; ?>
						                </div>
										<?php
									}

								for($i=0; $i<sizeof($_POST['nameInput']); $i++) {
								?>
						        <div <?php echo (!$i) ? 'class="col-sm-12 p-2" id="cloneDiv"' : 'class="col-sm-12 p-2 removeDiv"'; ?>>
						        	<div class="card">
					                  	<div class="card-header">
							                <h5 class="card-title">Contact
							                	<?php echo ($i!=0) ?
							                		'<button type="button" class="btn close" onclick="removeForm(this)">Remove</button>' : '';
							                	?>
							                </h5>
							            </div>
							        </div>
					                <div class="card-body">
					                  <div class="form-group row">
					                    <label for="inputPassword3" class="col-sm-4 col-form-label">Name</label>
					                    <div class="col-sm-8">
					                      <input type="text" name="nameInput[]" class="form-control nameInput" autocomplete="off" placeholder="Name" value="<?php echo isset($_POST['nameInput'][$i]) ? $_POST['nameInput'][$i] : ''?>">
					                      <span class="errormess nameInputError" style="color: red;"></span>
					                    </div>
					                  </div>
					                  <div class="form-group row">
					                    <label for="inputEmail3" class="col-sm-4 col-form-label">Email</label>
					                    <div class="col-sm-8">
					                      <input type="email" name="emailInput[]" class="form-control emailInput" autocomplete="off" placeholder="Email" value="<?php echo isset($_POST['emailInput'][$i]) ? $_POST['emailInput'][$i] : ''?>">
					                       <span class="errormess emailInputError" style="color: red;"></span>
					                    </div>
					                  </div>
					                  <div class="form-group row">
					                    <label for="inputPassword3" class="col-sm-4 col-form-label">Contact Number</label>
					                    <div class="col-sm-8">
					                      <input type="text" name="contactInput[]" class="form-control contactInput" autocomplete="off" placeholder="Contact Number" value="<?php echo isset($_POST['contactInput'][$i]) ? $_POST['contactInput'][$i] : ''?>">
					                      <span class="errormess contactInputError" style="color: red;"></span>
					                    </div>
					                  </div>
					                </div>
					                <!-- /.card-body --> 
					        	</div>
					        	<?php } ?>
					        </form>
			            </div>
			            <!-- ./card -->
			          </div>
			          <!-- /.col -->
			        </div>
			</div>
		</section>
		<script type="text/javascript" src="assets/js/main.js"></script>
	<body>
</html>