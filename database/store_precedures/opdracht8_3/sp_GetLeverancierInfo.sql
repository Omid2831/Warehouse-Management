USE aryanDBassignment;

DROP PROCEDURE IF EXISTS sp_GetLeverancierInfo;


DELIMITER $$

CREATE PROCEDURE sp_GetLeverancierInfo(
    IN p_ProductID INT
)
BEGIN

    SELECT
          L.fk_ContactId AS ContactId
        , L.Naam AS Naam
        , L.Contactpersoon AS Contactpersoon
        , L.Leveranciernummer AS Leveranciernummer
        , L.Mobiel AS Mobiel

    FROM Leverancier AS L

    INNER JOIN ProductPerLeverancier AS PPL
    ON L.Id = PPL.LeverancierId
    INNER JOIN 
        Contact AS C
    ON 
        L.fk_ContactId = C.Id

    WHERE PPL.ProductId = p_ProductID;
END$$

DELIMITER ;