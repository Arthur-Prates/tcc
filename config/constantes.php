<?php
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_ALL, 'pt_BR');
session_start();
define('URLBASEPATH', __DIR__ . '/../');
define('BASEPATH', __DIR__ . DIRECTORY_SEPARATOR );
define('BASEPATHFILE', __FILE__);
define('BASEPATHVIRTUAL',$_SERVER['DOCUMENT_ROOT']. DIRECTORY_SEPARATOR);
define('DOMINIO',$_SERVER['SERVER_NAME']);
define('TITULOSITE','');
define('TEMPOFALHA','15');
define('TENTATIVAFALHA','3');
define('DATATIMEATUAL', date("Y-m-d H:i:s"));
define('DATAATUAL', date("Y-m-d"));

$servidorLocal = true;
if ($servidorLocal) {
    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASS', '');
    define('DBNAME', 'tccmarco');
} else {
    define('HOST', '15.235.55.95');
    define('USER', 'tccmarco');
    define('PASS', 'Wold51@2');
    define('DBNAME', 'tccmarco');
}