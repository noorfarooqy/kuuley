const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/quizes/quizes.js', 'public/js')
    .js('resources/js/courses/lesson.js', 'public/js')
    .js('resources/js/courses/courses_list.js', 'public/js')
    .js('resources/js/courses/course_info.js', 'public/js')
    .js('resources/js/students/student_diag.js', 'public/js')
    .js('resources/js/quizes/quiz_report.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');