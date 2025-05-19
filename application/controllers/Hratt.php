<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hratt extends CI_Controller {

	public function index()
	{
		$usr=$this->session->userdata('user_data');
		if(isset($usr)){
			//$view=$this->input->get("p");
			$data["session"]=$usr;
			$view="hratt";
			//if($usr["uaccess"]!='ADM') $view='unauthorize';
			$this->load->view($view,$data);
		}else{
			redirect(base_url()."sign/out/1");
		}
	}
	
	public function datatable()
	{
		$usr=$this->session->userdata('user_data');
		$data=array();
		if(isset($usr)){
			$nik=$usr['nik'];
			$sql="select dt,a.nik,nama,tmin,reasonin,tmout,reasonout,a.rowid from hr_attend a left join hr_kary k on k.nik=a.nik where a.nik='$nik'";
			$res=$this->db->query($sql)->result_array();
			for($i=0;$i<count($res);$i++){
				$dum=array_values($res[$i]);
				$rowid=$res[$i]['rowid'];
				//$dum[0]='<a href="#" onclick="openf('.$rowid.')">'.$dum[0].' </a>';
				$data[]=$dum;
			}
		}
		$out=array('data'=>$data);
		echo json_encode($out);
	}
	
	public function get()
	{
		$usr=$this->session->userdata('user_data');
		$data=array();$cod='500';
		if(isset($usr)){
			$sqltbl=$this->sqltbl($this->input->post("t"));
			$c=$sqltbl[3]; $t=$sqltbl[2];
			$c=$c==''?'*':$c;
			$sql="select $c from $t where rowid=".$this->input->post("id");
			$data=$this->db->query($sql)->result_array();
			$cod='200';
		}
		$ret=array('code'=>$cod,'data'=>$data);
		echo json_encode($ret);
	}
	
	
	public function sv()
	{
		$usr=$this->session->userdata('user_data');
		$data=array();$msgs='Employee not found'; $typ="error";
		if(isset($usr)){
			$nik=trim($usr['nik']);
			if($nik!=''){
				if($this->db->where("nik",$nik)->count_all_results("hr_kary")>0) {//emp adha
					$dt=date('Y-m-d');
					$tm=date('H:i:s');
					$io='in';
					if($this->db->where(array("nik"=>$nik,"dt"=>$dt))->count_all_results("hr_attend")>0) $io='out';
					$data['dt']=$dt;
					$data['nik']=$nik;
					$data['tm'.$io]=$tm;
					$data['ed'.$io]=$tm;
					$data['reason'.$io]=$this->input->post("reason");
					$data['lat'.$io]=$this->input->post("lat");
					$data['lng'.$io]=$this->input->post("lng");
					$data['photo'.$io]=$this->input->post("photo");
					if($io=='in'){
						$this->db->insert("hr_attend",$data);
					}else{
						$this->db->update("hr_attend",$data,array("nik"=>$nik,"dt"=>$dt));
					}
					if($this->db->affected_rows()>0) {
						$msgs='Success'; $typ="success";
					}else{
						$msgs="Failed";
					}
				}
			}
		}else{
			$msgs="Session closed, please login";
		}
		$ret=array('msgs'=>$msgs,'type'=>$typ);
		echo json_encode($ret);
	}
}
