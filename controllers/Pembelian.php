<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian extends CI_Controller {

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
	public function index()
	{
		$query=$this->db->get('C007')->result_array();
		foreach ($query as $key => $value) {
			$dataOptions[$value['KODE_SPL']]=$value['NAMA_SPL'];
		}
		$form[]=['type'=>'select','name'=>'KODE_SPL','options'=>$dataOptions,'value'=>$val['KODE_SPL']];
		$this->load->view('index',['title'=>'Pembelian','form'=>$form]);
	}

	public function selectJu(){
		$query=$this->db->select('KODE_JU,KETERANGAN')->get('B001')->result_array();
		foreach ($query as $key => $value) {
			$datajson[] = ["KODE_JU"=>$value['KODE_JU'],"KETERANGAN"=>$value['KETERANGAN']];
		}
		echo json_encode($datajson);
	}
	public function selectSj(){
		$query=$this->db->select('KODE_SJ,KETERANGAN')->get('B001A')->result_array();
		foreach ($query as $key => $value) {
			$datajson[] = ["KODE_SJ"=>$value['KODE_SJ'],"KETERANGAN"=>$value['KETERANGAN']];
		}
		echo json_encode($datajson);
	}
	public function selectSz(){
		$query=$this->db->select('KODE_SZ,KETERANGAN')->get('B001B')->result_array();
		foreach ($query as $key => $value) {
			$datajson[] = ["KODE_SZ"=>$value['KODE_SZ'],"KETERANGAN"=>$value['KETERANGAN']];
		}
		echo json_encode($datajson);
	}
	public function selectJenis(){
		$query=$this->db->select('KODE_JNS,KETERANGAN')->get('B001C')->result_array();
		foreach ($query as $key => $value) {
			$datajson[] = ["KODE_JNS"=>$value['KODE_JNS'],"KETERANGAN"=>$value['KETERANGAN']];
		}
		echo json_encode($datajson);
	}
	public function selectKodeBarcode($id){
		$query=$this->db->get_where('B003',['KODE_BARCODE'=>$id])->row();
		$datajson = ["KODE_BARCODE"=>$query->KODE_BARCODE,"NAMA_JNS"=>$query->NAMA_JNS,"HJUAL_PCS"=>$query->HJUAL_PCS];
		echo json_encode($datajson);
	}

	public function selectBank(){
		$query=$this->db->get('C006')->result();
		foreach ($query as $key => $value) {
			$datajson[] = ["ID"=>$value->ID,"NOREK"=>$value->NOREK,"BANK"=>$value->BANK,"NAMA"=>$value->NAMA];
		}
		
		echo json_encode($datajson);
	}

	public function selectHutang(){
		$query=$this->db->get('H001')->result();
		foreach ($query as $key => $value) {
			$datajson[] = ["KODE_HUTANG"=>$value->Kode_hutang,"NAMA"=>$value->Nama_hutang];
		}
		
		echo json_encode($datajson);
	}

	public function generateBarcode(){
		$post = $this->input->post();
		
		$num = $this->db->get('B003')->num_rows();
		$num = $num + 1;
		if($num<1000 && $num>99){
			$numInt = "0".$num;
		}else if($num<100 && $num>9){
			$numInt="00".$num;
		}else if($num<10){
			$numInt="000".$num;
		}else{
			$numInt=$num;
		}
		$kodeBar=$post['jenis_umum'].$post['sub_jenis'].$post['supplier'].$post['size'].$post['jenis'];
		$this->db->like('KODE_BARCODE',(int)$kodeBar);
		$queryGenBar = $this->db->select('KODE_BARCODE,NAMA_JNS')->get('B003')->result_array();
		foreach ($queryGenBar as $key => $value) {
			$datajson[] = ["KODE_BARCODE"=>$value['KODE_BARCODE'],"NAMA_JNS"=>$value['NAMA_JNS']];
		}
		echo json_encode($datajson);
	}

	public function tambahKode($id){
		$query = $this->db->get_where('B003',['KODE_BARCODE'=>$id])->row();
		$dataBarang = ['KODE_BARCODE'=>$query->KODE_BARCODE,'NAMA_JNS'=>$query->NAMA_JNS,'HARGA_PCS'=>$query->HJUAL_PCS,'KODE_JU'=>$query->KODE_JU,'KODE_SJ'=>$query->KODE_SJ,'KODE_SZ'=>$query->KODE_SZ,'KODE_JNS'=>$query->KODE_JNS];
		echo json_encode($dataBarang);
	}

	public function add()
	{
		$post=$this->input->post();
		$arrayPost = [
		'NO_TRANS'=>$post['notrans'],
		'KODE_JU'=>$post['jenis_umum'],
		'NO_URUT'=>0001,
		'KODE_SJ'=>$post['sub_jenis'],
		'KODE_SZ'=>$post['size'],
		'KODE_JNS'=>$post['jenis'],
		'KODE_BARCODE'=>$post['kode_barcode'],
		'NAMA_JNS'=>$post['nama_barang'],
		'JML_BELI'=>$post['jum_barang'],
		'HARGA_PCS'=>$post['hrg_barang'],
		'JML_HARGA'=>$post['tot_barang'],
		'KODE_SPL'=>$post['supplier']
		];
		$this->db->insert('BL001',$arrayPost);
		//redirect('Pembelian');
	}

	public function addPembayaran()
	{
		$post=$this->input->post();
		if($post['bilyet_giro']==0){
			$post['rek_an2']="";
		}
		if($post['non_tunai']==0){
			$post['rek_an']="";
		}
		$arrayPost = [
		'NO_TRANS'=>$post['notrans'],
		'TOTAL_BELI'=>$post['tot_barang'],
		'TUNAI'=>$post['tunai'],
		'NON_TUNAI'=>$post['non_tunai'],
		'HUTANG'=>$post['hutang'],
		'BG'=>$post['bilyet_giro'],
		'ABA_NOREK'=>$post['rek_an'],
		'ABA_BANK'=>$post['no_rek'],
		'BG_NOMOR'=>$post['no_giro'],
		'BG_BANK'=>$post['rek_an2'],
		'BG_TGL'=>$post['tgl_bg'],
		'BG_JT'=>$post['tgl_jt'],
		'H_KODE'=>$post['kode_hutang'],
		'H_NOMOR'=>$post['no_hutang'],
		'H_TGL'=>$post['tgl_mulai'],
		'H_JT'=>$post['tgl_jatuh'],
		'H_KET'=>$post['syarat']
		];
		$this->db->insert('BL002',$arrayPost);
		redirect('Pembelian');
	}

	public function jumHarga($id){
		$query = $this->db->select('sum(JML_HARGA) as JML_HARGA')->get_where('BL001',['NO_TRANS'=>$id])->row();
		echo $query->JML_HARGA;
	}

	public function proses($type){
		if($type=="add"){
			$this->db->insert('BL001',$this->input->post());
		}else{
			$this->db->where('KODE_CST',$this->input->post('KODE_CST'));
			$this->db->update('BL001',$this->input->post());
		}
		redirect('Customer');
	}

	

	function getdata($type=null){
				header('Access-Control-Allow-Origin: *'); 
				$requestData= $_REQUEST;
				

				$columns = array('KODE_BARCODE','NAMA_JNS','JML_BELI','HARGA_PCS','JML_HARGA');
				//$sel=implode(",", $columns);
				$sqlQuery = "SELECT *
							FROM ( SELECT *, ROW_NUMBER() OVER (ORDER BY [ID]) AS RowNum
							FROM [db_InTyasSalatiga].[dbo].[BL001] ) AS SOD
							WHERE SOD.RowNum BETWEEN ".$requestData['start']."+1
							AND ".$requestData['start']."+".$requestData['length']."";
				/*$sql = "SELECT $sel ";
				$sql.=" FROM po where id_user = '$session' $add_q";*/
				$sql = $this->db->get('BL001');
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
				$nestedData[] = $row["KODE_BARCODE"];
				$nestedData[] = $row["NAMA_JNS"];
				$nestedData[] = $row["JML_BELI"];
				$nestedData[] = $row["HARGA_PCS"];
				$nestedData[] = $row["JML_HARGA"];
				$nestedData[] = "<a class='btn btn-danger' href='".base_url()."index.php/".$this->uri->segment(1)."/delete/".$row["KODE_CST"]."'><span class='glyphicon glyphicon-trash'> </span>Delete</a>";
				
				$data[] = $nestedData;
			}



			$json_data = array(
						"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
						"recordsTotal"    => intval( $totalData ),  // total number of records
						"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
						"data"            => $data // total data array
						);

			echo json_encode($json_data);
    }

    function getdataPop($type=null){
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
		      
		      ,'HJUAL_PCS'
		      
		      ,'HJUAL_PCS_1'
		      );
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
				$idx =  $row["KODE_BARCODE"];
				$nestedData=array(); 
				$nestedData[] = $dataOptions[$row["KODE_JU"]];
				$nestedData[] = $dataOptions2[$row["KODE_SJ"]];
				$nestedData[] = $dataOptions4[$row["KODE_SPL"]];
				$nestedData[] = $dataOptions3[$row["KODE_SZ"]];
				$nestedData[] = $dataOptions5[$row["KODE_JNS"]];
				$nestedData[] = $row["KODE_BARCODE"];
				$nestedData[] = $row["NAMA_JNS"];
				$nestedData[] = $row["HJUAL_PCS"];
				
				$nestedData[] = '<button class="btn btn-success brg" value="'.$idx.'" id="id-'.$idx.'" onclick="tambah('.$idx.')" data-dismiss="modal"><span class="glyphicon glyphicon-pencil"></span></button>';
				
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
