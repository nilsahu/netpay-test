<html>
	<head>
		<title>Net Pay</title>

		<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
		<link rel="stylesheet" href="../assets/fontawesome-free/css/all.min.css">
		<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
		<?php include('checkStructure.php'); ?>
	</head>
	<body>
		<!-- Main content -->
	    <section class="content">
	      	<div class="container-fluid">
				    <div class="row">
			          <div class="col-12">
			            <!-- Custom Tabs -->
			            <div class="card" id="parentDiv">
							<div class="card-header d-flex p-0">
								<h3 class="card-title p-3">Multi Contact Form</h3>
								<ul class="nav nav-pills ml-auto p-2">
								  <li class="nav-item"></li>&nbsp;
								  <li class="nav-item"><button class="btn btn-info" id="validateForm" onclick="validateForm()">Validate</button></li>&nbsp;
								  <li class="nav-item"><button class="btn btn-info" onclick="subForm()">Save Contact</button></li>
								</ul>
							</div><!-- /.card-header -->
							<!-- form start -->
							
					       
					        	
						        <div class="col-sm-12">
					                <div class="card-body">
					                  <div class="form-group row">
					                    <label for="inputPassword3" class="col-sm-2 col-form-label">Scan Directory</label>
					                    <div class="col-sm-4">
					                    <form class="form-horizontal form" method="post" name="">
					                      	<select class="form-control" name="scanDirectory">
												<option>Select Directory</option>
												<option value="c:/" <?php echo (isset($_POST['scanDirectory']) && $_POST['scanDirectory'] == "c:/") ? "selected" : ''?>>C:/</option>
												<option value="d:/" <?php echo (isset($_POST['scanDirectory']) && $_POST['scanDirectory'] == "d:/") ? "selected" : ''?>>D:/</option>
												<option value="e:/" <?php echo (isset($_POST['scanDirectory']) && $_POST['scanDirectory'] == "e:/") ? "selected" : ''?>>E:/</option>
												<option value="f:/" <?php echo (isset($_POST['scanDirectory']) && $_POST['scanDirectory'] == "f:/") ? "selected" : ''?>>F:/</option>
				                        	</select>
					                    </div>
					                    <div class="col-sm-4">
					                    	<button type="submit" class="btn btn-info">Scan</button>
					                    </div>
					                	</form>
					                  </div>
					                  <div class="form-group row">
					                    <label for="inputPassword3" class="col-sm-2 col-form-label">Scan Directory</label>
					                    <div class="col-sm-4">
					                    <form class="form-horizontal form" method="post" name="">
					                    	<input class="form-control" type="text" name="searchDirectory" placeholder="Search a directory..">
					                    </div>
					                    <div class="col-sm-4">
					                    	<button type="submit" class="btn btn-info">Search</button>
					                    </div>
					                    </form>
					                  </div>
					                  <div>
					                <!-- /.card-body --> 
					        	</div>
					        </form>

					        <!-- /.row -->
					        <div class="row">
					          <div class="col-12">
					            <div class="card">
					              <div class="card-header">
					                <h3 class="card-title">File Structure</h3>
					              </div>
					              <!-- ./card-header -->
					              <div class="card-body p-0">
					                <table class="table table-hover">
					                  <tbody>
					                  	<?php echo $html; ?>
					                  </tbody>
					                </table>
					              </div>
					              <!-- /.card-body -->
					            </div>
					            <!-- /.card -->
					          </div>
					        </div>
					        <!-- /.row -->


			            </div>
			            <!-- ./card -->
			          </div>
			          <!-- /.col -->
			        </div>
			</div>
		</section>
		<script type="text/javascript" src="../assets/js/jquery/jquery.min.js"></script>
		<script type="text/javascript" src="../assets/js/ExpandableTable.js"></script>  
		<script type="text/javascript" src="../assets/js/main.js"></script>
	<body>
</html>