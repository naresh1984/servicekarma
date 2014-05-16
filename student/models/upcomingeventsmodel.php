<?php 
class UpcomingeventsModel extends Model
{
	public function upcomingevents($establishment_id)
	{
	    $sql="SELECT *,events.id as id, establishment_categories.id as cat_id, organizations.id as org_id FROM events INNER JOIN establishment_categories ON establishment_categories.id = events.category_id INNER JOIN profiles ON profiles.id = events.profile_id INNER JOIN organizations ON organizations.id = events.organization_id WHERE events.to_date >= '".date('Y-m-d')."' AND events.establishment_id = '".$establishment_id."' ORDER BY events.from_date ASC, events.start_time ASC";
		$this->_setSql($sql);
		$res = $this->getAll();
		return $res;
	}
}