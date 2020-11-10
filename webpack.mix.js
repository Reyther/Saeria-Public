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

mix.extend('customConfig', webpackConfig => {
  // Register "@" alias
  webpackConfig.resolve.alias = {
    vue$: 'vue/dist/vue.common.js', // Already exists
    '@': __dirname + '/resources',
  };

  // Import the sass lib in every Sass file
  // Doing it manually since options in .sass(src, dest, options) doesn't work with .vue files
  webpackConfig.module.rules.forEach(r => {
    ['loaders', 'use'].forEach(key => {
      if (key in r) {
        r[key].forEach(u => {
          if (u.loader === 'sass-loader') {
            if (!u.options) {
              u.options = {};
            }

            u.options.prependData = '@import "@/scss/lib/_lib.scss";';
          }
        });
      }
    });
  });
});

mix.webpackConfig({
  module: {
    rules: [
      {
        enforce: 'pre',
        exclude: /node_modules/,
        loader: 'eslint-loader',
        test: /\.(js|vue)?$/,
      },
    ],
  },
});

mix
  .js('resources/js/app.js', 'public/js')
  .sass('resources/scss/main.scss', 'public/css')
  .options({ extractVueStyles: true })
  .customConfig()
  .version(['public/images']);

if (mix.inProduction()) {
  mix.styles(
    ['node_modules/normalize.css/normalize.css', 'public/css/main.css'],
    'public/css/main.css'
  );
} else {
  mix
    .styles(
      'node_modules/normalize.css/normalize.css',
      'public/css/normalize.css'
    )
    .sourceMaps();
}
