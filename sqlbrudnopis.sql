INSERT INTO `testowa`.`emaile` (Email)
SELECT  Email
FROM `testowa`.`uzytkownicyrejestracja` WHERE Login='kjdsakjsahkjdha' && ID=16;

INSERT INTO `testowa`.`hasla` (Hash)
SELECT  HasloHash
FROM `testowa`.`uzytkownicyrejestracja` WHERE Login='kjdsakjsahkjdha' && ID=16;

INSERT INTO `testowa`.`uzytkownicy` (Login, Imie, Nazwisko, Wojewodztwo, Miejscowosc, Plec, Typ)
SELECT Login, Imie, Nazwisko, Wojewodztwo, Miejscowosc, Plec, Typ
FROM `testowa`.`uzytkownicyrejestracja` WHERE Login='kjdsakjsahkjdha' && ID=16;


SELECT Hash, Login FROM uzytkownicy JOIN hasla ON hasla.ID = uzytkownicy.ID WHERE Login="krilek"


TINYTEXT: 256 bytes
TEXT: 65,535 bytes utf-8 chars 16383
MEDIUMTEXT: 16,777,215 bytes utf-8 chars 4194304
LONGTEXT: 4,294,967,295 bytes utf-8 chars 1073741823
