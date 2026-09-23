# TravelFic Toolkit AJAX Import Authorization Fix

## Scope

- Fix the eight destructive demo-import AJAX handlers in `inc/class/class-importer.php`.
- Require the same administrator capability used by the template-library screen.
- Preserve administrator imports and existing nonce validation.
- Review Tourfic Free, Pro, Vendor, iCal, Toolkit, and TravelFic theme dependencies.

## Plan

- [x] Inspect the Toolkit tree, branch, and all registered import handlers.
- [x] Map nonce exposure, template-library capability, JavaScript callers, and sibling dependencies.
- [x] Add a shared nonce and `manage_options` authorization boundary.
- [x] Add focused static and live Subscriber/administrator regression coverage.
- [x] Run PHP lint, repository checks, live AJAX checks, and administrator workflow validation.
- [x] Audit the final diff for minimality and compatibility.
- [x] Create reasoning and tutorial documentation.
- [x] Present the reviewed diff without committing or pushing.

## Guardrails

- Do not execute the destructive proof-of-concept requests before authorization is in place.
- Do not commit or push without explicit user approval.

## Review Results

- Confirmed eight affected AJAX handlers: global settings, Customizer, pages, menus, widgets, hotels,
  tours, and cars.
- The nonce is localized by a script enqueued on every admin page, but nonces are not authorization;
  the new shared guard requires `manage_options` before any import processing or mutation.
- The existing Bricks importer now uses the same guard. Theme switching, template sync, and plugin
  activation handlers retain their existing dedicated capability checks.
- The template-library screen already requires `manage_options`, so legitimate UI access and the new
  server-side boundary match.
- No Tourfic Free, Pro, Vendor, iCal, or TravelFic theme code calls or overrides these handlers.
- Static regression checks passed for all eight action registrations, guard ordering, nonce
  validation, capability enforcement, and HTTP 403 response.
- The live WordPress matrix called all eight actions with a valid Subscriber nonce. Every request
  returned JSON failure with HTTP 403, and a before/after fingerprint proved no site content or
  setting changed.
- An administrator with a valid nonce passed the shared guard.
- PHP lint and `git diff --check` passed. No asset build is required because no JavaScript or Sass
  changed.

# Demo Import Runtime Blockers

## Plan

- [x] Reproduce Hotel, Tour, and Car imports in isolated WordPress databases.
- [x] Normalize structured Car cancellation-policy metadata during import.
- [x] Preserve existing Contact Form 7 forms during repeated imports.
- [x] Defensively ignore malformed legacy cancellation-policy entries in Tourfic.
- [x] Add focused regressions for both defects.
- [x] Repeat the Contact Form 7 and legacy Car browser paths and review debug logs.
- [x] Document validation evidence and remaining risk.

## Guardrails

- Do not overwrite existing contact forms or user settings.
- Do not migrate or rewrite saved Car data; tolerate malformed legacy values at read time.
- Do not commit or push without explicit user approval.

## Review Results

- A repeated Tour demo import completed at 100% while the Contact Form 7 count remained at three.
- A Car page containing the previously fatal string value `[]` accepted a new date range, recalculated
  the price, and produced no new debug log.
- The isolated importer regression proves the corrected CSV field decodes valid JSON, preserves an
  empty policy as an array, rejects invalid JSON, and leaves same-title contact forms unchanged.
- The isolated Tourfic regression proves malformed legacy entries are skipped while valid policies
  in the same record remain usable.
- The final fresh Car reimport was interrupted before completion. The structured-data regression
  covers the writer, while the live browser check covers the existing-data recovery path.
