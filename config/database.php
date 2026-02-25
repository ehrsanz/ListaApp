<?php

// Tama tiedosto vastaa yhdesta asiasta:
// se muodostaa yhteyden MySQL-tietokantaan


// -------------------------
// 1. TIETOKANNAN TIEDOT
// -------------------------

// localhost tarkoittaa:
// tietokanta on omalla koneella
$host = "localhost";

// Taman tietokannan nimi (se jonka loit phpMyAdminissa)
$dbname = "lista_app";

// Tietokannan kayttajanimi
// XAMPPissa se on usein root
$username = "root";

// Tietokannan salasana
// XAMPPin oletus on tyhja
$password = "";


// -------------------------
// 2. YRITETAAN MUODOSTAA YHTEYS
// -------------------------

// try tarkoittaa:
// kokeile suorittaa tama koodi
try {

    // new PDO(...) tarkoittaa:
    // luodaan yhteys tietokantaan

    // PDO = PHP:n sisaanrakennettu tyokalu,
    // jolla PHP osaa keskustella tietokannan kanssa

    // "mysql:host=...;dbname=..." kertoo:
    // - mika tietokantapalvelin
    // - mika tietokanta

    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // setAttribute tarkoittaa:
    // muutetaan yhteyden asetuksia

    // PDO::ATTR_ERRMODE = virheiden kasittelytapa
    // PDO::ERRMODE_EXCEPTION tarkoittaa:
    // jos tulee virhe, nayta se selkeasti

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// -------------------------
// 3. JOS JOKIN MENEE PIELEEN
// -------------------------

// catch suoritetaan vain jos try-lohkossa tapahtuu virhe
} catch(PDOException $e) {

    // PDOException = tietokantavirhe

    // $e->getMessage() hakee virheen selityksen

    echo "Tietokantayhteys epaonnistui: " . $e->getMessage();
}


// -------------------------
// MITA TAMAN JALKEEN?
// -------------------------

// Jos yhteys onnistui,
// muuttuja $conn sisaltaa yhteyden tietokantaan

// Tama $conn annetaan Task-luokalle (Modelille)

// database.php EI hae tietoja, lisaa tietoja tai poista tietoja
// Se vain luo yhteyden

// Siksi se EI ole Model, View tai Controller

// Se on apuosa (infrastructure)
// joka mahdollistaa Modelin toiminnan