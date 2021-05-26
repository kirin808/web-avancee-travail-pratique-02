<?php 
	namespace XPetsIntl;

	require_once("classe/XPetGateway.php");

	$xpgw = new XPetGateway("localhost", "xpets", "root", "");

	$cssClasses = [
		"Amphibien" => "amphibien",
		"Mammifère" => "mammifere",
		"Oiseau" => "oiseau",
		"Reptile" => "reptile",
		"Poisson" => "poisson"
	];

?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>X-Pets - Adoption d'animaux avec superpouvoirs</title>
	<meta name="description" content="Portail d'accueil de X-Pets, un centre d'hébergement et d'adoption pour animaux mutants">

	<!-- Fonts -->

	<!-- Stylesheets -->
	<link rel="stylesheet" href="styles/main.css">

	<!-- Scripts -->
	<script type="text/javascript" src="scripts/script.js"></script>
</head>

<body>
	<header>
		<h1>Bienvenue chez Xpets Intl. !</h1>
		<span class="tagline">Notre mission, trouver votre meilleur ami !</span>
	</header>
	
	<main>
		<section class="animal-listing">
			<h2>Nos animaux</h2>
			
			<div class="grid">
				<?php foreach($xpgw->getAllXpets() as $xpet) : ?>
				<article>
					<h3><?= $xpet->getName(); ?></h3>
					<span class="animal-class <?= $cssClasses[$xpet->getClass()]; ?>"><?= $xpet->getClass(); ?></span>
					<p><?= $xpet->getDescription(); ?></p>
					<a href="formulaire/<?= $xpet->getId(); ?>">Mettre à jour</a>
				</article>				
				<?php endforeach; ?>
			</div>
		</section>

		<a href="formulaire/">Ajouter une fiche</a>
	</main>
</body>
</html>