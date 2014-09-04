<?php

/**
 * 
 * @author Adrien RUIZ
 * 
 */

class PageModel {
    
    /** @var string */
    const PAGE_FORMAT = 'html';
    
    /** @var string */
    private $uri;
    
    /** @var boolean */
    private $is_home;
    
    /** @var string */
    private $file;
    
    /** @string */
    private $key;
    
    /** @var string */
    private $path;
    
    /** @var MetaModel */
    private $meta;
    
    /**
     * @param string $uri
     * @throws Exception
     */
    public function __construct ($uri = null) {
        if ($uri === null) $uri = $_SERVER['REQUEST_URI'];
        $this->uri = $uri;
        
        $page = explode ('.', $uri);
        if ($page[0] == '/') {
            $this->is_home = true;
            $this->file = HOME_PAGE;
            $key = explode ('.', $this->file);
            $this->key = $key[0];
        } else {
            if ($page[1] !== self::PAGE_FORMAT) {
                throw new Exception ("Le format '$page[1]' n'est pas autorisé.");
            }
            $this->is_home = false;
            $page[0] = substr ($page[0], 1, strlen ($page[0]) - 1);
            $this->file = $page[0] . '.php';
            $this->key = $page[0];
        }
        
        $this->path = '.' . DS . 'pages' . DS . $this->file;
        
        if (!file_exists ($this->path)) {
            throw new Exception ("La page '$this->path' n'existe pas.");
        }
        
        // Mise en cache.
        $GLOBALS['pagemodelcache'][md5 ($uri)] = $this;
    } // __construct ();
    
    /**
     * @return string
     */
    public function getURI () {
        return $this->uri;
    } // getURI ();
    
    /**
     * @return string
     */
    public function getURL () {
        return 'http://' . HOST . $this->getURI ();
    } // getURL ();
    
    /**
     * @return boolean
     */
    public function getIsHome () {
        return $this->is_home;
    } // getIsHome ();
    
    /**
     * @return string
     */
    public function getFile () {
        return $this->file;
    } // getFile ();
    
    /**
     * @return string
     */
    public function getKey () {
        return $this->key;
    } // getKey ();
    
    /**
     * @return string
     */
    public function getPath () {
        return $this->path;
    } // getPath ();
    
    /**
     * @return MetaModel
     */
    public function getMeta () {
        if ($this->meta === null) {
            $this->meta = new MetaModel ($this);
        }
        return $this->meta;
    } // getMeta ();
    
}; // PageModel;