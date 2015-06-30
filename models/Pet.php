<?php

namespace DomainLayer\Entity;

class Pet {

    protected $id;
    protected $nome;
    protected $owner;
    protected $species;
    protected $sex;
    protected $birth;
    protected $death;
    protected $status;
    protected $datecreated;
    protected $dateupdated;
    protected $age;
    //constants
    CONST STATUS_ACTIVE = 1;
    CONST STATUS_INATIVE = 0;

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setOwner($owner) {
        $this->owner = $owner;
    }

    public function getOwner() {
        return $this->owner;
    }

    public function setSpecies($species) {
        $this->species = $species;
    }

    public function getSpecies() {
        return $this->species;
    }

    public function setSex($sex) {
        $this->sex = $sex;
    }

    public function getSex() {
        return $this->sex;
    }

    public function setBirth($birth) {
        $this->birth = $birth;
    }

    public function getBirth() {
        if ($this->birth instanceof \DateTime) {
            return $this->birth->format('Y-m-d H:i:s');
        } else {
            return $this->birth;
        }
    }

    public function setDeath($death) {
        $this->death = $death;
    }

    public function getDeath() {
        return $this->death;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setDateCreated($datecreated) {
        $this->datecreated = $datecreated;
    }

    public function getDateCreated() {
        $this->datecreated = new \DateTime('NOW');
        return $this->datecreated->format('Y-m-d H:i:s');
    }

    public function setDateUpdated($dateupdated) {
        $this->dateupdated = $dateupdated;
    }

    public function getDateUpdated() {
        $this->dateupdated = new \DateTime('NOW');
        return $this->dateupdated->format('Y-m-d H:i:s');
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setAge($age) {
        $this->age = $age;
    }

    public function getAge() {
        return $this->age;
    }
}