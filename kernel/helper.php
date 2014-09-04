<?php

/**
 *
 * @author Adrien RUIZ
 *
 */

class Helper {
    
    /**
     * @param string $uri
     * @return PageModel
     */
    public static function getPageModel ($uri) {
        $pagemodel = null;
        try {
            $pagemodel = isset ($GLOBALS['pagemodelcache'][$hash = md5 ($uri)])
                ? $GLOBALS['pagemodelcache'][$hash]
                : new PageModel ($uri);
        } catch (Exception $e) {}
        return $pagemodel;
    } // getPageModel ();
    
}; // Helper;