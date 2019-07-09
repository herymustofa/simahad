<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Santri_model extends CI_Model
{
    public function getHistori($limit, $start)
    {
        // $query = "
        //             SELECT
        //                 *
        //             FROM
        //                 ijin 
        //             LIMIT $limit, $start
        //         ";
        // return $this->db->query($query)->result_array();
        return $this->db->get('ijin', $limit, $start)->result_array();
    }

    public function setPulang($id, $jam_masuk)
    {
        $query = "
            UPDATE
            `simahaddb`.`ijin`
            SET
            `jam_masuk` = $jam_masuk
            WHERE `id` = $id           
        ";
        return $this->db->query($query);
    }

    public function countHistoriPulang()
    {
        $query = "
            SELECT
            COUNT(id) as tot
            FROM
            ijin
            WHERE jam_masuk=0
            AND nim = 100        
        ";
        return $this->db->query($query)->row();
    }

    public function countAllHistory()
    {
        return $this->db->get('ijin')->num_rows();
    }
}
