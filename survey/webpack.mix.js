const mix = require('laravel-mix');

mix.js('assets/js/audio.js', 'dist/js/' );
mix.js('assets/js/dashboard.js', 'dist/js/' );
mix.js('assets/js/app.js', 'dist/js/' );
mix.js('assets/js/confirm.js', 'dist/js/' );
mix.js('assets/js/date_picker.js', 'dist/js/' );
mix.js('assets/js/chart.js', 'dist/js/' );
mix.js('assets/js/installation.js', 'dist/js/' );
mix.js('assets/js/rules.js', 'dist/js/' );
mix.js('assets/js/createUser.js', 'dist/js/' );
mix.js('assets/js/user.js', 'dist/js/' );
mix.js('assets/js/login.js', 'dist/js/' );

mix.sass('assets/sass/app.scss' , 'dist/css');
mix.sass('assets/sass/login.scss' , 'dist/css').options({
    processCssUrls: false
});
