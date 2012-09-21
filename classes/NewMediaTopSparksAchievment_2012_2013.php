<?php
/**
 * NewMedia Top Sparks Achievement
 * 
 * @package NewMedia
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010 - 2012
 * @link http://www.thinkglobalschool.com/
 *
 */

class NewMediaTopSparksAchievment_2012_2013 extends AchievementBase {

	// Award names
	const TOP_SPARKS_2012_2013 = 'TOP_SPARKS_2012_2013';
	
	// Achievement end date
	const TOP_SPARKS_2012_2013_LOWER = 1346500800; // Sat, 01 Sep 2012 12:00:00 GMT
	const TOP_SPARKS_2012_2013_UPPER = 1378036800; // Sun, 01 Sep 2013 12:00:00 GMT

	/**
	 * Construct the Achievement
	 * 
	 * @param ElggUser $user
	 */
	public function __construct($user = NULL) {
		parent::__construct($user);
		
		$this->awards = array(
			self::TOP_SPARKS_2012_2013
		);
		
		$this->type = "top";
		$this->event_type = "create";
		$this->object_type = "object";
		$this->object_subtype = ELGG_ENTITIES_ANY_VALUE;
	}

	public function execute($data = NULL) {
		$this->attempt_award($this->has_top_sparks_2012_2013());
	}

	protected function attempt_award($result) {
		if ($result) {
			$users = achievements_get_users_with_achievement(self::TOP_SPARKS_2012_2013);

			$this->award(self::TOP_SPARKS_2012_2013);

			$ia = elgg_get_ignore_access();
			elgg_set_ignore_access(TRUE);
			if ($users && count($users)) {
				foreach ($users as $user) {
					if ($user->guid == $this->user->guid) {
						continue;
					}
					remove_user_achievement($user, self::TOP_SPARKS_2012_2013);
				}
			}
			elgg_set_ignore_access($ia);

		}
	}

	/** 
	 * Determine if user has the top sparks
	 */
	private function has_top_sparks_2012_2013() {
		return achievements_user_has_most_entities(array(
			'user' => $this->user, 
			'entity_subtype' => $this->object_subtype,
			'entity_metadata_names' => array('tags'),
			'entity_metadata_values' => array('spark'),
			'entity_created_time_lower' => self::TOP_SPARKS_2012_2013_LOWER,
			'entity_created_time_upper' => self::TOP_SPARKS_2012_2013_UPPER,
		));
	}

	/**
	 * Logic for populating a leaderboard for this achievement
	 */
	public function get_leaderboard() {
		return array(
			'entity_subtype' => $this->object_subtype,
			'count_column_title' => 'Sparks',
			'count_column_field' => 'e_count',
			'entity_metadata_names' => array('tags'),
			'entity_metadata_values' => array('spark'),
			'entity_created_time_lower' => self::TOP_SPARKS_2012_2013_LOWER,
			'entity_created_time_upper' => self::TOP_SPARKS_2012_2013_UPPER,
			'achievement_name' => self::TOP_SPARKS_2012_2013,
			'getter' => 'achievements_get_users_order_by_entity_count',
		);
	}
}