<?php

/**
 *
 * @author Adrien RUIZ
 *
 */

class PageFactory {
    
    /** @var PageModel */
    private $page;
    
    /** @var boolean */
    private $is_error;
    
    /**
     * @throws Exception
     */
    private function __construct () {
        $this->page = null;
        $this->is_error = false;
        
        if (!file_exists ('.' . DS . 'pages' . DS . HOME_PAGE)) {
            throw new Exception ("La page d'accueil n'existe pas.");
        } else if (!file_exists ('.' . DS . 'pages' . DS . ERROR_PAGE)) {
            throw new Exception ("La page d'erreur n'existe pas.");
        }
    } // __construct ();
    
    /**
     * @return PageModel
     */
    public function getPageModel () {
        if ($this->page === null) {
            try {
                $this->page = new PageModel ();
                if ($this->page->getFile () == ERROR_PAGE) {
                    throw new Exception ();
                } else if (!$this->page->getIsHome()
                        && $this->page->getFile () == HOME_PAGE) {
                    header ('Status: 301 Moved Permanently', false, 301);
                    header ("Location: http://{$_SERVER['HTTP_HOST']}");
                    exit ();
                }
            } catch (Exception $e) {
                header ("HTTP/1.0 404 Not Found");
                $error = explode ('.', ERROR_PAGE);
                $this->page = new PageModel ('/' . $error[0] . '.' . PageModel::PAGE_FORMAT);
                $this->is_error = true;
            }
        }
        return $this->page;
    } // getPageModel ();
    
    /**
     * @return boolean
     */
    public function getIsError () {
        return $this->is_error;
    } // getIsError ();
    
    /**
     * @var PageFactory
     */
    private static $instance;
    
    /**
     * @return PageFactory
     * @throws Exception
     */
    public static function getInstance () {
        if (self::$instance === null) {
            self::$instance = new PageFactory ();
        }
        return self::$instance;
    } // getInstance ();
    
}; // PageFactory;