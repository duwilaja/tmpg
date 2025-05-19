<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md extends CI_Controller {

	public function index()
	{
		$usr=$this->session->userdata('user_data');
		if(isset($usr)){
			$view=$this->input->get("p");
			$data["session"]=$usr;
			if($usr["uaccess"]!='ADM') $view='unauthorize';
			$this->load->view($view,$data);
		}else{
			redirect(base_url()."sign/out/1");
		}
	}
	
	private function sqltbl($m){
		$sql="";$c="";$t="";$cc="";
		switch($m){
			case "users": $sql="select uid,uname,nik,uaccess,rowid from users where uaccess<>'SYS'";
							$c="uid,uname,ugrp,umail,uaccess,nik";
							$t="users";
							break;
			case "holidays": $sql="select dt,ket,rowid from hr_holiday";
							$c="dt,ket";
							$t="hr_holiday";
							break;
			case "employees": $sql="select nik,nama,job,rowid from hr_kary";
							$c="nik,nama,job";
							$t="hr_kary";
							break;
		}
		return array($sql,$c,$t,$cc);
	}
	
	public function datatable()
	{
		$usr=$this->session->userdata('user_data');
		$data=array();
		if(isset($usr)){
			$sqltbl=$this->sqltbl($this->input->post("m"));
			$sql=$sqltbl[0];
			$res=$this->db->query($sql)->result_array();
			//$this->load->model("myodbc");
			//$res=$this->myodbc->query($sql)->result_array();
			for($i=0;$i<count($res);$i++){
				$dum=array_values($res[$i]);
				$rowid=$res[$i]['rowid'];
				$dum[0]='<a href="#" onclick="openf('.$rowid.')">'.$dum[0].' </a>';
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
	
	public function gets()
	{
		$usr=$this->session->userdata('user_data');
		$data=array();
		if(isset($usr)){
			$c=base64_decode($this->input->post("c"));
			$w=base64_decode($this->input->post("w"));
			$t=base64_decode($this->input->post("t"));
			$c=$c==''?'*':$c;
			$sql="select $c from $t where $w";
			$data=$this->db->query($sql)->result_array();
		}
		$ret=array('data'=>$data);
		echo json_encode($ret);
	}
	
	public function lov()
	{
		$usr=$this->session->userdata('user_data');
		$data=array();
		if(isset($usr)){
			$c=base64_decode($this->input->post("c"));
			$w=base64_decode($this->input->post("w"));
			$t=base64_decode($this->input->post("t"));
			$onclick=base64_decode($this->input->post("o"));
			$sql="select $c from $t where $w";
			$data=$this->db->query($sql)->result_array();
			for($i=0;$i<count($res);$i++){
				$dum=array_values($res[$i]);
				$dum[0]='<input type="radio" name="pilih" onclick="'.$onclick.'" value="'.$dum[0].'"> '.$dum[0];
				$data[]=$dum;
			}
		}
		$ret=array('data'=>$data);
		echo json_encode($ret);
	}
	
	public function sv()
	{
		$usr=$this->session->userdata('user_data');
		$data=array();$msgs='Failed'; $typ="error";
		if(isset($usr)){
			$this->load->model("mydb");
			$sqltbl=$this->sqltbl($this->input->post("menu"));
			$c=$sqltbl[1];
			$t=$sqltbl[2];
			$rowid=$this->input->post("rowid");
			$flag=$this->input->post("flag");
			$where="rowid=$rowid";
			
			$data=$this->input->post(explode(",",$c));
			$data["updby"]=$usr["uid"];
			$data["lastupd"]=date('Y-m-d H:i:s');
			
			//specific user pwd
			if(isset($_POST['upwd'])){
				if($_POST['upwd']!='') $data["upwd"]=md5($this->input->post("upwd"));
			}
			
			if($rowid==0){
				$sql=$this->mydb->insert_string($t, $data);
			}else{
				$sql=$this->mydb->update_string($t, $data, $where);
				if($flag=='DEL') $sql="delete from $t where $where";
			}
			
			$this->db->query($sql);
			if($this->db->affected_rows()>0) {
				$msgs='Success'; $typ="success";
			}else{
				$msgs=$this->mydb->error($this->db->error());
			}
			
		}else{
			$msgs="Session closed, please login";
		}
		$ret=array('msgs'=>$msgs,'type'=>$typ);
		echo json_encode($ret);
	}
}
