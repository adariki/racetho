<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JenisUmum extends CI_Controller {

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
	public $label = ['Kode'
      ,'Keterangan'
      ,'GL Persediaan'
      ,'GL Pendapatan'
      ,'GL Diskon Jual'
      ,'GL Pembelian'
      ,'GL HPP'
      ,'GL Return'];
	public function index()
	{
		$this->load->view('index',['title'=>'Jenis Umum']);
	}

	public function add()
	{
		$form = [];
		$fk="SGL_SEDIA";
		$fk2="SGL_PDPT";
		$fk3="SGL_DISJUAL";
		$fk4="SGL_PEMBELIAN";
		$fk5="SGL_HPP";
		$fk6="SGL_RETURNJUAL"; 
		$comboSlQuery = $this->db->select('codesl,namasl')
									 ->get('G003')->result_array();
		foreach ($comboSlQuery as $key5 => $value5) {
			$comboSl[$value5['codesl']] = $value5['namasl'];
		}
		$valAI = $this->autoInc();
		$field = $this->db->field_data('B001');
		/*echo '<pre>';
		print_r($dataOptions);die();*/
		/*foreach ($field as $key => $value) {
			if($value->type=='nvarchar' && $value->name!=$fk){
				$form[] = ['type'=>'text','name'=>$value->name,'value'=>'','pk'=>0];
			}else if($value->type!='nvarchar' && $value->name!=$fk){
				$form[] = ['type'=>'number','name'=>$value->name,'value'=>'','pk'=>0];
			}else if($value->name==$fk){
				$form[] = ['type'=>'select','name'=>$value->name,'options'=>$comboSl];
			}else if($value->name==$fk2){
				$form[] = ['type'=>'select','name'=>$value->name,'options'=>$comboSl];
			}else if($value->name==$fk3){
				$form[] = ['type'=>'select','name'=>$value->name,'options'=>$comboSl];
			}else if($value->name==$fk4){
				$form[] = ['type'=>'select','name'=>$value->name,'options'=>$comboSl];
			}else if($value->name==$fk5){
				$form[] = ['type'=>'select','name'=>$value->name,'options'=>$comboSl];
			}

		}*/
			$form[] = ['type'=>'text','name'=>'KODE_JU','value'=>$valAI,'pk'=>1,'label'=>$this->label[0]];
			$form[] = ['type'=>'text','name'=>'KETERANGAN','value'=>'','pk'=>0,'label'=>$this->label[1]];
			$form[] = ['type'=>'select','name'=>'SGL_SEDIA','options'=>$comboSl,'pk'=>0,'label'=>$this->label[2]];
			$form[] = ['type'=>'select','name'=>'SGL_PDPT','options'=>$comboSl,'pk'=>0,'label'=>$this->label[3]];
			$form[] = ['type'=>'select','name'=>'SGL_DISJUAL','options'=>$comboSl,'pk'=>0,'label'=>$this->label[4]];
			$form[] = ['type'=>'select','name'=>'SGL_PEMBELIAN','options'=>$comboSl,'pk'=>0,'label'=>$this->label[5]];
			$form[] = ['type'=>'select','name'=>'SGL_HPP','options'=>$comboSl,'pk'=>0,'label'=>$this->label[6]];
			$form[] = ['type'=>'select','name'=>'SGL_RETURNJUAL','options'=>$comboSl,'pk'=>0,'label'=>$this->label[7]];
			$this->load->view('index',['title'=>'Tambah Jenis Umum','field'=>$form]);
	}

	public function edit($id)
	{
		$val = (array) $this->db->get_where('B001',['KODE_JU'=>$id])->row();
		$form = [];
		$fk = "";
		$comboSlQuery = $this->db->select('codesl,namasl')
									 ->get('G003')->result_array();
		foreach ($comboSlQuery as $key5 => $value5) {
			$comboSl[$value5['codesl']] = $value5['namasl'];
		}
		//print_r($val);die();
		$field = $this->db->field_data('B001');
		/*foreach ($field as $key => $value) {
			if($value->type=='nvarchar' && $value->name!=$fk){
				$form[] = ['type'=>'text',
							'name'=>$value->name,
							'value'=>$val[$value->name],
							'pk'=>$value->primary_key];
			}else if($value->type!='nvarchar' && $value->name!=$fk){
				$form[] = ['type'=>'number'
							,'name'=>$value->name,
							'value'=>$val[$value->name],
							'pk'=>$value->primary_key];
			}else if($value->name==$fk){
				$form[] = ['type'=>'select','name'=>$value->name,'options'=>$dataOptions,'value'=>$val[$value->name]];
			}
		}*/
		$form[] = ['type'=>'text','name'=>'KODE_JU','value'=>$val['KODE_JU'],'pk'=>1,'label'=>$this->label[0]];
			$form[] = ['type'=>'text','name'=>'KETERANGAN','value'=>$val['KETERANGAN'],'pk'=>0,'label'=>$this->label[1]];
			$form[] = ['type'=>'select','name'=>'SGL_SEDIA','options'=>$comboSl,'pk'=>0,'value'=>$val['SGL_SEDIA'],'label'=>$this->label[2]];
			$form[] = ['type'=>'select','name'=>'SGL_PDPT','options'=>$comboSl,'pk'=>0,'value'=>$val['SGL_PDPT'],'label'=>$this->label[3]];
			$form[] = ['type'=>'select','name'=>'SGL_DISJUAL','options'=>$comboSl,'pk'=>0,'value'=>$val['SGL_DISJUAL'],'label'=>$this->label[4]];
			$form[] = ['type'=>'select','name'=>'SGL_PEMBELIAN','options'=>$comboSl,'pk'=>0,'value'=>$val['SGL_PEMBELIAN'],'label'=>$this->label[5]];
			$form[] = ['type'=>'select','name'=>'SGL_HPP','options'=>$comboSl,'pk'=>0,'value'=>$val['SGL_HPP'],'label'=>$this->label[6]];
			$form[] = ['type'=>'select','name'=>'SGL_RETURNJUAL','options'=>$comboSl,'pk'=>0,'value'=>$val['SGL_RETURNJUAL'],'label'=>$this->label[7]];
			$this->load->view('index',['title'=>'Edit Jenis Umum','field'=>$form]);
		
	}

	public function proses($type){
		if($type=="add"){
			$this->db->insert('B001',$this->input->post());
		}else{
			$this->db->where('KODE_JU',$this->input->post('KODE_JU'));
			$this->db->update('B001',$this->input->post());
		}
		redirect('JenisUmum');
	}

	public function delete($id){
		$this->db->where('KODE_JU',$id);
		$this->db->delete('B001');
		redirect('JenisUmum');
	}

	public function autoInc(){
		$query = $this->db->select('KODE_JU')->order_by('KODE_JU',"DESC")->limit(1)->get('B001')->row();
		$num=(int) $query->KODE_JU;
		$num=$num+1;
		if($num<10){
			$numInt = "0".$num;
		}else{
			$numInt=$num;
		}
		return $numInt;
	}

	function getdata($type=null){
				header('Access-Control-Allow-Origin: *'); 
				$requestData= $_REQUEST;
				

				$columns = array(
		      'KODE_JU'
      ,'KETERANGAN'
      ,'SGL_SEDIA'
      ,'SGL_PDPT'
      ,'SGL_DISJUAL'
      ,'SGL_DISBELI'
      ,'SGL_PEMBELIAN'
      ,'SGL_HPP'
      ,'SGL_RETURNJUAL'
		      );
				//$sel=implode(",", $columns);
				$sqlQuery = "SELECT *
							FROM ( SELECT *, ROW_NUMBER() OVER (ORDER BY [KODE_JU]) AS RowNum
							FROM [db_InTyasSalatiga].[dbo].[B001] ) AS SOD
							WHERE SOD.RowNum BETWEEN ".$requestData['start']."+1
							AND ".$requestData['start']."+".$requestData['length']."";
				/*$sql = "SELECT $sel ";
				$sql.=" FROM po where id_user = '$session' $add_q";*/
				$sql = $this->db->get('B001');
				$totalData = $sql->num_rows();
				$totalFiltered = $totalData;  
				if( $requestData['search']['value'] ) {
					$sqlQuery.="AND KODE_JU LIKE '%".$requestData['search']['value']."%' OR KETERANGAN LIKE '%".$requestData['search']['value']."%' ORDER BY ".$columns[$requestData['order'][0]['column']]." ".$requestData['order'][0]['dir']."";
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
				$nestedData[] = $row["KODE_JU"];
				$nestedData[] = $row["KETERANGAN"];
				$nestedData[] = $row["SGL_SEDIA"];
				$nestedData[] = $row["SGL_PDPT"];
				$nestedData[] = $row["SGL_DISJUAL"];
				$nestedData[] = $row["SGL_DISBELI"];
				$nestedData[] = $row["SGL_PEMBELIAN"];
				$nestedData[] = $row["SGL_HPP"];
				$nestedData[] = $row["SGL_RETURNJUAL"];
				$nestedData[] = "<a class='btn btn-success' href='".base_url()."index.php/".$this->uri->segment(1)."/edit/".$row["KODE_JU"]."'><span class='glyphicon glyphicon-pencil'> </span></a><a class='btn btn-danger' href='".base_url()."index.php/".$this->uri->segment(1)."/delete/".$row["KODE_JU"]."'><span class='glyphicon glyphicon-trash'> </span></a>";
				
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
