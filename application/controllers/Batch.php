<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Batch extends CI_Controller {

	 
	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
		$usr=$this->session->userdata('user_data');
		if ( isset($usr))
		{ 
			// Allow some methods?
			$allowed = array(
				'dobatch'
			);
			if ( ! in_array($this->router->fetch_method(), $allowed) && $usr["useraccess"]!='ADM' && $usr["usergrp"]!='')
			{
				echo "Direct access not allowed";
			}
		}
	}
	public function index()
	{
		//$this->load->view('welcome_message');
		echo "";
	}
	private function tbl($mn){
		$tname="";$keys=array();
		switch($mn){
			case "outips": $tname="tm_ips"; $keys=array("oid","layanan"); break;
			case "outlets": $tname="tm_outlets"; $keys=array("oid"); break;
			case "m2ms": $tname="tm_m2ms"; $keys=array("notel"); break;
		}
		return array($tname,$keys);
	}
	private function keysok($k,$c){
		$ok=false;
		for($i=0;$i<count($k);$i++){
			$ok=($ok)?($ok&&in_array($k[$i],$c)):in_array($k[$i],$c);
		}
		return $ok;
	}
	private function datasok($c,$d){
		if(trim(implode("",$d))==""){
			return array(false,"No data found");
		}elseif(count($d)>500){
			return array(false,"Data more than 500 lines, please consider to reduce");
		}else{
			$ok=true; $mok="";
			for($i=0;$i<count($d)-1;$i++){
				$r=explode("	",$d[$i]);
				if(count($r)!=count($c)){
					$ok=false; $mok="Line ".($i+1)." : ".implode(",",$r)." unequal data with header";
					break;
				}
			}
			return array($ok,$mok);
		}
	}
	private function parse($c,$d,$u,$k=''){
		$data=array();
		for($x=0;$x<count($c);$x++){
			if(!is_array($k)){ //data
				$data[$c[$x]]=$d[$x];
			}else{
				if(in_array($c[$x],$k)){//where
					$data[$c[$x]]=$d[$x];
				}
			}
		}
		if(!is_array($k)){//data
			$data['lastupd']=date('Y-m-d H:i:s');
			$data['updby']=$u;
		}
		return $data;
	}
	private function doup($t,$act,$col,$dat,$k,$u){
		$ms="Data saved"; $ty="success";
		for($i=0;$i<count($dat)-1;$i++){
			$d=explode("	",$dat[$i]);
			$data=$this->parse($col,$d,$u);
			$where=$this->parse($col,$d,$u,$k);
			if($act=="ADD"){
				$this->db->insert($t,$data);
			}
			if($act=='UPD'){
				$this->db->update($t,$data,$where);
				//$ms=json_encode($where);
			}
			if($act=='DEL'){
				$this->db->delete($t,$where);
			}
		}
		return array($ms,$ty);
	}
	private function dosave($m,$act,$head,$data,$u){
		$tk=$this->tbl($m);$msg="Invalid parameter";$typ="error";
		$t=$tk[0]; $k=$tk[1];
		if($t!=""){
			$cols=explode("	",$head);
			if($this->keysok($k,$cols)){
				$datas=explode("\r\n",$data);
				$ok=$this->datasok($cols,$datas);
				if($ok[0]){
					$up=$this->doup($t,$act,$cols,$datas,$k,$u);
					$msg=$up[0]; $typ=$up[1];
				}else{
					$msg=$ok[1];
				}
			}else{
				$msg="Keys : ".implode(",",$k)." is not defined";
			}
		}
		return array($msg,$typ);
	}
	public function dobatch()
	{
		$usr=$this->session->userdata('user_data');
		$data=array();$msgs='Failed'; $typ="error";
		if(isset($usr)){
			$retr=$this->dosave($this->input->post("bmenu"),$this->input->post("bacti"),$this->input->post("heads"),$this->input->post("datas"),$usr['userid']);
			$msgs=$retr[0]; $typ=$retr[1];
		}else{
			$msgs="Session closed, please login";
		}
		$ret=array('msgs'=>$msgs,'type'=>$typ);
		echo json_encode($ret);
	}
	
}
