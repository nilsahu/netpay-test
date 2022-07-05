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
				    <div class="row justify-content-center p-2">
			          <div class="col-8">
			            <!-- Custom Tabs -->
			            <div class="card" id="parentDiv">
							<div class="card-header d-flex p-0">
								<h3 class="card-title p-3">File Structure</h3>
							</div><!-- /.card-header -->
							<!-- form start -->
 	
						        <div class="col-sm-12">
					                <div class="card-body">
					                  <div class="form-group row">
					                    <label for="inputPassword3" class="col-sm-4 col-form-label">Scan Directory</label>
					                    <div class="col-sm-6">
					                    <form class="form-horizontal form" method="post" name="">
					                    	<input class="form-control" type="text" name="scanDirectory" placeholder="Scan a directory..">
					                    	<span class="alert-danger">* Please enter a correct path to run scan.</span>
					                    </div>
					                    <div class="col-sm-2">
					                    	<button type="submit" class="btn btn-info">Scan</button>
					                    </div>
					                	</form>
					                  </div>
					                  <div class="form-group row">
					                    <label for="inputPassword3" class="col-sm-4 col-form-label">Search Directory</label>
					                    <div class="col-sm-6">
					                    <form class="form-horizontal form" method="post" name="">
					                    	<input class="form-control" type="text" name="searchDirectory" placeholder="Search a directory..">
					                    </div>
					                    <div class="col-sm-2">
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