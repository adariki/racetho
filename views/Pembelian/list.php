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
            <h3>TRANSAKSI PEMBELIAN</h3>
              <div class="tab-pane active" id="tab_1">
                <div class="col-sm-12">
                <br>
                  <div class="col-sm-6">
                  <label for="nofaktur">No Faktur</label>
                  <input type="text" name="nofaktur" class="form-control" />
                  <label for="tglfaktur">Tanggal Faktur</label>
                  <input type="text" name="tglfaktur" class="form-control" />
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
                  <label for="notrans">No Transaksi :11.3284892</label><br>
                  <label for="tgltrans">Tgl Transaksi : <?= date("d-m-Y")?></label>
                 
                    </div>
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
                <select class="form-control" id="supplier" name="supplier" required>
                  <?php $dataOptions = $this->db->select('KODE_JU,KETERANGAN')->get('B001')->result_array();?>
                  <option>Silakan Pilih Supplier</option>
                  <?php foreach($dataOptions as $key=>$value){
                    echo "<option value='".$value['KODE_JU']."'>".$value['KETERANGAN']."</option>";
                    }?>
                  </select>
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

      <div class="modal fade" id="modal-default" >
          <div class="modal-dialog">
            <div class="modal-content" style="width: 800px">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Default Modal</h4>
              </div>
              <div class="modal-body">
                
                <form>
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
                   <!--  <input type="text" name="kode_barcode" id="kode_barcode" class="form-control" /> -->
                    <select class="form-control" name="kode_barcode" id="kode_barcode">
                      
                    </select> 
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" />
                </form>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>