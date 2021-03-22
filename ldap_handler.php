<?php

require_once 'controllers/UserController.php';
$uc = new UserController();

// using ldap bind
$dn = 'ou=People, DC=stuba, DC=sk';
$ldapuid = $_POST['ais_login'];
$ldappass = $_POST['ais_password'];
$ldaprdn  = "uid=$ldapuid, $dn";

// connect to ldap server
$ldapconn = ldap_connect("ldap.stuba.sk")
or die("Could not connect to LDAP server.");

if ($ldapconn) {
    $set = ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION,3);

    // verify binding
    if (@ldap_bind($ldapconn, $ldaprdn, $ldappass)) {
        $results=ldap_search($ldapconn,$dn,"uid=*".$_POST['ais_login']."*",array("givenname","employeetype","surname","mail","faculty","cn","uisid","uid"),0,5);
        $info=ldap_get_entries($ldapconn,$results);

        // login existing user
        if ($uc->isRegistered($info[0]['mail'][0])) {
            session_start();
            $_SESSION['email'] = $info[0]['mail'][0];
            $uc->recordLog($uc->getUserId($info[0]['mail'][0]));
            header('Location: https://wt156.fei.stuba.sk/authentication/home.php');
        }
        // register new user
        else {
            $uc->registerUser($info[0]['givenname'][0],$info[0]['sn'][0],$info[0]['mail'][0],null,'ldap',null,null);
            header('Location: https://wt156.fei.stuba.sk/authentication');
        }

//        echo $info[0]['cn'][0]."<br>";
//        echo $info[0]['givenname'][0]."<br>";
//        echo $info[0]['sn'][0]."<br>";
//        echo $info[0]['mail'][0]."<br>";
////        echo $info[$i]['employeetype'][0]."<br>";
////        echo $info[$i]['uisid'][0]."<br>";
//        echo $info[0]['uid'][0]."<br>";



    } else {
        echo '<a href="ldap.php">Wrong ais login or password entered, click to try again.<a/>';
    }
}

