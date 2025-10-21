<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page Tremplin</title>
  <link rel="stylesheet" href="style.css.css">
</head>
<body>

<div class="image-container">
  <form action="insert_contact.php" method="POST">

  <img src="assets/salon.png" alt="Maquette Salon">
 <div class="overlay">
        <input type="hidden" name="dispos" id="dispos-json">

</div>

    <h1 class="titre-agence">CONTACTEZ L’AGENCE</h1>
    <h2 class="sous-titre">VOS COORDONNÉES</h2>

 <div class="choix-genre">
      <label><input type="radio" name="genre" value="mme"> Mme</label>
      <label><input type="radio" name="genre" value="m"> M</label>
 </div>

    <h2 class="titre-message">VOTRE MESSAGE</h2>

 <div class="choix-options">
      <label><input type="radio" name="option" value="visite"> Demande de visite</label>
      <label><input type="radio" name="option" value="rappel"> Être rappelé</label>
      <label><input type="radio" name="option" value="photos"> Plus de photos</label>
 </div>

<div class="form-message">
      <textarea name="message" placeholder="Votre message"></textarea>
</div>

<div class="form-nom-prenom">
      <input type="text" name="nom" placeholder="Nom">
      <input type="text" name="prenom" placeholder="Prénom">
 </div>

<div class="form-email">
      <input type="email" name="email" placeholder="Adresse mail">
</div>

<div class="form-telephone">
      <input type="tel" name="telephone" placeholder="Téléphone">
</div>

    <h2 class="titre-disponibilite">DISPONIBILITÉ POUR UNE VISITE</h2>

<div class="disponibilite">
      <select name="jour" class="input-jour">
        <option value="">Jour</option>
        <option value="lundi">Lundi</option>
        <option value="mardi">Mardi</option>
        <option value="mercredi">Mercredi</option>
        <option value="jeudi">Jeudi</option>
        <option value="vendredi">Vendredi</option>
      </select>

     <div class="input-hm">
        <input type="number" name="heure" min="7" max="20" class="input-heure" placeholder="HH">
        <span class="suffix">h</span>
    </div>

    <div class="input-hm">
        <input type="number" name="minutes" min="0" max="59" class="input-minutes" placeholder="MM">
        <span class="suffix">min</span>
    </div>

      <button type="button" class="btn-ajouter">AJOUTER DISPO</button>
    </div>
<div class="liste-dispo"></div>

    
    <button type="submit" class="btn-envoyer">ENVOYER</button>
</form>
</div>
<script>
const btnAjouter = document.querySelector('.btn-ajouter');
const inputJour = document.querySelector('.input-jour');
const inputHeure = document.querySelector('.input-heure');
const inputMinutes = document.querySelector('.input-minutes');
const listeDispo = document.querySelector('.liste-dispo');
const hiddenDispos = document.getElementById('dispos-json');
const btnEnvoyer = document.querySelector('.btn-envoyer');

let disponibilites = [];

btnAjouter.addEventListener('click', () => {
  const jour = inputJour.value;
  const heure = inputHeure.value;
  const minutes = inputMinutes.value;

  if (!jour || !heure || !minutes) {
    alert("Merci de remplir tous les champs !");
    return;
  }

  const item = document.createElement('div');
  item.classList.add('dispo-item');
  item.innerHTML = `${jour} à ${heure}h${minutes}min <button class="close-btn">×</button>`;

  listeDispo.appendChild(item);

  // Ajouter à la liste JS
  disponibilites.push({ jour, heure, minutes });

  // Supprimer une dispo
  item.querySelector('.close-btn').addEventListener('click', () => {
    disponibilites = disponibilites.filter(d => !(d.jour === jour && d.heure === heure && d.minutes === minutes));
    item.remove();
  });

  // Nettoyer les champs
  inputJour.value = "";
  inputHeure.value = "";
  inputMinutes.value = "";

  // Mettre à jour le champ caché
  hiddenDispos.value = JSON.stringify(disponibilites);
});

btnEnvoyer.addEventListener('click', () => {
  hiddenDispos.value = JSON.stringify(disponibilites);
  document.querySelector('form').submit();
});
</script>



</body>
</html>
