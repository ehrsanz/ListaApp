<?php

// Ladataan database.php
// Tasta saadaan $conn muuttuja
// $conn on yhteys tietokantaan
require_once "config/database.php";


// Ladataan Task-luokka
// Task osaa hakea, lisata ja poistaa tehtavia
require_once "models/Task.php";


// Luodaan uusi Task
// Annetaan sille tietokantayhteys $conn
// Nyt $task osaa kayttaa tietokantaa
$task = new Task($conn);



// ------------------------------------
// 1. JOS LOMAKE LAHETETTIIN
// ------------------------------------

// $_SERVER["REQUEST_METHOD"] kertoo
// tuliko pyynto POST vai GET muodossa

// POST tarkoittaa:
// kayttaja lahetti lomakkeen

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Haetaan lomakkeesta tullut arvo
    // $_POST["title"] tulee input-kentasta
    $title = $_POST["title"];

    // Pyydetaan Task-luokkaa lisaamaan uusi tehtava
    $task->create($title);

    // header("Location: index.php") tarkoittaa:
    // ohjataan selain takaisin samalle sivulle

    // Tama estaa tilanteen jossa selain lahettaa lomakkeen uudestaan
    header("Location: index.php");

    // Lopetetaan ohjelman suoritus tahan
    exit();
}



// ------------------------------------
// 2. JOS POISTETAAN TEHTAVA
// ------------------------------------

// isset tarkistaa onko muuttuja olemassa

// $_GET["delete"] tulee URL-osoitteesta
// Esim: index.php?delete=5

if (isset($_GET["delete"])) {

    // Tallennetaan id numero muuttujaan
    $id = $_GET["delete"];

    // Pyydetaan Task-luokkaa poistamaan tehtava
    $task->delete($id);

    // Ohjataan selain takaisin paivitettyyn listaan
    header("Location: index.php");

    // Lopetetaan ohjelma tahan
    exit();
}



// ------------------------------------
// 3. HAE KAIKKI TEHTAVAT
// ------------------------------------

// Pyydetaan Task-luokkaa hakemaan kaikki tehtavat
// getAll hakee ne tietokannasta
$tasks = $task->getAll();



// ------------------------------------
// 4. NAYTA SIVU
// ------------------------------------

// Ladataan tasks.php
// Se nayttaa HTML-sivun selaimessa

// tasks.php saa kayttoon muuttujan $tasks
require_once "views/tasks.php";



// Tama tiedosto on Controller MVC-rakenteessa

// Se:
// - kasittelee lomakkeet
// - kasittelee URL-parametrit
// - kutsuu Modelia
// - lataa View-tiedoston

// Se EI:
// - tee SQL-kyselyita itse
// - kirjoita HTML-sivua itse