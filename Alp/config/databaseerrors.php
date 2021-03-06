<?php
$settings = array(
	-101 => 'You do not have sufficient rights.',
	-102 => 'You are not currently logged in.',
	-110 => 'You do not have sufficient rights.',
	-111 => 'You do not have sufficient rights.',
	-112 => 'You do not have sufficient rights.',
	-113 => 'You do not have sufficient rights.',
	-114 => 'You do not have sufficient rights.',
	-200 => 'There was an unexpected error creating the user session.',
	-201 => 'There was an error creating the user session.',
	-202 => 'The email address and password do not match.',
	-210 => 'Your session as expired.',
	-211 => 'Your session as expired.',
	-1000 => 'There was an unexpected error resetting the account.',
	-1001 => 'There was an error resetting the account.',
	-1010 => 'There was an unexpected error deactivating the account.',
	-1011 => 'There was an error deactivating the account.',
	-1020 => 'There was an unexpected error creating the user.',
	-1021 => 'There was an error creating the user.',
	-1030 => 'There was an unexpected error updating the user.',
	-1031 => 'There was an error updating the user.',
	-1050 => 'There was an unexpected error updating the user.',
	-1051 => 'There was an error updating the user.',
	-1060 => 'There was an unexpected error updating a user field.',
	-1061 => 'There was an error updating a user field.',
	-1070 => 'There was an unexpected error resetting the account.',
	-1071 => 'There was an error resetting the account.',
	-1080 => 'There was an unexpected error updating preferences.',
	-1081 => 'There was an error updating preferences.',
	-1100 => 'There was an unexpected error creating the project.',
	-1101 => 'There was an error creating the project.',
	-1110 => 'There was an unexpected error updating the project.',
	-1111 => 'There was an error updating the project.',
	-1120 => 'There was an unexpected error updating the project dates.',
	-1121 => 'There was an error updating the project dates.',
	-1130 => 'There was an unexpected error removing the project.',
	-1131 => 'There was an error removing the project.',
	-1132 => 'You can not remove a project that has time records.',
	-1140 => 'There was an unexpected error updating the project defaults.',
	-1141 => 'There was an error updating the project defaults.',
	-1200 => 'There was an unexpected error creating the organization.',
	-1201 => 'There was an error creating the organization.',
	-1210 => 'There was an unexpected error updating the organization.',
	-1211 => 'There was an error updating the organization.',
	-1220 => 'There was an unexpected error updating the organization field.',
	-1221 => 'There was an error updating the organization field.',
	-1230 => 'There was an unexpected error removing the organization.',
	-1231 => 'There was an error removing the organization.',
	-1232 => 'You cannot remove an organization that has projects.',
	-1233 => 'You cannot remove the organization that owns the subscription.',
	-1300 => 'There was an unexpected error setting global rights.',
	-1301 => 'There was an error setting global rights.',
	-1310 => 'There was an unexpected error adding the user to the project.',
	-1311 => 'There was an error adding the user to the project.',
	-1320 => 'There was an unexpected error removing the user from the project.',
	-1321 => 'There was an error removing the user from the project.',
	-1330 => 'There was an unexpected error updating the project rights.',
	-1331 => 'There was an error updating the project rights.',
	-1340 => 'There was an unexpected error updating the project supervisor rights.',
	-1341 => 'There was an error updating the project supervisor rights.',
	-1400 => 'There was an unexpected error creating the subscription.',
	-1401 => 'There was an error creating the subscription.',
	-1402 => 'There was an error creating the subscription organization record.',
	-1403 => 'There was an error updating the subscription organization record.',
	-1404 => 'There was an error creating the subscription user.',
	-1410 => 'There was an unexpected error removing the subscription.',
	-1420 => 'There was an unexpected error updating the subscription.',
	-1421 => 'There was an error updating the subscription.',
	-1500 => 'There was an unexpected error creating the project area.',
	-1501 => 'There was an error creating the project area.',
	-1502 => 'A project area with that name already exists in the project.',
	-1510 => 'There was an unexpected error updating the project area.',
	-1511 => 'There was an error updating the project area.',
	-1520 => 'There was an unexpected error completing the project area.',
	-1521 => 'There was an error completing the project area.',
	-1530 => 'There was an unexpected error removing the project area.',
	-1531 => 'There was an error removing the project.',
	-1532 => 'You can not remove a project area that has time records.',
	-1533 => 'You can not remove a project area that has time records.',
	-1600 => 'There was an unexpected error creating the project milestones.',
	-1601 => 'There was an error creating the project milestones.',
	-1610 => 'There was an unexpected error updating the project milestone.',
	-1611 => 'There was an error updating the project milestone.',
	-1620 => 'There was an unexpected error completing the project milestone.',
	-1621 => 'There was an error completing the project milestone.',
	-1630 => 'There was an unexpected error removing the project milestone.',
	-1631 => 'There was an error removing the project milestone.',
	-1700 => 'There was an unexpected error creating the task.',
	-1701 => 'There was an error creating the task.',
	-1702 => 'There was an error creating the task submitter.',
	-1703 => 'There was an error creating the task assigned user.',
	-1704 => 'There was an error creating the task approving user.',
	-1705 => 'There was an error creating the task description.',
	-1710 => 'There was an unexpected error updating the task.',
	-1711 => 'There was an error updating the task.',
	-1720 => 'There was an unexpected error updating the task dates.',
	-1721 => 'There was an error updating the task dates.',
	-1730 => 'There was an unexpected error updating the task milestone.',
	-1731 => 'There was an error updating the task milestone.',
	-1740 => 'There was an unexpected error updating the task assignment.',
	-1741 => 'There was an error updating the task assignment.',
	-1750 => 'There was an unexpected error deleting the task.',
	-1751 => 'There was an error deleting the task.',
	-1752 => 'You cannot delete a task that has time records.',
	-1800 => 'There was an unexpected error adding the task note.',
	-1801 => 'There was an error adding the task note.',
	-1802 => 'There was an error sanding task message.',
	-1810 => 'There was an unexpected error updating the task note.',
	-1811 => 'There was an error updating the task note.',
	-1820 => 'There was an unexpected error removing the task note.',
	-1821 => 'There was an error removing the task note.',
	-1830 => 'There was an unexpected error tagging the task note as seen.',
	-1900 => 'There was an unexpected error adding the task file.',
	-1901 => 'There was an error adding the task file.',
	-1910 => 'There was an unexpected error updating the task file.',
	-1911 => 'There was an error updating the task file.',
	-1920 => 'There was an unexpected error removing the task file.',
	-1921 => 'There was an error removing the task file.',
	-2000 => 'There was an unexpected error completing the task.',
	-2001 => 'There was an error completing the task.',
	-2002 => 'There was an error assigning the user who completed the task.',
	-2003 => 'There was an error updating the user who completed the task.',
	-2010 => 'There was an unexpected error approving the task.',
	-2011 => 'There was an error assigning the approved date.',
	-2012 => 'There was an error assigning the user who approved the task.',
	-2013 => 'There was an error updating the user who approved the task.',
	-2020 => 'There was an unexpected error disapproving the task.',
	-2021 => 'There was an error disapproving the task.',
	-2100 => 'There was an unexpected error clocking out.',
	-2101 => 'There was an error clocking out.',
	-2110 => 'There was an unexpected error clocking in to the project.',
	-2111 => 'No project was indicated.',
	-2112 => 'There was an error clocking in to the project.',
	-2120 => 'There was an unexpected error clocking in to the project area.',
	-2121 => 'No project area was indicated.',
	-2122 => 'There was an error clocking in to the project area.',
	-2130 => 'There was an unexpected error clocking in to the task.',
	-2131 => 'No task was indicated.',
	-2132 => 'There was an error clocking in to the task.',
	-2140 => 'There was an unexpected error recording time.',
	-2141 => 'No project was indicated.',
	-2142 => 'There was an error recording time.',
	-2150 => 'There was an unexpected error adjusting time.',
	-2151 => 'There was an error adjusting time.',
	-2160 => 'There was an unexpected error changing the project.',
	-2161 => 'There was an error changing the project.',
	-2170 => 'There was an unexpected error clocking the user out.',
	-2171 => 'There was an error clocking the user out.'
);
?>