<?php

class posts{

    private $id;
    private $titre;
    private $contenu;

    public function setId($id){

        $this->id = $id;

    }
    public function getId() {

        return $this->id;

    }

    public function setTitre($titre){

        $this->titre = $titre;

    }
    public function getTitre(): string {

        return $this->titre;

    }

    public function setContenu($contenu){

        $this->contenu = $contenu;

    }
    public function getContenu(): string {

        return $this->contenu;

    }

}