<?php



$dbname = 'to_do_list';
$dbhost = 'localhost';
$dbuser = 'greta';
$dbpass = 'Greta1234!';

try {
    $dsn = "mysql:dbname=".$dbname.";host=".$dbhost;
    $db = new PDO($dsn, $dbuser, $dbpass);
    $db->exec("SET NAMES utf8");
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
}catch(PDOException $e) {
    die($e->getMessage());
}
$useremail = $_POST['email'];
$hash = $_POST ['mdp'];

$coo="SELECT * FROM `user` WHERE `email`= :email";
$query=$db->prepare($coo);
$query->bindValue(":email", $useremail, PDO::PARAM_STR);
$query->execute();
$onche = $query->fetch(PDO::FETCH_ASSOC);


if ($onche['email'] === $useremail && password_verify($hash, $onche['mdp'])) {
  session_start();
  $_SESSION['utilisateur'] = $onche['nom'];
  $_SESSION['id_user'] = $onche['id'];
  header("Location: session.php");
  exit(); 
} else if (!empty($_POST['email']) && !empty($_POST['mdp']))
{
echo 'Identifiants incorrects';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,700;1,600;1,700&family=Josefin+Slab:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Noto+Sans+Kawi:wght@400;500&display=swap" rel="stylesheet">
    <script src="script.js" defer></script>
    <link rel="stylesheet" href="ssttyyllee.css">
    <title>Connexion</title>
</head>
<body>
  
    <div class=seconnecter>
      <div class=formseconnecter>
      <div class=titreh1>
      <h1>Se connecter :</h1>
      </div>
<form action="" method="POST">
  <div class="mb-3 formulaires ">
    <label for="email" class="form-label">Adresse email:</label>
    <input type="email" class="form-control" name="email">
  </div>
  <div class="mb-3 formulaires">
    <label for="mdp" class="form-label">Mot de passe:</label>
    <input type="password" class="form-control" name="mdp">
  </div>
  <div class="btnpositionco"><button type="submit" class="btn couleurbtn">Se connecter</button>
</form>
<form action="inscription.php">
<button class="btn couleurbtn">Créer un compte</button></div>
</form>

</div>
</div>
<p class="textsignature "> Tout droit réservé Admi Rayan et Axel Carette. </p>
</div>

</body>
</html>