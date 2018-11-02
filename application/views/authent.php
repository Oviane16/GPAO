<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>GPAO Authentification</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?php echo css_url('bootstrap.css');?>" rel="stylesheet" type="text/css">
    <link href="<?php echo css_url('bootstrap-responsive.css'); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo css_url('bootstrap.css');?>" rel="stylesheet" type="text/css">
    <link href="<?php echo css_url('prettify.css');?>" rel="stylesheet" type="text/css">
    <style type="text/css">
        body {
            padding-top: 100px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            max-width: 300px;
            padding: 19px 29px 29px;
            margin: 0 auto 20px;
            background-color: #fff;
            border: 1px solid #e5e5e5;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
            -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
            box-shadow: 0 1px 2px rgba(0,0,0,.05);
        }
        .form-signin .form-signin-heading,
        .form-signin .checkbox {
            margin-bottom: 10px;
        }
        .form-signin input[type="text"],
        .form-signin input[type="password"] {
            font-size: 16px;
            height: auto;
            margin-bottom: 15px;
            padding: 7px 9px;
        }

    </style>
    <link href="<?php echo css_url('bootstrap-responsive.css');?>" rel="stylesheet" type="text/css">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>

    <![endif]-->


</head>

<body>
</br>
<div class="container">
    <form method="post" class="form-signin" action="<?php echo site_url("authent/authentification/") ?>">
        <h3 class="form-signin-heading">Authentification</h3>
        <input type="text" id="matricule" name="matricule" class="input-block-level" placeholder="Matricule"><?php if(isset($erreurLog)) echo $erreurLog ?>
        <input type="password" id="motdepasse" name="mdp" class="input-block-level" placeholder="Mot de passe">
        <button class="btn btn-info" type="submit">Connexion</button>
    </form>
</div> <!-- /containe

<!-- Placed at the end of the document so the pages load faster -->

<script src="<?php echo js_url('bootstrap-button.js');?> " type="text/javascript"> </script>
</body>
</html>
