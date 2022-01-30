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
    .vue()
    .postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss'),
    ])
    .webpackConfig({
        module: {
          rules: [
            {
              test: /\.(postcss)$/,
              use: [
                'vue-style-loader',
                { loader: 'css-loader', options: { importLoaders: 1 } },
                'postcss-loader'
              ]
            }
          ],
        },
      })

    
if (mix.inProduction()) {
    mix.version().purgeCss();
}