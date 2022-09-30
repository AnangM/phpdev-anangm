## PHP Dev Anang M
---

### How to run this app

1. Clone this repository `git clone https://github.com/AnangM/phpdev-anangm.git`

2. Change workdir to phpdev-anangm `cd phpdev-anangm`

3. Install dependencies `composer install`

4. Change necessary enivronment variables in `.env` and `.env.testing`

5. Generate passport key `php artisan passport:key`

6. Run migration and seed database `php artisan migrate --seed`

7. Link storage `php artisan storage:link`

8. Create passport password client id and client secret `php artisan passport:client --password` then store client id and secret

9. Run application `php artisan serve`

10. Or test application `php artisan test`

### Documentation

- Run application `php artisan serve`
- Go To `{baseurl}/api/documentation`
- Click `Authorize` button to authorize swagger, usernames and passwords detail are listed in the `Useful Credential` section of this document
- Make sure the token url are correct, it shouldbe `{baseurl}/oauth/token`
- (Optional) If token url are wrong, adjust it accordingly in file `app/config/l5-swagger.php` on options `default.securityDefinitions.passport.flows.password` or around line 196-198
- Fill required information 
```
username: fill with email from credential below
password: fill with corresponding password from credential below
client credential location: choose Authorization Header
client id: fill with client id generated from step 8 on How to run this app
client secret : fill with client secret generated from step 8 on How to run this app
```
-  Click `Authorize`
- You can play with any api in the docs by clicking the api and click `Try it out`


---
### App dependencies

- `laravel/passport` for OAuth2
- `spatie/laravel-permission` for role based access control
- `darkaonline/l5-swagger` for swagger documentation
- `crazybooot/base64-validation` for base64 validation
- `ramsey/uuid` for uuid generator

---
### Usefull URL
- `/api/documentation` for api documentation

---
### Useful Credential
- `john.doe@mail.com` as email/username witih `password` as password for Senior HRD role
- `lee.doe@mail.com` as email/username witih `password` as password for HRD role
- `client id` 9763f4c2-7aa1-499b-91a7-c31dedb256cb (only if using included .sql, if using migration this value may be different)
- `client secret` hp03sD5aPoXfgVnydXZgtbep9dtG1VuLMENKi5ue (only if using included .sql, if using migration this value may be different)