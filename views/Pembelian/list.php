<div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Daftar Barang</a></li>
              <li><a href="#tab_2" data-toggle="tab">Pembayaran</a></li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  Dropdown <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                  <li role="presentation" class="divider"></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
                </ul>
              </li>
              <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <div class="col-sm-12">
                <br>
                  <div class="col-sm-6">
                  <form action="<?= base_url()?>index.php/Pembelian/add" method="POST">
                  <label for="nofaktur">No Faktur</label>
                  <input type="text" name="nofaktur" id="nofaktur" class="form-control" />
                  <label for="tglfaktur">Tanggal Faktur</label>
                  <input type="text" name="tglfaktur" id="nofaktur" class="form-control datepicker" />
                  <label for="supplier">Supplier</label>
                  <select class="form-control" id="supplier" name="supplier" required>
                  <?php $dataOptions = $this->db->select('KODE_SPL,NAMA_SPL')->get('C007')->result_array();?>
                  <option>Silakan Pilih Supplier</option>
                  <?php foreach($dataOptions as $key=>$value){
                    echo "<option value='".$value['KODE_SPL']."'>".$value['NAMA_SPL']."</option>";
                    }?>
                  </select>
                    </div>
                    <div class="col-sm-6">
                  <label for="notrans">No Transaksi</label>
                  <input type="text" name="notrans" id="notrans" class="form-control" value="11.<?= $this->session->userdata('kodeuser');?>.<?= date('dmY');?>0001" readonly/>
                  <label for="tgltrans">Tgl Transaksi : <?= date("d-m-Y")?></label>
                 
                    </div>
                </div>
<!-- modal -->
                <div class="modal fade" id="modal-default" >
          <div class="modal-dialog">
            <div class="modal-content" style="width: 800px">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Default Modal</h4>
              </div>
              <div class="modal-body">
                
                
                    <label for="jenis_umum">Jenis Umum</label>
                    <select class="form-control" name="jenis_umum" id="jenis_umum">
                      
                    </select>
                    <label for="sub_jenis">Sub Jenis</label>
                    <select class="form-control" name="sub_jenis" id="sub_jenis">
                      
                    </select>
                    <label for="size">Size</label>
                    <select class="form-control" name="size" id="size">
                      
                    </select> 
                    <label for="jenis">Jenis</label>
                    <select class="form-control" name="jenis" id="jenis">
                      
                    </select> 
                    <label for="kode_barcode">Kode Barcode</label>
                    <input type="text" name="kode_barcode" id="kode_barcode" class="form-control" />
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" name="nama_barang" id="nama_barang" class="form-control" />
                    <label for="hrg_barang">Harga Barang</label>
                    <input type="number" name="hrg_barang" id="hrg_barang" class="form-control" />
                    <label for="jum_barang">Jumlah Barang</label>
                    <input type="number" name="jum_barang" id="jum_barang" class="form-control" />
                    <label for="tot_barang">Total Harga Barang</label>
                    <input type="number" name="tot_barang" id="tot_barang" class="form-control" />
                

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-default pull-left" data-toggle="modal" data-target="#modal-default2">Cari</button>
                <button type="button" class="btn btn-primary" id="submid" data-dismiss="modal">Save changes</button>
                </form>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

                <div class="col-sm-12">
                <br>
                  <button class="btn btn-success" data-toggle="modal" data-target="#modal-default">Add</button><br>
                                        <table class="table table-striped table-hover table-bordered" id="example1">
                                            <thead>
                                                <tr>
                                                    <th> Kode </th>
                                                    <th> Nama </th>
                                                    <th> Jml Beli </th>
                                                    <th> Harga Pcs </th>
                                                    <th> Jml Harga </th>
                                                    <th> Action </th>
                                                </tr>
                                            </thead>
                                            
                                        </table>
                </div>

              </div>

              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <div class="col-sm-12">
                <br>
                    <div class="col-sm-3" id="list_bayar" >
                    <h4>Cara Pembayaran</h4>
                    <label for="tot_bayar">Total Pembayaran</label>
                    <input type="number" id="tot_bayar" name="tot_bayar" class="form-control" value="0" />
                    <label for="tunai">Tunai</label>
                    <input type="number" id="tunai" name="tunai" class="form-control" value="0"/>
                    <label for="non_tunai">Non Tunai</label>
                    <input type="number" id="non_tunai" name="non_tunai" class="form-control" value="0"/>
                    <label for="hutang">Hutang</label>
                    <input type="number" id="hutang" name="hutang" class="form-control" value="0"/>
                    <label for="hutang">Bilyet Giro</label>
                    <input type="number" id="bilyet_giro" name="bilyet_giro" class="form-control" value="0"/>
                    <label for="hutang">Jumlah Bayar</label>
                    <input type="number" id="tot_pemb" name="tot_pemb" class="form-control" value="0"/>
                    <hr>
                    
                    </div>
                    <div class="col-sm-3" id="nontunai" style="display: none">
                      <h4>Rekening</h4>
                      <label for="rek_an">Bank a/n</label>
                      <select id="rek_an" name="rek_an" class="form-control">
                        <option></option>
                      </select>
                      <label for="no_rek">No Rekening</label>
                      <input type="number" id="no_rek" name="no_rek" class="form-control" />
                      
                    </div>
                    <div class="col-sm-3" id="bilyetgiro" style="display: none">
                      <h4>Bilyet Giro</h4>
                      <label for="rek_an2">Bank a/n</label>
                      <select id="rek_an2" name="rek_an2" class="form-control">
                        <option></option>
                      </select>
                      <label for="no_rek2">No Rekening</label>
                      <input type="number" id="no_rek2" name="no_rek2" class="form-control" />
                      <label for="no_giro">No Giro</label>
                      <input type="text" id="no_giro" name="no_giro" class="form-control" />
                      <label for="tgl_bg">Tgl BG</label>
                      <input type="text" id="tgl_bg" name="tgl_bg" class="form-control datepicker" />
                      <label for="tgl_jt">Tgl JT</label>
                      <input type="text" id="tgl_jt" name="tgl_jt" class="form-control datepicker" />
                      
                    </div>
                    <div class="col-sm-3" id="hutang_form" style="display: none">
                      <h4>Hutang</h4>
                      <label for="kode_hutang">Kode Hutang</label>
                      <select id="kode_hutang" name="kode_hutang" class="form-control">
                      </select>
                      <label for="no_hutang">No Hutang</label>
                      <input type="text" id="no_hutang" name="no_hutang" class="form-control" />
                      <label for="no_supplier">No Supplier</label>
                      <input type="text" id="no_supplier" name="no_supplier" class="form-control" /><label for="nama_supplier">Nama Supplier</label>
                      <input type="text" id="nama_supplier" name="nama_supplier" class="form-control" />
                      <label for="tgl_mulai">Tgl Mulai</label>
                      <input type="text" id="tgl_mulai" name="tgl_mulai" class="form-control datepicker" value="<?= date("m/d/Y");?>"/><label for="tgl_jatuh">Tgl Jatuh Tempo</label>
                      <input type="text" id="tgl_jatuh" name="tgl_jatuh" class="form-control datepicker" />
                      <label for="nominal">Nominal</label>
                      <input type="number" id="nominal" name="nominal" class="form-control" />
                      <label for="syarat">Syarat</label>
                      <input type="text" id="syarat" name="syarat" class="form-control" />
                      
                    </div>

                  </div>
                  <div class="col-sm-12">
                      <button type="button" class="btn btn-primary" id="submid2" data-dismiss="modal">Save changes</button>
                  </div>

              </div>
              <!-- /.tab-pane -->

              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->

        <!-- /.col -->
      </div>

      

        <div class="modal fade" id="modal-default2" >
          <div class="modal-dialog">
            <div class="modal-content" style="width: 1024px">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Barang</h4>
              </div>
              <div class="modal-body">
                
                <table class="table table-striped table-hover table-bordered" id="example2">
                                            <thead>
                                                    <th> Jenis Umum</th>
                                                    <th> Sub Jenis </th>
                                                    <th> Supplier </th>
                                                    <th> Ukuran(Size) </th>
                                                    <th> Jenis </th>
                                                    <th> Kode Barang </th>
                                                    <th> Nama Barang </th>
                                                    <th> Harga Jual (Offline) </th>
                                                    <th> Action </th>
                                            </thead>
                                            
                                        </table>

              </div>
              <div class="modal-footer">
                
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <script>
        function tambah(id){
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              var barang = JSON.parse(this.responseText);
              document.getElementById("nama_barang").value=barang.NAMA_JNS;
              document.getElementById("kode_barcode").value=barang.KODE_BARCODE;
              document.getElementById("hrg_barang").value=barang.HARGA_PCS;
              document.getElementById("tot_barang").value=barang.HARGA_PCS;
              document.getElementById("jum_barang").value=1;
              document.getElementById("jenis_umum").value=barang.KODE_JU;
              document.getElementById("jenis").value=barang.KODE_JNS;
              document.getElementById("size").value=barang.KODE_SZ;
              document.getElementById("sub_jenis").value=barang.KODE_SJ;
              
              //console.log();
              }
            };
          xhttp.open("GET", "<?= base_url() ?>index.php/Pembelian/tambahKode/"+id, true);
          xhttp.send();
        }

        
        </script>