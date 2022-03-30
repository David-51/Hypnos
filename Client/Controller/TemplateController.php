<?php

namespace Client\Controller;

class Template
{
    public string $title = 'Hypnos Hôtels';
    public string $view;
    public string $header ='undefined';
    public string $body = 'undefined';
    public string $footer = 'undefined';
    public string $navbar = 'undefined';

    public function setTitle($title) :string{
        return $this->title = $title;        
    }
    public function getTitle() :string{
        return $this->title;
    }

    public function setHeader(string $header_name, $props = []){
        ob_start();
        $props = $props;
        require $header_name.'View.php';
        return $this->header = ob_get_clean();
    }
    public function getHeader(){
        return $this->header;
    }
    public function setBody(string $body_name, $props = []){
        ob_start();
        $props = $props;
        require $body_name.'View.php';
        return $this->body = ob_get_clean();
        
    }
    public function setNavbar(string $navbar_name, $props = []){
        ob_start();
        $props = $props;
        require $navbar_name.'View.php';
        return $this->navbar = ob_get_clean();        
    }
    public function getBody(){
        return $this->body;
    }
    public function setFooter(string $footer_name, $props = []){
        ob_start();
        $props = $props;
        require $footer_name.'View.php';
        return $this->footer = ob_get_clean();
    }
    public function getFooter(){
        return $this->footer;
    }

    public function getContent() {     
        ob_start();
        
        $this->navbar = $this->navbar === 'undefined' ? '' : $this->navbar; 
        $this->header = $this->header === 'undefined' ? '' : $this->header; 
        $this->body = $this->body === 'undefined' ? '<h5>Pas de contenu ...</h5>' : $this->body; 
        $this->footer = $this->footer === 'undefined' ? '' : $this->footer;   
        require 'templateView.php';
        $this->view = ob_get_clean();
        return $this->view;
    }
}