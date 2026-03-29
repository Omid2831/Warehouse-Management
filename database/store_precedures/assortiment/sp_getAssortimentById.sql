# use database aryanDBassignment;
USE aryanDBassignment;

# Drop the procedure if it already exists
DROP PROCEDURE IF EXISTS sp_getAssortimrentById;

DELIMITER $$

# Create the stored procedure
CREATE PROCEDURE sp_getAssortimentById(
    IN p_productId INT
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        -- Rollback the transaction if any error occurs
        ROLLBACK;
        -- Optionally, you can signal an error or set an output variable/message
        SELECT 'An error occurred, transaction rolled back.' AS error_message;
    END;

    START TRANSACTION;

    -- Get the data for the specified product ID
    -- INCLUDE:
    -- PRODUCT ID, PRODUCT NAAM, BARCODE, ALLERGEEN NAAM, EINDDATUM LEVERING

    SELECT * FROM vw_AssortimentById
    WHERE productId = p_productId
    ORDER BY EinddatumLevering DESC;

    COMMIT;
END$$

DELIMITER ;