<?php
define('HOME', 'http://localhost/phs');

// CONFIGRAÇÕES DO SITE ####################
define('HOST', 'localhost');
define('USER', 'phs');
define('PASS', '123456');
define('DBSA', 'phs');

// AUTO LOAD DE CLASSES ####################
function __autoload($Class)
{
    $cDir = ['pdo','helpers','model','dao','controller','view'];    
    $iDir = null;
 
    foreach ($cDir as $dirName):
        if (!$iDir && file_exists(__DIR__ . "/{$dirName}/{$Class}.class.php") && !is_dir(__DIR__ . "/{$dirName}/{$Class}.class.php")):
            include_once (__DIR__ . "/{$dirName}/{$Class}.class.php");
            $iDir = true;
        endif;
    endforeach;

    if (!$iDir):
        #trigger_error("Não foi possível incluir {$Class}.class.php", E_USER_ERROR);
        echo "Não foi possível incluir {$Class}.class.php";
        #die;
    endif;
}

// TRATAMENTO DE ERROS #####################
//CSS constantes :: Mensagens de Erro
define('SS_ACCEPT', 'accept');
define('SS_INFOR', 'infor');
define('SS_ALERT', 'alert');
define('SS_ERROR', 'error');

//SSErro :: Exibe erros lançados :: Front
function SSErro($ErrMsg, $ErrNo, $ErrDie = null) {
    $CssClass = ($ErrNo == E_USER_NOTICE ? SS_INFOR : ($ErrNo == E_USER_WARNING ? SS_ALERT : ($ErrNo == E_USER_ERROR ? SS_ERROR : $ErrNo)));
    echo "<p class=\"trigger {$CssClass}\">{$ErrMsg}<span class=\"ajax_close\"></span></p>";

    if ($ErrDie):
        die;
    endif;
}

//PHPErro :: personaliza o gatilho do PHP
function PHPErro($ErrNo, $ErrMsg, $ErrFile, $ErrLine) {
    $CssClass = ($ErrNo == E_USER_NOTICE ? SS_INFOR : ($ErrNo == E_USER_WARNING ? SS_ALERT : ($ErrNo == E_USER_ERROR ? SS_ERROR : $ErrNo)));
    echo "<p class=\"trigger {$CssClass}\">";
    echo "<b>Erro na Linha: #{$ErrLine} ::</b> {$ErrMsg}<br>";
    echo "<small>{$ErrFile}</small>";
    echo "<span class=\"ajax_close\"></span></p>";

    if ($ErrNo == E_USER_ERROR):
        die;
    endif;
}

set_error_handler('PHPErro');
