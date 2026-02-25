<?php

// Ladataan database.php tiedosto
// Tasta saadaan $conn muuttuja, joka on yhteys tietokantaan
require_once "config/database.php";


// Luodaan Task-luokka
// Luokka on kuin suunnitelma tai muotti
// Sen perusteella voidaan luoda "Task-olio", joka osaa kasitella tehtavia
class Task {

    // Tama muuttuja tallentaa tietokantayhteyden
    // private tarkoittaa etta sita voi kayttaa vain taman luokan sisalla
    private $conn;


    // __construct on erityinen funktio
    // Se suoritetaan automaattisesti kun luodaan uusi Task
    // $connection tulee index.php tiedostosta
    public function __construct($connection) {

        // Tallennetaan saatu tietokantayhteys taman luokan kayttoon
        // $this tarkoittaa "tama olio"
        $this->conn = $connection;
    }


    // Tama funktio hakee kaikki tehtavat tietokannasta
    public function getAll() {

        // SQL on kieli jolla puhutaan tietokannalle
        // Tama komento tarkoittaa:
        // hae kaikki rivit tasks-taulusta
        // jarjesta niin etta uusin (suurin id) tulee ensin
        $sql = "SELECT * FROM tasks ORDER BY id DESC";

        // prepare tarkoittaa:
        // valmistele kysely turvallisesti
        // se estaa haitalliset komennot
        $stmt = $this->conn->prepare($sql);

        // execute tarkoittaa:
        // suorita kysely tietokannassa
        $stmt->execute();

        // palautetaan tulos takaisin index.php:lle
        return $stmt;
    }


    // Tama funktio lisaa uuden tehtavan
    public function create($title) {

        // Tama SQL-komento lisaa uuden rivin tasks-tauluun
        // :title on paikka johon laitetaan oikea arvo
        $sql = "INSERT INTO tasks (title) VALUES (:title)";

        // Valmistellaan kysely
        $stmt = $this->conn->prepare($sql);

        // bindParam tarkoittaa:
        // liita PHP-muuttuja turvallisesti SQL-kyselyyn
        // taman ansiosta kukaan ei voi syottaa haitallista SQL-koodia
        $stmt->bindParam(":title", $title);

        // Suoritetaan lisays tietokantaan
        // palauttaa true jos onnistuu
        // palauttaa false jos epaonnistuu
        return $stmt->execute();
    }


    // Tama funktio poistaa tehtavan id-numeron perusteella
    public function delete($id) {

        // SQL-komento joka poistaa rivin jossa id vastaa annettua arvoa
        $sql = "DELETE FROM tasks WHERE id = :id";

        // Valmistellaan kysely
        $stmt = $this->conn->prepare($sql);

        // Liitetaan annettu id turvallisesti kyselyyn
        $stmt->bindParam(":id", $id);

        // Suoritetaan poisto
        return $stmt->execute();
    }
}


// Tama tiedosto on Model MVC-rakenteessa
// Se vastaa tietojen hakemisesta, lisaamisesta ja poistamisesta
// Se ei nayta mitaan selaimessa eika kasittele lomakkeita
// Se tekee vain tietokantatyota