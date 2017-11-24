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
                  <?php $dataOptions = $this->db->select('KODE_JU,KETERANGAN')->get('B001')->result_array();?>
                  <option>Silakan Pilih Supplier</option>
                  <?php foreach($dataOptions as $key=>$value){
                    echo "<option value='".$value['KODE_JU']."'>".$value['KETERANGAN']."</option>";
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
                  <a class="btn btn-success" href="<?= base_url()?>index.php/<?= $this->uri->segment(1)?>/add">Add</a><br>
                                        <table class="table table-striped table-hover table-bordered" id="example1">
                                            <thead>
                                                <tr>
                                                    <th> Kode </th>
                                                    <th> CP </th>
                                                    <th> Nama </th>
                                                    <th> Alamat </th>
                                                    <th> Kota </th>
                                                    <th> Telepon </th>
                                                    <th> Npwp </th>
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