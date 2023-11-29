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

class User
{
  //propriétés
  public $name;
  public $surname;
  public $email;
  public $password; }

if (!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['email']) && !empty($_POST['mdp'])) {
  $user = new User();
  $user->name = $_POST['name'];
  $user->surname = $_POST['surname'];
  $user->email = $_POST['email'];
  $user->password = $_POST['mdp'];


  $sql = "SELECT * FROM `user` WHERE `email` = :mail";
  $query2= $db->prepare($sql);
  $query2->bindValue(":mail", $_POST["email"], PDO::PARAM_STR);
  $query2->execute();
  $verifEmail = $query2->fetch();
  if ($verifEmail === false) {   
    if ( $user->password === $_POST['mdpverif']) {
    
  
      # Validé 
      echo "accépté";
      $sql = "INSERT INTO `user` (`nom`, `prenom`, `email`, `mdp`) 
      VALUES (:prenom, :nom, :mail, :mdp)";
      
      

      $query = $db->prepare($sql);
      $query->bindValue(":prenom", $user->surname, PDO::PARAM_STR);
      $query->bindValue(":nom", $user->name, PDO::PARAM_STR);
      $query->bindValue(":mail", $user->email, PDO::PARAM_STR);
      $query->bindValue(":mdp",password_hash($user->password, PASSWORD_DEFAULT) , PDO::PARAM_STR);
      $query->execute();
  }
}
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
    <title>Inscription</title>
</head>
<body>
  
<?php
  if ($_POST['mdp'] !== $_POST['mdpverif']) {
   echo '<div class="alert alert-danger" role="alert"> Mot de passe different</div>';
   
}
if (!empty($_POST['surname'])) {
  if ($verifEmail !== false ) {
    echo '<div class="alert alert-danger" role="alert">Email déja enregistrer</div>';
    }
}
?>
<div class="inscriptionetconnexion">
<div class="formform">
<form action="" method="POST">
<div class="mb-3 name formulaires">
    <label for="name" class="form-label">Entrez votre nom de famille.</label>
    <input type="text" class="form-control" name="name">
  </div>
  <div class="mb-3 surname formulaires">
    <label for="surname" class="form-label">Prénom :</label>
    <input type="text" class="form-control" name="surname">
  </div>
  <div class="mb-3 email  formulaires">
    <label for="email" class="form-label">Adresse mail :</label>
    <input type="email" class="form-control" name="email">
  </div>
  <div class="mb-3 mdp formulaires">
    <label for="mdp" class="form-label">Mot de passe :</label>
    <input type="password" class="form-control" name="mdp">
  </div>
  <div class="mb-3 mdpverif formulaires">
    <label for="mdpverif" class="form-label">Vérification du mot de passe.</label>
    <input type="password" class="form-control" name="mdpverif">
  </div>
  <div class="btnposition"><button type="submit" class="btn couleurbtn ">Inscription</button>
  
</form>
<form action="index.php" method="POST" class="formco"> 
<button class="btn couleurbtn ">Se connecter</button></div>
</form>

</div>
<p class="textsignature "> Tout droit réservé Admi Rayan et Axel Carette </p>
</div>
</body>
</html>

