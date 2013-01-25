<?php
/**
 * NewMedia Achievement (Jan 13 - Jun 13)
 * 
 * @package NewMedia
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010 - 2012
 * @link http://www.thinkglobalschool.com/
 *
 */

class NewMediaAchievement_Jan13_Jun13 extends AchievementBase {

	protected $tags;
	
	// Achievement start/end date
	const NEW_MEDIA_ACHIEVEMENT_JAN13_JUN13_LOWER = 1357106400; // Wed, 02 Jan 2013 06:00:00 GMT
	const NEW_MEDIA_ACHIEVEMENT_JAN13_JUN13_UPPER = 1372550400; // Sun, 30 Jun 2013 00:00:00 GMT

	/**
	 * Construct the Achievement
	 * 
	 * @param ElggUser $user
	 */
	public function __construct($user = NULL) {
		parent::__construct($user);
		
		$this->tags = array(
			'spark' => 5,
			'study' => 2,
			'indepthstudy' =>1,
		);
	
		$this->awards = array();
	
		$english = array();
	
		foreach($this->tags as $tag => $threshold) {
				$award_name = strtoupper($tag) . "_{$threshold}_JAN13_JUN13";
				$this->awards[] = $award_name;
		}

		$this->event_type = "create";
		$this->object_type = "object";
		$this->object_subtype = ELGG_ENTITIES_ANY_VALUE;
	}

	public function execute($data = NULL) {
		foreach($this->tags as $tag => $threshold) {
			$this->attempt_award(array(
				'count' => $this->count_tags($tag),
				'tag' => $tag,
			));
		}
	}

	protected function attempt_award($data) {
		$threshold = $this->tags[$data['tag']];
		$award_name = strtoupper($data['tag']) . "_{$threshold}_JAN13_JUN13";
		$counts[$award_name] = $threshold;

		if ($data['count'] >= $threshold) {
			$result = $this->award($award_name);
		}
	}

	/** Count entities with a new media tag **/
	private function count_tags($tag) {
		$count = elgg_get_entities_from_metadata(array(
			'type' => $this->object_type,
			'subtypes' => $this->object_subtype,
			'count' => TRUE,
			'limit' => 0,
			'metadata_name' => 'tags',
			'metadata_value' => $tag,
			'owner_guid' => $this->user->guid,
			'created_time_lower' => self::NEW_MEDIA_ACHIEVEMENT_JAN13_JUN13_LOWER,
			'created_time_upper' => self::NEW_MEDIA_ACHIEVEMENT_JAN13_JUN13_UPPER,
		));

		return $count;
	}
}