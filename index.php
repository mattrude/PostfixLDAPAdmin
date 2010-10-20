<?php

require_once("config.php");
require_once("header.php");

$justthese = array("dc", "ou", "sn", "mail");
$dn = $ldapbase;
$filter = "(|(objectclass=*))";

$sr = ldap_search($ds, $dn, $filter, $justthese);
$count = ldap_get_entries($ds, $sr);

echo "Number of entries: " . $count["count"];
echo "<br /><br />";



?><table border="1"><tr><?php

$ls = ldap_list($ds, $dn, "ou=*");
$info = ldap_get_entries($ds, $ls);
echo "<tr><th>Domains</th><th># Users</th><th>Public Dir</th></tr>";
for ($i=0; $i<$info["count"]; $i++) {
    echo "<td>" . $info[$i]["ou"][0] . "</td>" ;
    $udn = "ou=users,ou=" . $info[$i]["ou"][0] . "," . $ldapbase;
    $uls = ldap_list($ds, $udn, "uid=*");
    $users = ldap_get_entries($ds, $uls);
    echo "<td>" . $users[$i]["count"][0] . "</td>" ;
    echo "<td>" . $info[$i]["ou"][0] . "</td>" ;
    echo "</tr>
<tr>";
} ?>
</tr>
</table><?php

?>
