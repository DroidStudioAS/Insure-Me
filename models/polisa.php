<?php

class Polisa {
    private $idPolise;
    private $idKorisnika;
    private $polisaBrPasosa;
    private $polisaBrTelefona;
    private $polisaDatumRodjenja;
    private $polisaOd;
    private $polisaDo;
    private $polisaIme;
    private $polisaTip;
    private $polisaEmail;
    private $polisaDodatniOsiguranici;

    // Constructor
    public function __construct(
        $idPolise, $idKorisnika, $polisaBrPasosa, $polisaBrTelefona,
        $polisaDatumRodjenja, $polisaOd, $polisaDo, $polisaIme,
        $polisaTip, $polisaEmail, $polisaDodatniOsiguranici
    ) {
        $this->idPolise = $idPolise;
        $this->idKorisnika = $idKorisnika;
        $this->polisaBrPasosa = $polisaBrPasosa;
        $this->polisaBrTelefona = $polisaBrTelefona;
        $this->polisaDatumRodjenja = $polisaDatumRodjenja;
        $this->polisaOd = $polisaOd;
        $this->polisaDo = $polisaDo;
        $this->polisaIme = $polisaIme;
        $this->polisaTip = $polisaTip;
        $this->polisaEmail = $polisaEmail;
        $this->polisaDodatniOsiguranici = $polisaDodatniOsiguranici;
    }

    // Getters
    public function getIdPolise() {
        return $this->idPolise;
    }

    public function getIdKorisnika() {
        return $this->idKorisnika;
    }

    public function getPolisaBrPasosa() {
        return $this->polisaBrPasosa;
    }

    public function getPolisaBrTelefona() {
        return $this->polisaBrTelefona;
    }

    public function getPolisaDatumRodjenja() {
        return $this->polisaDatumRodjenja;
    }

    public function getPolisaOd() {
        return $this->polisaOd;
    }

    public function getPolisaDo() {
        return $this->polisaDo;
    }

    public function getPolisaIme() {
        return $this->polisaIme;
    }

    public function getPolisaTip() {
        return $this->polisaTip;
    }

    public function getPolisaEmail() {
        return $this->polisaEmail;
    }

    public function getPolisaDodatniOsiguranici() {
        return $this->polisaDodatniOsiguranici;
    }

    // Setters
    public function setIdPolise($idPolise) {
        $this->idPolise = $idPolise;
    }

    public function setIdKorisnika($idKorisnika) {
        $this->idKorisnika = $idKorisnika;
    }

    public function setPolisaBrPasosa($polisaBrPasosa) {
        $this->polisaBrPasosa = $polisaBrPasosa;
    }

    public function setPolisaBrTelefona($polisaBrTelefona) {
        $this->polisaBrTelefona = $polisaBrTelefona;
    }

    public function setPolisaDatumRodjenja($polisaDatumRodjenja) {
        $this->polisaDatumRodjenja = $polisaDatumRodjenja;
    }

    public function setPolisaOd($polisaOd) {
        $this->polisaOd = $polisaOd;
    }

    public function setPolisaDo($polisaDo) {
        $this->polisaDo = $polisaDo;
    }

    public function setPolisaIme($polisaIme) {
        $this->polisaIme = $polisaIme;
    }

    public function setPolisaTip($polisaTip) {
        $this->polisaTip = $polisaTip;
    }

    public function setPolisaEmail($polisaEmail) {
        $this->polisaEmail = $polisaEmail;
    }

    public function setPolisaDodatniOsiguranici($polisaDodatniOsiguranici) {
        $this->polisaDodatniOsiguranici = $polisaDodatniOsiguranici;
    }
}


