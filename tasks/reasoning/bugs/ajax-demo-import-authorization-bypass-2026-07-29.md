# TravelFic Toolkit AJAX Demo-Import Authorization Bypass

## Context

- Date: 2026-07-29
- Reported versions: TravelFic Toolkit 1.5.0 and earlier
- Local source version: 1.4.2
- Classification: Broken Access Control
- Attacker role: Subscriber
- Touched plugin: TravelFic Toolkit
- Reviewed components: Tourfic Free, Pro, Vendor, iCal, and TravelFic theme
- Working branch: `khoyer-staging`

## Problem or Goal

Eight authenticated AJAX handlers accepted the globally localized `updates` nonce without checking
whether the caller was authorized to run the administrator-only demo importer. A Subscriber could
therefore reach handlers that replace global settings, Customizer values, pages, menus, widgets, and
Tourfic demo inventory.

The goal was to reject every non-administrator before any remote request, option write, content
deletion, or import operation while preserving the existing administrator workflow and nonce check.

## Root Cause

- `travelfic_toolkit_admin_page_script()` enqueues and localizes the importer nonce on every admin
  page, including pages available to Subscribers.
- The eight handlers called `check_ajax_referer()` but did not call `current_user_can()`.
- A valid nonce proves request intent for the current session; it does not grant permission.
- The template-library screen already requires `manage_options`, but that UI capability was not
  repeated at the server-side AJAX boundary.

## Changes Made (file-by-file)

- `inc/class/class-importer.php`
  - Adds `verify_import_request()` with the existing nonce validation and a `manage_options` check.
  - Returns a JSON error with HTTP 403 for unauthorized callers.
  - Calls the guard first in all eight reported handlers.
  - Routes the already-protected Bricks importer through the same guard to prevent policy drift.
- `tests/security/importer-authorization-security.php`
  - Verifies all eight action registrations remain present.
  - Verifies the shared nonce, capability, and 403 response.
  - Verifies every handler authorizes before its first import operation.
- `tests/security/importer-authorization-live.php`
  - Calls all eight real callbacks with a valid Subscriber nonce.
  - Verifies JSON denial, HTTP 403, and no site-content/settings mutation.
  - Verifies an administrator with a valid nonce passes the shared guard.

## Why This Change

`manage_options` matches the capability already required by the template-library screen and the
existing Bricks/template-sync import paths. A shared guard keeps the authorization rule identical
across every destructive importer and ensures nonce validation remains mandatory.

The nonce can remain localized without being treated as a secret. Security depends on the
capability check, which WordPress evaluates for the authenticated caller on every request.

## Validation Performed

- PHP lint passed for the importer and both new security tests.
- Static importer authorization regression passed.
- Live WordPress authorization matrix passed for all eight actions:
  - Valid Subscriber nonce returned JSON failure and HTTP 403.
  - No tracked option, theme modification, widget state, menu count, page, hotel, tour, or car count
    changed.
  - Administrator with a valid nonce passed the guard.
- Local validation context:
  - TravelFic Toolkit active.
  - TravelFic theme active.
  - Administrator and Subscriber fixtures present.
- `git diff --check` passed.
- No JavaScript or Sass changed, so no asset build was required.

## Risks and Follow-ups

- Administrator imports remain intentionally destructive and should still be preceded by a backup.
- The admin script continues to expose a nonce to authenticated users. This is safe after the
  capability fix because WordPress nonces are not authorization credentials.
- The broader importer contains legacy formatting and data-handling patterns that are outside this
  narrowly scoped authorization fix.
- No version bump, commit, or push was performed.
