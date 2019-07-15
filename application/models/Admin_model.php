<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    function getMahasiswaByNim($nim)
    {
        $row = $this->db->query("SELECT * FROM user WHERE nim=$nim");
        if ($row->num_rows() > 0) {
            foreach ($row->result() as $data) {
                $hasil = array(
                    'nim' => $data->nim,
                    'name' => $data->name,
                );
            }
        }
        return $hasil;
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

    public function countAllHistory()
    {
        return $this->db->get(' ijin')->num_rows();
    }

    public function getAllHistori($limit, $start)
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

        return $this->db->get('ijin', $limit, $start)->result_array();
    }
}
