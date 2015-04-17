<?php
Class m extends Public_Controller
    {
        function __construct()
        {
            parent::__construct();
			$this->template->set_theme('mobile');
    		$this->template->set_layout('layout');
        }   
        
        function index(){
            $this->template->build('index');
        }
		
		function news(){
			$this->template->build('index');
		}
    }
?>