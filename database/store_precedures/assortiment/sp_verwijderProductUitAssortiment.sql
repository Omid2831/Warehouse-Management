# Use database AryanDBassignment;
USE aryanDBassignment;

# Drop the procedure if aleardy exists
DROP PROCEDURE IF EXISTS sp_verwijderProductUitAssortiment;

DELIMITER $$

# Create the stored procedure
CREATE PROCEDURE sp_verwijderProductUitAssortiment(
    IN p_productId INT
)
BEGIN
    DECLARE v_einddatum DATE;
    DECLARE v_today DATE;

    -- Get the end delivery date for the product
    SELECT EindDatumLevering INTO v_einddatum
    FROM ProductEinddatumLevering
    WHERE ProductId = p_productId;

    SET v_today = CURDATE();

    IF v_today > v_einddatum THEN
        -- Delete from child tables first
        DELETE FROM ProductPerAllergeen WHERE ProductId = p_productId;
        DELETE FROM ProductPerLeverancier WHERE ProductId = p_productId;
        DELETE FROM ProductEinddatumLevering WHERE ProductId = p_productId;
        DELETE FROM Magazijn WHERE ProductId = p_productId;
        -- Then delete from parent table
        DELETE FROM Product WHERE Id = p_productId;
        SELECT 'Product succesvol verwijderd' AS message;
    ELSE
        SELECT 'Product kan niet worden verwijderd, datum van vandaag ligt voor einddatum levering' AS message;
    END IF;
END$$

DELIMITER ;