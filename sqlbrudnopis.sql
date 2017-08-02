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


#TODO: TREŚĆ PRZENIEŚĆ DO OSOBNEJ TABELI
INSERT INTO `ogloszenia` (Uzytkownik,Tytul,Kategoria,Tresc,Typ,Cena,DataUtworzenia) VALUES
(3,"OGLOSZENIE", 2, "TRESC",1,2321.12,NOW())

SELECT 
    ogloszenia.ID,ogloszenia.Tytul, 
    IF(LENGTH(ogloszenia.Tresc) > 450, CONCAT(LEFT(ogloszenia.Tresc, 450), '...'), ogloszenia.Tresc) AS Tresc,
    ogloszenia.Cena,
    kategorie.Nazwa as Kategoria, typogloszenia.Nazwa as Typ,
    typogloszenia.CenaPotrzebna, Zdjecia.NazwaPliku, ogloszenia.DataUtworzenia
    FROM ogloszenia 
      JOIN kategorie ON `kategorie`.ID = `ogloszenia`.Kategoria 
      JOIN typogloszenia ON `typogloszenia`.ID = `ogloszenia`.Typ 
      LEFT JOIN (SELECT * FROM zdjecia GROUP BY zdjecia.Ogloszenie) AS zdjecia ON Ogloszenia.ID = Zdjecia.Ogloszenie
WHERE `Uzytkownik` = 3

TINYTEXT: 256 bytes
TEXT: 65,535 bytes utf-8 chars 16383
MEDIUMTEXT: 16,777,215 bytes utf-8 chars 4194304
LONGTEXT: 4,294,967,295 bytes utf-8 chars 1073741823

https://gist.github.com/anonymous/a5084dc46d77b141a6a79153ecebeb36
drop table emaile;
drop table emailtokeny;
drop table hasla;
drop TABLE kategorie;
DROP TABLE miasta;
drop TABLE ogloszenia;
drop TABLE typogloszenia;
drop table uzytkownicy;
drop TABLE uzytkownicyrejestracja;
DROP TABLE wojewodztwa;
drop TABLE zdjecia;