<?php
function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
        //echo "sampai sini";
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);
        //echo $menu;
        //echo "role_id : ";


        $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
        //var_dump($queryMenu);
        $menu_id = $queryMenu['id'];

        //var_dump($queryMenu);
        //echo "menu_id : ";
        //var_dump($menu_id);


        $userAccess = $ci->db->get_where('user_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ]);

        //echo "userAccess : ";
        //var_dump($userAccess);s
        //die;
        //echo "num_row : ";
        //var_dump($userAccess->num_rows());
        //die;

        if ($userAccess->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}


function check_access($role_id, $menu_id)
{
    $ci = get_instance();
    $ci->db->where('role_id', $role_id);
    $ci->db->where('menu_id', $menu_id);
    $result = $ci->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return "checked = 'checked'";
    }
}
