<?php

namespace Artisterie\DAO;

use Artisterie\Domain\Quote;

/**
 * Description of QuoteDAO
 *
 * @author David
 */
class QuoteDAO extends DAO {
	
	public function findAll(){
		$sql = "SELECT txtQuote,txtAuthor,idQuote FROM t_quote ORDER BY RAND() LIMIT 1";
		$result = $this->getDb()->fetchAll($sql);
		
		$entities = array();
		foreach ($result as $row) {
            $id = $row['idQuote'];
            $entities[$id] = $this->buildDomainObject($row);
        }
        return $entities;
	}
	
	//	on gère les injections de dépendances
	
	protected function buildDomainObject(array $row) {		
		$quote = new quote();
        $quote->setId($row['idQuote']);
        $quote->setQuote($row['txtQuote']);
        $quote->setAuthor($row['txtAuthor']);        
                
        return $quote;
	}
		
//	public function find($id) {
//        $sql = "SELECT txtQuote,txtAuthor FROM t_quote ORDER BY RAND() LIMIT 1";
//        $row = $this->getDb()->fetchAssoc($sql, array($id));
//
//        if ($row) {
//            return $this->buildDomainObject($row);
//        } else {
//            throw new \Exception("Pas de citation avec cet id " . $id);
//        }
//    }	
}
