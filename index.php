<?php

error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors", 1);
ini_set("output_buffering", 4096);

if(!defined('ROOT_DIR'))
{
    define('ROOT_DIR', dirname(__FILE__));
}

if (!defined("FRMK_DIR"))
{
    define("FRMK_DIR", ROOT_DIR . DIRECTORY_SEPARATOR . "piola");
}

if (!defined("APP_DIR"))
{
    define("APP_DIR", ROOT_DIR . DIRECTORY_SEPARATOR . "app");
}

require_once FRMK_DIR . '/CAutoLoader.php';

/*set_error_handler(function ($err_severity, $err_msg, $err_file, $err_line, array $err_context)
{
    if (0 === error_reporting()) { return false; }
    switch($err_severity)
    {
        case E_ERROR:               
            throw new \ErrorException            ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_WARNING:             
            throw new piola\exceptions\WarningException          ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_PARSE:               
            throw new piola\exceptions\ParseException            ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_NOTICE:              
            throw new piola\exceptions\NoticeException           ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_CORE_ERROR:          
            throw new piola\exceptions\CoreErrorException        ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_CORE_WARNING:        
            throw new piola\exceptions\CoreWarningException      ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_COMPILE_ERROR:       
            throw new piola\exceptions\CompileErrorException     ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_COMPILE_WARNING:     
            throw new piola\exceptions\CoreWarningException      ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_USER_ERROR:          
            throw new piola\exceptions\UserErrorException        ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_USER_WARNING:        
            throw new piola\exceptions\UserWarningException      ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_USER_NOTICE:         
            throw new piola\exceptions\UserNoticeException       ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_STRICT:              
            throw new piola\exceptions\StrictException           ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_RECOVERABLE_ERROR:   
            throw new piola\exceptions\RecoverableErrorException ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_DEPRECATED:          
            throw new piola\exceptions\DeprecatedException       ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_USER_DEPRECATED:     
            throw new piola\exceptions\UserDeprecatedException   ($err_msg, 0, $err_severity, $err_file, $err_line);
    }
});*/

try
{
    // cargador de clases
    $autloader = new \piola\CAutoLoader();
    
    // inicio session
    session_start();
    
    print '<pre>' . htmlspecialchars(print_r($_ENV, true)) . '</pre>';
    
    // coso que maneja para que lado va el programa
    $request = new \piola\web\CHttpRequest();
    $front = new \piola\CFrontController($request);
    $front->run();
}
catch(\Exception $ex)
{
    var_dump($ex);
    //echo "<pre>" . $ex->getMessage() . "</pre>" . PHP_EOL;
    //echo "<pre>" . $ex->getTraceAsString() . "</pre>" . PHP_EOL;
}

?>