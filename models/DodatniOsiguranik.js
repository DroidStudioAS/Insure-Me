class DodatniOsiguranik {
    constructor(ime, datumRodjenja, brojPasosa) {
        this.ime = ime;
        this.datumRodjenja = datumRodjenja;
        this.brojPasosa = brojPasosa;
    }

    // Getters
    getIme() {
        return this.ime;
    }

    getDatumRodjenja() {
        return this.datumRodjenja;
    }

    getBrojPasosa() {
        return this.brojPasosa;
    }

    // Setters
    setIme(ime) {
        this.ime = ime;
    }

    setDatumRodjenja(datumRodjenja) {
        this.datumRodjenja = datumRodjenja;
    }

    setBrojPasosa(brojPasosa) {
        this.brojPasosa = brojPasosa;
    }
}
