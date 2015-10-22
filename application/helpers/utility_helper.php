<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Utility Helper
 *
 * @package		CodeIgniter
 * @subpackage	Utility
 * @category	Utilitários
 * @author		Fabio Fontoura
 */

// ------------------------------------------------------------------------
if (!function_exists('dateToMysql')) {

    function dateToMysql($datetime = false) {
        if (!$datetime)
            return '0000-00-00 00:00:00';

        if (count(explode(' ', $datetime)) > 1)
            list($data, $hora) = explode(' ', $datetime);
        else {
            $data = $datetime;
            $hora = '';
        }

        list($dia, $mes, $ano) = explode('/', $data);
        return "$ano-$mes-$dia $hora";
    }

}
/**
 * Transforma data no formato YYYY-MM-DD HH:MM:SS para o formato
 * HH:MM:SS para exibição com opção de exibição dos segundos
 *
 * @access	public
 * @param $string string
 * @return	string
 */
if (!function_exists('mysqlToHour')) {

    function mysqlToHour($date,$showsegundos=false) {
        if($date != "") {
            if (count(explode(' ', $date)) > 1)
                list($data, $hora) = explode(' ', $date);
            else
                $data = $date;

            //list($ano, $mes, $dia) = explode('-', $data);

            if ($hora)
                if ($showsegundos) {
                    $hora = explode(':', $hora);

                    return $hora[0] . ':' . $hora[1];
                } else {
                    return "$hora";
                }
            else
                return "";
        }else{
            return "";
        }
    }

}

/**
 * Transforma data no formato YYYY-MM-DD HH:MM:SS para o formato
 * DD/MM/YYYY para exibição com opção de exibição de hora junto
 *
 * @access	public
 * @param $string string
 * @return	string
 */
if (!function_exists('mysqlToDate')) {

    function mysqlToDate($date, $showHour = false) {
        if($date != ""){
            $hora = false;
            if (count(explode(' ', $date)) > 1)
                list($data, $hora) = explode(' ', $date);
            else
                $data = $date;
    
            list($ano, $mes, $dia) = explode('-', $data);
    
            if ($hora && $showHour)
                return "$dia/$mes/$ano $hora";
            else
                return "$dia/$mes/$ano";
        }else{
            return false;
        }
    }

}
/**
 * Transforma data no formato DD/MM/YYYY HH:MM:SS para o formato
 * YYYY-MM-DD HH:MM:SS para inserção no banco de dados
 *
 * @access	public
 * @param $string string
 * @return	string
 */
if (!function_exists('dateToMysqll')) {

    function dateToMysqll($datetime = false) {
        if (!$datetime)
            return '0000-00-00 00:00:00';

        if (count(explode(' ', $datetime)) > 1)
            list($data, $hora) = explode(' ', $datetime);
        else {
            $data = $datetime;
            $hora = '';
        }

        list($dia, $mes, $ano) = explode('/', $data);
        return "$ano-$mes-$dia $hora";
    }

}

/**
 * Função de DEBUG para os códigos exibindo o print_r de um objeto ou array
 *
 * @access	public
 * @param $string string
 * @return	string
 */
  if (!function_exists('debug')) {

    function debug($var, $die = true) {
          if (is_string($var)) {
            $var = htmlentities($var);
          }

          echo "<pre>";
          print_r($var);
          echo "</pre>";

        if ($die) {
            die();
        }
    }
  }

  /**
 * Retorna o mês escrito por extenso
 *
 * @access	public
 */
if (!function_exists('getMesExtenso')) {

    function getMesExtenso($data) {
        $meses = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outrubro', 'Novembro', 'Dezembro');

        $vetor = explode('/', mysqlToDate($data));

        return $meses[$vetor[1] - 1];
    }

}

/**
 * Retorna somente o mês escrito por extenso
 *
 * @access	public
 */
if (!function_exists('getMes')) {

    function getMes($mes) {
        $meses = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outrubro', 'Novembro', 'Dezembro');

        return $meses[$mes - 1];
    }

}

/**
 * Retorna a abreviação do mês escrito por extenso
 *
 * @access	public
 */
if (!function_exists('getMesAbreviacao')) {

    function getMesAbreviacao($mes) {
        $meses = array('Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez');

        return $meses[$mes - 1];
    }

}

/**
 * Upload de um arquivo para o servidor
 *
 * @access	public
 */
if (!function_exists('uploadArquivo')) {

    function uploadArquivo($dir, $field) {

        $CI = & get_instance();

        $config['upload_path'] = $dir;
        $config['allowed_types'] = 'xls';
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = '200000000';

        $CI->load->library('upload', $config);
        $CI->upload->initialize($config);

        $field_name = $field;

        if ($CI->upload->do_upload($field_name)) {
            $dados = $CI->upload->data();

            // Retorna o nome do arquivo
            return $dados['file_name'];
        } else {
            $error = array('error' => $CI->upload->display_errors());

            return $error;
        }
    }

}

/**
 * Gerador de THUMB para imagens
 *
 * @access	public
 */
if (!function_exists('geraThumbImagem')) {

    function geraThumbImagem($dir, $dir_padrao, $largura, $altura, $nome_imagem) {

        $CI = & get_instance();

        $CI->load->library('image_lib');

        $size = getimagesize($dir . '/' . $nome_imagem);

        $config_img['image_library'] = 'GD2';
        $config_img['source_image'] = $dir . $nome_imagem;
        $config_img['create_thumb'] = FALSE;
        $config_img['maintain_ratio'] = TRUE;
        $config_img['encrypt_name'] = FALSE;
        $config_img['new_image'] = caminho_fisico() . $dir_padrao . $largura . 'x' . $altura . '/' . $nome_imagem;

        if ($size[0] > $size[1]) {
            $config_img['width'] = $largura;
            $config_img['height'] = $size[1];
        } else {
            $config_img['width'] = $size[0];
            $config_img['height'] = $altura;
        }

        $CI->image_lib->initialize($config_img);
        $CI->image_lib->resize();
    }

}

/**
 * Upload de uma imagem para o servidor
 *
 * @access	public
 */
if (!function_exists('uploadImagem')) {

    function uploadImagem($dir, $field, $largura = false, $altura = false) {

        $CI = & get_instance();

        $config['upload_path'] = $dir;
        $config['allowed_types'] = 'gif|jpg|png|swf';
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = '200000';
        $config['max_width'] = '10024';
        $config['max_height'] = '7068';

        $CI->load->library('upload', $config);
        $CI->upload->initialize($config);

        $field_name = $field;

        if ($_FILES[$field]['tmp_name'] != '') {
            if ($CI->upload->do_upload($field_name)) {
                $dados = $CI->upload->data();
                if ($largura && $altura) {
                    $CI->load->library('image_lib');

                    $size = getimagesize($dados['full_path']);

                    $config_img['image_library'] = 'GD2';
                    $config_img['source_image'] = $dados['full_path'];
                    $config_img['create_thumb'] = FALSE;
                    $config_img['maintain_ratio'] = TRUE;
                    $config_img['encrypt_name'] = TRUE;

                    if ($size[0] > $size[1]) {

                        if ($size[0] < $largura) {
                            $error = array('error' => 'A Largura da imagem deve ser no mínimo de ' . $largura . 'px');

                            return $error;
                        }

                        $config_img['width'] = $largura;
                        $config_img['height'] = $size[1];
                    } else {

                        if ($size[1] < $altura) {
                            $error = array('error' => 'A Altura da imagem deve ser no mínimo de ' . $altura . 'px');

                            return $error;
                        }

                        $config_img['width'] = $size[0];
                        $config_img['height'] = $altura;
                    }

                    $CI->image_lib->initialize($config_img);
                    $CI->image_lib->resize();
                }
                // Returns the photo name
                return $dados['file_name'];
            } else {
                $error = array('error' => $CI->upload->display_errors());

                return $error;
            }
        } else {
            return FALSE;
        }
    }

}


/**
 * Retorna a diferença de dias entre duas datas
 *
 * @access	public
 */
if (!function_exists('diferencaDias')) {

    function diferencaDias($date1, $date2 = false) {
        if (!$date2)
            $date2 = date('d/m/Y');

        $diff = $date1 > $date2 ? $date1 - $date2 : $date2 - $date1;

        return $diff / 3600;

        $databd = $data; // d/m/Y
        $databd = explode("/", $databd);
        $data = mktime(0, 0, 0, $databd[1], $databd[0], $databd[2]);

        if ($dataAtual) {
            list($dia, $mes, $ano) = explode('/', $dataAtual);
            $data_atual = mktime(0, 0, 0, $mes, $dia, $ano);
        } else
            $data_atual = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
        if ($data > $data_atual)
            $dias = ($data - $data_atual) / 86400;
        else
            $dias = ($data_atual - $data) / 86400;

        return ceil($dias);
    }

}

/**
 * Retorna a DATA E HORA PARA EXIBIÇÃO
 *
 * @access	public
 */
if (!function_exists('hora_e_data')) {

    function hora_e_data() {
        return date('Y-m-d H:i:s');
    }

}

/**
 * Função para verificar se uma data é válida em padrão SQL
 *
 * @access	public
 */
if (!function_exists('validMysqlDate')) {

    function validMysqlDate($date) {
        $data = explode('-', $date);
        if (isset($data[2])) {
            return checkdate($data[1], $data[2], $data[0]);
        } else {
            return false;
        }
    }

}

/**
 * Função para pegar os dados postados e deixamos em formato de URL
 *
 * @access	public
 */
if (!function_exists('arrayToUrlSearch')) {

    function arrayToUrlSearch($array) {
        $url = array();

        foreach ($array as $key => $value) {
            if ($value != '') {
                $value = str_replace('/', '-', $value);
                $value = urlencode(trim($value));
                $url[] = "$key/$value";
            }
        }

        return implode('/', $url);
    }

}

/**
 * Função para detectar a codificação de uma string
 *
 * @access	public
 */
if (!function_exists('codificacao')) {

    function codificacao($string) {
        return mb_detect_encoding($string . 'x', 'UTF-8, ISO-8859-1');
    }

}

/**
 * Função para formatar e exibir um valor em Reais
 *
 * @access	public
 */
if (!function_exists('frmPreco')) {

    function frmPreco($preco) {
        return number_format($preco, '2', ',', '.');
    }

}

if (!function_exists('frmNumero')) {

    function frmNumero($numero) {
        return str_replace('.',',',$numero);
    }

}

/**
 * Função para pegar o dia da semana por extenso
 *
 * @access	public
 */
function get_dia_semana($data = false) {
    if ($data) {
        $d = date('w', strtotime($data));
        switch ($d) {
            case 0: return 'Dom';
                break;
            case 1: return 'Seg';
                break;
            case 2: return 'Ter';
                break;
            case 3: return 'Qua';
                break;
            case 4: return 'Qui';
                break;
            case 5: return 'Sex';
                break;
            case 6: return 'Sab';
                break;
        }
    }
}

/**
 * Função para enviar e-mails pela amazon usando amazon SES
 *
 * @access	public
 */
function enviar_email($para, $assunto, $mensagem, $formato='html', $anexo=false, $from=false, $emailFrom=false){

    if($from == false){
        $from = titulo_padrao();
    }

    if($emailFrom == false){
        $emailFrom = email_contato();
    }

    $CI = & get_instance();

    /*$CI->load->library('email');
    $config['mailtype']     = $formato;
    $config['useragent']    = 'Post Title';
    $config['protocol']     = 'smtp';
    $config['smtp_host']    = 'tls://email-smtp.us-east-1.amazonaws.com';
    $config['smtp_user']    = 'AKIAJMHSOCDUGHYBOUEA';
    $config['smtp_pass']    = 'Ah2PJqJS2lAbLMZtzuoSu6p8jsWcbmLIKJhGVKVlY4Y+';
    $config['smtp_port']    = '465';
    $config['wordwrap']     = TRUE;
    $config['newline']      = "\r\n";

    $CI->email->initialize($config);

    $CI->email->from(email_contato(), titulo_padrao());
    $CI->email->to($para);
    $CI->email->reply_to('financeiro@n49.com.br', 'Financeiro G49');
    $CI->email->cc('financeiro@n49.com.br');
    $CI->email->subject($assunto);
    $CI->email->message($mensagem);

    if($anexo){
      $CI->email->attach($anexo);
    }

    if($CI->email->send()):
        return TRUE;
    else:
        $CI->email->print_debugger();
    endif;*/

    //Verifica se o e-mail está autorizado a disparar
    if($CI->amazon_ses->address_is_verified(email_contato())){
        $CI->amazon_ses->to($para);
        $CI->amazon_ses->from($emailFrom, $from);
        $CI->amazon_ses->subject($assunto);
        $CI->amazon_ses->message($mensagem);

        if($CI->amazon_ses->send()){
            return TRUE;
        }else{
            $CI->amazon_ses->debug(TRUE);
        }
    }

}

/**
 * Função para enviar e-mails por smtp com anexox, sem usar o amazon SES
 *
 * @access	public
 */
function enviarEmailAnexo($para, $assunto, $mensagem, $formato='html', $anexo=false, $from=false){

    if($from == false){
        $from = titulo_padrao();
    }

    $CI = & get_instance();

    $CI->load->library('email');
    $config['mailtype']     = $formato;
    $config['useragent']    = 'Post Title';
    $config['protocol']     = 'smtp';
    $config['smtp_host']    = 'tls://email-smtp.us-east-1.amazonaws.com';
    $config['smtp_user']    = 'AKIAJMHSOCDUGHYBOUEA';
    $config['smtp_pass']    = 'Ah2PJqJS2lAbLMZtzuoSu6p8jsWcbmLIKJhGVKVlY4Y+';
    $config['smtp_port']    = '465';
    $config['wordwrap']     = TRUE;
    $config['newline']      = "\r\n";

    $CI->email->initialize($config);

    $CI->email->from(email_contato(), titulo_padrao());
    $CI->email->to($para);
    //$CI->email->reply_to('financeiro@n49.com.br', 'Financeiro G49');
    //$CI->email->cc('financeiro@n49.com.br');
    $CI->email->subject($assunto);
    $CI->email->message($mensagem);

    if($anexo){
      $CI->email->attach($anexo);
    }

    if($CI->email->send()):
        return TRUE;
    else:
        $CI->email->print_debugger();
    endif;
}

/**
 * Função para contar o numero de notificações recebidas
 *
 * @access	public
 */
function numeroNotificacoes($contador=true)
{
    $CI = & get_instance();

    $notificacoes = 0;
    $notificacoes_html = '';

    //Verifica se tem algum cadastro de empresa
    $CI->db->select('id_empresa');
    $CI->db->select('razao_social');
    $CI->db->from('empresas');
    $CI->db->where('dono',$CI->session->userdata('ba_dono'));

    $rows = $CI->db->get();

    if($rows->num_rows() <= 0){
        $notificacoes++;
        $notificacoes_html .= '<li>
                                    <a href="javascript:;">
                                        <span class="label label-warning"><i class="icon-bell"></i></span>
                                        Você deve cadastrar pelo menos 1 empresa para usar o sistema
                                    </a>
                                </li>';

        $notificacoes_html .= '<li>
                                    <a href="javascript:;">
                                        <span class="label label-warning"><i class="icon-bell"></i></span>
                                        Você não configurou sua conta do SIGEP ainda
                                    </a>
                                </li>';
        $notificacoes++;
    }else{
        //Caso tenha alguma empresa verifico se tem alguma configuração de serviço para a mesma
        $dadosEmpresas = $rows->result();

        foreach($dadosEmpresas as $empresa){
            //Verifico se tem algum serviço configurado para a empresa
            $CI->db->select('idConfig');
            $CI->db->from('configuracoes');
            $CI->db->where('empresa',$empresa->id_empresa);

            $servicos = $CI->db->get();

            if($servicos->num_rows() <= 0){
                $notificacoes++;
                $notificacoes_html .= '<li>
                                    <a href="javascript:;">
                                        <span class="label label-warning"><i class="icon-bell"></i></span>
                                        A empresa '.$empresa->razao_social.' não possui o SIGEP configurado
                                    </a>
                                </li>';
            }
        }
    }

    if($contador){
        return $notificacoes;
    }else{
        return $notificacoes_html;
    }
}

function is_dono($user_id)
{
    $CI = & get_instance();

    if($CI->session->userdata('ba_user_id') == $user_id){
        $grupos = $CI->session->userdata('ba_groups');

        if($grupos[0] == 1){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}

function getValorConfig($empresa,$config)
{
    $CI = & get_instance();

    $CI->db->select('valor');
    $CI->db->from('empresas_has_configuracoes');
    $CI->db->where('id_empresa',$empresa);
    $CI->db->where('config',$config);

    $configs = $CI->db->get();

    if($configs->num_rows() > 0){
        return $configs->row()->valor;
    }else{
        return '';
    }
}

function getCodigoDiretoria($empresa)
{
    $CI = & get_instance();

    $CI->db->select('codigoDiretoria');
    $CI->db->from('configuracoes');
    $CI->db->where('empresa',$empresa);

    $configs = $CI->db->get();

    if($configs->num_rows() > 0){
        return $configs->row()->codigoDiretoria;
    }else{
        return '';
    }
}

function getDestinatario($id)
{
    $CI = & get_instance();

    $CI->db->select('d.*');
    $CI->db->select('de.*');
    $CI->db->from('destinatarios as d');
    $CI->db->join('destinatarios_enderecos as de','de.destinatario = d.id_destinatario');
    $CI->db->where('d.empresa', $CI->session->userdata('ba_empresa_principal'));
    $CI->db->where('d.id_destinatario', $id);
    $CI->db->order_by('nome','ASC');

    $configs = $CI->db->get();

    if($configs->num_rows() > 0){
        return $configs->row()->nome . '<br>' . $configs->row()->endereco . ', '.$configs->row()->numero.', '.$configs->row()->bairro.', '.$configs->row()->cidade;
    }else{
        return '';
    }
}

function getDadosDestinatario($id)
{
    $CI = & get_instance();

    $CI->db->select('*');
    $CI->db->from('objetos');
    $CI->db->where('empresa', $CI->session->userdata('ba_empresa_principal'));
    $CI->db->where('id_objeto', $id);
    $CI->db->order_by('nome','ASC');

    $configs = $CI->db->get();

    if($configs->num_rows() > 0){
        return $configs->row();
    }else{
        return '';
    }
}

function getDestinatarioByEmail($email)
{
    $CI = & get_instance();

    $CI->db->select('id_destinatario');
    $CI->db->from('destinatarios');
    $CI->db->where('email',$email);
    $CI->db->where('empresa',$CI->session->userdata('ba_empresa_principal'));

    $configs = $CI->db->get();

    if($configs->num_rows() > 0){
        return $configs->row()->id_destinatario;
    }else{
        return false;
    }
}

function getEmpresa()
{
    $CI = & get_instance();

    $CI->db->select('*');
    $CI->db->from('empresas');
    $CI->db->where('id_empresa',$CI->session->userdata('ba_empresa_principal'));

    $configs = $CI->db->get();

    if($configs->num_rows() > 0){
        return $configs->row();
    }else{
        return false;
    }
}

function getNomeEmpresa($idEmpresa)
{
    $CI = & get_instance();

    $CI->db->select('nome_fantasia');
    $CI->db->from('empresas');
    $CI->db->where('id_empresa',$idEmpresa);

    $configs = $CI->db->get();

    if($configs->num_rows() > 0){
        return $configs->row()->nome_fantasia;
    }else{
        return false;
    }
}

function getEmailEmpresa($idEmpresa)
{
    $CI = & get_instance();

    $CI->db->select('email');
    $CI->db->from('empresas');
    $CI->db->where('id_empresa',$idEmpresa);

    $configs = $CI->db->get();

    if($configs->num_rows() > 0){
        return $configs->row()->email;
    }else{
        return false;
    }
}

function getObjetoByNf($nf)
{
    $CI = & get_instance();

    $CI->db->select('id_objeto');
    $CI->db->from('objetos');
    $CI->db->where('nota_fiscal',$nf);
    $CI->db->where('empresa',$CI->session->userdata('ba_empresa_principal'));

    $configs = $CI->db->get();

    if($configs->num_rows() > 0){
        return $configs->row()->id_objeto;
    }else{
        return false;
    }
}

function getServico($valor)
{
    $CI = & get_instance();

    $CI->db->select('*');
    $CI->db->from('servicos_correios');
    $CI->db->where('valor',$valor);

    $configs = $CI->db->get();

    if($configs->num_rows() > 0){
        return $configs->row()->nome;
    }else{
        return false;
    }
}

function getTotalObjetos($id_plp)
{
    $CI = & get_instance();

    $CI->db->select('COUNT(id_objeto) as total');
    $CI->db->from('plps_has_objetos');
    $CI->db->where('id_plp',$id_plp);

    $configs = $CI->db->get();

    if($configs->num_rows() > 0){
        return $configs->row()->total;
    }else{
        return 0;
    }
}

function hasObj($id_plp,$id_objeto)
{
    $CI = & get_instance();

    $CI->db->select('*');
    $CI->db->from('plps_has_objetos');
    $CI->db->where('id_plp',$id_plp);
    $CI->db->where('id_objeto',$id_objeto);

    $configs = $CI->db->get();

    if($configs->num_rows() > 0){
        return 'checked="checked"';
    }else{
        return false;
    }
}

function getSiglaEstado($idEstado)
{
    $CI = & get_instance();

    $CI->db->select('sigla');
    $CI->db->from('estados');
    $CI->db->where('id_estado',$idEstado);

    $configs = $CI->db->get();

    if($configs->num_rows() > 0){
        return $configs->row()->sigla;
    }else{
        return 0;
    }
}

function getSigla($idEstado)
{
    $CI = & get_instance();

    $CI->db->select('sigla');
    $CI->db->from('estados');
    $CI->db->where('id_estado',$idEstado);

    $configs = $CI->db->get();

    if($configs->num_rows() > 0){
        return $configs->row()->sigla;
    }else{
        return 0;
    }
}

function getCidade($idCidade)
{
    $CI = & get_instance();

    $CI->db->select('nome');
    $CI->db->from('cidades');
    $CI->db->where('id_cidade',$idCidade);

    $configs = $CI->db->get();

    if($configs->num_rows() > 0){
        return $configs->row()->nome;
    }else{
        return 0;
    }
}

/**
 * @param $codigo
 * @return int
 */
function getNomeTipo($codigo)
{
    $CI = & get_instance();

    $CI->db->select('nome');
    $CI->db->from('servicos_correios');
    $CI->db->where('valor',$codigo);

    $configs = $CI->db->get();

    if($configs->num_rows() > 0){
        return $configs->row()->nome;
    }else{
        return false;
    }
}

function getStatusAtual($idRastreamento)
{
    $CI = & get_instance();

    $CI->db->select('status');
    $CI->db->from('rastreamento_historico');
    $CI->db->where('rastreamento',$idRastreamento);
    $CI->db->order_by('data','DESC');
    $CI->db->limit(1);

    $configs = $CI->db->get();

    if($configs->num_rows() > 0){
        return $configs->row()->status;
    }else{
        return 'Objeto sem rastreamento no momento';
    }
}

function getCartaoPostagem(){
    $CI = & get_instance();

    $CI->db->select('cartaoPostagem');
    $CI->db->from('configuracoes');
    $CI->db->where('empresa',$CI->session->userdata('ba_empresa_principal'));

    $configs = $CI->db->get();

    if($configs->num_rows() > 0){
        return $configs->row()->cartaoPostagem;
    }else{
        return false;
    }
}

function calculaDigitoVerificador($sro)
{
    //Inicializa o retorno
    $retorno = -1;
    //Valida a quantidade de caracteres
    if (strlen(trim($sro)) === 8)
    {
        //Valida
        $soma = 0;
        for ($i = 0; $i <= 8; $i++)
        {
            $soma = $soma + (int) substr($sro, $i, 1) * (int) substr('86423597', $i, 1);
        }
        //Calcula o dígito validador
        switch ($soma % 11)
        {
            case 0:
                $retorno = 5;
                break;
            case 1:
                $retorno = 0;
                break;
            default:
                $retorno = 11 - ($soma % 11);
                break;
        }
    }
    //Retorna
    return $retorno;
}

function getCodigoComDigito($codigo,$digito)
{
    $CI = & get_instance();

    $semLetras = substr($codigo,0, -2);
    $letras = substr($codigo, -2);

    if($digito == ""){
        $digito = calculaDigitoVerificador(substr($semLetras,2));
        $data['digitoVerificador'] = $digito;
        $CI->db->where('codRastreamento',$codigo);
        $CI->db->update('rastreamento',$data);
    }

    return $semLetras.$digito.$letras;
}

function getStatusRastreamento($nomeStatus)
{
    $CI = & get_instance();

    switch($nomeStatus){
        case "Aguardando":
            $CI->db->select('id_objeto');
            $CI->db->from('objetos');
            $CI->db->where('cod_rastreio','');
            $CI->db->where('empresa',$CI->session->userdata('ba_empresa_principal'));
            $retorno = $CI->db->get()->num_rows();
            break;
        case "Postado":
            $CI->db->select('COUNT(rh.idHistorico) as total');
            $CI->db->from('rastreamento_historico as rh');
            $CI->db->join('rastreamento as r','r.idRastreamento = rh.rastreamento');
            $CI->db->where('r.empresa',$CI->session->userdata('ba_empresa_principal'));
            $CI->db->where('rh.status','Objeto postado');
            $CI->db->group_by('rh.status');
            $dados = $CI->db->get();
            if($dados->num_rows() > 0){
                $retorno = $dados->row()->total;
            }else{
                $retorno = 0;
            }
            break;
        case "Em Trânsito":
            $CI->db->select('COUNT(rh.idHistorico) as total');
            $CI->db->from('rastreamento_historico as rh');
            $CI->db->join('rastreamento as r','r.idRastreamento = rh.rastreamento');
            $CI->db->where('r.empresa',$CI->session->userdata('ba_empresa_principal'));
            $CI->db->where('rh.status <>','Objeto postado');
            $CI->db->where('rh.status <>','Objeto entregue ao destinatário');
            $CI->db->where('rh.st <>','50');
            $CI->db->where('rh.st <>','51');
            $CI->db->where('rh.st <>','52');
            $CI->db->where('rh.st <>','69');
            $CI->db->where('rh.st <>','4');
            $CI->db->where('rh.st <>','5');
            $CI->db->where('rh.st <>','31');
            $CI->db->group_by('rh.status');
            $dados = $CI->db->get();
            if($dados->num_rows() > 0){
                $retorno = $dados->row()->total;
            }else{
                $retorno = 0;
            }
            break;
        case "Entregue":
            $CI->db->select('COUNT(rh.idHistorico) as total');
            $CI->db->from('rastreamento_historico as rh');
            $CI->db->join('rastreamento as r','r.idRastreamento = rh.rastreamento');
            $CI->db->where('r.empresa',$CI->session->userdata('ba_empresa_principal'));
            $CI->db->where('rh.status','Objeto entregue ao destinatário');
            $CI->db->group_by('rh.status');
            $dados = $CI->db->get();
            if($dados->num_rows() > 0){
                $retorno = $dados->row()->total;
            }else{
                $retorno = 0;
            }
            break;
        case "Objetos não entregues":
            $CI->db->select('COUNT(rh.idHistorico) as total');
            $CI->db->from('rastreamento_historico as rh');
            $CI->db->join('rastreamento as r','r.idRastreamento = rh.rastreamento');
            $CI->db->where('r.empresa',$CI->session->userdata('ba_empresa_principal'));
            $CI->db->where("(rh.st = '50' OR rh.st = '51' OR rh.st = '52' OR rh.st = '69' OR rh.st = '4' OR rh.st = '5' OR rh.st = '31')");
            $CI->db->group_by('rh.status');
            $dados = $CI->db->get();
            if($dados->num_rows() > 0){
                $retorno = $dados->row()->total;
            }else{
                $retorno = 0;
            }
            break;
    }

    return $retorno;
}