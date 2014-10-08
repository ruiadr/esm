<?php

/**
 *
 * @author Adrien RUIZ
 *
 */

class MetaModel {
    
    /** @var SimpleXMLElement */
    private $xml;
    
    /**
     * @param PageModel $pagemodel
     */
    public function __construct ($pagemodel) {
        $metafile = '.' . DS . 'pages' . DS . 'metas' . DS . $pagemodel->getKey () . '.xml';
        if (file_exists ($metafile)) {
            $this->xml = simplexml_load_file ($metafile);
        }
    } // __construct;
    
    /**
     * @return string
     */
     public function __get ($name) {
         return $this->xml !== null && isset ($this->xml->{$name})
             ? trim ($this->xml->{$name})
             : '';
     } // __get ();
    
}; // MetaModel;