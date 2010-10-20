<?php

require_once("config.php");

if (!isset($_REQUEST['user'])) {
  echo "";
} else {
  $user = $_REQUEST['user'];
  $udn = "uid=" . $user . "," . $ldapuser . "," . $ldapbase;
  $uls = ldap_list($ds, $udn, "");
  $users = ldap_get_entries($ds, $uls);
  echo $udn;
  echo '<br />';
  echo $users["uid"][0];
}

?>
