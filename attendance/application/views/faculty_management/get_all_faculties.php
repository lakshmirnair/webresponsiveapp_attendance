  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Faculty Management
        <!-- <small>advanced tables</small> -->
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Faculty Management</a></li>
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
              <h3 class="box-title">Faculty List</h3>
              <div class="pull-right">
              <a href="<?php echo base_url(); ?>index.php/FacultyManagement/addFaculty" class="btn btn-primary">Add Faculty</a>
            </div>
            </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Faculty Email</th>
                  <th>Faculty Name</th>
                  <th>Faculty Code</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 1;
                  foreach ($faculties as $row) {
                    ?>
                    <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $row['teacher_email']; ?></td>
                  <td><?php echo $row['teacher_name']; ?></td>
                  <td><?php echo $row['teacher_code']; ?></td>
                  <td><button type="button" class="btn btn-block btn-danger btn-sm" onclick="deleteFaculty(<?php echo $row['id']; ?>);">Delete</button></td>
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
                  <th>Faculty Email</th>
                  <th>Faculty Name</th>
                  <th>Faculty Code</th>
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
  <script>
  function deleteFaculty(id){
    var status = confirm("Do you want to delete faculty. There is no undo?")
    if(status){
      window.location='<?php echo base_url();?>index.php/FacultyManagement/delete_faculty/'+id;
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
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
     <!--  <b>Version</b> 1 -->
    </div>
    <!-- <strong>Group Name </strong> -->
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
  function deleteFaculty(id){
    var status = confirm("Do you want to delete faculty. There is no undo?")
    if(status){
      window.location='<?php echo base_url();?>index.php/FacultyManagement/delete_faculty/'+id;
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
