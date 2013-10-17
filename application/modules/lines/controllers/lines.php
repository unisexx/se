<?php
class Lines extends Public_Controller {

    function __construct()
    {
        parent::__construct();
    }
    
    function index(){
    	$data['stickers_update'] = new Line();
        $data['stickers_update']->where('status = "approve"')->order_by('id','desc')->get(5);
		
        $data['stickers_japan'] = new Line();
        $data['stickers_japan']->where('category <> "global" and status = "approve"')->order_by('sticker_code','desc')->get();
        
        $data['stickers_global'] = new Line();
        $data['stickers_global']->where('category = "global" and status = "approve"')->order_by('sticker_code','desc')->get();
        $this->load->view('index',$data);
    }
    
    function view($slug=false){
        $data['sticker'] = new Line();
        $data['sticker']->where('slug = "'.$slug.'"')->get();
        $this->load->view('view',$data);
    }
    
    function lists(){
        $data['stickers'] = new Line();
        $data['stickers']->order_by('title','asc')->get();
        $this->load->view('lists',$data);
    }
    
    function download($id){
        $line = new Line($id);
        $line->counter();
        $this->load->helper('download');
        $data = file_get_contents($line->preview);
        $name = basename($line->preview);
        force_download($name, $data); 
    }
}
?>