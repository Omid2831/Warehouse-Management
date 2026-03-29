USE aryanDBassignment;

DROP PROCEDURE IF EXISTS sp_getAllOverzichtAssortiment;

DELIMITER $$

CREATE PROCEDURE IF NOT EXISTS sp_getAllOverzichtAssortiment()
BEGIN
    
    # GET ALL THE DATA
    -- INCLUDE:
    -- LEVERANCIER NAAM, CONTACTPERSONEN, STAD VAN DE LEVERANCIER, PRODUCT NAAM, EINDDATUM LEVERING
    -- ORDER BY EINDDATUM LEVERING ASCENDING

    SELECT
         P.Id AS productId
        ,L.Naam AS LeverancierNaam
        ,L.Contactpersoon AS Contactpersoon
        ,C.Stad AS Stad
        ,P.Naam AS ProductNaam
        ,PEL.EindDatumLevering AS EinddatumLevering

    FROM Leverancier AS L
    INNER JOIN Contact AS C
        ON L.fk_ContactId = C.Id

    INNER JOIN ProductPerLeverancier AS PPL
        ON PPL.LeverancierId = L.Id

    INNER JOIN Product AS P
        ON P.Id = PPL.ProductId

    INNER JOIN ProductEinddatumLevering AS PEL
        ON PEL.ProductId = P.Id

    ORDER BY LeverancierNaam DESC, EinddatumLevering ASC;

END$$

DELIMITER ;