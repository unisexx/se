<?php
Class Music extends Public_Controller
    {
        function __construct()
        {
            parent::__construct();
        }   
        
        function index(){
            $data['rs'] = new Webboard_quiz();
			$data['rs']->where("webboard_category_id = 12 and status ='approve'")->order_by('id','desc')->get_page();
            $this->template->build('index',$data);
        }
        
        function view($slug,$id)
		{
			$data['webboard_quizs'] = new Webboard_quiz($id);
			$data['webboard_quizs']->counter();
			$user_id = $data['webboard_quizs']->user_id;
			
			$this->template->title($data['webboard_quizs']->title.' - Kpoplover '.$data['webboard_quizs']->webboard_category->name);
			meta_description(word_limiter(strip_tags($data['webboard_quizs']->detail),10));
			$this->template->build('view',$data);
		}
    }
?>