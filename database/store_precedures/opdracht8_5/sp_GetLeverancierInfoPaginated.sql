USE aryanDBassignment;

-- =========================================
-- CREATE PROCEDURE sp_getLeverancierInfoPaginated
-- =========================================
DELIMITER $$
DROP PROCEDURE IF EXISTS sp_getLeverancierInfoPaginated;

CREATE PROCEDURE sp_getLeverancierInfoPaginated (
    IN pageNumber INT
    ,IN pageSize INT
    )
BEGIN 

    -- Declare variables for pagination
DECLARE startRow INT DEFAULT 0;


    -- Calculate the starting row for pagination (zero-based)
SET startRow = (pageNumber - 1) * pageSize;

-- Select leverancier info with pagination
SELECT
    L.Id
    ,L.Naam AS Naam
    ,L.Contactpersoon AS Contactpersoon
    ,L.Leveranciernummer AS Leveranciernummer
    ,L.Mobiel AS Mobiel
    ,COUNT(DISTINCT PPL.ProductId) AS AantalVerschillendeProducten
FROM
    Leverancier AS L
INNER JOIN
        ProductPerLeverancier AS PPL
ON L.ID = PPL.LeverancierId
GROUP BY
    L.Id,
    L.Naam,
    L.Contactpersoon,
    L.Leveranciernummer,
    L.Mobiel
ORDER BY
    L.Naam DESC
LIMIT
    startRow, pageSize;

END $$
DELIMITER ;