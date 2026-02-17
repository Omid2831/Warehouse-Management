USE aryanDBassignment;

DROP PROCEDURE IF EXISTS sp_allergeenSelection;

DELIMITER $$

CREATE PROCEDURE sp_allergeenSelection(
    IN p_allergeenNaam VARCHAR(30)
)
BEGIN

    --  Check if NULL
    IF p_allergeenNaam IS NULL OR p_allergeenNaam = '' THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Please provide an allergen name.';
    END IF;


    -- Check if allergen exists
    IF NOT EXISTS (SELECT 1 FROM Allergeen WHERE Naam = p_allergeenNaam) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Allergen not found.';
    END IF;

    -- Return result
    WITH allergen_data AS (
        SELECT
             ALGE.ID AS ID
            ,ALGE.Naam AS Naam
            ,ALGE.Omschrijving AS Omschrijving
        FROM Allergeen AS ALGE
        WHERE ALGE.Naam = p_allergeenNaam
        ORDER BY Omschrijving ASC
    )
    SELECT
       AD.Omschrijving AS Omschrijving
    FROM allergen_data AS AD;

END$$

DELIMITER ;
