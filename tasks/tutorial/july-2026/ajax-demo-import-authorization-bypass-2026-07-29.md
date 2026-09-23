# Fixing TravelFic Toolkit Demo-Import Authorization

## Metadata

- Date: 2026-07-29
- Scope: Eight destructive authenticated AJAX import handlers
- Touched plugins: TravelFic Toolkit
- Reviewed components: Tourfic Free, Pro, Vendor, iCal, and TravelFic theme
- Branch names used:
  - TravelFic Toolkit: `khoyer-staging`
  - Tourfic Free: `khoyer-staging` (review only)
  - Tourfic Pro: `khoyer-staging` (review only)
  - Tourfic Vendor: `master` (review only)
  - Tourfic iCal: `ical-improvement` (review only)
  - TravelFic theme: `khoyer-staging` (review only)
- Validation summary: All eight Subscriber requests fail with HTTP 403 and zero site mutations;
  administrator authorization, static coverage, PHP lint, and diff checks pass.

## Problem Statement

TravelFic Toolkit registered eight demo-import actions that were reachable by every authenticated
WordPress account. Each action checked the shared `updates` nonce, but none verified that the caller
could access the administrator-only template library.

## Impact and Reproduction

A Subscriber could obtain the localized nonce from an admin page and submit a request to an import
action. Depending on the chosen action, the handler could replace site identity and Customizer
settings, delete and recreate pages, change the front page, rebuild menus, clear widgets, or import
hotel, tour, and car content.

The destructive proof of concept was not executed against the local site before the fix. The source
made the authorization failure deterministic: every affected handler entered import processing
immediately after `check_ajax_referer()` with no capability check.

## Investigation Path (step-by-step)

1. Enumerated every `wp_ajax_*` hook in TravelFic Toolkit.
2. Mapped the eight reported action names to their callback methods.
3. Read each handler through its first remote request or destructive operation.
4. Confirmed the nonce is localized by `admin_enqueue_scripts` for every admin screen.
5. Verified the template-library screen itself requires `manage_options`.
6. Checked the Bricks importer, template sync, theme switch, and plugin activation handlers for
   existing capability checks.
7. Searched Tourfic Free, Pro, Vendor, iCal, and the TravelFic theme for handler callers or
   overrides; none were found.
8. Implemented one shared guard and routed all demo importers through it.
9. Ran static and live authorization matrices without executing an administrator import.

## Root Cause

The implementation treated a WordPress nonce as an authorization credential. Nonces mitigate CSRF,
but a logged-in Subscriber can legitimately receive and use a nonce created for that session.
Authorization requires an independent capability decision.

## Changes Made (file-by-file)

### `inc/class/class-importer.php`

- Adds a private importer guard that validates the nonce and requires `manage_options`.
- Returns a structured JSON error with HTTP 403 when the capability check fails.
- Calls the guard before work begins in global settings, Customizer, pages, menus, widgets, hotels,
  tours, cars, and Bricks imports.

### `tests/security/importer-authorization-security.php`

- Protects the eight-action matrix, route registrations, guard implementation, and execution order.

### `tests/security/importer-authorization-live.php`

- Exercises all eight callbacks as a Subscriber with a valid nonce.
- Captures JSON and HTTP status without allowing the process to exit between actions.
- Fingerprints site state to prove denied requests do not mutate content or settings.
- Invokes the same guard as an administrator positive control.

## Why Each Change Was Needed

- Keeping `check_ajax_referer()` preserves CSRF protection.
- Adding `manage_options` matches the actual template-library access policy.
- Returning HTTP 403 makes the authorization failure explicit to clients and logs.
- Centralizing the rule avoids eight duplicated checks diverging over time.
- Static and live tests cover both code wiring and runtime behavior.

## Removed/Reverted Changes and Why

- The nonce was not removed or replaced; it remains necessary for CSRF protection.
- The admin script was not changed. A nonce does not need to be hidden once the server enforces
  authorization, and changing script loading could affect unrelated setup UI behavior.
- No importer payload, remote URL, deletion rule, or administrator workflow was changed.
- No asset build, version bump, commit, or push was performed.

## Validation Evidence

- Static baseline:
  - Eight handlers contained nonce-only authorization.
  - The Bricks importer and template sync already used `manage_options`.
- After the fix:
  - Eight of eight valid-nonce Subscriber callbacks returned JSON failure and HTTP 403.
  - Before/after site fingerprints matched.
  - An administrator with the same valid nonce passed the shared guard.
- Passed:
  - PHP lint for every changed PHP file.
  - Static importer authorization test.
  - Live WordPress importer authorization test.
  - `git diff --check`.

## Regression Risk Review

- The capability matches the existing screen, so legitimate administrators retain access.
- JavaScript action names, request parameters, success payloads, and import sequencing are unchanged.
- Tourfic and theme components have no direct dependency on these callback methods.
- Unauthorized error responses now correctly use HTTP 403; the existing JavaScript error callbacks
  already handle non-2xx responses.

## Follow-up Notes

- Keep all future destructive importer actions behind `verify_import_request()`.
- Do not weaken the guard to `is_user_logged_in()` or rely on the nonce alone.
- Consider a separate importer-hardening review for remote response validation and legacy data
  deserialization; those topics are outside this access-control patch.
