<?php
session_start();
ob_start();

define('URL', 'http://10.2.99.168:1234/doxo/');

define('CONTROLER', 'Relatorio');
define('METODO', 'dashboard');

//Credenciais de acesso ao BD
define('HOST', '10.2.99.168:1234');
define('USER', 'SYSDBA');
define('PASS', 'masterkey');
define('DBNAME', '10.2.99.168:C:\Listo\Data\DUECUOCHI_ITAIM.FDB');