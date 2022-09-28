/// <reference types="cypress" />
describe("User Can Open Website", () => {
    it("User can create data", () => {
        cy.visit("http://127.0.0.1:8000/mahasiswa");
        cy.get('.float-right > .btn').click();
        cy.get('#Nim').type("2098786555");
        cy.get('#Nama').type("Nisrina ");
        const imagefile = 'sakura.jpg';
        cy.get('#Foto').attachFile(imagefile);
        cy.get(':nth-child(5) > .form-control').select("TI 2B");
        cy.get('#Jurusan').type("Teknologi Informasi")
        cy.get('#Alamat').type("Lampung");
        cy.get('#Tanggal_Lahir').type("2002-11-02");
        cy.get('#Email').type("nisrin@gmail.com");
        cy.get('.btn').click();

        cy.visit("http://127.0.0.1:8000/mahasiswa");
        cy.get('.float-right > .btn').click();
        cy.get('#Nim').type("2098780000");
        cy.get('#Nama').type("Park Sunghoon");
        const imagefile2 = 'london.jpg';
        cy.get('#Foto').attachFile(imagefile2);
        cy.get(':nth-child(5) > .form-control').select("TI 2F");
        cy.get('#Jurusan').type("Teknik Sipil")
        cy.get('#Alamat').type("Surabaya");
        cy.get('#Tanggal_Lahir').type("2002-12-09");
        cy.get('#Email').type("sunghoon@gmail.com");
        cy.get('.btn').click();
    });

    it("User can show data", () => {
        cy.visit("http://127.0.0.1:8000/mahasiswa");
        cy.get(':nth-child(2) > :nth-child(9) > .d-inline > .btn-info').click();
        cy.get('.btn').click()
    });

    it("User can update data", () => {
        cy.visit("http://127.0.0.1:8000/mahasiswa");
        cy.get(':nth-child(2) > :nth-child(9) > .d-inline > .btn-primary').click();
        cy.get(':nth-child(6) > .form-control').select("TI 2F");
        cy.get('.btn').click()     
    });

    it("User can delete data", () => {
        cy.visit("http://127.0.0.1:8000/mahasiswa");
        cy.get(':nth-child(5) > .page-link').click();
        cy.get(':nth-child(2) > :nth-child(9) > .d-inline > .btn-danger').click();
    })
 });