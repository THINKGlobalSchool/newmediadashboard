<?php
/**
 * NewMedia Top 'Over-achiever' Achievement (Jan 13 - Jun 13)
 * 
 * @package NewMedia
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010 - 2012
 * @link http://www.thinkglobalschool.com/
 *
 */

class NewMediaOAAchievement_Jan13_Jun13 extends AchievementBase {

	// Award names
	const NEWMEDIA_OVERACHIEVER_JAN13_JUN13 = 'NEWMEDIA_OA_JAN13_JUN13';
	
	// Achievement end date
	const NEWMEDIA_OVERACHIEVER_JAN13_JUN13_LOWER = 1357106400; // Wed, 02 Jan 2013 06:00:00 GMT
	const NEWMEDIA_OVERACHIEVER_JAN13_JUN13_UPPER = 1372550400; // Sun, 30 Jun 2013 00:00:00 GMT

	/**
	 * Construct the Achievement
	 * 
	 * @param ElggUser $user
	 */
	public function __construct($user = NULL) {
		parent::__construct($user);
		
		$this->awards = array(
			self::NEWMEDIA_OVERACHIEVER_JAN13_JUN13
		);
		
		$this->type = "top";
		$this->event_type = "create";
		$this->object_type = "object";
		$this->object_subtype = ELGG_ENTITIES_ANY_VALUE;
	}

	public function execute($data = NULL) {
		$this->attempt_award($this->is_new_media_overachiever_jan13_jun13());
	}

	protected function attempt_award($result) {
		if ($result) {
			$users = achievements_get_users_with_achievement(self::NEWMEDIA_OVERACHIEVER_JAN13_JUN13);

			$this->award(self::NEWMEDIA_OVERACHIEVER_JAN13_JUN13);

			$ia = elgg_get_ignore_access();
			elgg_set_ignore_access(TRUE);
			if ($users && count($users)) {
				foreach ($users as $user) {
					if ($user->guid == $this->user->guid) {
						continue;
					}
					remove_user_achievement($user, self::NEWMEDIA_OVERACHIEVER_JAN13_JUN13);
				}
			}
			elgg_set_ignore_access($ia);

		}
	}

	/** 
	 * Determine if user has the top studies
	 */
	private function is_new_media_overachiever_jan13_jun13() {
		$role = get_role_by_title('Grade 11');
		return achievements_user_has_most_entities(array(
			'user' => $this->user, 
			'entity_subtype' => $this->object_subtype,
			'relationship' => ROLE_RELATIONSHIP,
			'relationship_guid' => $role->guid,
			'inverse_relationship' => TRUE,
			'entity_metadata_names' => array('tags'),
			'entity_metadata_values' => array('newmedia'),
			'entity_created_time_lower' => self::NEWMEDIA_OVERACHIEVER_JAN13_JUN13_LOWER,
			'entity_created_time_upper' => self::NEWMEDIA_OVERACHIEVER_JAN13_JUN13_UPPER,
		));
	}

	/**
	 * Logic for populating a leaderboard for this achievement
	 */
	public function get_leaderboard() {
		$role = get_role_by_title('Grade 11');
		return array(
			'relationship' => ROLE_RELATIONSHIP,
			'relationship_guid' => $role->guid,
			'inverse_relationship' => TRUE,
			'entity_subtype' => $this->object_subtype,
			'count_column_title' => 'Items',
			'count_column_field' => 'e_count',
			'entity_metadata_names' => array('tags'),
			'entity_metadata_values' => array('newmedia'),
			'entity_created_time_lower' => self::NEWMEDIA_OVERACHIEVER_JAN13_JUN13_LOWER,
			'entity_created_time_upper' => self::NEWMEDIA_OVERACHIEVER_JAN13_JUN13_UPPER,
			'achievement_name' => self::NEWMEDIA_OVERACHIEVER_JAN13_JUN13,
			'getter' => 'achievements_get_users_order_by_entity_count',
		);
	}
}