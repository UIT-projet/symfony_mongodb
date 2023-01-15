<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Types\Type as Type;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[MongoDB\Document(db:"bioapp", collection: "users")]
class  User implements PasswordAuthenticatedUserInterface
{
    #[MongoDB\Id]
    private $id;

    #[MongoDB\Field(type:Type::STRING)]
    private $noms;
    #[MongoDB\Field(type:Type::STRING)]
    private $genre;

    #[MongoDB\Field(type:Type::DATE)]
    private $dnaiss;


    #[MongoDB\Field(type: Type::STRING)]
    private $adresse;

    #[MongoDB\Field(type: Type::INT)]
    private $tel;

    #[MongoDB\Field(type:Type::STRING)]
    private $password;

    #[MongoDB\Field(type:Type::INT)]
    private $role;

    #[MongoDB\Field(type: TYPE::HASH)]
    private $commandes;

    public  function getId(){
        return $this->id;
    }


    public function  setNom(string $nom){
        $this->noms = $nom;
    }

    public function  getNoms(){
        return $this->noms;
    }

    public function  setGenre(string $genre){
        $this->genre = $genre;
    }

    public function  getGenre(){
        return $this->genre;
    }

    public function  setDnaiss(string $dnaiss){
        $this->dnaiss = $dnaiss;
    }

    public function  getDnaiss(){
        return $this->dnaiss;
    }

    public function  setAdresse(string $adresse){
        $this->adresse = $adresse;
    }

    public function  getAdresse(){
        return $this->adresse;
    }

    public function  setTel(string $tel){
        $this->tel = $tel;
    }

    public function  getTel(){
        return $this->tel ;
    }

    public function  setPassword(string $password){
        $this->password = $password;
    }

    public function getPassword(): ?string
    {
        // TODO: Implement getPassword() method.
        return $this->password;
    }

    public function  setRole(string $role){
        $this->role = $role;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setCommandes($commandes){
        $this->commandes = $commandes;
        return;
    }

    public function getCommandes()
    {
        return $this->commandes;
    }
}
