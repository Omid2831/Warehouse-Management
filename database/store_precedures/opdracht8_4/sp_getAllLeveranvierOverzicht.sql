USE aryanDBassignment;

DROP PROCEDURE IF EXISTS sp_getAllLeverancierOverzicht;

DELIMITER $$

CREATE PROCEDURE sp_getAllLeverancierOverzicht (

)
BEGIN

    SELECT
        L.Id,
        L.fk_ContactId AS ContactId,
        L.Naam,
        L.Contactpersoon,
        L.Leveranciernummer,
        L.Mobiel,
        COUNT(DISTINCT PPL.ProductId) AS AantalVerschillendeProducten,
        ANY_VALUE(PPL.ProductId) AS ProductId,
        MAX(PPL.DatumEerstVolgendeLevering) AS DatumEerstVolgendeLevering
    FROM Leverancier AS L
    LEFT JOIN ProductPerLeverancier AS PPL
        ON L.Id = PPL.LeverancierId
    LEFT JOIN Contact AS C
        ON L.fk_ContactId = C.Id
    GROUP BY L.Id
    ORDER BY L.Id, L.Naam DESC;



END $$

DELIMITER ;