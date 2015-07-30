<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wishlist extends CI_Model {
	//validation for registration
	public function validate_reg($post)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', "Name", 'trim|required|min_length[3]');
		$this->form_validation->set_rules('username', "Username", 'required|min_length[3]|is_unique[users.username]');
		$this->form_validation->set_rules('password', "Password", 'trim|required|min_length[8]|matches[confirm_password]|md5');
		$this->form_validation->set_rules('confirm_password', "Confirm Password", 'trim|required');
		$this->form_validation->set_rules('date_hired', "Date Hired", 'required');
		if($this->form_validation->run()===FALSE)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	//validation for login
	public function validate_login($post)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', "username", 'trim|required');
		$this->form_validation->set_rules('password', "Password", 'trim|required|md5');
		if($this->form_validation->run()===FALSE)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	public function validate_new_item($post)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('item', "Item", 'trim|required|min_length[4]|is_unique[items.item]');
		if($this->form_validation->run()===FALSE)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	//query for adding a new user to the database.
	public function create($userinfo)
	{	
		$query = "INSERT INTO users(name, username, password, date_hired, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())";
		$values = array($userinfo['name'],$userinfo['username'],$userinfo['password'],$userinfo['date_hired']);
		$this->db->query($query, $values);
	}
	public function find_user($userinfo)
	{
		$query = "SELECT * FROM users WHERE username=? AND password =?";
		$values= array($userinfo['username'], $userinfo['password']);
		return $this->db->query($query, $values)->row_array();
	}
	public function create_item($item)
	{
		$query = "INSERT INTO items (item, created_at, updated_at, added_by_user_id) VALUES (?, NOW(), NOW(), ?)";
		$values = array($item['item'], $this->session->userdata['logged_user']['id']);
		$this->db->query($query, $values);
		return $this->db->insert_id();
	}

	public function add_users_items_list($id)
	{
		$query = "INSERT INTO users_items (user_id, item_id) VALUES (?, ?)";
		$values = array($this->session->userdata['logged_user']['id'], $id);
		$this->db->query($query, $values);
	}

	public function get_user_wishlists()
	{
		$query = "SELECT items.id, items.item, items.created_at 
					FROM users_items
					LEFT JOIN users ON users.id = users_items.user_id
					LEFT JOIN items ON items.id = users_items.item_id
					WHERE user_id = ?";
		$value = $this->session->userdata['logged_user']['id'];
		return $this->db->query($query, $value)->result_array();
	
	}
	public function get_other_wishlists()
	{
		$query = "SELECT items.id, items.item, items.created_at 
			FROM users_items
			LEFT JOIN users ON users.id = users_items.user_id
			LEFT JOIN items ON items.id = users_items.item_id
			WHERE user_id != ?
			GROUP BY items.id";

		return $this->db->query($query, $this->session->userdata['logged_user']['id'])->result_array();
	}
	public function get_user_added_by_name()
	{
		$query = "SELECT users_2.name 
					FROM users_items
					LEFT JOIN users ON users.id = users_items.user_id
					LEFT JOIN items ON items.id = users_items.item_id
					LEFT JOIN users AS users_2 ON users_2.id = items.added_by_user_id	
					WHERE user_id = ?";
		return $this->db->query($query, $this->session->userdata['logged_user']['id'])->result_array();
	}

		public function get_other_added_by_name()
	{
		$query = "SELECT users_2.name 
					FROM users_items
					LEFT JOIN users ON users.id = users_items.user_id
					LEFT JOIN items ON items.id = users_items.item_id
					LEFT JOIN users AS users_2 ON users_2.id = items.added_by_user_id	
					WHERE user_id != ?";
		return $this->db->query($query, $this->session->userdata['logged_user']['id'])->result_array();
	}
	public function delete($id)
	{
		$query = "DELETE from items WHERE id = ?";
		$this->db->query($query, $id);
	}
	public function get_item_by_id($id)
	{
		$query = "SELECT id, item FROM items WHERE id = ?";
		return $this->db->query($query, $id)->row_array();
	}

	public function remove($id)
	{
		$query = "DELETE FROM users_items WHERE user_id = ? AND item_id = ?";
		$values = array($this->session->userdata['logged_user']['id'], $id);
		$this->db->query($query, $values);
	}

	public function get_users_wish_lists($id)
	{
		$query = "SELECT users.name FROM users_items
					LEFT JOIN users ON users.id = users_items.user_id
					LEFT JOIN items ON items.id = users_items.item_id
					WHERE users_items.item_id = ?";
		return $this->db->query($query, $id)->result_array();
	}
}



























//end of main controller

//end of main controller