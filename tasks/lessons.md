# Lessons

## Demo importer validation must cross plugin boundaries

- A successful import is not enough. Repeat the same import to detect duplicate or destructive writes.
- Exercise the frontend consumer of imported structured data. A value can save successfully while
  still violating the type expected by Tourfic at runtime.
- Test both directions of a compatibility fix: correct future writes and tolerate already-saved
  malformed values without rewriting user data.
