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
              <h3 class="box-title">Add Subject</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Select Department</label>
                  <select class="form-control" id="department_id" name="department_id"  onchange="getTeachers();" required="">
                    <option value="">Select Department</option>
                    <?php 
                    foreach ($departments as $row) {
                      ?>
                      <option value="<?php echo $row['id']; ?>"><?php echo $row['branch_name']; ?></option>
                      <?php
                      }
                    ?>
                  </select>
                </div>
               <!--  <div class="form-group">
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
                </div> -->

                <div class="form-group">
                  <label for="exampleInputEmail1">Teacher Name</label>
                  <select class="form-control" id="teacher_id" name="teacher_id" required="">
                    <option value="">Select Teacher</option>
                    <?php
                    foreach ($teachers as $row) {
                      ?>
                      <option value="<?php echo $row['id']; ?>"><?php echo $row['teacher_email']; ?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Select Subject</label>
                  <select class="form-control" id="subject_id" name="subject_id" required="">
                    <option value="">Select a Subject</option>
                  </select>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>

        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
  </div>
  <script src="<?php echo base_url(); ?>public_html/jquery.min.js"></script>
  <script>

  function getTeachers(id) {
    var department_id=document.getElementById("department_id").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      //alert(this.responseText)
      document.getElementById("subject_id").innerHTML = this.responseText;
     }
    };
    xmlhttp.open("GET", "<?php echo base_url(); ?>index.php/Departments/getSubjectsFromDepartmentId/"+department_id, true);
    xmlhttp.send();
  }



  </script>
  