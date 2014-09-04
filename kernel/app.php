<?php

/**
 *
 * @author Adrien RUIZ
 *
 */

session_start ();

$GLOBALS['pagemodelcache'] = array ();

require_once 'config.php';
require_once 'kernel/define.php';
require_once 'kernel/metamodel.php';
require_once 'kernel/pagemodel.php';
require_once 'kernel/helper.php';
require_once 'kernel/pagefactory.php';

$pagefactory = null;
$page = null;
try {
    $pagefactory = PageFactory::getInstance ();
    $page = $pagefactory->getPageModel ();
} catch (Exception $e) {
    header ("HTTP/1.0 404 Not Found");
    echo '<html>'
       . '  <head>'
       . '    <title>Erreur système!</title>'
       . '    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>'
       . '   <body>'
       . '     <pre style="color:red;">' . $e->getMessage () . '</pre>'
       . '   </body>'
       . '</html>';
    exit ();
}