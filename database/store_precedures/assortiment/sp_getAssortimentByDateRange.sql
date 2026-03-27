# use database aryanDBassignment;
USE aryanDBassignment;

DROP PROCEDURE IF EXISTS sp_getAssortimentByDateRange;

DELIMITER $$

CREATE PROCEDURE IF NOT EXISTS sp_getAssortimentByDateRange(
    IN p_startDate DATE,
    IN p_endDate DATE
)
BEGIN
        # DECLARE VARIABLES
    DECLARE v_startDate DATE;
    DECLARE v_endDate DATE;

    # ASSIGN THE INCOMING PARAMETERS TO THE VARIABLES
    SET v_startDate = p_startDate;
    SET v_endDate = p_endDate;

    # GET THE DATA
    -- INCLUDE:
    -- LEVERANCIER NAAM, CONTACTPERSONEN, STAD VAN DE LEVERANCIER, PRODUCT NAAM, EINDDATUM LEVERING
    -- FILTER
    -- EINDDATUM LEVERING MUST BE BETWEEN THE START AND END DATE
    -- ORDER BY EINDDATUM LEVERING ASCENDING
    SELECT * FROM vw_AssortimentByDateRange
    WHERE EinddatumLevering BETWEEN v_startDate AND v_endDate
    ORDER BY EinddatumLevering ASC;

END$$
DELIMITER ;