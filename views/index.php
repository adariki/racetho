<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Data Tables</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url()?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url()?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url()?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url()?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url()?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= base_url()?>assets/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="../../index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Rumah Batik</b> In-Tyas</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- Notifications: style can be found in dropdown.less -->
          
          <!-- Tasks: style can be found in dropdown.less -->
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs"><?= $this->session->userdata('username')?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?= $this->session->userdata('username')?>
                </p>
              </li>
              <!-- Menu Body -->
              
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                
                <div class="pull-right">
                  <a href="<?= base_url()?>index.php/User/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $this->session->userdata('username');?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Tabel System</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="<?= base_url()?>index.php/JenisUmum"><i class="fa fa-circle-o"></i> Master Jenis Umum</a></li>
           <li><a href="<?= base_url()?>index.php/Jenis"><i class="fa fa-circle-o"></i> Master Jenis</a></li>
            <li><a href="<?= base_url()?>index.php/SubJenis"><i class="fa fa-circle-o"></i> Master Sub Jenis</a></li>
            <li><a href="<?= base_url()?>index.php/Size"><i class="fa fa-circle-o"></i> Master Size</a></li>
            <li><a href="<?= base_url()?>index.php/Barang"><i class="fa fa-circle-o"></i> Master barang</a></li>
            <li><a href="<?= base_url()?>index.php/Supplier"><i class="fa fa-circle-o"></i> Master Supllier</a></li>
            <li><a href="<?= base_url()?>index.php/Customer"><i class="fa fa-circle-o"></i> Master Customer</a></li>
            <li><a href="<?= base_url()?>index.php/Bank"><i class="fa fa-circle-o"></i> Master Bank</a></li>
            <li><a href="<?= base_url()?>index.php/Hutang"><i class="fa fa-circle-o"></i> Master Hutang</a></li>
            <li><a href="<?= base_url()?>index.php/Piutang"><i class="fa fa-circle-o"></i> Master Piutang</a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Chart Of Accounts
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?= base_url()?>index.php/Gl"><i class="fa fa-circle-o"></i>GeneraL Ledger</a></li>
                <li><a href="<?= base_url()?>index.php/Sgl"><i class="fa fa-circle-o"></i>Sub GeneraL Ledger</a></li>
                <li><a href="<?= base_url()?>index.php/Sl"><i class="fa fa-circle-o"></i>Sub Ledger</a></li>
                
              </ul>
            </li>
          </ul>
        </li>

       <!--  <li><a href="<?= base_url()?>index.php/Kodeinduk"><i class="fa fa-book"></i> <span>Master Induk</span></a></li>
        <li><a href="<?= base_url()?>index.php/Barang"><i class="fa fa-book"></i> <span>Master Barang</span></a></li>
        <li><a href="<?= base_url()?>index.php/Supplier"><i class="fa fa-book"></i> <span>Supplier/Customer</span></a></li>
        <li><a href="<?= base_url()?>index.php/Hutang"><i class="fa fa-book"></i> <span>Hutang</span></a></li>
        <li><a href="<?= base_url()?>index.php/Piutang"><i class="fa fa-book"></i> <span>Piutang</span></a></li>
        <li><a href="<?= base_url()?>index.php/Bank"><i class="fa fa-book"></i> <span>Bank</span></a></li>
        <li><a href="<?= base_url()?>index.php/Gl"><i class="fa fa-book"></i> <span>GL</span></a></li>
        <li><a href="<?= base_url()?>index.php/Sgl"><i class="fa fa-book"></i> <span>Sub GL</span></a></li>
        <li><a href="<?= base_url()?>index.php/Sl"><i class="fa fa-book"></i> <span>SL</span></a></li> -->
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $title ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?= $title ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <?php if($this->uri->segment(2)){?>
              <?= validation_errors(); ?>
              <?= form_open(base_url()."index.php/".$this->uri->segment(1)."/proses/".$this->uri->segment(2));?>
                    <!-- <form role="form" method="post" action="<?= base_url()."index.php/".$this->uri->segment(1)."/proses/".$this->uri->segment(2)?>"> -->
              <div class="box-body">  
                <?php foreach($field as $key=>$value){
                  if($value['type']!='select'){?>
                <div class="form-group">
                  <label for="<?= $value['name']?>"><?= $value['label']?></label>
                  <input type="<?= $value['type']?>" class="form-control" id="<?= $value['name']?>" name="<?= $value['name']?>" value="<?= $value['value']?>" placeholder="Enter <?= $value['label']?>" <?php if($value['pk']==1) echo "readonly";?>>
                </div>
                <?php } else {?>
                <div class="form-group">
                  <label for="<?= $value['name']?>"><?= $value['label']?></label>
                  <select class="form-control" id="<?= $value['name']?>" name="<?= $value['name']?>" value="<?= $value['value']?>" required>
                  <option>Silakan Pilih <?= $value['label']?></option>
                  <?php foreach($value['options'] as $key2=>$value2){
                    if($key2==$value['value']){$sel = "selected";}else{$sel = "";}
                    echo "<option value='".$key2."' ".$sel.">".$value2."</option>";
                    }?>
                  </select>
                </div>
              <?php }
              } ?>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan Data</button>
              </div>
            </form>
              <?php }else{
                    include(''.$this->uri->segment(1).'/list.php');
              }
              ?>
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
    
    <strong>Copyright &copy; 2017 <a href="https://adminlte.io">Rumah Batik InTyas</a>.</strong> All rights
    reserved.
  </footer>

  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"><?php include('sidebar.php');?></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?= base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?= base_url()?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url()?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?= base_url()?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url()?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url()?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url()?>assets/dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable( {
            'processing': true,
            'serverSide': true,
            'ajax': {
            'url': '<?php echo base_url()?>index.php/<?php echo $this->uri->segment(1);?>/getdata/',
            'type': 'POST'
                },
            } );
  })
</script>
</body>
</html>
