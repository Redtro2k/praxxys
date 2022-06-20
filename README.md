-* Step 1. clone my exam using git

-* Step 2. update/install using composer & npm 
     commands: "composer update" for composer
               "npm install" for node, after installing "npx mix watch" paste it.

-* Step 3. make .env paste on your terminal "cp .env.example .env"

-* Step 4. make a database on your localhost called "praxxys_exam"

-* Step 5. generate key for laravel paste it on terminal "php artisan
key:generate"

-* Step 6. generate a public shortcut storage paste in on terminal "php artisan storage:link"

-* Step 7. migrate the all of the tables "php artisan migrate"

-* Step 8. run seeder these 2 
          "php artisan db:seed --class=AdminSeeder"
          "php artisan db:seed --class=CategorySeeder"

-* Step 9. final step run, type in your terminal "php artisan serve"