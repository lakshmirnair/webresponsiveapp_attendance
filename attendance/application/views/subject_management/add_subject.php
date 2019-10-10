  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Add Subject
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Subject Management</a></li>
        <li class="active">Add Subject</li>
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
              <h3 class="box-title">Add Subject</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Select Department</label>
                  <select class="form-control" name="department_id" required="">
                    <option value="">Select Department</option>
                    <?php 
                    foreach ($departments as $row) {
                      ?>
                      <option value="<?php echo $row['id']; ?>"><?php echo $row['branch_name']; ?></option>
                      <?php
                      # code...
                    }

                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Select Semester</label>
                  <select class="form-control" name="semester_id" required="">
                    <option value="">Select Semester</option>
                    <option value="1">Semester 1</option>
                    <option value="2">Semester 2</option>
                    <option value="3">Semester 3</option>
                    <option value="4">Semester 4</option>
                    <option value="5">Semester 5</option>
                    <option value="6">Semester 6</option>
                    <option value="7">Semester 7</option>
                    <option value="8">Semester 8</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Subject Name</label>
                  <input type="text" name="subject_name" class="form-control" id="subject_name" placeholder="Subject Name" required="">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Subject Code</label>
                  <input type="text" name="sub_code" class="form-control" id="sub_code" placeholder="Subject Code" required="">
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
  