# Year shortcode compatibility and rollback

The public shortcode is `[travelfic_toolkit_year]`. The old generic `[year]`
registration is removed to avoid collisions with other plugins. On upgrade,
an administrator request migrates up to 50 posts at a time. Until every batch
has completed, frontend post and widget rendering translates simple `[year]`
tokens in memory. The active theme's saved footer copyright is migrated on the
first administrator request or theme switch.

Before changing a post, Toolkit saves its original `post_content` in
`_travelfic_toolkit_year_shortcode_backup_v1`. For Elementor JSON it saves
`_elementor_data` in `_travelfic_toolkit_year_elementor_backup_v1`. The old
footer value is saved once in the option
`travelfic_toolkit_year_footer_backup_v1_<stylesheet>`. The progress cursor is
`travelfic_toolkit_year_shortcode_migration_v1`.

If any backup or write fails, migration stops and an administrator notice is
shown. It does not skip the failed record. Do not clear the error flag until
the cause has been diagnosed and a fresh site/database backup has been made.

Rollback is a support operation, not an automatic plugin downgrade: restore
the database/site backup taken before upgrading, or restore the original
individual values from the backup meta/option keys above while retaining the
plugin version that understands `[year]`. Restoring only old `[year]` content
into this version is still rendered by the in-memory compatibility filter, but
the generic shortcode is not registered. Do not delete the backup keys until
the upgrade has been verified on the customer's site.
