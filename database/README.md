# Database

BRAINY uses MySQL/MariaDB for authentication, class scheduling, announcements, exam management and user subscriptions.

## Schema

`schema.sql` contains a **sanitized schema-only export** based on the original database dump. It contains table definitions, indexes and the foreign-key constraints present in the original dump, but no production records or credentials.

Import it with:

```bash
mysql -u YOUR_USER -p < database/schema.sql
```

The original database contains these tables:

- `users`
- `messages`
- `esami`
- `registrazioni`
- `announcements`
- `announcements_table`
- `class_appointments`
- `personal_appointments`
- `notification_queue`
- `user_subscriptions`

For security and privacy reasons, the production data dump is intentionally not included in this repository.
