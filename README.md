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
- `john.doe@mail.com` as email witih `password` as password for Senior HRD role
- `lee.doe@mail.com` as email witih `password` as password for HRD role