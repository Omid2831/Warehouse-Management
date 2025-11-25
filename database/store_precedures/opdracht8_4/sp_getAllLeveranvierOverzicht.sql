USE aryanDBassignment;

DROP PROCEDURE IF EXISTS sp_getAllLeverancierOverzicht;

DELIMITER $$

CREATE PROCEDURE sp_getAllLeverancierOverzicht (

)
BEGIN

    SELECT
         L.Id
        ,L.Naam AS Naam
        ,L.Contactpersoon AS Contactpersoon
        ,L.Leveranciernummer AS Leveranciernummer
        ,L.Mobiel AS Mobiel
        ,COUNT(DISTINCT PPL.ProductId) AS AantalVerschillendeProducten
        ,ANY_VALUE(PPL.ProductId) AS ProductId
        ,MAX(PPL.DatumEerstVolgendeLevering) AS DatumEerstVolgendeLevering
    FROM Leverancier AS L
    INNER JOIN
        ProductPerLeverancier AS PPL
    ON L.ID = PPL.LeverancierId
    GROUP BY L.Id;



END $$

DELIMITER ;