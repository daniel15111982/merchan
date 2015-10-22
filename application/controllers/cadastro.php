<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cadastro extends CI_Controller
{

    /**
     * Example::__construct()
     *
     */
    public function __construct()
    {
        parent::__construct();
        if( ! $this->bitauth->logged_in())
        {
            $this->session->set_userdata('redir', current_url());
            redirect('home/login');
        }
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    }

    public function index(){

        $data['titulo'] = "Cadastro Geral do Sistema";

        if (!$this->bitauth->has_role('admin')){

            $this->load->view('inc/acessonegado',$data);
            return;
        }

        $data['bitauth'] = $this->bitauth;
        $data['users'] = $this->bitauth->get_users();

        //debug($data['users']);
        $this->load->view('cadastro/index',$data);
    }

    public function novo()
    {

        if( ! $this->bitauth->logged_in())
        {
            $this->session->set_userdata('redir', current_url());
            redirect('home/login');
        }

        $data['titulo']= "Adicinar Cadastro";
        $this->load->model('cidades_estados_model');



        if ( ! $this->bitauth->has_role('admin'))
        {
            $this->load->view('example/no_access');
            return;
        }

        if($this->input->post())
        {
          //  debug($_FILES);
            $this->form_validation->set_rules('username', 'Username', 'trim|required|bitauth_unique_username');
            $this->form_validation->set_rules('fullname', 'Fullname', 'trim|required');
            $this->form_validation->set_rules('telefone', 'Telefone', 'trim|required');
            $this->form_validation->set_rules('cpf', 'Fullname', '');
            $this->form_validation->set_rules('fullname', 'Fullname', '');
            $this->form_validation->set_rules('groups[]', 'Groups', '');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'Senha', 'required|bitauth_valid_password');
            $this->form_validation->set_rules('password_conf', 'confirmação de senha', 'required|matches[password]');

            if($this->form_validation->run() == TRUE)
            {
                if($_FILES['logotipo']['error'] == 0) {
                    $logo = uploadImagem('uploads/logotipos', 'logotipo', 83, 106);

                    if (is_array($logo)) {
                        $this->session->set_flashdata('erro', $logo['error']);
                        redirect('cadastro', 'location');
                    } else {
                        $insert['logotipo'] = $logo;
                    }
                }

                    unset($_POST['submit'], $_POST['password_conf']);
                $this->bitauth->add_user($this->input->post());
                redirect('cadastro');
            }

        }

        if ($this->input->post('estado') && $this->input->post('cidade')) {
            $cidades = $this->cidades_estados_model->get_cidades($this->input->post('estado'));
            $opt_cidades = '';
            foreach ($cidades as $cidade) {
                $select = '';
                if ($cidade->id_cidade == $this->input->post('cidade'))
                    $select = 'selected';

                $opt_cidades .= "<option $select value=\"$cidade->id_cidade\">" . ucfirst($cidade->nome) . "</option>";

                $data['opt_cidades'] = $opt_cidades;
            }
        }

        foreach ($this->bitauth->get_roles() as $v => $calue) {
            $data['grupos'][]=array(
                'value'    =>$v,
                'descricao'=>$calue,
            );
        }


        $data['estados'] = $this->cidades_estados_model->get_estados();

        $this->load->view('cadastro/novo', $data);
    }

    public function verifica_cnpj($cnpj) {

        $this->db->where('cnpj', $cnpj);
        if ($this->db->get('bitauth_userdata')->num_rows() != 0) {
            $this->form_validation->set_message('verifica_cnpj', 'O CNPJ informado encontra-se em uso no momento.');
            return false;
        }else{
            return true;
        }
    }

    public function verifica_email($email) {

        $this->db->where('email', $email);
        if ($this->db->get('bitauth_userdata')->num_rows() != 0) {
            $this->form_validation->set_message('verifica_email', 'O E-mail informado encontra-se em uso no momento.');
            return false;
        }else{
            return true;
        }
    }

    public function edit_user($user_id)
    {
        if( ! $this->bitauth->logged_in())
        {
            $this->session->set_userdata('redir', current_url());
            redirect('example/login');
        }

        if ( ! $this->bitauth->has_role('admin'))
        {
            $this->load->view('example/no_access');
            return;
        }

        if($this->input->post())
        {
            $this->form_validation->set_rules('username', 'Username', 'trim|required|bitauth_unique_username['.$user_id.']');
            $this->form_validation->set_rules('fullname', 'Fullname', '');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('active', 'Active', '');
            $this->form_validation->set_rules('enabled', 'Enabled', '');
            $this->form_validation->set_rules('password_never_expires', 'Password Never Expires', '');
            $this->form_validation->set_rules('groups[]', 'Groups', '');

            if($this->input->post('password'))
            {
                $this->form_validation->set_rules('password', 'Password', 'bitauth_valid_password');
                $this->form_validation->set_rules('password_conf', 'Password Confirmation', 'required|matches[password]');
            }

            if($this->form_validation->run() == TRUE)
            {
                unset($_POST['submit'], $_POST['password_conf']);
                $this->bitauth->update_user($user_id, $this->input->post());
                redirect('example');
            }

        }

        $groups = array();
        foreach($this->bitauth->get_groups() as $_group)
        {
            $groups[$_group->group_id] = $_group->name;
        }


        $this->load->view('example/edit_user', array('bitauth' => $this->bitauth, 'groups' => $groups, 'user' => $this->bitauth->get_user_by_id($user_id)));
    }
    public function activate($activation_code)
    {
        if($this->bitauth->activate($activation_code))
        {
            $this->load->view('example/activation_successful');
            return;
        }

        $this->load->view('example/activation_failed');
    }


}