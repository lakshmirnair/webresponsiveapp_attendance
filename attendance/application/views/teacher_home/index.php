

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $assigned_subjects_count; ?></h3>
              <p>Total Assigned Subjects</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?php echo base_url(); ?>index.php/Departments/list" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
       
        
        <!-- ./col -->
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          

         
          <!-- TO DO List -->
          <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">Assigned Subjects</h3>

              <table class="table table-bordered">
                <tbody><tr>
                  <th>#</th>
                  <th>Department Id</th>
                  <th>Department Name</th>
                  <th>Subject Id</th>
                  <th>Subject Name</th>
                  <th>Subject Code</th>
                  <th>Over All Report</th>
                  <th style="width: 40px">Add Attendence</th>
                </tr>
                <?php
                foreach ($assigned_subjects as $row) {
                  ?>
                   <tr>
                   <td><?php echo $row['id']; ?></td>
                   <td><?php echo $row['department_id']; ?></td>
                   <td><?php echo $row['department_name']; ?></td>
                   <td><?php echo $row['subject_id']; ?></td>
                   <td><?php echo $row['subject_name']; ?></td>
                   <td><?php echo $row['subject_code']; ?></td>
                   <td><a href="<?php echo base_url(); ?>index.php/Reports/subjectWiseReport/<?php echo $row['id']; ?>" class="btn btn-primary">Overall Report</a></td>
                   <td><a href="<?php echo base_url(); ?>index.php/AttendanceManagement/addAttendance/<?php echo $row['id']; ?>" class="btn btn-primary">Add Attendence</a></td>
                </tr>
                  <?php
                }
                ?>
               
                
              </tbody></table>

              <!-- <div class="box-tools pull-right">
                <ul class="pagination pagination-sm inline">
                  <li><a href="#">&laquo;</a></li>
                  <li><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">&raquo;</a></li>
                </ul>
              </div> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              <ul class="todo-list">
                
                
              </ul>
            </div>
            <!-- /.box-body -->
           <!--  <div class="box-footer clearfix no-border">
              <button type="button" class="btn btn-default pull-right"> View All Activities</button>
            </div> -->
          </div>
          <!-- /.box -->

          
        </section>
        
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  