# Context

Date: 2026-09-23

The Tourfic demo importer was tested repeatedly with Contact Form 7 and with the Car frontend.

# Problem or Goal

Repeated imports created duplicate contact forms. Car demo data stored cancellation policies as the
string `[]`, which caused Tourfic price calculation to index a string as an array and terminate.

# Root Cause

Contact forms were always created without checking for an existing same-title form. The Car importer
looked for a nonexistent `cancellation_type` CSV field instead of decoding `calcellation_policy`.

# Changes Made (file-by-file)

- `inc/class/class-importer.php`: skip same-title contact forms and decode the actual cancellation
  policy field into an array.
- `tests/security/demo-import-structured-data.php`: cover idempotent form imports and JSON decoding.
- Tourfic `inc/functions/functions-car.php`: ignore malformed legacy policy rows at read time.
- Tourfic `tests/regression/car-cancellation-policy-robustness.php`: cover mixed valid and malformed
  policy records.

# Why This Change

Future imports now store the contract Tourfic expects. Existing sites recover without a data rewrite,
so the fix does not risk replacing user configuration.

# Validation Performed

- PHP lint and focused regressions passed.
- A repeated Tour import completed without increasing the contact-form count.
- An existing Car record containing the malformed string accepted a new date range and recalculated
  without a fatal error or a new debug log.

# Risks and Follow-ups

The final fresh Car reimport was interrupted before completion. The writer is covered by the isolated
regression, and the already-imported compatibility path was verified live.
