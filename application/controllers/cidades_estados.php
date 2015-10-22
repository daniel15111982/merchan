<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cidades_estados extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function ajax_get_cidades_from_estado($id = 0) {

        $this->load->model('cidades_estados_model');

        if ($id == 0) {
            echo "<option value=\"\">Selecione um Estado</option>";
            die;
        }

        $cidades = $this->cidades_estados_model->get_cidades_from_estado($id);

        echo "<option value=\"\">Selecione...</option>";

        foreach ($cidades as $cidade) {
            echo "<option value=\"$cidade->nome\">" . ucfirst($cidade->nome) . "</option>";
        }
    }

    public function ajax_get_cidades_from_estado_empresa($id = 0) {

        $this->load->model('cidades_estados_model');

        if ($id == 0) {
            echo "<option value=\"\">Selecione um Estado</option>";
            die;
        }

        $cidades = $this->cidades_estados_model->get_cidades_from_estado($id);

        echo "<option value=\"\">Selecione...</option>";

        foreach ($cidades as $cidade) {
            echo "<option value=\"$cidade->id_cidade\">" . ucfirst($cidade->nome) . "</option>";
        }
    }

    public function getCep($cep)
    {
        $json = array();

        $cep = str_replace('-','',$cep);

        $wsdl = 'http://wscep.n49.com.br/server.php?wsdl';
        $client = new SoapClient($wsdl, array(  'soap_version' => SOAP_1_1,
            'trace' => true,
        ));
        try {
            $params = array(
                'cep' => $cep,
                'token' => 'sjjdh73983hwndhiwkq99283hhdikka88'
            );
            $res = $client->__soapCall( 'getEndereco', $params );

            if($res['erro'] == 0){
                $json['logradouro'] = utf8_decode($res['logradouro']);
                $json['tipo'] = utf8_decode($res['tipo']);
                $json['cidade'] = utf8_decode($res['cidade']);
                $json['bairro'] = utf8_decode($res['bairro']);
                $json['uf'] = utf8_decode($res['uf']);

                //Seleciona estado
                $this->db->select('id_estado');
                $this->db->from('estados');
                $this->db->where('sigla',$res['uf']);

                $estado = $this->db->get()->row();

                if($estado){
                    $json['uf'] = $estado->id_estado;
                }else{
                    $json['uf'] = '';
                }

                $json['erro'] = 0;
            }else{
                $json['erro'] = $res['msgErro'];
            }

        } catch (SoapFault $e) {
            $json['erro'] = "Error: {$e}";
        }

        echo json_encode($json);
    }
}