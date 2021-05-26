<?php 

	namespace XPetsIntl;

	require_once("../classe/XPetGateway.php");

	$xpgw = new XPetGateway("localhost", "xpets", "root", "");

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if(isset($_POST["delete"]))
			$xpgw->deleteXPetRecord($_POST["id"]);
		else
			$xpgw->saveRecord($_POST);
		
		header("Location: ./..");
	}

	$textHeader = "Formulaire d'enregistrement";

	if(isset($_REQUEST['id'])) {
		$xpet = $xpgw->getXpetById($_REQUEST['id']);
		$textHeader = "Formulaire de modification";
	}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Formulaire d'enregistrement :: X-Pets</title>
	<meta name="description" content="Formulaire permettant d'enregistrer ou mettre à jour une fiche animal dans la base de données de l'institution">

	<!-- Fonts -->

	<!-- Stylesheets -->
	<link rel="stylesheet" href="../styles/main.css">

	<!-- Scripts -->
	<script type="text/javascript" src="scripts/script.js"></script>
</head>

<body>
	<header>
		<h1><?= $textHeader; ?></h1>
	</header>
	<main>
		<form action="" method="post">
			<div class="input-field">
				<label for="inputName">Nom de l'animal : </label>
				<input name="name" id="inputName" type="text" value="<?= isset($xpet) ? $xpet->getName() : ""; ?>"> 
			</div>

			<div class="input-field">
				<label for="selectClass">Classe animalière : </label>
				<select name="classId" id="selectClass">
					<option value="" disabled <?= isset($xpet) ? "" : "selected" ?>>Choisir une classe ...</option>					
					<?php foreach($xpgw->getAllClasses() as $class) : ?>
					<option
						value="<?= $class["id"]; ?>"
						<?= isset($xpet) && $class["label"] == $xpet->getClass() ? "selected" : "" ?>>
						<?= $class["label"]; ?>
					</option>
					<?php endforeach; ?>
				</select>
			</div>
			
			<!-- <div class="input-field">
				<label for="inputSuperpowers">Superpouvoirs : </label>
				<textarea name="superpowers" id="inputSuperpowers"></textarea>
			</div> -->

			<div class="input-field">
				<label for="inputDesc">Description : </label>
				<textarea name="description" id="inputDesc"><?= isset($xpet) ? $xpet->getDescription() : "" ?></textarea>
			</div>

			<?php if(isset($xpet)) : ?>
			<input type="hidden" name="id" value="<?= $xpet->getId(); ?>">
			<?php endif; ?>

			<button type="submit">Enregistrer l'animal</button>
			<?php if(isset($xpet)) : ?>
			<button type="submit" name="delete">Effacer l'animal</button>
			<?php endif; ?>
		</form>
	</main>
</body>
</html>