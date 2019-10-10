  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Add Attendance
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Add Attendance</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- form start -->
            <form role="form" method="POST" action="<?php echo base_url(); ?>index.php/AttendanceManagement/postAttendance"> 
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Department</label>
                  <select class="form-control" disabled="" required="">
                    <option value="<?php echo $department_id; ?>"><?php echo $department_name; ?></option>
                    
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Semester</label>
                  <select id="semester_id" class="form-control" required="" disabled="">
                    <option value="<?php echo $semester_id; ?>"><?php echo $semester_name; ?></option>
                    
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Subject</label>
                  <select class="form-control" id="subject_id" required="" disabled="">
                    <option value="<?php echo $subject_id; ?>"><?php echo $subject_name; ?></option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Teacher</label>
                  <select class="form-control" id="teacher_id" disabled="">
                    <option value="<?php echo $teacher_id; ?>"><?php echo $teacher_name; ?></option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Date</label>
                  <input type="date" value="<?php echo $att_date; ?>" class="form-control" required="" disabled="">
                </div>
                <input type="hidden" name="department_id" value="<?php echo $department_id; ?>">
                <input type="hidden" name="semester_id" value="<?php echo $semester_id; ?>">
                <input type="hidden" name="subject_id" value="<?php echo $subject_id; ?>">
                <input type="hidden" name="teacher_id" value="<?php echo $teacher_id; ?>">
                <input type="hidden" name="att_date" value="<?php echo $att_date; ?>">
                <div class="form-group">
                  <label for="exampleInputEmail1">Hour</label>
                  <select class="form-control" required="" disabled="">
                    <option value="">Select Hour</option>
                    <option value="1" <?php if($hour==1) { echo "selected"; } ?>>Hour 1</option>
                    <option value="2" <?php if($hour==2) { echo "selected"; } ?>>Hour 2</option>
                    <option value="3" <?php if($hour==3) { echo "selected"; } ?>>Hour 3</option>
                    <option value="4" <?php if($hour==4) { echo "selected"; } ?>>Hour 4</option>
                    <option value="5" <?php if($hour==5) { echo "selected"; } ?>>Hour 5</option>
                    <option value="6" <?php if($hour==6) { echo "selected"; } ?>>Hour 6</option>
                  </select>
                </div>
              </div>
              <!-- /.box-body -->
              <!-- <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div> -->


              <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Students List</h3>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 10px">#</th>
                  <th>Roll Number</th>
                  <th>Student Name</th>
                  <th>Label</th>
                </tr>
                <?php
                foreach ($student_details as $row) {
                  ?>
                  <tr>
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $row['roll_number']; ?></td>
                  <td><?php echo $row['student_name']; ?></td>
                  <td><select class="form-control" name="student_<?php echo $row['id']; ?>"><option value="1">Present</option>
                  <option value="2">Absent</option><option value="1">On Duty</option></select></td>
                </tr>
                  <?php
                }
                ?>
              </tbody></table>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <script src="<?php echo base_url(); ?>public_html/jquery.min.js"></script>
  <script>
  $(document).ready(function(){
    document.getElementById("add_to_cart").disabled = true;

    var customer_id = $('#customer_id').val();
    var posting = $.post( '<?php echo base_url(); ?>index.php/Billing/getCustomerPromisedProducts', { customer_id: customer_id } );
      // Put the results in a div
    posting.done(function( data ) {
      //alert(data)
      $("#table_data").html(data)
    });

    $("#qr_code_button").click(function(){
      var qr_code = $('#qr_code').val();
      if(qr_code==''){
        alert("You must add the qr_code");
      }
      if(qr_code!=''){
        var posting = $.post( '<?php echo base_url(); ?>index.php/Billing/ScanQR', { qr_code: qr_code } );
        // Put the results in a div
        posting.done(function( data ) {
          if(data=='product_details_not_found'){
            alert("QR code details not found")
          }else if(data=='no_quantity_available'){
            alert("No Quantity Available")
          }else{
            $("#qr_scanner").html(data)
            document.getElementById("add_to_cart").disabled = false;
          }
        });
      }
    });

    $("#add_to_cart").click(function(){
      var product_id = $('#product_id').val();
      var quantity_needed = $('#quantity_needed').val();
      var customer_id = $('#customer_id').val();

      var posting = $.post( '<?php echo base_url(); ?>index.php/Billing/addToCart', { product_id: product_id , quantity_needed: quantity_needed, customer_id: customer_id } );
      // Put the results in a div
      posting.done(function( data ) {
       // alert(data);
        if(data=='quantity_not_available'){
          alert("Quantity Not Available")
        }else{
          $("#table_data").html(data)
          document.getElementById("add_to_cart").disabled = true;
        }
      });
    });
  });


  function getSubjects(id) {
    var semester_id=document.getElementById("semester_id").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      alert(this.responseText);
          document.getElementById("subject_id").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "<?php echo base_url(); ?>index.php/AttendanceManagement/getSubjects/"+semester_id, true);
    xmlhttp.send();
  }

  function getTeachers(id) {
    var subject_id=document.getElementById("subject_id").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     // alert(this.responseText)
          document.getElementById("teacher_id").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "<?php echo base_url(); ?>index.php/AttendanceManagement/getTeachers/"+subject_id, true);
    xmlhttp.send();
  }



  </script>