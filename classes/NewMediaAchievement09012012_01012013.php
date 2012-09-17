<?php
/**
 * NewMedia Achievement
 * 
 * @package NewMedia
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010 - 2012
 * @link http://www.thinkglobalschool.com/
 * 
 * @todo subtypes
 */

class NewMediaAchievement09012012_01012013 extends AchievementBase {

	protected $tags;
	protected $thresholds;
	protected $subtypes;
	
	// Achievement start/end date
	const NEW_MEDIA_ACHIEVEMENT_09012012_01012013_LOWER = 1346472000; // Sat, 01 Sep 2012 04:00:00 GMT
	const NEW_MEDIA_ACHIEVEMENT_09012012_01012013_UPPER = 1357016400; // Tue, 01 Jan 2013 05:00:00 GMT

	/**
	 * Construct the Achievement
	 * 
	 * @param ElggUser $user
	 */
	public function __construct($user = NULL) {
		parent::__construct($user);
		
		$this->tags = array(
			'spark' => 'Spark',
			'study' => 'Study',
			'indepthstudy' => 'In Depth Study'
		);
		
		$this->thresholds = array(
			20, 10, 5
		);
		
		// Note: update me!
		$this->subtypes = ELGG_ENTITIES_ANY_VALUE;
	
		$this->awards = array();
	
		$english = array();
	
		foreach($this->tags as $tag => $name) {
			foreach($this->thresholds as $threshold) {
				$award_name = strtoupper($tag) . "_TAG_{$threshold}_09012012_01012013";
				$this->awards[] = $award_name;
				
				// Create title/description strings
				$title = elgg_echo('newmedia:achievement:generic_title', array($threshold, $name));
				$description = elgg_echo('newmedia:achievement:generic_description', array($threshold, $name));

				// Create language strings
				$english['achievements:' . strtolower($award_name) . ':title'] = $title . " (September - December 2012)";
				$english['achievements:' . strtolower($award_name) . ':description'] = $description;

			}
		}
		
		// Add dynamic translations	
		add_translation('en',$english);

		$this->event_type = "create";
		$this->object_type = "object";
		$this->object_subtype = NULL;
	}

	public function execute($data = NULL) {
		foreach($this->tags as $tag => $name) {
			$this->attempt_award(array(
				'count' => $this->count_tags($tag),
				'tag' => $tag,
			));
		}
	}

	protected function attempt_award($data) {	
		$counts = array();

		foreach($this->thresholds as $threshold) {
			$award_name = strtoupper($data['tag']) . "_TAG_{$threshold}_09012012_01012013";
			$counts[$award_name] = $threshold;
		} 

		foreach ($counts as $name => $c) {
			if ($data['count'] >= $c) {
				$result = $this->award($name);
				$this->shouldNotify = !$result; // Only notify on first occurance
			}
		}
	}

	/** Count entities with a new media tag **/
	private function count_tags($tag) {
		$count = elgg_get_entities_from_metadata(array(
			'type' => $this->object_type,
			'subtypes' => $this->subtypes,
			'count' => TRUE,
			'limit' => 0,
			'metadata_name' => 'tags',
			'metadata_value' => $tag,
			'owner_guid' => $this->user->guid,
			'created_time_lower' => self::NEW_MEDIA_ACHIEVEMENT_09012012_01012013_LOWER,
			'created_time_upper' => self::NEW_MEDIA_ACHIEVEMENT_09012012_01012013_UPPER,
		));

		return $count;
	}
}