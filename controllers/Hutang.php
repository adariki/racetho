<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hutang extends CI_Controller {

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
	public $label = ['Kode','Nama Hutang','GL Utang','GL Biaya'];
	public function index()
	{
		$this->load->view('index',['title'=>'Hutang']);
	}

	public function add()
	{
		$form = [];

		$field = $this->db->field_data('h001');
		$valAI = $this->autoInc();
		$dataOptionsQuery = $this->db->select('codesl,namasl')->get('G003')->result_array();
		foreach ($dataOptionsQuery as $key => $value) {
			$dataOptions[$value['codesl']]=$value['namasl'];
		}
		
			$form[] = ['type'=>'text','name'=>'Kode_hutang','value'=>$valAI,'pk'=>1,'label'=>$this->label[0]];
			$form[] = ['type'=>'text','name'=>'Nama_hutang','value'=>'','label'=>$this->label[1]];
			$form[] = ['type'=>'select','name'=>'SGL_HUTANG','options'=>$dataOptions,'label'=>$this->label[2],'value'=>''];
			$form[] = ['type'=>'select','name'=>'SGL_BIAYA','options'=>$dataOptions,'label'=>$this->label[3],'value'=>''];
		
			$this->load->view('index',['title'=>'Tambah Hutang','field'=>$form]);
	}

	public function edit($id)
	{
		$val = (array) $this->db->get_where('h001',['kode_hutang'=>$id])->row();
		$form = [];
		$field = $this->db->field_data('h001');
		$dataOptionsQuery = $this->db->select('codesl,namasl')->get('G003')->result_array();
		foreach ($dataOptionsQuery as $key => $value) {
			$dataOptions[$value['codesl']]=$value['namasl'];
		}
		$form[] = ['type'=>'text','name'=>'Kode_hutang','value'=>$val['Kode_hutang'],'pk'=>1,'label'=>$this->label[0]];
			$form[] = ['type'=>'text','name'=>'Nama_hutang','value'=>$val['Nama_hutang'],'label'=>$this->label[1]];
			$form[] = ['type'=>'select','name'=>'SGL_HUTANG','value'=>$val['SGL_HUTANG'],'label'=>$this->label[2],'options'=>$dataOptions];
			$form[] = ['type'=>'select','name'=>'SGL_BIAYA','value'=>$val['SGL_BIAYA'],'label'=>$this->label[3],'options'=>$dataOptions];
			$this->load->view('index',['title'=>'Edit Hutang','field'=>$form]);
		
	}

	public function proses($type){
		if($type=="add"){
			$this->db->insert('h001',$this->input->post());
		}else{
			$this->db->where('Kode_hutang',$this->input->post('Kode_hutang'));
			$this->db->update('h001',$this->input->post());
		}
		redirect('Hutang');
	}

	public function delete($id){
		$this->db->where('Kode_hutang',$id);
		$this->db->delete('h001');
		redirect('Hutang');
	}

	public function autoInc(){
		$query = $this->db->select('Kode_hutang')->order_by('Kode_hutang',"DESC")->limit(1)->get('H001')->row();
		$exNum = explode('.', $query->Kode_hutang);
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
		return "H.".$numInt;
	}
	
	function getdata($type=null){
				header('Access-Control-Allow-Origin: *'); 
				$requestData= $_REQUEST;
				

				$columns = array('kode_hutang','nama_hutang','sgl_hutang','sgl_biaya');
				//$sel=implode(",", $columns);

				/*$sql = "SELECT $sel ";
				$sql.=" FROM po where id_user = '$session' $add_q";*/
				$sqlQuery = "SELECT *
							FROM ( SELECT *, ROW_NUMBER() OVER (ORDER BY [Kode_hutang]) AS RowNum
							FROM [db_InTyasSalatiga].[dbo].[H001] ) AS SOD
							WHERE SOD.RowNum BETWEEN ".$requestData['start']."+1
							AND ".$requestData['start']."+".$requestData['length']."";
				$sql = $this->db->select('kode_hutang,nama_hutang,sgl_hutang,sgl_biaya')
								->get('h001');
				$totalData = $sql->num_rows();
				$totalFiltered = $totalData;  
				if( $requestData['search']['value'] ) {
				$sqlQuery.="AND Kode_hutang LIKE '%".$requestData['search']['value']."%' OR Nama_hutang LIKE '%".$requestData['search']['value']."%' ORDER BY ".$columns[$requestData['order'][0]['column']]." ".$requestData['order'][0]['dir']."";
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
				$nestedData[] = $row["Kode_hutang"];
				$nestedData[] = $row["Nama_hutang"];
				$nestedData[] = $row["SGL_HUTANG"];
				$nestedData[] = $row["SGL_BIAYA"];
				$nestedData[] = "<a class='btn btn-success' href='".base_url()."index.php/".$this->uri->segment(1)."/edit/".$row["Kode_hutang"]."'><span class='glyphicon glyphicon-pencil'> </span>Edit</a><a class='btn btn-danger' href='".base_url()."index.php/".$this->uri->segment(1)."/delete/".$row["Kode_hutang"]."'><span class='glyphicon glyphicon-trash'> </span>Delete</a>";
				
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
