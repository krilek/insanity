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

SELECT * FROM ogloszenia JOIN kategorie ON `kategorie`.ID = `ogloszenia`.Kategoria JOIN typogloszenia ON `typogloszenia`.ID = `ogloszenia`.Typ WHERE `Uzytkownik` = 3
SELECT * FROM ogloszenia 
      JOIN kategorie ON `kategorie`.ID = `ogloszenia`.Kategoria 
      JOIN typogloszenia ON `typogloszenia`.ID = `ogloszenia`.Typ 
      LEFT INNER JOIN zdjecia ON `zdjecia`.`Ogloszenie` = `ogloszenia`.ID
WHERE `Uzytkownik` = 3

SELECT 
	ogloszenia.ID,ogloszenia.Tytul, 
    ogloszenia.Cena, ogloszenia.Tresc,
    kategorie.Nazwa, typogloszenia.Nazwa,
    typogloszenia.CenaPotrzebna, zdjecia.NazwaPliku FROM ogloszenia 
      JOIN kategorie ON `kategorie`.ID = `ogloszenia`.Kategoria 
      JOIN typogloszenia ON `typogloszenia`.ID = `ogloszenia`.Typ 
      JOIN zdjecia ON `zdjecia`.`Ogloszenie` = 
      (
        SELECT Ogloszenie FROM zdjecia GROUP BY Ogloszenie
      )
      -- `ogloszenia`.ID
WHERE `Uzytkownik` = 3



SELECT   Orders.OrderNumber,
         LineItems.Quantity,
         LineItems.Description
FROM     Orders
JOIN     LineItems
ON       LineItems.LineItemGUID =
         (
         SELECT  TOP 1 LineItemGUID 
         FROM    LineItems
         WHERE   OrderID = Orders.OrderID
         )


TINYTEXT: 256 bytes
TEXT: 65,535 bytes utf-8 chars 16383
MEDIUMTEXT: 16,777,215 bytes utf-8 chars 4194304
LONGTEXT: 4,294,967,295 bytes utf-8 chars 1073741823
