<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Piutang extends CI_Controller {

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
	public $label = ['Kode','Nama Piutang','GL Piutang','GL Pendapatan'];
	public function index()
	{
		$this->load->view('index',['title'=>'Piutang']);
	}

	public function add()
	{
		$form = [];
		$field = $this->db->field_data('p001');
		$valAI = $this->autoInc();
		
			$form[] = ['type'=>'text','name'=>'KODE_PIN','value'=>$valAI,'pk'=>1,'label'=>$this->label[0]];
			$form[] = ['type'=>'text','name'=>'NAMA_PIN','value'=>'','label'=>$this->label[1]];
			$form[] = ['type'=>'text','name'=>'SGL_PIN','value'=>'','label'=>$this->label[2]];
			$form[] = ['type'=>'text','name'=>'SGL_PDPT','value'=>'','label'=>$this->label[3]];
		
			$this->load->view('index',['title'=>'Tambah Piutang','field'=>$form]);
	}

	public function edit($id)
	{
		$val = (array) $this->db->get_where('p001',['KODE_PIN'=>$id])->row();
		$form = [];
		$field = $this->db->field_data('p001');
		$form[] = ['type'=>'text','name'=>'KODE_PIN','value'=>$val['KODE_PIN'],'pk'=>1,'label'=>$this->label[0]];
			$form[] = ['type'=>'text','name'=>'NAMA_PIN','value'=>$val['NAMA_PIN'],'label'=>$this->label[1]];
			$form[] = ['type'=>'text','name'=>'SGL_PIN','value'=>$val['SGL_PIN'],'label'=>$this->label[2]];
			$form[] = ['type'=>'text','name'=>'SGL_PDPT','value'=>$val['SGL_PDPT'],'label'=>$this->label[3]];
			$this->load->view('index',['title'=>'Edit Piutang','field'=>$form]);
		
	}

	public function proses($type){
		if($type=="add"){
			$this->db->insert('p001',$this->input->post());
		}else {
			$this->db->where('KODE_PIN',$this->input->post('KODE_PIN'));
			$this->db->update('p001',$this->input->post());
		}
		redirect('Piutang');
	}

	public function autoInc(){
		$query = $this->db->select('KODE_PIN')->order_by('KODE_PIN',"DESC")->limit(1)->get('P001')->row();
		$exNum = explode('.', $query->KODE_PIN);
		$num=(int)$exNum[1];
		$num=$num+1;
		if($num<1000 && $num>99){
			$numInt = "0".$num;
		}else if($num<100 && $num>9){
			$numInt="00".$num;
		}else if($num<10){
			$numInt="000".$num;
		}else{
			$numInt=$num;
		}
		return "P.".$numInt;
	}

	public function delete($id){
			$this->db->where('KODE_PIN',$id);
			$this->db->delete('p001');
			redirect('Piutang');
	}

	function getdata($type=null){
				header('Access-Control-Allow-Origin: *'); 
				$requestData= $_REQUEST;
				

				$columns = array('KODE_PIN','NAMA_PIN','SGL_PIN','SGL_PDPT');
				//$sel=implode(",", $columns);

				/*$sql = "SELECT $sel ";
				$sql.=" FROM po where id_user = '$session' $add_q";*/
				$sqlQuery = "SELECT *
							FROM ( SELECT *, ROW_NUMBER() OVER (ORDER BY [KODE_PIN]) AS RowNum
							FROM [db_InTyasSalatiga].[dbo].[P001] ) AS SOD
							WHERE SOD.RowNum BETWEEN ".$requestData['start']."+1
							AND ".$requestData['start']."+".$requestData['length']."";
				$sql = $this->db->select('KODE_PIN,NAMA_PIN,SGL_PIN,SGL_PDPT')
								->get('P001');
				$totalData = $sql->num_rows();
				$totalFiltered = $totalData;  
				if( $requestData['search']['value'] ) {
					$sqlQuery.="AND KODE_PIN LIKE '%".$requestData['search']['value']."%' OR NAMA_PIN LIKE '%".$requestData['search']['value']."%' ORDER BY ".$columns[$requestData['order'][0]['column']]." ".$requestData['order'][0]['dir']."";
				/*$sql = $this->db->select('kode_piutang,nama_piutang,sgl_piut,sgl_pdpt')
								->like('kode_piutang',$requestData['search']['value'])
								->or_like('nama_piutang',$requestData['search']['value'])
								->order_by($columns[$requestData['order'][0]['column']],$requestData['order'][0]['dir'])
								->limit($requestData['start']." ,".$requestData['length'])
								->get('p001');*/
								
				$sql = $this->db->query($sqlQuery);
				$totalFiltered = $sql->num_rows(); 
			    $res=$sql->result_array();
				
			} else { 	

				$sql = $this->db->query($sqlQuery);
								
				$res=$sql->result_array();
				
			}

			$data = [];
			foreach( $res as $k=>$row) {  
				$nestedData=array(); 
				$nestedData[] = $row["KODE_PIN"];
				$nestedData[] = $row["NAMA_PIN"];
				$nestedData[] = $row["SGL_PIN"];
				$nestedData[] = $row["SGL_PDPT"];
				$nestedData[] = "<a class='btn btn-success' href='".base_url()."index.php/".$this->uri->segment(1)."/edit/".$row["KODE_PIN"]."'><span class='glyphicon glyphicon-pencil'> </span>Edit</a><a class='btn btn-danger' href='".base_url()."index.php/".$this->uri->segment(1)."/delete/".$row["KODE_PIN"]."'><span class='glyphicon glyphicon-trash'> </span>Delete</a>";
				
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
