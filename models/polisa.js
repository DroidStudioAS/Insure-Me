class Polisa {
    constructor(
        idKorisnika, polisaBrPasosa, polisaBrTelefona,
        polisaDatumRodjenja, polisaOd, polisaDo, polisaIme,
        polisaTip, polisaEmail, polisaDodatniOsiguranici,datumPrijave
    ) {
        this.idKorisnika = idKorisnika;
        this.polisaBrPasosa = polisaBrPasosa;
        this.polisaBrTelefona = polisaBrTelefona;
        this.polisaDatumRodjenja = polisaDatumRodjenja;
        this.polisaOd = polisaOd;
        this.polisaDo = polisaDo;
        this.polisaIme = polisaIme;
        this.polisaTip = polisaTip;
        this.polisaEmail = polisaEmail;
        this.polisaDodatniOsiguranici = polisaDodatniOsiguranici;
        this.datumPrijave=datumPrijave;
        
    }

    // Getters
    getIdKorisnika() {
        return this.idKorisnika;
    }

    getPolisaBrPasosa() {
        return this.polisaBrPasosa;
    }

    getPolisaBrTelefona() {
        return this.polisaBrTelefona;
    }

    getPolisaDatumRodjenja() {
        return this.polisaDatumRodjenja;
    }

    getPolisaOd() {
        return this.polisaOd;
    }

    getPolisaDo() {
        return this.polisaDo;
    }

    getPolisaIme() {
        return this.polisaIme;
    }

    getPolisaTip() {
        return this.polisaTip;
    }

    getPolisaEmail() {
        return this.polisaEmail;
    }

    getPolisaDodatniOsiguranici() {
        return this.polisaDodatniOsiguranici;
    }
    getDatumPrijave(){
        return this.datumPrijave;
    }

    // Setters
    setIdKorisnika(idKorisnika) {
        this.idKorisnika = idKorisnika;
    }

    setPolisaBrPasosa(polisaBrPasosa) {
        this.polisaBrPasosa = polisaBrPasosa;
    }

    setPolisaBrTelefona(polisaBrTelefona) {
        this.polisaBrTelefona = polisaBrTelefona;
    }

    setPolisaDatumRodjenja(polisaDatumRodjenja) {
        this.polisaDatumRodjenja = polisaDatumRodjenja;
    }

    setPolisaOd(polisaOd) {
        this.polisaOd = polisaOd;
    }

    setPolisaDo(polisaDo) {
        this.polisaDo = polisaDo;
    }

    setPolisaIme(polisaIme) {
        this.polisaIme = polisaIme;
    }

    setPolisaTip(polisaTip) {
        this.polisaTip = polisaTip;
    }

    setPolisaEmail(polisaEmail) {
        this.polisaEmail = polisaEmail;
    }

    setPolisaDodatniOsiguranici(polisaDodatniOsiguranici) {
        this.polisaDodatniOsiguranici = polisaDodatniOsiguranici;
    }
    setDatumPrijave(datumPrijave){
        this.datumPrijave=datumPrijave;
    }
}
