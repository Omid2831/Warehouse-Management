# USE aryanDBassignment DATABASE
USE aryanDBassignment;

DROP VIEW IF EXISTS vw_AssortimentByDateRange;

CREATE OR REPLACE VIEW vw_AssortimentByDateRange AS
SELECT
    L.Naam AS LeverancierNaam,
    L.Contactpersoon AS Contactpersoon,
    C.Stad AS Stad,
    P.Naam AS ProductNaam,
    PEL.EindDatumLevering AS EinddatumLevering
FROM Leverancier AS L
INNER JOIN Contact AS C ON L.fk_ContactId = C.Id
INNER JOIN ProductPerLeverancier AS PPL ON PPL.LeverancierId = L.Id
INNER JOIN Product AS P ON P.Id = PPL.ProductId
INNER JOIN ProductEinddatumLevering AS PEL ON PEL.ProductId = P.Id;