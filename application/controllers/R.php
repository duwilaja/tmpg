<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class R extends CI_Controller {
	
	//private $site="http://mp.omgdemo.website/";
	//private $site="http://localhost/test/omg/";
	private $site="http://10.22.194.61/omg-main/";
	
	private $mppath="files/mp/";
	private $billpath="files/bp/";
	private $invpath="files/iv/";
	private $sspath="files/ss/";
	private $fppath="files/fp/";
	private $mbpath="files/mb/";

	public function index()
	{
		$usr=$this->session->userdata('user_data');
		if(isset($usr)){
			$data["session"]=$usr;
			//$data["sitelength"]=strlen($this->site);
			$this->load->view("r_".$this->input->get('v'),$data);
		}else{
			redirect(base_url()."sign/out/1");
		}
	}
	private function build($m){
		$sql="";$w="";
		switch($m){
			case "users": $sql="select uid,uname,nik,uaccess,rowid from users where uaccess<>'SYS'";
							$c="uid,uname,ugrp,umail,uaccess,nik";
							$t="users";
							break;
			case "hratt": $sql="select a.nik,nama,dt,tmin,photoin,reasonin,latin,lngin,tmout,photoout,reasonout,latout,lngout from hr_attend a
								left join hr_kary k on k.nik=a.nik";
							$c="dt,ket";
							$t="hr_holiday";
							break;
			case "employees": $sql="select nik,nama,job,rowid from hr_kary";
							$c="nik,nama,job";
							$t="hr_kary";
							break;
		}
		return array($sql,$w);
	}
	public function datatable()
	{
		$usr=$this->session->userdata('user_data');
		$data=array();
		if(isset($usr)){
			$sqlw=$this->build($this->input->post("s"));
			$sql=$sqlw[0];
			$where=$sqlw[1];
			$sql.=$where==''?'':" where $where";
			$res=$this->db->query($sql)->result_array();
			for($i=0;$i<count($res);$i++){
				$dtlin=$this->detilkan($res[$i]['photoin'],$res[$i]['reasonin'],$res[$i]['latin'],$res[$i]['lngin']);
				$dtlout=$this->detilkan($res[$i]['photoout'],$res[$i]['reasonout'],$res[$i]['latout'],$res[$i]['lngout']);
				$data[]=array($res[$i]['nik'],$res[$i]['nama'],$res[$i]['dt'],$res[$i]['tmin'],$dtlin,$res[$i]['tmout'],$dtlout);
			}
		}
		$out=array('data'=>$data);
		echo json_encode($out);
	}
	
	private function detilkan($poto,$ket,$lat,$lng){
		$ret=$poto!=''?'<img src="'.$poto.'">':'';
		return $ret.'<br />'.$ket.'<br />'.$lat.'/'.$lng;
	}
	
	private function linkkan($dat,$path){
		$r=array();
		$ar=explode(";",$dat);
		for($j=0;$j<count($ar);$j++){
			//if($ar[$j]!="") $r[]='<a href="javascript:;" data-fancybox data-type="iframe" data-src="'.$path.$ar[$j].'">'.$ar[$j].'</a>';
			if($ar[$j]!="") $r[]='<a target="_blank" href="'.$path.$ar[$j].'">'.$ar[$j].'</a>';
			//if($ar[$j]!="") $r[]=$path.$ar[$j];
		}
		return implode(", ",$r);
	}
	
	private function rmp($dat){
		$d=$dat;
		$d["invattc"]=$this->linkkan($dat["invattc"],$this->site.$this->invpath);
		$d["ssattc"]=$this->linkkan($dat["ssattc"],$this->site.$this->sspath);
		$d["billattc"]=$this->linkkan($dat["billattc"],$this->site.$this->billpath);
		$d["moattc"]=$this->linkkan($dat["moattc"],$this->site.$this->mbpath);
		$d["fpattc"]=$this->linkkan($dat["fpattc"],$this->site.$this->fppath);
		return $d;
	}
	private function rmpdoc($dat){
		$d=$dat;
		$d["attc"]=$this->linkkan($dat["attc"],$this->site.$this->mppath);
		return $d;
	}
	
}