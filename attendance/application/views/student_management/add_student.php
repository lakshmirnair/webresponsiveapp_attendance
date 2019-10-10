  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Add Student
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Student Management</a></li>
        <li class="active">Add Student</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Student</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Department name</label>
                  <select name="branch_id" class="form-control" required="">
                    <option value="">Select Department Name</option>
                    <?php
                    foreach ($departments as $row) {
                      ?>
                      <option value="<?php echo $row['id']; ?>"><?php echo $row['branch_name']; ?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Semester</label>
                  <select name="sem_code" class="form-control" required="">
                    <option value="">Select Semester</option>
                    <?php
                    foreach ($semesters as $row) {
                      ?>
                      <option value="<?php echo $row['semester_code']; ?>"><?php echo $row['semester_name']; ?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Student Name</label>
                  <input type="text" name="student_name" class="form-control" id="student_name" placeholder="Student Name" required="">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Roll Number</label>
                  <input type="text" name="roll_number" class="form-control" id="roll_no" placeholder="Roll Number" required="">
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


 
    <!-- /.content -->
  </div>
  