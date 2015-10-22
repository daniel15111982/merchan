<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{

    /**
     * Example::__construct()
     *
     */
    public function __construct()
    {
        parent::__construct();

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    }


    public function index(){

        $data['titulo'] = 'Home';

        $this->load->view('home/index', $data);

    }

    public function login()
    {
        $data = array();



        if($this->input->post())
        {
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('remember_me','Remember Me','');

            if($this->form_validation->run() == TRUE)
            {
                // Login
                if($this->bitauth->login($this->input->post('username'), $this->input->post('password'), $this->input->post('remember_me')))
                {
                    // Redirect
                    if($redir = $this->session->userdata('redir'))
                    {
                        $this->session->unset_userdata('redir');
                    }

                    redirect('home');
                }
                else
                {
                    $data['error'] = $this->bitauth->get_error();
                }
            }
            else
            {
                $data['error'] = validation_errors();
            }
        }

        $data['titulo'] = 'Login';

        $this->load->view('home/login', $data);
    }

}