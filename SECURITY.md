# Security Notes

This repository is a portfolio publication of a school web application.

Before deploying it publicly:

- create a local `config.php` from `config.example.php`;
- never commit database credentials;
- use HTTPS in production;
- review administrator authorization rules;
- review session cookie security settings;
- use a dedicated production database user with least privilege;
- do not import real student/user data into a public repository.

The original archive did not include a database dump.
