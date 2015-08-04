## Guillaume Dufrenne

### Install

 * Setup `.env` file to match local configuration
 * `bower install`
 * `npm install`
 * `gulp`
 * `composer install`
 * `chmod -R 0777 storage`
 * `php artisan serve`
 * Visit http://localhost:8000

### cURL error

If encounting "cURL error 60: SSL certificate problem: unable to get local issuer certificate (see http://curl.haxx.se/libcurl/c/libcurl-errors.html)"

 * Download from https://gist.github.com/VersatilityWerks/5719158/download
 * Unzip
 * Copy to `~/.ssh/cacert.pem`
 * Edit php.ini to `curl.cainfo = /path-to/.ssh/cacert.pem`
