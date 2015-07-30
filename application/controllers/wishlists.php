<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wishlists extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler();
	}

	public function index()
	{
		$this->load->view('index');
	}
	public function dashboard()
	{
		$this->load->model('wishlist');

		$result['user']['wishlist']=$this->wishlist->get_user_wishlists();
		$result['user']['added_by']=$this->wishlist->get_user_added_by_name();
		$result['other']['wishlist']=$this->wishlist->get_other_wishlists();
		$result['other']['added_by']=$this->wishlist->get_other_added_by_name();
		// var_dump($result['other']['wishlist']);
		// die();
		$this->load->view('dashboard', $result);

	}
	public function add_item()
	{
		$this->load->view('create');
	}
	
	public function create()
	{
		$this->load->model('wishlist');
		if($this->wishlist->validate_reg($this->input->post()) === FALSE)
		{
			$this->session->set_flashdata('errors', validation_errors());
			redirect('/');
		}
		else 
		{
			$this->wishlist->create($this->input->post());
			$this->session->set_flashdata('success', "<p>User was created successfully! Please login.</p>");
			redirect('/');
		}
	}
	public function login()
	{
		$this->load->model('wishlist');
		if($this->wishlist->validate_login($this->input->post())===FALSE)
		{
			$this->session->set_flashdata('errors', validation_errors());
		}

		$user = $this->wishlist->find_user($this->input->post());

		$this->session->set_userdata('logged_user', $user);
		if($user)
		{
			redirect('/dashboard');
		}
		else {

			$this->session->set_flashdata('errors', "<p> No user with those email and password</p>");
			redirect('/');
		}
	}
	public function create_item()
	{
		$this->load->model('wishlist');

		if($this->wishlist->validate_new_item($this->input->post()) === FALSE)
		{
			$this->session->set_flashdata('errors', validation_errors());
			redirect('/wish_items/create');
		}
		else 
		{
			$item_id = $this->wishlist->create_item($this->input->post());
			$this->wishlist->add_users_items_list($item_id);
			redirect('/dashboard');
		}
	}
	public function destroy()
	{
		$this->session->unset_userdata();
		$this->session->sess_destroy();
		redirect('/');
	}

	public function add_wishlist($id)
	{
		$this->load->model('wishlist');
		$this->wishlist->add_users_items_list($id);
		redirect('/dashboard');
	}

	public function delete($id)
	{
		$this->load->model('wishlist');
		$this->wishlist->delete($id);
		redirect('/dashboard');
	}

	public function wish_items($id)
	{
		$this->load->model('wishlist');
		$result['item'] = $this->wishlist->get_item_by_id($id);
		$result['users'] = $this->wishlist->get_users_wish_lists($id);
		$this->load->view('item', $result);
	}
	public function remove($id)
	{
		$this->load->model('wishlist');
		$this->wishlist->remove($id);
		redirect('/dashboard');
	}
}	
//end of main controller













