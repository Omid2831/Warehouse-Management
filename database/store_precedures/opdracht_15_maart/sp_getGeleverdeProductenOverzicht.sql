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
    DECLARE startRow INT DEFAULT 0;
    DECLARE recordsExist INT DEFAULT 0;

    SET startRow = (pageNumber - 1) * pageSize;

    -- Check if any records exist first
    SELECT COUNT(*) INTO recordsExist
    FROM ProductPerLeverancier PPL
    WHERE (p_StartDatum IS NULL OR PPL.DatumLevering >= p_StartDatum)
      AND (p_EindDatum IS NULL OR PPL.DatumLevering <= p_EindDatum);

    IF recordsExist = 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No products available in the selected date range';
    ELSE
        WITH FilteredData AS (
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
              AND (p_EindDatum IS NULL OR PPL.DatumLevering <= p_EindDatum)
            GROUP BY
                 L.Id, L.Naam, L.Contactpersoon, P.Id, P.Naam
        )
        SELECT *
        FROM FilteredData
        ORDER BY NaamLeverancier ASC, Productnaam ASC
        LIMIT pageSize OFFSET startRow;
    END IF;

END $$

DELIMITER ;
