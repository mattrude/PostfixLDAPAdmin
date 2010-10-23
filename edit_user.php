<?php

require_once("config.php");

if (!isset($_REQUEST['user'])) {
  echo "No Username given, you must be cheating!";
} else {
  $user = $_REQUEST['user'];
  $udn = "uid=" . $user . "," . $ldapuser . "," . $ldapbase;
  $uls = ldap_list($ds, $udn, "");
  $users = ldap_get_values($ds, $uls, "uid");
  $result = ldap_search($ds, $uls, "(uid=*)");
  $test = ldap_get_entries($ldap_con, $users);

  $filter="(objectclass=*)"; // this command requires some filter
  $justthese = array("uid", "sn", "givenname", "mail"); //the attributes to pull, which is much more efficient than pulling all attributes if you don't do this
  $sr=ldap_read($ds, $udn, $filter, $justthese);
  $entry = ldap_get_entries($ds, $sr);

  echo "<h2>" . $entry[0]["givenname"][0] . $entry[0]["sn"][0] . "</h2>";
  echo "<h4>" . $entry[0]["ou"][0] . "</h4>";
  echo "<table border='0'>";
  echo "<tr><td>First Name:</td><td>" . $entry[0]["givenname"][0] . "</td></tr>";
  echo "<tr><td>Last Name:</td><td>" . $entry[0]["sn"][0] . "</td></tr>";
  echo "<tr><td>Email Address:</td><td>" . $entry[0]["mail"][0] . "</td></tr>";

  ldap_close($ds);
}

?>
