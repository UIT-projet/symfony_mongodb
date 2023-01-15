<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Types\Type as Type;



#[MongoDB\Document(db:"bioapp", collection: "categories")]

class Categorie
{
    #[MongoDB\Id]
    private $id;
    #[MongoDB\Field(type: Type::STRING)]
    private $lib;

    public function getId(){
        return $this->id;
    }
    public function setLib(string $lib){
        $this->lib = $lib;
    }
    public function getLib(){
        return $this->lib;
    }
}