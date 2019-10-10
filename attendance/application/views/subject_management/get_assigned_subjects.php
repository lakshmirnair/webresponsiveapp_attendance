  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Assigned Subjects
        <!-- <small>advanced tables</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Assigned Subjects</a></li>
        <li class="active">list</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <div class="">
              <h3 class="box-title">Assigned Subjects</h3>
              <div class="pull-right">
              <a href="<?php echo base_url(); ?>index.php/AssignedList/assignSubject" class="btn btn-primary">Assign Subject</a>
            </div>
            </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Department Id</th>
                  <th>Department Name</th>
                  <th>Subject Id</th>
                  <th>Subject Name</th>
                  <th>Subject Code</th>
                  <th>Teacher Id</th>
                  <th>Teacher Name</th>
                  <th>Teacher Email</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 1;
                  foreach ($assigned_subjects as $row) {
                    ?>
                    <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $row['department_id']; ?></td>
                  <td><?php echo $row['department_name']; ?></td>
                  <td><?php echo $row['subject_id']; ?></td>
                  <td><?php echo $row['subject_name']; ?></td>
                  <td><?php echo $row['subject_code']; ?></td>
                  <td><?php echo $row['teacher_id']; ?></td>
                  <td><?php echo $row['teacher_email']; ?></td>
                  <td><?php echo $row['teacher_name']; ?></td>
                  <td><button type="button" class="btn btn-block btn-danger btn-sm" onclick="deleteAssignedSubject(<?php echo $row['id']; ?>);">Delete</button></td>
                  <?php $i = $i+1; ?>
                </tr>
                    <?php
                    # code...
                  }
                  ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Department Id</th>
                  <th>Department Name</th>
                  <th>Subject Id</th>
                  <th>Subject Name</th>
                  <th>Subject Code</th>
                  <th>Teacher Id</th>
                  <th>Teacher Name</th>
                  <th>Teacher Email</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
     <!--  <b>Version</b> 1 -->
    </div>
    <!-- <strong>Group Name</strong> -->
  </footer>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo base_url(); ?>public_html/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url(); ?>public_html/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url(); ?>public_html/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>public_html/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url(); ?>public_html/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>public_html/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>public_html/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>public_html/dist/js/demo.js"></script>
<!-- page script -->
<script>
  function deleteAssignedSubject(id){
    var status = confirm("Do you want to delete assigned subject. There is no undo?")
    if(status){
      window.location='<?php echo base_url();?>index.php/AssignedList/deleteAssignedSubject/'+id;
    }
  }
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
