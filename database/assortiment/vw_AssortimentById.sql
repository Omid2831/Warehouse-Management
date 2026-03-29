# USE aryanDBassignment DATABASE
USE aryanDBassignment;


# Drop the view if it already exists
DROP VIEW IF EXISTS vw_AssortimentById;

# Create the view
CREATE OR REPLACE VIEW vw_AssortimentById AS
SELECT
    P.Id AS productId,
    P.Naam AS productNaam,
    P.Barcode AS barcode,
    A.Naam AS allergeenNaam,
    E.EindDatumLevering
FROM
    Product P
    INNER JOIN ProductEinddatumLevering E
            ON P.Id = E.ProductId
    LEFT JOIN ProductPerAllergeen PA
            ON P.Id = PA.ProductId
    LEFT JOIN Allergeen A
            ON PA.AllergeenId = A.Id
WHERE
    E.EindDatumLevering IS NOT NULL
ORDER BY
    E.EindDatumLevering DESC;
