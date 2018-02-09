<?php

namespace Artisterie\DAO;

use Artisterie\Domain\Track;

class TrackDAO extends DAO {

	protected function buildDomainObject(array $row) {
		$track = new Track();
		$track->setId($row['idTrack']);
		$track->setName($row['txtTrackName']);
		$track->setUrl($row['txtSoundcloudURL']);
		$track->setPath($row['txtAudioPath']);
		$track->setRecord($row['txtRecordName']);
		$track->setDate($row['dtRecordDate']);
		$track->setStyle($row['txtRecordStyle']);
		$track->setArtwork($row['txtArtworkPath']);
		$track->setArtist($row['txtArtistName']);

		return $track;
	}
		
	/**
	 * Returns a list of all tracks, sorted by date.
	 *
	 * @return array A list of all tracks.
	 */
	public function findAll() {
		$sql = "select * from t_track order by dtRecordDate desc,idTrack desc";
		$result = $this->getDb()->fetchAll($sql);

		// Convert query result to an array of domain objects
		$entities = array();
		foreach ($result as $row) {
			$id = $row['idTrack'];
			$entities[$id] = $this->buildDomainObject($row);
		}
		return $entities;
	}
	
	/**
	 * Returns the track of id.
	 *
	 * @return the track.
	 */
	public function find($id) {
		$sql = "select * from t_track where idTrack=?";
		$row = $this->getDb()->fetchAssoc($sql, array($id));

		if ($row){
			return $this->buildDomainObject($row);
		} else {
			throw new \Exception("Pas de titre correspondant à l'id '" . $id . "'");
		}		
	}
			
	/**
     * Tuning iframe soundcloud.
     *
     * @param string $iframe soundcloud iframe
     * 
     * @return string $tmp soundcloud iframe for artisterie
     */
    public function translateIframe($iframe){
        
        $tmp = str_replace('height="300"', 'height="250"', $iframe);
		$tmp = str_replace(' width="100%"', '', $tmp);
        $tmp = str_replace(' scrolling="no"', '', $tmp);
        $tmp = str_replace(' frameborder="no" allow="autoplay"', '', $tmp);
        $tmp = str_replace('color=%23ff5500', 'color=%23287c4e', $tmp);
        $tmp = str_replace('hide_related=false', 'hide_related=true', $tmp);
        $tmp = str_replace('show_comments=true', 'show_comments=false', $tmp);
        $tmp = str_replace('show_user=true', 'show_user=false', $tmp);
        $tmp = str_replace('show_teaser=true', 'show_teaser=false', $tmp);

        return $tmp;
    }
	
	
	/**
	 * Saves a track into the database.
	 *
	 * @param \Artisterie\Domain\Track $track The track to save
	 */
	public function save(Track $track) {
		$trackData = array(
			'idTrack' => $track->getId(),
			'txtTrackName' => ucwords($track->getName()),
			'txtSoundcloudURL' => $this->translateIframe($track->getUrl()),
			'txtAudioPath' => $track->getPath(),
			'txtRecordName' => ucwords($track->getRecord()),
			'dtRecordDate' => $track->getDate(),
			'txtRecordStyle' => ucwords($track->getStyle()),
			'txtArtworkPath' => $track->getArtwork(),
			'txtArtistName' => ucwords($track->getArtist()),
		);

		if ($track->getId()) {
			// The track has already been saved : update it
			$this->getDb()->update('t_track', $trackData, array('idTrack' => $track->getId()));
		} else {
			// The track has never been saved before : insert it
			$this->getDb()->insert('t_track', $trackData);
			// Get the id of the newly created track and set it on the entity.
			$id = $this->getDb()->lastInsertId();
			$track->setId($id);
		}
	}
	
	/**
	 * Removes a track from the database.
	 *
	 * @param integer $id The track id.
	 */
	public function delete($id) {
		// Delete the track
		$this->getDb()->delete('t_track', array('idTrack' => $id));
	}

}
