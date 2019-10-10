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
          <?php
  if($this->session->flashdata('alert_message')!=''){
    echo '<div class="alert alert-danger">';
              echo $this->session->flashdata('alert_message');
              echo "</div>";
  }
  ?>
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- form start -->
            <form role="form" method="POST" action="<?php echo base_url(); ?>index.php/AttendanceManagement/addAttendancePost">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Department</label>
                  <select class="form-control" name="dept_id" id="dept_id" required="" readonly="">
                    <option value=""><?php echo $assigned_subjects['department_name']; ?></option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Subject Name</label>
                  <select class="form-control" id="dept_id" disabled="">
                    <option value=""><?php echo $assigned_subjects['subject_name']; ?></option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Subject Code</label>
                  <select class="form-control" id="dept_id" disabled="">
                    <option value=""><?php echo $assigned_subjects['subject_code']; ?></option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Semester</label>
                  <select class="form-control" id="dept_id" disabled="">
                    <option value=""><?php echo $assigned_subjects['semester_id']; ?></option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Date</label>
                  <input type="date" name="date" class="form-control" required="">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Hour</label>
                  <select class="form-control" name="hour" required="">
                    <option value="">Select Hour</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                  </select>
                </div>
                <input type="hidden" name="department_id" value="<?php echo $assigned_subjects['department_id'] ?>">
                <input type="hidden" name="subject_id" value="<?php echo $assigned_subjects['subject_id'] ?>">
                <input type="hidden" name="teacher_id" value="<?php echo $assigned_subjects['teacher_id'] ?>">
                <input type="hidden" name="semester_id" value="<?php echo $assigned_subjects['semester_id'] ?>">
               <!--  <div class="form-group">
                  <label for="exampleInputEmail1">Hour</label>
                  <select class="form-control" required="">
                    <option value="">Select Hour</option>
                    <option value="1">Hour 1</option>
                    <option value="1">Hour 2</option>
                    <option value="1">Hour 3</option>
                    <option value="1">Hour 4</option>
                    <option value="1">Hour 5</option>
                    <option value="1">Hour 6</option>
                  </select>
                </div> -->
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
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
    var dept_id=document.getElementById("dept_id").value;

    var posting = $.post( '<?php echo base_url(); ?>index.php/AttendanceManagement/getSubjects', { semester_id: semester_id, dept_id : dept_id } );
    // Put the results in a div
    posting.done(function( data ) {
      document.getElementById("subject_id").innerHTML = data;
    });
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