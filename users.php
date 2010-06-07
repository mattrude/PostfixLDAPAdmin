<?php

require_once("config.php");


if (!isset($_REQUEST['domain']))
        {
         $_REQUEST['domain'] = "";
        }
$domain = $_REQUEST['domain'];

if (!isset($_REQUEST['user'])) {
  $udn = "ou=users,ou=" . $domain . "," . $ldapbase;
  $uls = ldap_list($ds, $udn, "uid=*");
  $users = ldap_get_entries($ds, $uls);
  ?><table border="1"><tr><?php
  $ls = ldap_list($ds, $udn, "uid=*");
  $info = ldap_get_entries($ds, $ls);
  echo "<tr><th>Users</th></tr>";
  for ($i=0; $i<$info["count"]; $i++) {
    echo "<td>" . $users[$i]["uid"][0] . "</td>" ;
    echo "</tr><tr>";
  }
  ?></tr></table><?php
} else {
  $user = $_REQUEST['user'];
  $udn = "uid=" . $user . "ou=users,ou=" . $domain . "," . $ldapbase;
  $uls = ldap_list($ds, $udn, "");
  $users = ldap_get_entries($ds, $uls);

}

?>
