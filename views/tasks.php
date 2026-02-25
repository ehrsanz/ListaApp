<!DOCTYPE html>
<!-- Tama kertoo selaimelle etta sivu on HTML5-muodossa -->

<html>
<!-- HTML-sivun alku -->

<head>
    <!-- Head-osiossa on selaimelle tarkoitettua tietoa -->

    <title>ListaApp</title>
    <!-- Tama teksti nakyy selaimen valilehdessa -->
</head>

<body>
<!-- Body-osio sisaltaa kaiken minka kayttaja oikeasti nakee -->

<h2>Lisää tehtävä</h2>
<!-- Otsikko joka nakyy sivulla -->


<!-- Lomake jonka avulla kayttaja voi lisata uuden tehtavan -->
<form method="POST" action="index.php">
    <!-- method="POST" tarkoittaa:
         lomake lahettaa tiedot palvelimelle turvallisesti piilossa -->

    <!-- action="index.php" tarkoittaa:
         tiedot lahetetaan index.php tiedostoon kasiteltavaksi -->

    <input type="text" name="title" required>
    <!-- Tekstikentta johon kayttaja kirjoittaa tehtavan -->
    <!-- name="title" tarkoittaa:
         PHP saa taman arvon muuttujasta $_POST["title"] -->
    <!-- required tarkoittaa:
         selaimen on pakko saada teksti ennen lahetysta -->

    <button type="submit">Lisää</button>
    <!-- Nappi jota painamalla lomake lahetetaan -->
</form>


<h2>Tehtävät</h2>
<!-- Otsikko listalle -->


<ul>
<!-- ul tarkoittaa jarjestamatonta listaa (pisteet listan edessa) -->

<?php
// Tämä while-silmukka kay lapi kaikki tehtavat yksitellen
// $tasks sisaltaa tietokannasta haetut rivit
// fetch tarkoittaa: hae yksi rivi kerrallaan
// PDO on PHP:n tapa keskustella tietokannan kanssa turvallisesti
// FETCH_ASSOC tarkoittaa: hae tiedot taulukkona jossa sarakkeiden nimet ovat avaimina
while($row = $tasks->fetch(PDO::FETCH_ASSOC)) :
?>

    <li>
        <!-- li tarkoittaa yksi listan kohta -->

        <?= htmlspecialchars($row["title"]) ?>
        <!-- Tulostaa tehtavan nimen selaimeen -->

        <!-- htmlspecialchars tarkoittaa:
             muunna erikoismerkit turvalliseen muotoon
             estaa haitallisen koodin suorittamisen -->

        <a href="index.php?delete=<?= $row["id"] ?>">Poista</a>
        <!-- Tama on linkki poistamiseen -->

        <!-- ?delete=ID tarkoittaa:
             laheta index.php tiedostolle tieto mika tehtava poistetaan -->

        <!-- $_GET["delete"] saa taman arvon index.php tiedostossa -->
    </li>

<?php endwhile; ?>
<!-- endwhile tarkoittaa silmukan loppua -->

</ul>
<!-- Listan loppu -->

</body>
<!-- Body-osio loppuu -->

</html>
<!-- HTML-dokumentti loppuu -->


<!-- Tama tiedosto on View MVC-rakenteessa -->
<!-- Se vain nayttaa tietoa -->
<!-- Se ei hae tietokannasta itse mitaan -->
<!-- Se ei tee paatoksia -->