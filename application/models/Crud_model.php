<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud_model extends CI_Model {

	private $table;
	private $keyid;
	private $column_order; //set column field database for datatable orderable
	private $column_search; //set column field database for datatable searchable just firstname , lastname , address are searchable
	private $order; // default order 

	public function __construct()
	{
		parent::__construct();
	}

	private function _get_datatables_query()
	{
		
		$this->db->from($this->table);

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where($this->keyid,$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where($this->keyid, $id);
		$this->db->delete($this->table);
	}


	//Setters
	public function set_table($newValue)
	{
	    $this->table = $newValue;
	}

	public function set_keyid($newValue)
	{
	    $this->keyid = $newValue;
	}

	public function set_column_order($newValue)
	{
	    $this->column_order = $newValue;
	}

	public function set_column_search($newValue)
	{
	    $this->column_search = $newValue;
	}

	public function set_order($newValue)
	{
	    $this->order = $newValue;
	}

	//Getters
	public function get_table()
	{
	    return $this->table;
	}

	public function get_keyid()
	{
	    return $this->keyid;
	}

	public function get_column_order()
	{
	    return $this->column_order;
	}

	public function get_column_search()
	{
	    return $this->column_search;
	}

	public function get_order()
	{
	    return $this->order;
	}

	public function getResults(){
        $this->db->from($this->table);
        return $this->db->get();
    }

    public function getResultsCriteria($wheredata,$order,$groupcol=null){

        $this->db->from($this->table);
        $this->db->where($wheredata);
        if($order['orderkey']){
        	$this->db->order_by($order['orderkey'],$order['orderset']);
    	}
    	if($groupcol){
        	$this->db->group_by($groupcol);
        }

        return $this->db->get();
    }

    public function getJoinResultsCriteria($wheredata,$joindata,$groupcol=null){
    	
        $this->db->from($this->table);
        $this->db->join($joindata['table'],$this->table.'.'.$this->keyid.'='.$joindata['table'].'.'.$joindata['col']);
        if($wheredata){
        	$this->db->where($wheredata);
        }
        
        if($groupcol){
        	$this->db->group_by($groupcol);
        }
        return $this->db->get();
    }

    public function getJoin2ResultsCriteria($wheredata,$joindata,$groupcol){
    	
        $this->db->from($this->table);

        if($joindata){
        	/**
        	$num = count($joindata);

        	for($i=0; $i<$num; $i++)  
            {  
                if(trim($this->input->post('requirements')[$i] != ''))  
                {  
                    $data = array(
                        'requirementid' => $this->input->post('requirements')[$i],
                        'courseid'      => $this->input->post('course'),
                        'createdby'     => $myusername,
                        'updatedby'     => $myusername
                    );
                }  
            } 
            **/

        	
	        $this->db->join($joindata['table1'],$this->table.'.'.$this->keyid.'='.$joindata['table1'].'.'.$joindata['col1']);
	        $this->db->join($joindata['table2'],$joindata['table1'].'.'.$joindata['col1_1'].'='.$joindata['table2'].'.'.$joindata['col2']);
	        
	    }

        if($wheredata){
        	$this->db->where($wheredata);
        }

        if($groupcol){
        	$this->db->group_by($joindata['table1'].'.'.$groupcol);
        }
        	
        
        return $this->db->get();
        
    }

    function call_SP($spname,$params){

    	$call_procedure ="CALL ".$spname."(".$params.")";
    	return $this->db->query($call_procedure);
    }

    function getUsersDetails($username){

    	$this->db->from('users');
		$this->db->where(array('username' => $username));
	    $query = $this->db->get()->row();

        return $query;
    }


    function getRequirementsCourse($screqid){

    	
	    $query = $this->db->query("CALL getRequirementCourse(".$screqid.")");

        return $query->row();
    }
}