<?php namespace Shincode\Envision\Support;

abstract class Resource {

    /*
    | Store the model name in a variable
    */
    protected static $model;

    /*
    | Store responses in a variable
    */
    protected $cache = array();

    /*
    | Extract the model name from the full classname
    */
    public function __construct() {
        $p = get_parent_class($this);
        $c = get_called_class();

        $c::$model = substr($c, 0, -strlen($p));
    }


    /*
    | Get all the results
    */
    public function all($number = null) {
        $number = $number ? $number : null;

    }

    /*
    | Insert one entry
    */
    public function insert(Array $args = []) {

    }

    /*
    | Update one entry
    */
    public function update($id, Array $args = []) {

    }

    /*
    | Delete one entry
    */
    public function delete($id) {

    }

    /*
    | Check a value
    */
    public function check($id, Array $args = []) {

    }

}






  //   class nmesubscriptions {
    
  //       static function listsubscriptions() {
  //           if (!$subscriptions = syssql::select("SELECT * FROM `nme_subscriptions` ORDER BY subscription_date DESC")) return false;
  //           return $subscriptions;
  //       }
		
		// static function listprojectssubscriptions() {
  //           if (!$subscriptions = syssql::select("			SELECT `nme_projects`.* FROM `nme_projects`
		// 													INNER JOIN  `nme_subscriptions`
		// 														ON 		`nme_subscriptions`.subscription_project_id = `nme_projects`.project_id
															
		// 	")) return false;
			
		// 	/*
		// 				$pollquestions = pysql::select("	SELECT 		`py_pollquestions`.pollquestion_text FROM `py_link_pollquestions`
		// 										INNER JOIN 	`py_pollquestions`
		// 											ON	 	`py_link_pollquestions`.question_id = `py_pollquestions`.pollquestion_id
		// 										WHERE 		`py_link_pollquestions`.linkquestion_id = '".$linkquestion_id."'
		// 		/									AND		`py_link_pollquestions`.language_id = '".$language."'");
		// 	*/
  //           return $subscriptions;
  //       }
        
  //       static function insertsubscription($member_id, $project_id, $priority) {
  //           syssql::query(" 	INSERT INTO `nme_subscriptions` ( 
		// 						subscription_member_id, subscription_project_id, subscription_priority 
  //                           ) VALUES ( 
  //                           	'".$member_id."', '".$project_id."', '".$priority."' 
  //                           )");
  //           if (syssql::isError()) return false;
            
  //           if (!$return = syssql::select("SELECT LAST_INSERT_ID()")) return false;
  //           $resetreturn = reset($return);
  //           return reset($resetreturn);
  //       }
        
  //       static function updatesubscription($subscription_id, $member_id, $project_id, $priority) {
  //           syssql::query("	UPDATE `nme_subscriptions` SET subscription_member_id = '".$member_id."', subscription_project_id = '".$project_id."', subscription_priority = '".$priority."' 
  //           				WHERE subscription_id = '".$subscription_id."'");
  //           if (syssql::isError()) return false;
  //           return true;
  //       }
			
		// static function deletesubscriptions($member_id) {
  //           syssql::query("	DELETE FROM `nme_subscriptions` WHERE subscription_member_id = '".$member_id."'");
  //           if (syssql::isError()) return false;
  //           return true;
		// }
		
		// static function activatesubscription($subscription_id) {
		// 	syssql::query(" UPDATE `nme_subscriptions` SET subscription_ok = '1'
  //           				WHERE subscription_id = '".$subscription_id."'");
  //           if (syssql::isError()) return false;
  //           return true;
		// }
		
		// static function checksubscriptionslots($project_id) {
  //           if ($subscriptions = syssql::select("SELECT COUNT(*) as subscription_slots FROM `nme_subscriptions` WHERE subscription_project_id = '".$project_id."' AND (subscription_date >= DATE_SUB(CURDATE(),INTERVAL 2 DAY) OR subscription_ok = '1')")) {
		// 		$limit = nmeprojects::checkprojectlimit($project_id);
		// 		$total = $limit - $subscriptions[0]['subscription_slots'];
		// 		if ($total < 0) $total = 0;
		// 		return $total;
		// 	}
		// 	return false;
		// }
		
		// static function checksubscriptionok($member_id) {
  //           if (!$subscriptions = syssql::select("SELECT * FROM `nme_subscriptions` WHERE subscription_member_id = '".$member_id."' AND subscription_ok = '1'")) return false;
  //           return $subscriptions;	
  //       }
		        
		// static function checksubscription($member_id) {
  //           if (!$subscriptions = syssql::select("SELECT * FROM `nme_subscriptions` WHERE subscription_member_id = '".$member_id."' AND subscription_date >= DATE_SUB(CURDATE(),INTERVAL 2 DAY)")) return false;
  //           return $subscriptions;	
  //       }
			        
  //       static function checksubscriptionid($subscription_id) {
  //           if (!$return = syssql::select("SELECT subscription_id FROM `nme_subscriptions` WHERE subscription_id = '".$subscription_id."'")) return false;
  //           return $return[0]['subscription_id'];	
  //       }
        
        	        
  //       static function checksubscriptionmember_id($subscription_id) {
  //           if (!$return = syssql::select("SELECT subscription_member_id FROM `nme_subscriptions` WHERE subscription_id = '".$subscription_id."'")) return false;
  //           return $return[0]['subscription_member_id'];	
  //       }
        
        	        
  //       static function checksubscriptionproject_id($project_id) {
  //           if (!$return = syssql::select("SELECT * FROM `nme_subscriptions` WHERE subscription_project_id = '".$project_id."'")) return false;
  //           return $return;	
  //       }
		
        	        
  //       static function checksubscriptionproject_idnow($project_id) {
  //           if (!$return = syssql::select("SELECT * FROM `nme_subscriptions` WHERE subscription_project_id = '".$project_id."' AND subscription_date >= DATE_SUB(CURDATE(),INTERVAL 2 DAY)")) return false;
  //           return $return;	
  //       }
		
  //       static function checksubscriptionproject_idok($project_id) {
  //           if (!$return = syssql::select("SELECT * FROM `nme_subscriptions` WHERE subscription_project_id = '".$project_id."' AND subscription_ok = '1'")) return false;
  //           return $return;	
  //       }
        
        	        
  //       static function checksubscriptionpriority($subscription_id) {
  //           if (!$return = syssql::select("SELECT subscription_priority FROM `nme_subscriptions` WHERE subscription_id = '".$subscription_id."'")) return false;
  //           return $return[0]['subscription_priority'];	
  //       }
        
        	        
  //       static function checksubscriptiondate($subscription_id) {
  //           if (!$return = syssql::select("SELECT subscription_date FROM `nme_subscriptions` WHERE subscription_id = '".$subscription_id."'")) return false;
  //           return $return[0]['subscription_date'];	
  //       }
        
        	    
  //   }