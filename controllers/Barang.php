<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public $label = ['Barcode','Nama Barang','Jenis Umum','Sub Jenis','Ukuran','Supplier','Jenis','Harga Jual(Offline)','Harga Jual(Online)'];
	public function index()
	{
		$this->load->view('index',['title'=>'Barang']);
	}

	public function add()
	{
		$form = [];
		$fk = "KODE_JU";
		$fk2 = "KODE_SJ";
		$fk3 = "KODE_SZ";
		$fk4 = "KODE_SPL";
		$dataOptionsQuery = $this->db->select('KODE_JU,KETERANGAN')
									 ->get('B001')->result_array();
		foreach ($dataOptionsQuery as $key => $value) {
			$dataOptions[$value['KODE_JU']] = $value['KETERANGAN'];
		}
		$dataOptionsQuery2 = $this->db->select('KODE_SJ,KETERANGAN')
									 ->get('B001A')->result_array();
		foreach ($dataOptionsQuery2 as $key2 => $value2) {
			$dataOptions2[$value2['KODE_SJ']] = $value2['KETERANGAN'];
		}
		$dataOptionsQuery3 = $this->db->select('KODE_SZ,KETERANGAN')
									 ->get('B001B')->result_array();
		foreach ($dataOptionsQuery3 as $key3 => $value3) {
			$dataOptions3[$value3['KODE_SZ']] = $value3['KETERANGAN'];
		}
		$dataOptionsQuery4 = $this->db->select('KODE_SPL,NAMA_SPL')
									 ->get('C007')->result_array();
		foreach ($dataOptionsQuery4 as $key4 => $value4) {
			$dataOptions4[$value4['KODE_SPL']] = $value4['NAMA_SPL'];
		}
		$dataOptionsQuery5 = $this->db->select('KODE_JNS,KETERANGAN')
									 ->get('B001C')->result_array();
		foreach ($dataOptionsQuery5 as $key5 => $value5) {
			$dataOptions5[$value5['KODE_JNS']] = $value5['KETERANGAN'];
		}

		$field = $this->db->select('KODE_JU,KODE_SJ,KODE_SPL,KODE_SZ,KODE_BARCODE
      ,NAMA_JNS,HJUAL_PCS,HJUAL_PCS_1')->get('B003')->field_data();
		/*echo '<pre>';
		print_r($dataOptions);die();*/
			$form[]=['type'=>'text','name'=>'KODE_BARCODE','label'=>$this->label[0]];
			$form[]=['type'=>'text','name'=>'NAMA_JNS','label'=>$this->label[1]];
			$form[]=['type'=>'select','name'=>'KODE_JU','options'=>$dataOptions,'label'=>$this->label[2]];
			$form[]=['type'=>'select','name'=>'KODE_SJ','options'=>$dataOptions2,'label'=>$this->label[3]];
			$form[]=['type'=>'select','name'=>'KODE_SZ','options'=>$dataOptions3,'label'=>$this->label[4]];
			$form[]=['type'=>'select','name'=>'KODE_SPL','options'=>$dataOptions4,'label'=>$this->label[5]];
			$form[]=['type'=>'select','name'=>'KODE_JNS','options'=>$dataOptions5,'label'=>$this->label[6]];
			$form[]=['type'=>'number','name'=>'HJUAL_PCS','label'=>$this->label[7]];
			$form[]=['type'=>'number','name'=>'HJUAL_PCS_1','label'=>$this->label[8]];
		
			$this->load->view('index',['title'=>'Tambah Barang','field'=>$form]);
	}

	public function edit($id)
	{
		$val = (array) $this->db->get_where('B003',['KODE_BARCODE'=>$id])->row();
		$form = [];
		$fk = "KODE_JU";
		$fk2 = "KODE_SJ";
		$fk3 = "KODE_SZ";
		$fk4 = "KODE_SPL";
		$dataOptionsQuery = $this->db->select('KODE_JU,KETERANGAN')
									 ->get('B001')->result_array();
		foreach ($dataOptionsQuery as $key => $value) {
			$dataOptions[$value['KODE_JU']] = $value['KETERANGAN'];
		}
		$dataOptionsQuery2 = $this->db->select('KODE_SJ,KETERANGAN')
									 ->get('B001A')->result_array();
		foreach ($dataOptionsQuery2 as $key2 => $value2) {
			$dataOptions2[$value2['KODE_SJ']] = $value2['KETERANGAN'];
		}
		$dataOptionsQuery3 = $this->db->select('KODE_SZ,KETERANGAN')
									 ->get('B001B')->result_array();
		foreach ($dataOptionsQuery3 as $key3 => $value3) {
			$dataOptions3[$value3['KODE_SZ']] = $value3['KETERANGAN'];
		}
		$dataOptionsQuery4 = $this->db->select('KODE_SPL,NAMA_SPL')
									 ->get('C007')->result_array();
		foreach ($dataOptionsQuery4 as $key4 => $value4) {
			$dataOptions4[$value4['KODE_SPL']] = $value4['NAMA_SPL'];
		}
		$dataOptionsQuery5 = $this->db->select('KODE_JNS,KETERANGAN')
									 ->get('B001C')->result_array();
		foreach ($dataOptionsQuery5 as $key5 => $value5) {
			$dataOptions5[$value5['KODE_JNS']] = $value5['KETERANGAN'];
		}
		//$field = $this->db->select("NAMA_JNS")->get('B003')->field_data();
		//print_r($field);die();
		/*foreach ($field as $key => $value) {
			if($value->type=='nvarchar'){
				$form[] = ['type'=>'text',
							'name'=>$value->name,
							'value'=>$val[$value->name],
							'pk'=>$value->primary_key];
			}else if($value->type!='nvarchar' && $value->name!=$fk && $value->name!=$fk2 && $value->name!=$fk3){
				$form[] = ['type'=>'number'
							,'name'=>$value->name,
							'value'=>$val[$value->name],
							'pk'=>$value->primary_key];
			}else if($value->name==$fk){
				$form[] = ['type'=>'select','name'=>$value->name,'options'=>$dataOptions,'value'=>$val[$value->name]];
			}else if($value->name==$fk2){
				$form[] = ['type'=>'select','name'=>$value->name,'options'=>$dataOptions2,'value'=>$val[$value->name]];
			}else if($value->name==$fk3){
				$form[] = ['type'=>'select','name'=>$value->name,'options'=>$dataOptions3,'value'=>$val[$value->name]];
			}else if($value->name==$fk4){
				$form[] = ['type'=>'select','name'=>$value->name,'options'=>$dataOptions4,'value'=>$val[$value->name]];
			}
		}*/
			$form[]=['type'=>'text','name'=>'KODE_BARCODE','value'=>$val['KODE_BARCODE'],'pk'=>1,'label'=>$this->label[0]];
			$form[]=['type'=>'text','name'=>'NAMA_JNS','value'=>$val['NAMA_JNS'],'label'=>$this->label[1]];
			$form[]=['type'=>'select','name'=>'KODE_JU','options'=>$dataOptions,'value'=>$val['KODE_JU'],'label'=>$this->label[2]];
			$form[]=['type'=>'select','name'=>'KODE_SJ','options'=>$dataOptions2,'value'=>$val['KODE_SJ'],'label'=>$this->label[3]];
			$form[]=['type'=>'select','name'=>'KODE_SZ','options'=>$dataOptions3,'value'=>$val['KODE_SZ'],'label'=>$this->label[4]];
			$form[]=['type'=>'select','name'=>'KODE_SPL','options'=>$dataOptions4,'value'=>$val['KODE_SPL'],'label'=>$this->label[5]];
			$form[]=['type'=>'select','name'=>'KODE_JNS','options'=>$dataOptions5,'value'=>$val['KODE_JNS'],'label'=>$this->label[6]];
			$form[]=['type'=>'number','name'=>'HJUAL_PCS','value'=>$val['HJUAL_PCS'],'label'=>$this->label[7]];
			$form[]=['type'=>'number','name'=>'HJUAL_PCS_1','value'=>$val['HJUAL_PCS_1'],'label'=>$this->label[8]];

			$this->load->view('index',['title'=>'Edit Barang','field'=>$form]);
		
	}

	public function proses($type){
		if($type=="add"){
			$this->db->insert('b003',$this->input->post());
		}else{
			$this->db->where('KODE_BARCODE',$this->input->post('KODE_BARCODE'));
			$this->db->update('b003',$this->input->post());
		}
		redirect('Barang');
	}

	public function delete($id){
		$this->db->where('KODE_BARCODE',$id);
		$this->db->delete('b003');
		redirect('Barang');
	}
	function getdata($type=null){
				header('Access-Control-Allow-Origin: *'); 
				$requestData= $_REQUEST;
				$dataOptionsQuery = $this->db->select('KODE_JU,KETERANGAN')
									 ->get('B001')->result_array();
				foreach ($dataOptionsQuery as $key => $value) {
					$dataOptions[$value['KODE_JU']] = $value['KETERANGAN'];
				}
				$dataOptionsQuery2 = $this->db->select('KODE_SJ,KETERANGAN')
											 ->get('B001A')->result_array();
				foreach ($dataOptionsQuery2 as $key2 => $value2) {
					$dataOptions2[$value2['KODE_SJ']] = $value2['KETERANGAN'];
				}
				$dataOptionsQuery3 = $this->db->select('KODE_SZ,KETERANGAN')
											 ->get('B001B')->result_array();
				foreach ($dataOptionsQuery3 as $key3 => $value3) {
					$dataOptions3[$value3['KODE_SZ']] = $value3['KETERANGAN'];
				}
				$dataOptionsQuery4 = $this->db->select('KODE_SPL,NAMA_SPL')
											 ->get('C007')->result_array();
				foreach ($dataOptionsQuery4 as $key4 => $value4) {
					$dataOptions4[$value4['KODE_SPL']] = $value4['NAMA_SPL'];
				}
				$dataOptionsQuery5 = $this->db->select('KODE_JNS,KETERANGAN')
									 ->get('B001C')->result_array();
				foreach ($dataOptionsQuery5 as $key5 => $value5) {
					$dataOptions5[$value5['KODE_JNS']] = $value5['KETERANGAN'];
				}

				$columns = array('KODE_JU'
		      ,'KODE_SJ'
		      ,'KODE_SPL'
		      ,'KODE_SZ'
		      ,'KODE_JNS'
		      ,'KODE_BARCODE'
		      ,'NAMA_JNS'
		      ,'JML_AWAL'
		      ,'JML_DBT'
		      ,'JML_CRD'
		      ,'JML_AKHIR'
		      ,'SALDO_AWAL'
		      ,'MUTASI_DBT'
		      ,'MUTASI_CRT'
		      ,'SALDO_AKHIR'
		      ,'HJUAL_PCS'
		      ,'DISCOUNT'
		      ,'DISGROSIR'
		      ,'MT_LABA'
		      ,'PERSEN'
		      ,'MT_STOCK'
		      ,'HJUAL_PCS_1'
		      ,'HJUAL_PCS_2'
		      ,'HJUAL_PCS_3'
		      ,'HJUAL_PCS_4'
      		  ,'HJUAL_PCS_5');
				//$sel=implode(",", $columns);
				$sqlQuery = "SELECT *
							FROM ( SELECT *, ROW_NUMBER() OVER (ORDER BY [KODE_BARCODE]) AS RowNum
							FROM [db_InTyasSalatiga].[dbo].[B003] ) AS SOD
							WHERE SOD.RowNum BETWEEN ".$requestData['start']."+1
							AND ".$requestData['start']."+".$requestData['length']."";
				/*$sql = "SELECT $sel ";
				$sql.=" FROM po where id_user = '$session' $add_q";*/
				$sql = $this->db->get('B003');
				$totalData = $sql->num_rows();
				$totalFiltered = $totalData;  
				if( $requestData['search']['value'] ) {
					$sqlQuery.="AND KODE_BARCODE LIKE '%".$requestData['search']['value']."%' OR NAMA_JNS LIKE '%".$requestData['search']['value']."%' ORDER BY ".$columns[$requestData['order'][0]['column']]." ".$requestData['order'][0]['dir']."";
				$sql=$this->db->query($sqlQuery);
				$totalFiltered = $sql->num_rows(); 
			    $res=$sql->result_array();
			} else { 
			$sqlQuery.=" ORDER BY ".$columns[$requestData['order'][0]['column']]." ".$requestData['order'][0]['dir']."";	
				$sql=$this->db->query($sqlQuery);
				$res=$sql->result_array();
			}

			$data = [];
			foreach( $res as $k=>$row) {  
				$nestedData=array(); 
				$nestedData[] = $dataOptions[$row["KODE_JU"]];
				$nestedData[] = $dataOptions2[$row["KODE_SJ"]];
				$nestedData[] = $dataOptions4[$row["KODE_SPL"]];
				$nestedData[] = $dataOptions3[$row["KODE_SZ"]];
				$nestedData[] = $dataOptions5[$row["KODE_JNS"]];
				$nestedData[] = $row["KODE_BARCODE"];
				$nestedData[] = $row["NAMA_JNS"];
				$nestedData[] = $row["HJUAL_PCS"];
				$nestedData[] = $row["HJUAL_PCS_1"];
				
				$nestedData[] = "<a class='btn btn-success' href='".base_url()."index.php/".$this->uri->segment(1)."/edit/".$row["KODE_BARCODE"]."'><span class='glyphicon glyphicon-pencil'> </span>Edit</a><a class='btn btn-danger' href='".base_url()."index.php/".$this->uri->segment(1)."/delete/".$row["KODE_BARCODE"]."'><span class='glyphicon glyphicon-trash'> </span>Delete</a>";
				
				$data[] = $nestedData;
			}
			$json_data = array(
						"draw"            => intval( $requestData['draw'] ),
						"recordsTotal"    => intval( $totalData ),
						"recordsFiltered" => intval( $totalFiltered ),
						"data"            => $data
						);

			echo json_encode($json_data);
    }
}
