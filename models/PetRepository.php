<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PetRepository
 *
 * @author thymo
 */

namespace DomainLayer\Repository;

use Doctrine\DBAL\Connection;
use DomainLayer\Entity\Pet;

class PetRepository {

    protected $db;

    //put your code here
    public function __construct(Connection $db) {
        $this->db = $db;
    }

    protected function calculeAge($id) {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder->select('(YEAR(CURDATE()) - YEAR(p.birth)) 
            - (RIGHT(CURDATE(),5) < RIGHT(p.birth,5)) as Age')
                ->from('pet', 'p')
                ->where('p.id = ?');
        $result = $this->db->fetchAssoc($queryBuilder->getSQL(), [(int) $id]);
        return $result['Age'];
    }

    public function findDeathAge() {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder->select('nome, birth, death, (YEAR(death)-YEAR(birth)) - (RIGHT(death,5)< RIGHT(birth,5)) AS age ')
                ->from('pet', 'p')
                ->where('p.death IS NOT NULL')
                ->orderBy('age', '');

        $result = $this->db->fetchAll($queryBuilder->getSQL());
        return $result;
    }

    public function findBirthdaysByMonth($month) {
        $months = [1 => 'janeiro', 2 => 'fevereiro', 3 => 'marco',
            4 => 'abril', 5 => 'maio', 6 => 'junho',
            7 => 'julho', 8 => 'agosto', 9 => 'setembro',
            10 => 'outubro', 11 => 'novembro', 12 => 'dezembro'];
        foreach ($months as $listmonth) {
            if ($listmonth == $month) {
                $boolean = 1;
                break;
            }
        }
        
        if (isset($boolean)) {
            $queryBuilder = $this->db->createQueryBuilder();
            $queryBuilder->select('p.id, p.nome, p.owner, p.species, p.sex, p.birth, p.age, p.status')
                    ->from('pet', 'p')
                    ->where('MONTH(p.birth) = ?')
                    ->orderBy('p.birth', 'DESC');
            $result = $this->db->fetchAll($queryBuilder->getSQL(), [$month]);
            return $result;
        }else{
            return false;
        }
    }

    public function save(Pet $pet) {
        if ($pet) {
            $petData = [
                'nome' => $pet->getNome(),
                'owner' => $pet->getOwner(),
                'species' => $pet->getSpecies(),
                'sex' => $pet->getSex(),
                'birth' => $pet->getBirth(),
                'status' => Pet::STATUS_ACTIVE,
                'datecreated' => $pet->getDateCreated(),
                'dateupdated' => $pet->getDateUpdated()
            ];

            if ($pet->getId()) {
                $this->db->update('pet', $petData, ['id' => $pet->getId()]);
            } else {
                $this->db->insert('pet', $petData);
                $id = $this->db->lastInsertId();
                $pet->setId($id);
                $this->db->update('pet', ['age' => $this->calculeAge($pet->getId())], ['id' => $pet->getId()]);
                return true;
            }
        }
    }

}
