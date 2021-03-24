<?php

require_once '2FA/PHPGangsta/GoogleAuthenticator.php';

$websiteTitle = 'Zadanie3';
$ga = new PHPGangsta_GoogleAuthenticator();
$secret = $ga->createSecret();
$qrCodeUrl = $ga->getQRCodeGoogleUrl($websiteTitle, $secret);

//third parameter of verifyCode is a multiplicator for 30 seconds clock tolerance
//$result = $ga->verifyCode($secret, $myCode, 1);
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
    <link rel="stylesheet" href="style.css">
    <title>Bootstrap 4 Login/Register Form</title>
</head>
<body>
<div id="logreg-forms">
    <form class="form-signin">
        <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Sign in</h1>
        <div class="social-login">
            <div class="d-inline-block">
                <a href="ldap/index.php" class="btn ldap-btn social-btn py-2" type="button"><span><i class="fas fa-user-alt"></i> Sign in with LDAP</span> </a>
            </div>
            <div class="d-inline-block">
                <a href="oauth2/index.php" class="btn google-btn social-btn py-2" type="button"><span><i class="fab fa-google-plus-g"></i> Sign in with Google+</span> </a>
            </div>
        </div>
        <p style="text-align:center"> OR  </p>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="">

        <button class="btn btn-success m-auto mt-3 d-block" type="submit"><i class="fas fa-sign-in-alt"></i> Sign in</button>
        <hr>
        <!-- <p>Don't have an account!</p>  -->
        <button class="btn btn-primary m-auto mt-3 d-block" type="button" id="btn-signup"><i class="fas fa-user-plus"></i> Sign up New Account</button>
    </form>

    <form action="2FA/signup.php" method="post" class="form-signup">
        <div class="social-login">
            <a href="ldap/index.php" class="btn ldap-btn social-btn py-2"><span><i class="fas fa-user-alt"></i> Sign up with LDAP</span> </a>
        </div>
        <div class="social-login">
            <a href="oauth2/index.php" class="btn google-btn social-btn py-2"><span><i class="fab fa-google-plus-g"></i> Sign up with Google+</span> </a>
        </div>

        <p style="text-align:center">OR</p>

        <input type="text" id="user-name"     name="name" class="form-control" placeholder="Full name" required autofocus="">
        <input type="email" id="user-email"   name="email" class="form-control" placeholder="Email address" required autofocus="">
        <input type="password" id="user-pass" name="password" class="form-control" placeholder="Password" required autofocus="">

        <div id="verify_google_qr">
            <p class="text-center pt-2">Please scan this code</p>
            <img src="<?php echo $qrCodeUrl;?>" alt="application code" class="m-auto pt-1 d-block">
            <input type="text" id="qr_code" name="qr_code" class="form-control mt-2" placeholder="Code from app after scan qr" required>
            <input type="hidden" id="code" name="secret_code" value="<?php echo $secret;?>">
        </div>

        <hr>

        <button class="btn btn-primary btn-block" type="submit"><i class="fas fa-user-plus"></i> Sign Up</button>
        <a href="#" id="cancel_signup"><i class="fas fa-angle-left"></i> Back</a>
    </form>
    <br>

</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
<script src="javascript.js"></script>
</body>
</html>