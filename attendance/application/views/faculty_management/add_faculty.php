  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Add Faculty
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Faculty Management</a></li>
        <li class="active">Add Faculty</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
           <?php
  if($this->session->flashdata('alert_message')!=''){
    echo '<div class="alert alert-danger">';
              echo $this->session->flashdata('alert_message');
              echo "</div>";
  }
  ?>
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Faculty</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Faculty Email</label>
                  <input type="email" name="faculty_email" class="form-control" id="exp_name" placeholder="Faculty Email" required="">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Faculty name</label>
                  <input type="text" name="faculty_name" class="form-control" id="exp_name" placeholder="Faculty Name" required="">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Faculty Code</label>&nbsp;&nbsp; (<b>default password</b>)
                  <input type="text" name="faculty_code" class="form-control" id="branch_code" value="<?php echo time(); ?>" placeholder="Faculty Code" required="">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.box -->

          

          <!-- /.box -->

        </div>
        <!--/.col (left) -->
        <!-- right column -->
   
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
  </div>
  