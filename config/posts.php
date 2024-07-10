<?php

class posts{

    private $titre;
    private $post;

    public function setTitre($titre){

        $this->titre = $titre;

    }
    public function getTitre(): string {

        return $this->titre;

    }
    public function setPost($post){

        $this->post = $post;

    }
    public function getPost(): string {

        return $this->post;

    }

}