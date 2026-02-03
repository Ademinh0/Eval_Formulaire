<?php
$nom = '';
$prenom = '';
$email = '';
$age = '';
$conditions = false;

$erreurs = [];
$succes = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = isset($_POST['nom']) ? trim($_POST['nom']) : '';
    $prenom = isset($_POST['prenom']) ? trim($_POST['prenom']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $age = isset($_POST['age']) ? trim($_POST['age']) : '';
    $conditions = isset($_POST['conditions']);

    if (empty($nom)) {
        $erreurs['nom'] = 'Le nom est requis';
    } elseif (strlen($nom) < 2) {
        $erreurs['nom'] = 'Le nom ne peut pas être inférieur à 2 caractères';
    } elseif (strlen($nom) > 50) {
        $erreurs['nom'] = 'Le nom ne peut pas dépasser 50 caractères';
    }

    if (empty($prenom)) {
        $erreurs['prenom'] = 'Le prénom est requis';
    } elseif (strlen($prenom) < 2) {
        $erreurs['prenom'] = 'Le prénom ne peut pas être inférieur à 2 caractères';
    } elseif (strlen($prenom) > 50) {
        $erreurs['prenom'] = 'Le prénom ne peut pas dépasser 50 caractères';
    }

    if (empty($email)) {
        $erreurs['email'] = "L'email est requis";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs['email'] = "L'email est incorrect";
    }

    if (empty($age)) {
        $erreurs['age'] = "L'âge est requis";
    } elseif ($age < 16) {
        $erreurs['age'] = 'Vous devez avoir au moins 16 ans pour vous inscrire';
    }

    if (!$conditions) {
        $erreurs['conditions'] = 'Vous devez accepter les conditions générales pour vous inscrire';
    }

    if (empty($erreurs)) {
        $succes = true;
        $nom_succes = $nom;
        $prenom_succes = $prenom;
    }
}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if ($succes): ?>
        <div style="background-color: green; color: white; padding: 10px">
            Inscription réussie ! Bienvenue <?php echo htmlspecialchars($prenom_succes); ?> <?php echo htmlspecialchars($nom_succes); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div>
            <label for="nom">Nom</label>
            <input type="text" name="nom" value="<?php echo htmlspecialchars($nom); ?>">
            <?php if (isset($erreurs['nom'])): ?>
                <div style="color: red;"><?php echo $erreurs['nom']; ?></div>
            <?php endif; ?>
        </div>
    

        <div>
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" value="<?php echo htmlspecialchars($prenom); ?>">
            <?php if (isset($erreurs['prenom'])): ?>
                <div style="color: red;"><?php echo $erreurs['prenom']; ?></div>
            <?php endif; ?>
        </div>
        

        <div>
            <label for="email">Email</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <?php if (isset($erreurs['email'])): ?>
                <div style="color: red;"><?php echo $erreurs['email']; ?></div>
            <?php endif; ?>
        </div>
        

        <div>
            <label for="age">Age</label>
            <input type="number"  name="age" value="<?php echo htmlspecialchars($age); ?>">
            <?php if (isset($erreurs['age'])): ?>
                <div style="color: red;"><?php echo $erreurs['age']; ?></div>
            <?php endif; ?>
        </div>
        

        <div>
            <input type="checkbox" name="conditions" <?php echo $conditions ? 'checked' : ''; ?>>
            <label for="conditions">J'accepte les conditions générales</label>
            <?php if (isset($erreurs['conditions'])): ?>
                <div style="color: red;"><?php echo $erreurs['conditions']; ?></div>
            <?php endif; ?>
        </div>

        <button type="submit">S'inscrire</button>
    </form>
</body>
</html>