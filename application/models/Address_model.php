<?php
class Address_model extends CI_Model
{
	public $tableName = "";
	public function __construct()
	{
		parent::__construct();
	}
	public function get_all($tableName = null,$where = array(), $order = "")
	{
        $this->tableName = $tableName;
		return $this->db->where($where)->order_by($order)->get($this->tableName)->result();;
	}
	public function add($tableName = null,$data = array())
	{
        $this->tableName = $tableName;
		return $this->db->insert($this->tableName, $data);
	}
	public function get($tableName = null,$where = array())
	{
        $this->tableName = $tableName;
		return $this->db->where($where)->get($this->tableName)->row();
	}
	public function update($tableName = null,$where = array(), $data = array())
	{
        $this->tableName = $tableName;
		return $this->db->where($where)->update($this->tableName, $data);
	}
	public function delete($tableName = null,$where = array())
	{
        $this->tableName = $tableName;
		return $this->db->where($where)->delete($this->tableName);
	}
}
