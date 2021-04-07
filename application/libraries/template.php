<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template {
	protected $_ci;

	function __construct(){
		$this->_ci = &get_instance();
	}


	function display($view, $data = null){

		$v_content = isset($view['content']) ? $view['content'] : 'template/content_default';

		$data['head'] = $this->_ci->load->view('template/header_b', $data, true);
		$data['sidebar'] = $this->_ci->load->view('template/sidebar_b', $data, true);
		$data['content'] = $this->_ci->load->view($v_content, $data, true);
		$data['foot'] = $this->_ci->load->view('template/footer_b', $data, true);

		$this->_ci->load->view('/template/template.php', $data);
	}

}
