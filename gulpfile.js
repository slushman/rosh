/**
 * WordPress Theme-specific Gulp file.
 *
 * Instructions
 *
 * In command line, cd into the project directory and run the following two commands:
 * npm init
 * sudo npm install --save-dev gulp gulp-util gulp-load-plugins browser-sync fs path event-stream
 * sudo npm install --save-dev gulp-sourcemaps gulp-autoprefixer gulp-filter gulp-merge-media-queries gulp-cssnano gulp-sass gulp-concat gulp-uglify gulp-notify gulp-imagemin gulp-rename gulp-wp-pot gulp-sort
 *
 * Implements:
 * 		1. Live reloads browser with BrowserSync.
 * 		2. CSS: Sass to CSS conversion, error catching, Autoprixing, Sourcemaps,
 * 			 CSS minification, and Merge Media Queries.
 * 		3. JS: Concatenates & uglifies JS files in sub-directories to respective files.
 * 		4. Images: Minifies PNG, JPEG, GIF and SVG images.
 * 		5. Watches files for changes in CSS or JS.
 * 		6. Watches files for changes in PHP.
 * 		7. Corrects the line endings.
 *      8. InjectCSS instead of browser page reload.
 *      9. Generates .pot file for i18n and l10n.
 *
 * @since 1.0.0
 * @author Ahmad Awais (@mrahmadawais) and Chris Wilcoxson (@slushman)
 */

var project = {
	'url': 'rosh.dev',
	'i18n': {
		'domain': 'rosh',
		'destFile': 'rosh.pot',
		'package': 'Rosh',
		'bugReport': 'http://www.dccmarketing.com/contact',
		'translator': 'Chris Wilcoxson <chrisw@dccmarketing.com>',
		'lastTranslator': 'DCC Marketing <web@dccmarketing.com>',
		'path': './assets/languages',
	}
};

var watch = {
	'php': './*.php',
	'scripts': {
		'path': './src/js/',
		'source': './src/js/**/*.js',
	},
	'styles': './src/sass/**/*.scss',
}

/**
 * Browsers you care about for autoprefixing.
 */
const AUTOPREFIXER_BROWSERS = [
	'last 2 version',
	'> 1%',
	'ie >= 9',
	'ie_mob >= 10',
	'ff >= 30',
	'chrome >= 34',
	'safari >= 7',
	'opera >= 23',
	'ios >= 7',
	'android >= 4',
	'bb >= 10'
];

/**
 * Load gulp plugins and assing them semantic names.
 */
var gulp 			= require( 'gulp' ); // Gulp of-course
var plugins 		= require( 'gulp-load-plugins' )();
var browserSync 	= require( 'browser-sync' ).create(); // Reloads browser and injects CSS.
var reload 			= browserSync.reload; // For manual browser reload.
var fs 				= require( 'fs' );
var path 			= require( 'path' );
var es 				= require( 'event-stream' );

/**
 * Creates style files and put them in the root folder.
 */
gulp.task( 'styles', function () {
	gulp.src( watch.styles )
		.pipe( plugins.sourcemaps.init() )
		.pipe( plugins.sass( {
			errLogToConsole: true,
			includePaths: ['./sass'],
			outputStyle: 'compact',
			precision: 10
		} ) )
		.on('error', console.error.bind(console))
		.pipe( plugins.autoprefixer( AUTOPREFIXER_BROWSERS ) )
		.pipe( plugins.sourcemaps.write ( './', { includeContent: false } ) )
		.pipe( plugins.filter( '**/*.css' ) ) // Filtering stream to only css files
		.pipe( plugins.mergeMediaQueries( { log: true } ) ) // Merge Media Queries
		.pipe( plugins.cssnano() )
		.pipe( gulp.dest( './' ) )

		.pipe( plugins.filter( '**/*.css' ) ) // Filtering stream to only css files
		.pipe( browserSync.stream() ) // Reloads style.css if that is enqueued.
		.pipe( plugins.notify( { message: 'TASK: "styles" Completed! 💯', onLast: true } ) );
});

/**
 * Returns all the folders in a directory.
 *
 * @see 	https://gist.github.com/jamescrowley/9058433
 */
function getFolders( dir ){
	return fs.readdirSync( dir )
		.filter(function( file ){
			return fs.statSync( path.join( dir, file ) ).isDirectory();
	});
}

/**
 * Creates a minified javascript file for each folder in the source directory.
 */
gulp.task( 'scripts', function() {
	var folders = getFolders( watch.scripts.path );

	var tasks = folders.map( function( folder ) {

		return gulp.src( path.join( watch.scripts.path, folder, '/*.js' ) )
			.pipe( plugins.concat( folder + '.js' ) )
			.pipe( plugins.uglify() )
			.pipe( plugins.rename( folder + '.min.js' ) )
			.pipe( gulp.dest( './assets/js' ) );
	});

	return es.concat.apply( null, tasks )
		.pipe( plugins.notify( { message: 'TASK: "scripts" Completed! 💯', onLast: true } ) );
});

/**
 * Live Reloads, CSS injections, Localhost tunneling.
 *
 * @link http://www.browsersync.io/docs/options/
 */
gulp.task( 'browser-sync', function() {
	browserSync.init({
		proxy: project.url,
		host: project.url,
		open: 'external',
		injectChanges: true,
		browser: "google chrome"
	});
});

/**
 * Minifies PNG, JPEG, GIF and SVG images.
 */
gulp.task( 'images', function() {
	gulp.src( './assets/images/*.{png,jpg,gif,svg}' )
		.pipe( plugins.imagemin({
			progressive: true,
			optimizationLevel: 3, // 0-7 low-high
			interlaced: true,
			svgoPlugins: [{removeViewBox: false}]
		}))
		.pipe( gulp.dest( './assets/images/' ) )
		.pipe( plugins.notify( { message: 'TASK: "images" Completed! 💯', onLast: true } ) );
});

/**
 * WP POT Translation File Generator.
 */
gulp.task( 'translate', function () {
	return gulp.src( watch.php )
		.pipe( plugins.sort() )
		.pipe( plugins.wpPot( project.i18n ))
		.pipe( gulp.dest( project.i18n.path ) )
		.pipe( plugins.notify( { message: 'TASK: "translate" Completed! 💯', onLast: true } ) );
});

/**
* Watches for file changes and runs specific tasks.
*/
gulp.task( 'default', ['translate', 'images', 'browser-sync', 'styles', 'scripts'], function () {
	gulp.watch( watch.php, reload ); // Reload on PHP file changes.
	gulp.watch( watch.styles, ['styles', reload] ); // Reload on SCSS file changes.
	gulp.watch( watch.scripts.source, [ 'scripts', reload ] ); // Reload on publicJS file changes.
});
