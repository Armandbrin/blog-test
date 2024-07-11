<?php



class users{

    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $mdp;
    private $age;
    private $statut;

    public function setId($id){

        $this->id = $id;

    }
    public function getId(): string {

        return $this->id;

    }
    public function setNom($nom){

        $this->nom = $nom;

    }
    public function getNom(): string {

        return $this->nom;

    }

    public function setPrenom($prenom){

        $this->prenom = $prenom;

    }
    public function getPrenom(): string {

        return $this->prenom;

    }

    public function setEmail($email){

        $this->email = $email;

    }
    public function getEmail(): string {

        return $this->email;

    }

    public function setMdp($mdp){

        $this->mdp = $mdp;

    }
    public function getMdp(): string {

        return $this->mdp;

    }

    public function setAge($age){

        $this->age = $age;

    }
    public function getAge(): string {

        return $this->age;
        
    }

    public function setStatut($statut){

        $this->statut = $statut;

    }
    public function getStatut(): string {

        return $this->statut;

    }
    
}