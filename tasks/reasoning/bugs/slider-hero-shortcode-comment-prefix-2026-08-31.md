# Slider Hero comment references updated to tourfic_search_form

## Context

Branch `fix/wordpress-org-compliance` in TravelFic Toolkit aligns every
Tourfic Free runtime contract consumed by the toolkit with Free's
`tf_` → `tourfic_` prefix migration (shortcodes, helpers, constants,
filter, option keys) and bumps the version to 1.5.4. The executable
shortcode calls in `SliderHero.php` were already migrated to
`[tourfic_search_form]`, but three prose comments still referenced the
legacy `[tf_search_form]` tag.

## Problem or Goal

Comments describing the current shortcode contract must not advertise
the retired `tf_search_form` name after the migration, otherwise future
readers may reintroduce or copy the stale identifier.

## Root Cause

The prefix migration pass renamed executable call sites only; prose
comments referencing the shortcode were not part of the token positions
covered by the rename.

## Changes Made (file-by-file)

- `inc/Components/SliderHero.php`
  - Line 31 inline comment: `[tf_search_form]` → `[tourfic_search_form]`.
  - `get_type()` docblock (line ~486): same update.
  - `get_tab_attrs()` docblock (line ~497): same update.

## Why This Change

Keeps documentation consistent with the migrated shortcode contract and
avoids re-anchoring the retired short prefix in fresh code.

## Validation Performed

- `php -l inc/Components/SliderHero.php` — no syntax errors.
- `rg 'tf_search_form|tf_cars\b|tf_data_types' inc/` — zero matches;
  no stale executable or prose references remain in `inc/`.
- The commented-out legacy AJAX hook line in `class-template-list.php`
  was intentionally left untouched (dead code, not a live contract).

## Risks and Follow-ups

- None: comment-only change, no runtime effect.
- Follow-up: decide whether to commit the untracked `tasks/` directory
  with the compliance commit or keep it local.
