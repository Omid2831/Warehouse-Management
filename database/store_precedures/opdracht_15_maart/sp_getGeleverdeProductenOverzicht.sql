USE aryanDBassignment;

DELIMITER $$

DROP PROCEDURE IF EXISTS sp_getGeleverdeProductenOverzicht $$

CREATE PROCEDURE sp_getGeleverdeProductenOverzicht (
     IN pageNumber INT
    ,IN pageSize INT
    ,IN p_StartDatum DATE
    ,IN p_EindDatum DATE
)
BEGIN

        -- Declare variables for pagination
        DECLARE startRow INT DEFAULT 0;


    -- Calculate the starting row for pagination (zero-based)
    SET startRow = (pageNumber - 1) * pageSize;


    SELECT
         L.Id             AS LeverancierId,
         L.Naam           AS NaamLeverancier,
         L.Contactpersoon AS Contactpersoon,
         P.Id             AS ProductId,
         P.Naam           AS Productnaam,
         SUM(PPL.Aantal)  AS TotaalGeleverd
    FROM Leverancier AS L
    INNER JOIN ProductPerLeverancier AS PPL ON L.Id = PPL.LeverancierId
    INNER JOIN Product AS P ON PPL.ProductId = P.Id
    WHERE (p_StartDatum IS NULL OR PPL.DatumLevering >= p_StartDatum)
      AND (p_EindDatum  IS NULL OR PPL.DatumLevering <= p_EindDatum)
    GROUP BY
         L.Id, L.Naam, L.Contactpersoon, P.Id, P.Naam
    ORDER BY
         L.Naam ASC, P.Naam ASC
    LIMIT pageSize OFFSET startRow;
END $$

DELIMITER ;
