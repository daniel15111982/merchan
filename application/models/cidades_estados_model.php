<?php

class cidades_estados_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function get_estados() {
        $this->db->select("*");
        $this->db->from("estados");
        $this->db->order_by("nome");

        return $this->db->get()->result();
    }

    function get_cidades_from_estado($id) {
        $this->db->select("*");
        $this->db->from("cidades");
        $this->db->where("id_estado", $id);
        $this->db->order_by("nome");

        return $this->db->get()->result();
    }

    function get_cidades($id) {
        $this->db->select('*');
        $this->db->from('cidades');
        $this->db->where('id_estado', $id);

        return $this->db->get()->result();
    }

    function get_cidade($id) {
        $this->db->select('*');
        $this->db->from('cidades');
        $this->db->where('id_estado', $id);

        return $this->db->get()->row();
    }

    function get_nome_estado($id) {
        $this->db->select('nome');
        $this->db->from('estados');
        $this->db->where('id_estado', $id);

        return $this->db->get()->row()->nome;
    }

    function get_uf_estado($id) {
        $this->db->select('sigla');
        $this->db->from('estados');
        $this->db->where('id_estado', $id);

        return $this->db->get()->row()->sigla;
    }

    function get_estado_usuario($id) {
        $this->db->select('estado');
        $this->db->from('enderecos');
        $this->db->where('id_cliente', $id);

        return $this->db->get()->row()->estado;
    }

}