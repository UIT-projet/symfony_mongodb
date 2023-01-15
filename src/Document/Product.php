<?php

namespace App\Document;


use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Types\Type as Type;

#[MongoDB\Document(db:"bioapp", collection: "products")]
class Product
{

    #[MongoDB\Id]
    private $id;

    #[MongoDB\Field(type: Type::STRING)]
    private $nom;
    #[MongoDB\Field(type: Type::INT)]
    private  $qte;
    #[MongoDB\Field(type: Type::FLOAT)]
    private $prix;

    #[MongoDB\Field(type: Type::OBJECTID)]
    private $categorie;

    public function getId(){
        return $this->id;
    }

    public function setNom(string $nom){
        $this->nom = $nom;
    }

    public function getNom(){
        return $this->nom;
    }

    public function setQte(int $qte){
        $this->qte = $qte;
    }
    public function getQte(){
        return $this->qte;
    }

    public function setPrix(float $prix){
        $this->prix = $prix;
    }
    public function getPrix(){
        return $this->prix;
    }
    public function setCategorie(string $catgorie){
        $this->categorie = $catgorie;
    }

    public function getCategorie(){
        return $this->categorie;
    }
}