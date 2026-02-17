USE aryanDBassignment;

DROP PROCEDURE IF EXISTS sp_GetAllergenen;

DELIMITER $$

CREATE PROCEDURE sp_GetAllergenen()
BEGIN

    SELECT ALGE.Id
          ,ALGE.Naam
          ,ALGE.Omschrijving
    FROM Allergeen as ALGE
    ORDER BY ALGE.Naam ASC; -- Sort the result by the name of the allergen in ascensing order

END$$

DELIMITER ;