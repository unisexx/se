<?php
class Stickers extends Public_Controller {

    function __construct()
    {
        parent::__construct();
        // $this->template->set_theme('line')->set_layout('layout');
    }
    
	function inc_home(){
		$data['stickers_update'] = new Sticker();
        $data['stickers_update']->where('status = "approve"')->order_by('id','desc')->get(6);
		$this->load->view('inc_home',$data);
	}
	
    function index(){
        $this->template->set_theme('line')->set_layout('layout');
        $data['themes'] = new Theme();
        $data['themes']->where('status = "approve"')->order_by('id','desc')->get();
        
    	$data['stickers_update'] = new Sticker();
        $data['stickers_update']->where('status = "approve"')->order_by('id','desc')->get(6);
		
        $data['stickers_japan'] = new Sticker();
        $data['stickers_japan']->where('category <> "global" and status = "approve"')->order_by('sticker_code','desc')->get();
        
        $data['stickers_global'] = new Sticker();
        $data['stickers_global']->where('category = "global" and status = "approve"')->order_by('sticker_code','desc')->get();
        $this->template->title('บริการรับฝากซื้อสติ๊กเกอร์ไลน์ ของแท้ ไม่มีหาย เชื่อถือได้ 100% โดยแอดมิน - line2me.in.th');
        meta_description("อัพเดทสติ๊กเกอร์ไลน์ใหม่ๆ พร้อมกับโปรโมชั่นราคาพิเศษ เพื่อเอาใจคนเล่นไลน์โดยเฉพาะ ของแท้ ถูกลิขสิทธิ์ ไม่มีหาย เชื่อถือได้ 100% การันตีโดยกลุ่มลูกค้าในเฟสบุคกว่าพันคน");
        $this->template->build('index',$data);
    }
    
    function view($slug=false){
        $this->template->set_theme('line')->set_layout('layout');
        $data['sticker'] = new Sticker();
        $data['sticker']->where('slug = "'.$slug.'"')->get();
        $this->template->title('Sticker LINE: '.$data['sticker']->title.' - line2me.in.th');
        meta_description('Sticker LINE: '.$data['sticker']->title.' อัพเดทสติ๊กเกอร์ไลน์ใหม่ๆ พร้อมกับโปรโมชั่นราคาพิเศษ เพื่อเอาใจคนเล่นไลน์โดยเฉพาะ ของแท้ ถูกลิขสิทธิ์ ไม่มีหาย เชื่อถือได้ 100% การันตีโดยกลุ่มลูกค้าในเฟสบุคกว่าพันคน');
        $this->template->build('view',$data);
    }

    function theme($slug=false){
        $this->template->set_theme('line')->set_layout('layout');
        $data['theme'] = new Theme();
        $data['theme']->where('slug = "'.$slug.'"')->get();
        $this->template->title('Theme LINE: '.$data['theme']->title.' - line2me.in.th');
        meta_description('Theme LINE: '.$data['theme']->title.' อัพเดทสติ๊กเกอร์ไลน์ใหม่ๆ พร้อมกับโปรโมชั่นราคาพิเศษ เพื่อเอาใจคนเล่นไลน์โดยเฉพาะ ของแท้ ถูกลิขสิทธิ์ ไม่มีหาย เชื่อถือได้ 100% การันตีโดยกลุ่มลูกค้าในเฟสบุคกว่าพันคน');
        $this->template->build('theme',$data);
    }
    
    function lists(){
    	$this->template->set_theme('line')->set_layout('layout');
        $data['stickers'] = new Sticker();
        $data['stickers']->order_by('title','asc')->get();
        $this->load->view('lists',$data);
    }
    
    function download($id){
        $line = new Sticker($id);
        $line->counter();
        $this->load->helper('download');
        $data = file_get_contents($line->preview);
        $name = basename($line->preview);
        force_download($name, $data); 
    }
}
?>