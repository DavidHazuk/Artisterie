<?php

namespace Artisterie\DAO;

use Artisterie\Domain\News;

/**
 * Description of NewsDAO
 *
 * @author David
 */
class NewsDAO extends DAO {

	private $perPage = 3;
	
	public function findAll(){
		$sql = "SELECT * FROM t_news ORDER BY idnew DESC";
		$result = $this->getDb()->fetchAll($sql);
		
		$entities = array();
		foreach ($result as $row) {
            $id = $row['idnew'];
            $entities[$id] = $this->buildDomainObject($row);
        }
        return $entities;
	}
	
	public function findLastNews(){
		$sql = "SELECT * FROM t_news ORDER BY idnew DESC LIMIT 1";
		$result = $this->getDb()->fetchAll($sql);
		
		$entities = array();
		foreach ($result as $row) {
            $id = $row['idnew'];
            $entities[$id] = $this->buildDomainObject($row);
        }
        return $entities;
	}

	public function countAllPages(){		
		
		$sql = "SELECT COUNT(idnew) AS numbernews FROM t_news";
		$data = $this->getDb()->fetchAssoc($sql);		

		$number_news= $data['numbernews'];		
		$numberPages = ceil($number_news/$this->perPage);
		
		return $numberPages;
	}
	
	public function findCurrentPage($currentPage){
		$sql = "SELECT * FROM t_news ORDER BY dtNewDate DESC LIMIT ".(($currentPage-1)*$this->perPage).",".$this->perPage;
		$result = $this->getDb()->fetchAll($sql);
		
		$entities = array();
		foreach ($result as $row) {
            $id = $row['idnew'];
            $entities[$id] = $this->buildDomainObject($row);
        }
        return $entities;
	}
	
	

	//	on gère les injections de dépendances
	
	protected function buildDomainObject(array $row) {		
		$news = new news();
        $news->setId($row['idnew']);
        $news->setTitle($row['txtNewTitle']);
        $news->setContent($row['txtNewContent']);
        $news->setImgPath($row['txtNewImgPath']);
		$news->setDate($row['dtNewDate']);
                
        return $news;
	}
	
	public function save(News $news) {
        $newsData = array(
            'txtNewTitle' => $news->getTitle(),
			'txtNewContent' => $news->getContent()
		);

		// Si une image est fournie
		if (!empty($news->getImgPath())){
			$newsData['txtNewImgPath'] = $news->getImgPath();
		}
		
        if ($news->getId()) {
            // The news has already been saved : update it
            $this->getDb()->update('t_news', $newsData, array('idnew' => $news->getId()));
        } else {
            // The news has never been saved : insert it
            $this->getDb()->insert('t_news', $newsData);
            // Get the id of the newly created news and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $news->setId($id);
        }
    }
	
	public function find($id) {
        $sql = "SELECT * FROM t_news WHERE idnew=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row) {
            return $this->buildDomainObject($row);
        } else {
            throw new \Exception("Pas de news avec cet id " . $id);
        }
    }
	
	/**
     * Removes an news from the database.
     *
     * @param integer $id The news id.
     */
    public function delete($id) {
        // Delete the news
        $this->getDb()->delete('t_news', array('idnew' => $id));
    }

}

