##Brewski

Laravel-based blogging app that you shouldn't use because it was written by a hack (me) and still needs lots of work. In spite of that, it is now running my blog
at [http://thereluctantdeveloper.com](http://thereluctantdeveloper.com).


####Initial Features:
- Laravel-based
- Theme-able
- Basic Disqus integration
- Responsive Admin (bootstrap)
- Markdown-based editor

####TODO
- Caching
- Tags
- Page Creation
- Search
- Unit Tests
- Lots of code cleanup/refactoring

####Once Again - I advise against using it at this time. However, if you must....

- Install the app like you would any other basic Laravel install.
- Rename default.env.php to .env.php and populate the array.
- Rename app/Brewski/default.config.json to config.json (Can be managed via Options in the admin afterward)
- Update the UsersTableSeeder with your info.
- run `php artisan migrate --seed` to populate the database and add the admin user
- Fix the other stuff that's likely to still be broken after doing the above


####License

Brewski is free software distributed under the terms of the MIT license.