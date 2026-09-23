# Demo Import Runtime Blockers

## Date

2026-09-23

## Scope

Make repeated demo imports idempotent and prevent malformed imported Car cancellation data from
breaking price calculations.

## Touched plugins

- TravelFic Toolkit
- Tourfic Free

## Branch names used

- Toolkit: `fix/wordpress-org-compliance`
- Tourfic Free: `fix/wordpress-org-compliance-empty-metabox-tabs`

## Problem Statement

Repeating a demo import created duplicate Contact Form 7 forms. A Car demo import stored cancellation
policy JSON as a string, and the Tourfic frontend later treated each string character as a policy row.

## Impact and Reproduction

The form count increased on every repeat import. Selecting Car dates called the pricing endpoint,
which failed with `Cannot access offset of type string on string`.

## Investigation Path (step-by-step)

1. Imported Hotel, Tour, and Car demos into isolated databases.
2. Repeated the import and compared forms, posts, menus, settings, and attachments.
3. Selected a Car date range with debug logging enabled.
4. Traced the fatal from Tourfic's policy reader back to Toolkit's CSV importer.
5. Compared the CSV field list with the decoder condition.

## Root Cause

The contact-form importer had no identity check. The Car importer decoded `cancellation_type`, but the
CSV field is named `calcellation_policy`, so the JSON remained a string.

## Changes Made (file-by-file)

- Toolkit importer now preserves a same-title contact form and decodes cancellation policy JSON.
- Tourfic policy readers now skip entries that do not satisfy the expected array contract.
- Focused regressions cover repeat imports, JSON decoding, and mixed legacy policy values.

## Why Each Change Was Needed

The writer correction prevents new malformed records. The reader guard is separately required for
sites that already imported the old value. Neither path rewrites stored customer data.

## Removed/Reverted Changes and Why

No data migration was added. A migration would introduce unnecessary write and rollback risk when a
safe read-time fallback is sufficient.

## Validation Evidence

- Both focused regression scripts pass.
- PHP lint passes for the changed runtime files.
- Repeat Tour import completed without adding Contact Form 7 forms.
- Existing malformed Car data no longer causes a fatal during date selection and pricing.

## Regression Risk Review

Valid cancellation policies continue through the existing calculations unchanged. Invalid rows are
ignored instead of terminating the request. Existing same-title forms remain under site-owner control.

## Follow-up Notes

The final fresh Car reimport was interrupted before completion. Run that final browser path before a
release candidate is signed off, even though the writer and compatibility paths have focused coverage.
