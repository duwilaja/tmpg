<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
		$usr=$this->session->userdata('user_data');
		if ( isset($usr))
		{ 
			// Allow some methods?
			$allowed = array(
				'index',
				'in',
				'out',
				'pwd'
			);
			if ( ! in_array($this->router->fetch_method(), $allowed) && $usr["useraccess"]!='ADM' && $usr["usergrp"]!='')
			{
				echo "Direct access not allowed";
			}
		}
	}
	
	public function index()
	{
		$usr=$this->session->userdata('user_data');
		if(isset($usr)){
			$view=$this->input->get("p");
			$data["session"]=$usr;
			if($usr["useraccess"]!='ADM' && $usr["usergrp"]!='') $view='unauthorize';
			$this->load->view($view,$data);
		}else{
			redirect(base_url()."sign/out/1");
		}
	}
	
	private function sqltbl($m){
		$sql="";$c="";$t="";$cc="";
		switch($m){
			case "users": $sql="select userid,username,usergrp,useraccess,rowid from tm_users";
							$c="userid,username,useraccess,usergrp";
							$t="tm_users";
							break;
			case "holidays": $sql="select dt,name,kanwil,rowid from tm_holidays";
							$c="dt,name";
							$t="tm_holidays";
							break;
			case "filters": $sql="select probid,probname,grping,rowid from tm_problems";
							$c="probid,probname,grping";
							$t="tm_problems";
							break;
			case "notifys": $sql="select mnt,grp,typ,stts,rowid from tm_timers";
							$c="grp,typ,stts,mnt";
							$t="tm_timers";
							break;
			case "kanwils": $sql="select locid,locname,rowid from tm_kanwils";
							$c="locid,locname";
							$t="tm_kanwils";
							break;
			case "kanusers": $sql="select kanwil,user,rowid from tm_kanwilusers";
							$c="kanwil,user";
							$t="tm_kanwilusers";
							break;
			case "m2ms": $sql="select notel,iptel,sn,m.oid,o.oname as oname1,o.kanwil,stts,guna,jenis,oidx,o2.oname as oname2,m.ticketno,m.rowid from 
					tm_m2ms m left join tm_outlets o on o.oid=m.oid left join tm_outlets o2 on o2.oid=m.oidx";
							$c="oid,oidx,iptel,notel,sn,stts,guna,jenis,ticketno";
							$t="tm_m2ms";
							break;
			case "lovs": $sql="select v,g,rowid from tm_lovs";
							$c="v,g";
							$t="tm_lovs";
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
			$data=$this->lov($this->input->post("tgt"));
		}
		$ret=array('data'=>$data);
		echo json_encode($ret);
	}
	
	private function lov($tgt)
	{
		$usr=$this->session->userdata('user_data');
		$data=array();
		if(isset($usr)){
			$mydb=$this->load->model("mydb");
			switch($tgt){
				case "#user": $sql="select userid as v,username as t from tm_users where useraccess<>'ADM' order by username"; 
								$data=$this->db->query($sql)->result_array(); break;
				case "#kanwil": $sql="select locid as v,locname as t from tm_kanwils order by locname"; 
								$data=$this->db->query($sql)->result_array(); break;
				case "#typ": $sql="select v,v as t from tm_lovs where g='problem' order by v"; 
								$data=$this->db->query($sql)->result_array(); break;
				case  "#useraccess": $data=$this->mydb->getuseraccess(); break;
				case  "#usergrp": $data=$this->mydb->getusergroup(); break;
				case  "#grp": $data=$this->mydb->getusergroup(); break;
				case  "#g": $data=$this->mydb->getfieldlov(); break;
				case  "#stts": $data=$this->mydb->getstatus(); break;
			}
		}
		return $data;
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
			$data["updby"]=$usr["userid"];
			$data["lastupd"]=date('Y-m-d H:i:s');
			
			//specific user pwd
			if(isset($_POST['upwd'])){
				if($_POST['upwd']!='') $data["userpwd"]=md5($this->input->post("upwd"));
			}
			
			if($rowid==0){
				//$sql=$this->mydb->insert_string($t, $data);
				$this->db->insert($t, $data);
			}else{
				//$sql=$this->mydb->update_string($t, $data, $where);
				if($flag=='DEL') {
					//$sql="delete from $t where $where";
					$this->db->delete($t, $where);
				}else{
					$this->db->update($t, $data,$where);
				}
			}
			
			//$this->db->query($sql);
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
