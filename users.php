<?php

require_once("config.php");

if (!isset($_REQUEST['user'])) {
  $udn = $ldapuser . "," . $ldapbase;
  $uls = ldap_list($ds, $udn, "uid=*");
  $users = ldap_get_entries($ds, $uls);
  $ls = ldap_list($ds, $udn, "uid=*");
  $info = ldap_get_entries($ds, $ls);
  echo "<table border='1'>
  	<tr>
	  <th>Users Name</th>
	  <th>First Name</th>
	  <th>Last Name</th>
	  <th>Home Directory</th>
	</tr>";
  for ($i=0; $i<$info["count"]; $i++) {
    echo "
	<tr>
	  <td><a href='edit_user.php?user=" . $users[$i]["uid"][0] . "'>" . $users[$i]["uid"][0] . "</a></td>
	  <td>" . $users[$i]["givenname"][0] . "</td>
	  <td>" . $users[$i]["sn"][0] . "</td>
	  <td>" . $users[$i]["homedirectory"][0] . "</td>
	</tr>
";
  }
  echo "</table>";
} else {
  $user = $_REQUEST['user'];
  $udn = "uid=" . $user . "," . $ldapuser . "," . $ldapbase;
  $uls = ldap_list($ds, $udn, "");
  $users = ldap_get_entries($ds, $uls);

}

?>
