<?php
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $ldapconfig['host'] = 'ldap.stuba.sk';//CHANGE THIS TO THE CORRECT LDAP SERVER
    $ldapconfig['port'] = '389';
    $ldapconfig['basedn'] = 'ou=People, DC=stuba, DC=sk';//CHANGE THIS TO THE CORRECT BASE DN
    $ldapconfig['usersdn'] = 'cn=users';//CHANGE THIS TO THE CORRECT USER OU/CN
    $ds = ldap_connect($ldapconfig['host'], $ldapconfig['port']);

    ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
    ldap_set_option($ds, LDAP_OPT_NETWORK_TIMEOUT, 10);

    $dn = "uid=" . $username . "," . $ldapconfig['basedn'];
    if (isset($_POST['username'])) {
        if ($bind = ldap_bind($ds, $dn, $password)) {
            echo("Login correct");//REPLACE THIS WITH THE CORRECT FUNCTION LIKE A REDIRECT;
        } else {
            echo "Login Failed: Please check your username or password";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="../style.css">
    <title>Bootstrap 4 Login/Register Form</title>
</head>
<body>
<div id="logreg-forms">
    <form class="form-signin" action="" method="post">
        <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Sign up with LDAP</h1>
        <input type="text" id="username" name="username" class="form-control" placeholder="Username" required="" autofocus="">
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="">

        <button class="btn btn-success m-auto mt-3 d-block" type="submit"><i class="fas fa-sign-in-alt"></i> Sign up</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>

</body>
</html>
