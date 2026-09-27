# Publishing to GitHub

Recommended repository name:

```text
bbrainy-class-management
```

From the project directory:

```bash
git init -b main
git add .
git commit -m "Initial commit: BRAINY class management web app"
git remote add origin https://github.com/marckhak/bbrainy-class-management.git
git push -u origin main
```

If the GitHub repository was created with an automatic README, LICENSE or `.gitignore`, and it contains no important work, you can replace the initial remote history with the local project:

```bash
git push -u origin main --force
```

Before publishing, make sure `config.php` is not tracked. It is intentionally excluded by `.gitignore`.

To create the local configuration:

```bash
cp config.example.php config.php
```

Then edit `config.php` with your database settings.

Do not commit production credentials or real student/user data.
