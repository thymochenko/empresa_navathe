<?php
namespace Domain\Model\Repository;

use Doctrine\DBAL\Connection;
use DomainLayer\Entity\Pet;

class ProjetoRepository {
	
	protected $db;
	
	public function __construct(Connection $db){
		$this->db = $db;
	}
	
	public function save(Projeto $projeto){	
        $pjData = [
                'projnome' => $projeto->getProjNome(),
                'projlocal' => $pet->getProjLocal(),
                'dnum' => $pet->getDnum()
            ];

            if ($projeto->getId()) {
                $this->db->update('projeto', $pjData, ['id' => $projeto->getId()]);
            } else {
                $this->db->insert('projeto', $pjData);
                $id = $this->db->lastInsertId();
                $pet->setId($id);
                return true;
            }
	}
}