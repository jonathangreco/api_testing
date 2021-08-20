# Steps

- composer create-project symfony/skeleton api_testing
- composer require doctrine "lexik/jwt-authentication-bundle"
- Check .env for passphrase and config is setted
- php bin/console lexik:jwt:generate-keypair 
- Put my config for form_login and proper firewall
- develop entities User and Role
- Add a Cli command to set a new user with password
- Expose an API to fetch users in /api/users
