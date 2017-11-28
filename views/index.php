<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Rumah Batik In-Tyas || <?= $title?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url()?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url()?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url()?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?= base_url()?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
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
    <a href="<?= base_url() ?>index.php" class="logo">
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
          <li><a href="<?= base_url()?>index.php/JenisUmum"><i class="fa fa-circle-o"></i> Tabel Jenis Umum</a></li>
            <li><a href="<?= base_url()?>index.php/SubJenis"><i class="fa fa-circle-o"></i> Tabel Sub Jenis</a></li>
            <li><a href="<?= base_url()?>index.php/Size"><i class="fa fa-circle-o"></i> Tabel Size</a></li>
            <li><a href="<?= base_url()?>index.php/Jenis"><i class="fa fa-circle-o"></i> Tabel Jenis</a></li>
            <li><a href="<?= base_url()?>index.php/Barang"><i class="fa fa-circle-o"></i> Tabel Barang</a></li>
            <li><a href="<?= base_url()?>index.php/Bank"><i class="fa fa-circle-o"></i> Tabel Bank</a></li>
            <li><a href="<?= base_url()?>index.php/Supplier"><i class="fa fa-circle-o"></i> Tabel Supllier</a></li>
            <li><a href="<?= base_url()?>index.php/Customer"><i class="fa fa-circle-o"></i> Tabel Customer</a></li>
            <li><a href="<?= base_url()?>index.php/Operator"><i class="fa fa-circle-o"></i> Tabel Operator</a></li>
            <li><a href="<?= base_url()?>index.php/Hutang"><i class="fa fa-circle-o"></i> Tabel Hutang</a></li>
            <li><a href="<?= base_url()?>index.php/Piutang"><i class="fa fa-circle-o"></i> Tabel Piutang</a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i>Tabel Chart Of Accounts
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?= base_url()?>index.php/Gl"><i class="fa fa-circle-o"></i>General Ledger</a></li>
                <li><a href="<?= base_url()?>index.php/Sgl"><i class="fa fa-circle-o"></i>Sub General Ledger</a></li>
                <li><a href="<?= base_url()?>index.php/Sl"><i class="fa fa-circle-o"></i>Sub Ledger</a></li>
                
              </ul>
            </li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Transaksi Stock</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="<?= base_url()?>index.php/Pembelian"><i class="fa fa-circle-o"></i> Pembelian </a></li>
            
            
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Transaksi Penjualan</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="#"><i class="fa fa-circle-o"></i> Penjualan </a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Cetak Ulang Nota </a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Return Penjualan </a></li>
            
            
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Perubahan</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="#"><i class="fa fa-circle-o"></i> Harga Jual </a></li>

          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Informasi</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="#"><i class="fa fa-circle-o"></i> Stock Global </a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Hutang </a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Piutang </a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Bilyet Giro </a></li>

          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Transaksi Sub GL</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="#"><i class="fa fa-circle-o"></i> Antar Sub GL </a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Debet Barang </a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Credit </a></li>
          

          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Hutang</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="#"><i class="fa fa-circle-o"></i> Pembayaran Hutang </a></li>
          
          

          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Piutang</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="#"><i class="fa fa-circle-o"></i> Pembayaran Piutang </a></li>
          
          

          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Laporan</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="#"><i class="fa fa-circle-o"></i> Laporan Keuangan </a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Laporan Statement </a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Laporan Transaksi Per User </a></li>
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
                <a href="<?= base_url().'index.php/'.$this->uri->segment(1)?>" class="btn btn-warning">Kembali</a>
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
<script src="<?= base_url()?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- page script -->
<script>
/* $("#id-10101110001").click(function() {
            alert("zzzz");
        });*/

    $(function() {
        $( ".datepicker" ).datepicker({ dateFormat: "yyyy-mm-dd" });
    }); 
    $("#jum_barang").keyup(function(){
        var hrg = parseInt($("#hrg_barang").val());
        var jum = parseInt($("#jum_barang").val());
        var tot = hrg * jum;
        $("#tot_barang").val(tot);
    })

        document.getElementById("tot_barang").value=parseInt(document.getElementById("hrg_barang").value) * parseInt(document.getElementById("jum_barang").value);
  $(function () {
    var tab1 = $('#example1').DataTable( {
            'processing': true,
            'serverSide': true,
            'ajax': {
            'url': '<?php echo base_url()?>index.php/<?php echo $this->uri->segment(1);?>/getdata/',
            'type': 'POST'
                },
            } );
    var tab2 =$('#example2').DataTable( {
            'processing': true,
            'serverSide': true,
            'ajax': {
            'url': '<?php echo base_url()?>index.php/<?php echo $this->uri->segment(1);?>/getdataPop/',
            'type': 'POST'
                },
            } );

    $("#submid").click(function(){
        $.post("<?= base_url()?>index.php/Pembelian/add",{
          notrans:$("#notrans").val(),jenis_umum:$("#jenis_umum").val(),sub_jenis:$("#sub_jenis").val(),
          size:$("#size").val(),jenis:$("#jenis").val(),kode_barcode:$("#kode_barcode").val(),nama_barang:$("nama_barang").val(),jum_barang:$("#jum_barang").val(),hrg_barang:$("#hrg_barang").val(),tot_barang:$("#tot_barang").val()
        }).done(function(data){
          tab1.ajax.reload();
        });
    });
  

  $("#submid2").click(function(){
        $.post("<?= base_url()?>index.php/Pembelian/addPembayaran",{
            notrans:$("#notrans").val(),
            tot_barang:$("#tot_barang").val(),
            tunai:$("#tunai").val(),
            non_tunai:$("#non_tunai").val(),
            hutang:$("#hutang").val(),
            bilyet_giro:$("#bilyet_giro").val(),
            rek_an:$("#rek_an").val(),
            no_rek:$("#no_rek").val(),
            rek_an2:$("#rek_an2").val(),
            no_rek2:$("#no_rek2").val(),
            no_giro:$("#no_giro").val(),
            tgl_bg:$("#tgl_bg").val(),
            tgl_jt:$("#tgl_jt").val(),
            kode_hutang:$("#kode_hutang").val(),
            no_hutang:$("#no_hutang").val(),
            tgl_mulai:$("#tgl_mulai").val(),
            tgl_jatuh:$("#tgl_jatuh").val(),
            nominal:$("#nominal").val(),
            syarat:$("#syarat").val(),
        }).done(function(data){
          tab1.ajax.reload();
        });
    });
  });



$("#KODE_JNS").change(function(){
  $.post( "<?= base_url() ?>index.php/Barang/generateBarcode", { jenis_umum: $("#KODE_JU").val(),
      sub_jenis: $("#KODE_SJ").val(),size:$("#KODE_SZ").val(),supplier:$("#KODE_SPL").val(),jenis:$("#KODE_JNS").val() })
  .done(function( data ) {
      $("#KODE_BARCODE").val(data);
  });
});

$(document).ready(function() {
    var jumlah_byr = 0;

     $.get("<?= base_url()?>index.php/Pembelian/jumHarga/"+$('#notrans').val(),function(data){
          $("#tot_bayar").val(data);
      });
     $("#tunai").keyup(function(){
          jumlah_byr = parseInt($("#tunai").val()) + parseInt($("#non_tunai").val()) + parseInt($("#bilyet_giro").val()) + parseInt($("#hutang").val());
          $("#tot_pemb").val(jumlah_byr);
     });
     $("#non_tunai").keyup(function(){
          if($("#non_tunai").val()>0){
            $("#nontunai").show();
          }else{
            $("#nontunai").hide();
          }
          jumlah_byr = parseInt($("#tunai").val()) + parseInt($("#non_tunai").val()) + parseInt($("#bilyet_giro").val()) + parseInt($("#hutang").val());
          $("#tot_pemb").val(jumlah_byr);
     });
     $("#hutang").keyup(function(){
          if($("#hutang").val()>0){
            $("#hutang_form").show();
          }else{
            $("#hutang_form").hide();
          }
          $("#nominal").val($("#hutang").val());
          jumlah_byr = parseInt($("#tunai").val()) + parseInt($("#non_tunai").val()) + parseInt($("#bilyet_giro").val()) + parseInt($("#hutang").val());
          $("#tot_pemb").val(jumlah_byr);
     });
     $("#bilyet_giro").keyup(function(){
          if($("#bilyet_giro").val()>0){
            $("#bilyetgiro").show();
          }else{
            $("#bilyetgiro").hide();
          }
          jumlah_byr = parseInt($("#tunai").val()) + parseInt($("#non_tunai").val()) + parseInt($("#bilyet_giro").val()) + parseInt($("#hutang").val());
          $("#tot_pemb").val(jumlah_byr);
     });
        


  /*function tambah(id){
        $.get("<?= base_url()?>index.php/Pembelian/tambahKode/"+id,function(data){
            var obj=JSON.parse(data);
            $("#nama_barang").val(obj.NAMA_JNS);
            $("#hrg_barang").val(obj.HJUAL_PCS);
            $("#jum_barang").val(1);
      });
    }*/
   
  /*$(".brg").each(function(index){
      $(this).on("click",function(){
          alert('xsad');
      })
  });*/

      $.get("<?= base_url()?>index.php/Pembelian/selectHutang",function(data){
          var htmls = "";
          var obj=JSON.parse(data);
          for(i=0;i<obj.length;i++){
            htmls+="<option value="+obj[i].KODE_HUTANG+">"+obj[i].NAMA+"</option>";
          }
          $("#kode_hutang").html(htmls);
      })


  $.get("<?= base_url()?>index.php/Pembelian/selectJu",function(data){
      var htmls = "";
      var obj=JSON.parse(data);
      for(i=0;i<obj.length;i++){
        htmls+="<option value="+obj[i].KODE_JU+">"+obj[i].KETERANGAN+"</option>";
      }
      $("#jenis_umum").html(htmls);

    });
  $.get("<?= base_url()?>index.php/Pembelian/selectSj",function(data){
      var htmls = "";
      var obj=JSON.parse(data);
      for(i=0;i<obj.length;i++){
        htmls+="<option value="+obj[i].KODE_SJ+">"+obj[i].KETERANGAN+"</option>";
      }
      $("#sub_jenis").html(htmls);

    });
  $.get("<?= base_url()?>index.php/Pembelian/selectSz",function(data){
      var htmls = "";
      var obj=JSON.parse(data);
      for(i=0;i<obj.length;i++){
        htmls+="<option value="+obj[i].KODE_SZ+">"+obj[i].KETERANGAN+"</option>";
      }
      $("#size").html(htmls);

    });
  $.get("<?= base_url()?>index.php/Pembelian/selectBank",function(data){
      var htmls = "";
      var obj=JSON.parse(data);
      for(i=0;i<obj.length;i++){
        htmls+="<option value="+obj[i].KODE_SZ+">"+obj[i].KETERANGAN+"</option>";
      }
      $("#size").html(htmls);

    });
  $.get("<?= base_url()?>index.php/Pembelian/selectJenis",function(data){
      var htmls = "";
      var obj=JSON.parse(data);
      for(i=0;i<obj.length;i++){
        htmls+="<option value="+obj[i].KODE_JNS+">"+obj[i].KETERANGAN+"</option>";
      }
      $("#jenis").html(htmls);

    });
  $.get("<?= base_url()?>index.php/Pembelian/selectBank",function(data){
      var htmls = "";
      var obj=JSON.parse(data);
      for(i=0;i<obj.length;i++){
        htmls+="<option value="+obj[i].ID+">"+obj[i].NAMA+"</option>";
      }
      $("#rek_an").html(htmls);
      $("#rek_an2").html(htmls);

    });
  $("#jenis").change(function(){
      $.post( "<?= base_url() ?>index.php/Pembelian/generateBarcode", { jenis_umum: $("#jenis_umum").val(),
          sub_jenis: $("#sub_jenis").val(),size:$("#size").val(),supplier:$("#supplier").val(),jenis:$("#jenis").val() })
          .done(function( data ) {
          var htmls = "<option>Pilih</option>";
          var obj=JSON.parse(data);
          if(data!="null"){
              for(i=0;i<obj.length;i++){
                htmls+="<option value="+obj[i].KODE_BARCODE+">"+obj[i].NAMA_JNS+"</option>";
              }
            $("#kode_barcode").html(htmls);
          }else{
            $("#kode_barcode").html("<option>Pilih</option>");
          }
          
          });
    });

    /*$("#kode_barcode").change(function(){
        $.get("<?= base_url()?>index.php/Pembelian/selectKodeBarcode/"+$("#kode_barcode").val(),function(data){
            var obj=JSON.parse(data);
            $("#nama_barang").val(obj.NAMA_JNS);
            $("#hrg_barang").val(obj.HJUAL_PCS);
            $("#nama_barang").val(obj.NAMA_JNS);
            $("#nama_barang").val(1);

      });
    });*/

    
  });

</script>
</body>
</html>
