<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content_model extends CI_Model
{
    public function get_all_count()
    {
        $sql = "SELECT COUNT(*) as tol_records FROM feed";   
       /* $this->db->join('alumni', 'alumni.id_al = feed.id_al ');
        $where = "alumni.id_al = `feed.id_al` AND alumni.id_sklh = '$this->id_sklh'";  */  
        $result = $this->db->query($sql)->row();
        
        return $result;
    }

    public function get_all_content($start,$content_per_page)
    {
        $sql = "SELECT * FROM  feed LIMIT $start,$content_per_page";       
        $result = $this->db->query($sql)->result();
        return $result;
    }
    
}