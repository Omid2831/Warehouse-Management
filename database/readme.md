### 1. Altering the foreign key to enforce one-to-one

```sql
ALTER TABLE Leverancier
MODIFY fk_ContactId SMALLINT UNSIGNED NULL UNIQUE;
```

* **`SMALLINT UNSIGNED`** – fine if your contact IDs are small numbers.
* **`NULL` allowed** – this is smart if sometimes a `Leverancier` may not yet have a `Contact`.
* **`UNIQUE`** – this is the critical part: it enforces that **no two Leverancier rows can reference the same Contact**, which is exactly what a one-to-one relationship requires. ✅

So this is the right approach to enforce one-to-one **without merging tables**.

---

### 2. Inserting new `Leverancier` with no contact yet

```sql
INSERT INTO Leverancier
(fk_ContactId, Naam, Contactpersoon, Leveranciernummer, Mobiel)
VALUES (NULL, 'Hom Food', 'Hom Ken', 'L1029234599', '06-23458477');
```

* **`fk_ContactId = NULL`** – allows insertion even though the corresponding `Contact` doesn’t exist yet.
* This prevents the foreign key error you would get if you tried to insert a non-existent contact ID. ✅

---

### 3. Updating `Id` after insertion

```sql
UPDATE Leverancier
SET Id = 7
WHERE Id = 19;
```

* Changing the primary key after insertion is usually **not recommended**, but if this was necessary for alignment with another system, it’s okay as long as you ensure no conflicts.
* Make sure **no foreign keys reference this Id** elsewhere, or you might break referential integrity.

---

### ✅ Best Practices / Notes

1. **Foreign key with UNIQUE is correct** for one-to-one. You did that.
2. **Insert with NULL first** if the dependent table may not yet exist — exactly what you did.
3. **Use transactions** if you plan to insert both Leverancier and Contact together:

```sql
START TRANSACTION;

INSERT INTO Contact (...) VALUES (...);
INSERT INTO Leverancier (fk_ContactId, ...) VALUES (LAST_INSERT_ID(), ...);

COMMIT;
```

* This ensures **both inserts succeed or fail together**, keeping one-to-one integrity.

4. Avoid updating primary keys after insertion unless necessary; ideally, set the correct ID on insert.

---

💡 **Summary:**

Your solution is valid. You:

* Modified the column with `UNIQUE` to enforce one-to-one.
* Inserted Leverancier with `NULL` for the foreign key to avoid errors.
* Updated the ID (optional, careful with FK constraints).

This is **the standard way to handle optional one-to-one relationships in SQL**.
