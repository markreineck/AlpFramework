<?php

class DatabaseDB extends DatabaseClass 
{

var $UserID;
var $TimeID;
var $UserEmail;
var $FirstName;
var $OrgID;
var $UserMaint;
var $SuperUser;
var $OwnerID;
//var $HasTime;
//var $HasMilestones;
var $HasOrgs;
var $HasFixedPrice;
var $SubscrName;

function DatabaseDB($framework, $pwd='', $username='', $dbname='', $host='')
{
	if (isset($_SESSION['DBPassword'])) {
		$pwd = $_SESSION['DBPassword'];
		$username = $_SESSION['DBUserID'];
		$host = $_SESSION['DBHost'];
		$dbname = $_SESSION['DBName'];
	} else {
		$pwd = '';
		$username = '';
		$host = '';
		$dbname = '';
	}

	$this->DatabaseClass($framework, $pwd, $username, $dbname, $host);
}

function ValidateUserSession($nth)
{
	$sid = $nth->Cookie()->GetSessionID();
	if ($sid > 0) {
		$mode = $this->DebugMode();
		$this->DebugMode(0);

		$sql = 'select s.userid, t.timeid, u.email, u.firstname, u.orgid, u.superuser, u.usermaint
from usersession s
inner join users u on s.userid=u.userid
left outer join (select timeid, userid from usertime where endon is null) t on s.userid=t.userid
where expireson>now() and s.sessionid=' . $sid;

		$data = $this->SelectRow($sql);

		if ($data->userid > 0) {
			$this->SessionID = ($data->userid > 0) ? $sid : 0;
			$this->UserID = $data->userid;
			$this->TimeID = $data->timeid;
			$this->UserEmail = $data->email;
			$this->FirstName = $data->firstname;
			$this->OrgID = $data->orgid;
			$this->UserMaint = $data->usermaint;
			$this->SuperUser = $data->superuser;

			$sql = 'select orgid, name, timetracking, milestones, organizations, contractors from subscription limit 1';
			$data = $this->SelectRow($sql);

			$this->SubscrName = $data->name;
			$this->OwnerID = $data->orgid;
//			$this->HasTime = $data->timetracking;
//			$this->HasMilestones = $data->milestones;
			$this->HasOrgs = $data->organizations;
			$this->HasFixedPrice = $data->contractors;
		} else {
			$sid = 0;
		}
		$this->DebugMode($mode);
	}
	if ($sid == 0) {
		$nth->RedirectTo('login/'.$nth->Cookie()->GetSiteID());
	}
}

function IsClockedIn()
{
	return $this->TimeID > 0;
}

function IsGlobalUserManager()
{
	if ($this->UserMaint < 1)
		return false;
	return ($this->OwnerID == $this->OrgID);
}

function IsUserManager()
{
	return (($this->UserMaint > 0) ? ($this->OwnerID == $this->OrgID) ? 1 : $this->OrgID : 0);
}

function IsGlobalSupervisor()
{
	if ($this->SuperUser < 1)
		return false;
	return ($this->OwnerID == $this->OrgID);
}

function IsSupervisor()
{
	return (($this->SuperUser > 0) ? $this->OrgID : 0);
}

function GetSubscriptionName()
{
	return ($this->SubscrName);
}

function GetUserID()
{
	return ($this->UserID);
}

function GetSessionID()
{
	return ($this->SessionID);
}

function GetUserFirstName()
{
	return ($this->FirstName);
}

function GetCompanyID()
{
	return ($this->OrgID);
}

function GetUserEmail()
{
	return ($this->UserEmail);
}

function GetOwnerCompanyID()
{
	return ($this->OwnerID);
}

/*
function HasTimeTracking()
{
	return ($this->HasTime);
}
function HasMilestones()
{
	return ($this->HasMilestones);
}
*/
function HasOrganizations()
{
	return ($this->HasOrgs);
}

function ReadCompanyList()
{
	$sql = "SELECT orgid, name from organizations order by name";
	return $this->SelectAll($sql,2);
}

function ReadUserList()
{
	$sql = "SELECT userid, name from usernames order by lastname, name";
	return $this->SelectAll($sql,2);
}

function ReadProjectList()
{
	$where = (($this->OwnerID == $this->OrgID)) ? '' : 'and orgid='.$this->OrgID;
	$sql = "select prjid, name from projects where status='A' $where order by name";
	return $this->SelectAll($sql, 2);
}

function ReadProjectUserList($prjid)
{
	$owner = $this->GetOwnerCompanyID();
	$sql = "select userid, name, lastname, firstname from usernames where superuser>0 and (orgid=$owner or orgid in (select orgid from projects where prjid=$prjid))
union all
select distinct u.userid, u.name, u.lastname, u.firstname from usernames u, projectusers p where u.userid=p.userid and p.prjid=$prjid
order by lastname, firstname";
	return $this->SelectAll($sql, 2);
}

}
?>