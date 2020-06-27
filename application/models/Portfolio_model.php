<?php
class Portfolio_model extends CI_Model
{
	public $tableName = "portfolios";
	public function __construct()
	{
		parent::__construct();
		$this->column_order = array('rank', 'id', 'id', 'title','title', 'isActive');
        // Set searchable column fields
        $this->column_search = array('rank', 'id', 'id', 'title','title', 'isActive');
        // Set default order
        $this->order = array('rank' => 'ASC');

	}
	public function get_all($where = array(), $order = "id ASC")
	{
		return $this->db->where($where)->order_by($order)->get($this->tableName)->result();;
	}
	public function add($data = array())
	{
		return $this->db->insert($this->tableName, $data);
	}
	public function get($where = array())
	{
		return $this->db->where($where)->get($this->tableName)->row();
	}
	public function update($where = array(), $data = array())
	{
		return $this->db->where($where)->update($this->tableName, $data);
	}
	public function delete($where = array())
	{
		return $this->db->where($where)->delete($this->tableName);
	}
	public function getRows($where = array(), $postData = array())
    {

        $this->_get_datatables_query($postData);
        if ($postData['length'] != -1) {
            $this->db->limit($postData['length'], $postData['start']);
        }


        return $this->db->get()->result();
    }

    private function _get_datatables_query($postData)
    {
        $this->db->where(["id!=" => ""]);

        if (!empty($this->input->post('search'))) {
            $this->db->group_start();
            $this->db->like('title', $this->input->post('search'), 'both');
            $this->db->group_end();

           
        }

        //print_r($postData);


        $this->db->from($this->tableName);
        $i = 0;
        // loop searchable columns
        foreach ($this->column_search as $item) {
            // if datatable send POST for search

            if (!empty($postData['search'])  && $item == "title" ) {
                // first loop
                if ($i === 0) {
                    // open bracket
                    $this->db->group_start();
                    $this->db->like($item, $postData['search'], 'both');
                } else {
                    $this->db->or_like($item, $postData['search'], 'both');
                }

                // last loop
                if (count($this->column_search) - 1 == $i) {
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }


        if (isset($postData['order'])) {
            $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
        public function get_data_table($where = array(), $order = "rank ASC")
    {
        return $this->db->where($where)->order_by($order)->get($this->tableName)->result();
    }

    public function rowCount($where = array())
    {
        return $this->db->where($where)->count_all_results($this->tableName);
    }

    public function countFiltered($where = array(), $postData)
    {

        $this->_get_datatables_query($postData);

	
        $query = $this->db->where($where)->get();

        return $query->num_rows();
    }
}
