<?php
class Home extends Public_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	function first_page()
	{
		$coverpage = new Coverpage();
		$coverpage->where("status = 'approve' and active = 1")->get();
		if($coverpage->id != ""){
			redirect("coverpages/index/".$coverpage->id);
		}else{
			redirect("home/index");
		}
	}
	
	function index(){
		$this->template->build('index');
        // $this->output->cache(10);
	}
	
	function intro(){
		$this->load->view('intro');
	}
	
	public function lang($lang)
	{
		$this->load->library('user_agent');
		$this->session->set_userdata('lang',$lang);
		
		redirect($this->agent->referrer());
	}
	
	public function sitemap()
	{
		$data['categories'] = new Category();
		$data['childs'] = new Category();
		$data['categories']->where("parents = 0 and id not in (74)")->get();
		$data['num'] = ceil($data['categories']->where("parents = 0 and id not in (74)")->count()/2);
		$this->template->build('sitemap',$data);
	}
	
	function testmail(){
			$this->load->library('email');
			$this->email->from('ampzimeow@gmail.com', 'เคน ธีรเดช วงสืบพันธุ์');
			$this->email->to('unisexx@hotmail.com');
			$this->email->subject('นี่คือสแปม');
			$this->email->message('555+');
			$this->email->send();
			echo $this->email->print_debugger();
	}
	
	function search()
	{
		$this->template->title(lang('search').' - zulex.co.th');
		$this->template->build('search');
	}
	
	function under_construction(){
		$this->template->build('under_contruction');
	}
	
	function convert(){
		$rs = new Kpop_new();
        $rs->where("image is null and source = 'pingbook'")->limit(1000)->order_by('id','desc')->get();
		
		foreach($rs as $row){
			preg_match('/src="([^"]*)"/i',$row->detail, $result);
			$search = array('http://www.pingbook.com/archive','/01/','/02/','/03/','/04/','/05/','/06/','/07/','/08/','/09/','/10/','/11/','/12/');
			$replace = array('https://www.pingbook.com/wp-content/uploads','/10/','/10/','/10/','/10/','/10/','/10/','/10/','/10/','/10/','/10/','/10/','/10/');
			
			// str_replace($search,$replace,substr($result[0],5,-1));
			
			$new = new Kpop_new($row->id);
            $_POST['image'] = str_replace($search,$replace,substr($result[0],5,-1));
    		$new->from_array($_POST);
    		$new->save();
			unset($_POST);
        	unset($new);
		}
	}
}
?>