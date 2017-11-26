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

	public function add()
	{
		$form = [];
		$field = $this->db->field_data('c012');
		foreach ($field as $key => $value) {
			if($value->type=='nvarchar'){
				$form[] = ['type'=>'text','name'=>$value->name,'value'=>''];
			}else{
				$form[] = ['type'=>'number','name'=>$value->name,'value'=>''];
			}
		}
		
			$this->load->view('index',['title'=>'Tambah Customer','field'=>$form]);
	}

	public function edit($id)
	{
		$val = (array) $this->db->get_where('c012',['KODE_CST'=>$id])->row();
		$form = [];
		$field = $this->db->field_data('c012');
		foreach ($field as $key => $value) {
			if($value->type=='nvarchar'){
				$form[] = ['type'=>'text','name'=>$value->name,
							'value'=>$val[$value->name]];
			}else{
				$form[] = ['type'=>'number'
							,'name'=>$value->name,
							'value'=>$val[$value->name]];
			}
		}
			$this->load->view('index',['title'=>'Edit Customer','field'=>$form]);
		
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
				$nestedData[] = "<a class='btn btn-success' href='".base_url()."index.php/".$this->uri->segment(1)."/edit/".$row["KODE_CST"]."'><span class='glyphicon glyphicon-pencil'> </span>Edit</a><a class='btn btn-danger' href='".base_url()."index.php/".$this->uri->segment(1)."/delete/".$row["KODE_CST"]."'><span class='glyphicon glyphicon-trash'> </span>Delete</a>";
				
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
}
