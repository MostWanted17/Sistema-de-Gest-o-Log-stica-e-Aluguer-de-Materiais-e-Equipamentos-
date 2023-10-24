<?php
require_once __DIR__ . '/../config/config.php';

/**
 * Classe para gerenciar as rotas do site.
 */
class Rotas
{
    // Constantes para os nomes das pastas.
    const PASTA_CONTROLLER = 'controller';
    const PASTA_VIEW = 'view';
    const ASSETS_URL = 'assets';


    /**
     * Página atual que está sendo exibida.
     * @var array
     */
    public static $pag;

    /**
     * Retorna a URL do site com a pasta do site.
     * @return string
     */

    public static function get_WebSite()
    {
        return BASE_URL;
    }
    
    /**
     * Retorna o caminho até a pasta de CSS.
     * @return string
     */
    public static function get_CSS()
    {
        return self::ASSETS_URL . "/css";
    }

    /**
     * Retorna o caminho até a pasta de JavaScript.
     * @return string
     */
    public static function get_JS()
    {
        return self::ASSETS_URL . "/js";
    }

    /**
     * Retorna o caminho até a pasta de bibliotecas de terceiros.
     * @return string
     */
    public static function get_VENDOR()
    {
        return self::ASSETS_URL . "/vendor";
    }

    /**
     * Retorna o caminho até a pasta de imagens.
     * @return string
     */
    public static function get_IMAGES()
    {
        return self::ASSETS_URL . "/images";
    }
    public static function get_FUNCIONARIOS()
    {
        return "/funcionarios";
    }
    public static function get_CARGA()
    {
        return "/carga";
    }
    public static function get_CARRO()
    {
        return "/carro";
    }
    public static function get_MAPS()
    {
        return "/maps";
    }
    public static function get_VIAGEM()
    {
        return "/viagem";
    }
    public static function get_MOTORISTA()
    {
        return "/motorista";
    }
    public static function get_PENDENTES()
    {
        return "/pendentes";
    }
    public static function get_EQUIPAMENTOS()
    {
        return "/equipamentos";
    }
    public static function get_CLIENTES()
    {
        return "/clientes";
    }
    public static function get_ALUGUER()
    {
        return "/aluguer";
    }
    public static function get_LOGOUT()
    {
        return "/logout?logout=true";
    }

    public static function get_RELATORIOALUGUER()
    {
        return "/relatorioAluguer";
    }
    public static function get_RELATORIOVIAGEM()
    {
        return "/relatorioViagem";
    }
    public static function get_RELATORIOCARGA()
    {
        return "/relatorioCarga";
    }
    public static function get_RELATORIOCARRO()
    {
        return "/relatorioCarro";
    }
    public static function get_RELATORIOMOTORISTA()
    {
        return "/relatorioMotorista";
    }
    public static function get_RELATORIOEQUIPAMENTOS()
    {
        return "/relatorioEquipamentos";
    }
    public static function get_RELATORIOFUNCIONARIOS()
    {
        return "/relatorioFuncionarios";
    }
    public static function get_RELATORIOCLIENTES()
    {
        return "/relatorioClientes";
    }
    /**
     * Carrega a página solicitada.
     */
    public static function get_Pagina()
    {
        try {
            if (isset($_GET['pag'])) {
                $pagina = $_GET['pag'];
                self::$pag = explode('/', $pagina);
                $pagina = self::PASTA_CONTROLLER . '/' . self::$pag[0] . '.php';
                if (file_exists($pagina)) {
                    include $pagina;
                } else {
                    throw new Exception('Página não encontrada.');
                }
            } else {
                if($_SESSION['auth_session']['id_nivel'] == 1){
                    include self::PASTA_CONTROLLER . '/pendentes.php';
                }else{
                    include self::PASTA_CONTROLLER . '/viagem.php';
                }
            }
        } catch (Exception $e) {
            include self::PASTA_CONTROLLER . '/erro.php';
        }
    }
}

?>
