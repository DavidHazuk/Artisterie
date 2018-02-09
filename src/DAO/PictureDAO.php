<?php

namespace Artisterie\DAO;

use Artisterie\Domain\Picture;

/**
 * Description of PictureDAO
 *
 * @author Etudiant
 */
class PictureDAO extends DAO {
	
	protected function buildDomainObject(array $row) {
		$picture = new Picture();
		$picture->setId($row['idPicture']);
		$picture->setName($row['txtPictureName']);
		$picture->setThumbnailPath($row['txtPictureThumbnailPath']);
		$picture->setImgPath($row['txtPicturePath']);

		return $picture;
	}
	
	
	/**
	 * Returns a list of all pictures, sorted by id desc.
	 *
	 * @return array A list of all pictures.
	 */
	public function findAll() {
		$sql = "select * from t_picture order by idPicture";
		$result = $this->getDb()->fetchAll($sql);

		// Convert query result to an array of domain objects
		$entities = array();
		foreach ($result as $row) {
			$id = $row['idPicture'];
			$entities[$id] = $this->buildDomainObject($row);
		}
		return $entities;
	}
	
	/**
	 * Returns the picture of id.
	 *
	 * @return the picture.
	 */
	public function find($id) {
		$sql = "select * from t_picture where idPicture=?";
		$row = $this->getDb()->fetchAssoc($sql, array($id));

		if ($row){
			return $this->buildDomainObject($row);
		} else {
			throw new \Exception("Pas d'image correspondante à l'id '" . $id . "'");
		}		
	}
	
	/**
	 * Saves a picture into the database.
	 *
	 * @param \Artisterie\Domain\Picture $picture The picture to save
	 */
	public function save(Picture $picture) {
		$pictureData = array(
			'txtPictureName' => $picture->getName()
		);

		// Si une miniature est fournie
		if (!empty($picture->getThumbnailPath())){
			$pictureData['txtPictureThumbnailPath'] = $picture->getThumbnailPath();
		}
		// Si une image est fournie
		if (!empty($picture->getImgPath())){
			$pictureData['txtPicturePath'] = $picture->getImgPath();
		}
		
		if ($picture->getId()) {
			// The picture has already been saved : update it
			$this->getDb()->update('t_picture', $pictureData, array('idPicture' => $picture->getId()));
		} else {
			// The picture has never been saved : insert it
			$this->getDb()->insert('t_picture', $pictureData);
			// Get the id of the newly created picture and set it on the entity.
			$id = $this->getDb()->lastInsertId();
			$picture->setId($id);
		}
	}
	
	/**
	 * Removes a picture from the database.
	 *
	 * @param integer $id The picture id.
	 */
	public function delete($id) {
		// Delete the picture
		$this->getDb()->delete('t_picture', array('idPicture' => $id));
	}	
}
