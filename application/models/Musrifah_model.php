<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Musrifah_model extends CI_Model
{
    public function getHistori($limit, $start, $nim)
    {
        // $query = "
        //             SELECT
        //                 *
        //             FROM
        //                 ijin 
        //             LIMIT $limit, $start
        //         ";
        // return $this->db->query($query)->result_array();
        $this->db->order_by('id', 'DESC');

        return $this->db->get_where('ijin', array('nim' => $nim,'status' => 1), $limit, $start)->result_array();
    }

    public function getStatus($limit, $start, $nim)
    {
        $this->db->order_by('id', 'DESC');
        return $this->db->get_where('ijin', array('status' => 0), $limit, $start)->result_array();
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

    public function setApprovalIjin($id)
    {
        $query = "
            UPDATE
            `simahaddb`.`ijin`
            SET
            `status` = 1
            WHERE `id` = $id           
        ";
        return $this->db->query($query);
    }    

    public function setNotApprovalIjin($id)
    {
        $query = "
            DELETE
            FROM
            `simahaddb`.`ijin`
            WHERE `id` = $id           
        ";
        return $this->db->query($query);
    }        

    public function countHistoriPulang($nim)
    {
        $query = "
            SELECT
            COUNT(id) as tot
            FROM
            ijin
            WHERE jam_masuk=0
            AND nim = $nim      
        ";
        return $this->db->query($query)->row();
    }

    public function countStatusApp($nim)
    {
        $query = "
            SELECT
            COUNT(id) as tot
            FROM
            ijin
            WHERE status=0
            AND nim = $nim      
        ";
        return $this->db->query($query)->row();
    }    

    public function countAllHistory()
    {
        return $this->db->get(' ijin')->num_rows();
    }
}
