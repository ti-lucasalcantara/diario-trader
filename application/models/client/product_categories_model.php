<?php

class Product_categories_model extends CI_Model {

    private $table          = "product_categories";
    private $id             = "id";
    private $main_column    = "name";
    private $updated_at     = true;
    private $deleted_at     = true;
    

    public function __contruct()
	{
        parent::__construct();
    }
    
    public function show($where = null, $order = null)
    {   
        $this->db->select('*');
        $this->db->from($this->table);

        if($where && !is_array($where) ){
            $this->db->where($this->id, $where);
        }

        if (is_array($where)){   
            foreach ($where as $column => $value) {
                if ( ! is_null($value) ){
                    $this->db->where($column, $value);
                }
            }
        }

        if($this->deleted_at){
            $this->db->where('deleted_at', NULL);
        }
        
        if( ! $order ){
            $this->db->order_by($this->main_column, 'ASC');
        }else{
            $this->db->order_by($order[0], $order[1]);
        }

        return $this->db->get()->result();
    }
    
    public function insert($data = null)
    {
        if(! $data ){
           return false;
        }

        $this->db->insert($this->table, $data);
        return $this->db->insert_id(); 
    }

    public function update($data = null, $id = null)
    {

        if(! $data ){
           return false;
        }
        if(! $id ){
            return false;
        }

        if($this->updated_at){
            $this->db->set('updated_at', date('Y-m-d H:i:s'));
        }

        foreach ($data as $key => $value) {
            if ( ! is_null($value) ){
                $this->db->set($key, $value);
            }
        }

        $this->db->where($this->id, $id);

        return $this->db->update($this->table);
    }

    public function delete($id = null)
    {
        if(! $id ){
            return false;
        }

        $result = $this->db->where($this->id, $id)->get($this->table)->result();

        if(empty($result)){
            return false;
        }

        foreach ($result as $row);

        if($this->deleted_at && ( is_null($row->deleted_at) || empty($row->deleted_at) )){
            return $this->update( array('deleted_at' => date('Y-m-d H:i:s') ), $row->{$this->id} );
        }else{
            return $this->db->delete($this->table, array($this->id => $id));
        }
    }

    public function restore( $id = null )
    {
        if(! $id ){
            return false;
        }

        if($this->updated_at){
            $this->db->set('updated_at', date('Y-m-d H:i:s'));
        }

        if($this->deleted_at){
            $this->db->set('deleted_at', NULL);
        }

        $this->db->where($this->id, $id);

        return $this->db->update($this->table);
    }

    public function lastQuery()
    {
        return $this->db->last_query();
    }

}