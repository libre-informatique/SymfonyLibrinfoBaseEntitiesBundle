#!/usr/bin/env sh
set -ev

mkdir --parents "${HOME}/bin"

# PHPUnit install
if [ ${TRAVIS_PHP_VERSION} '<' '5.6' ]; then
    PHPUNIT_PHAR=phpunit-4.8.phar
else
    PHPUNIT_PHAR=phpunit-5.7.phar
fi
wget "https://phar.phpunit.de/${PHPUNIT_PHAR}" --output-document="${HOME}/bin/phpunit"
chmod u+x "${HOME}/bin/phpunit"

# Coveralls client install
wget https://github.com/satooshi/php-coveralls/releases/download/v1.0.1/coveralls.phar --output-document="${HOME}/bin/coveralls"
chmod u+x "${HOME}/bin/coveralls"

#phpenv config-rm xdebug.ini

# Ugly hack
#mkdir --parents ${HOME}/phpenvini/
#echo 'memory_limit=2048M' > ${HOME}/phpenvini/myenv.ini
#phpenv config-add  ${HOME}/phpenvini/myenv.ini
echo "memory_limit=2G" >> ~/.phpenv/versions/$(phpenv version-name)/etc/conf.d/travis.ini

grep memory_limit ~/.phpenv/versions/$(phpenv version-name)/etc/conf.d/*.ini
grep memory_limit ~/.phpenv/versions/$(phpenv version-name)/etc/*.ini

#cat  ${HOME}/.phpenv/versions/$(phpenv version-name)/etc/conf.d/travis.ini

php -v

composer install --profile --prefer-dist --no-interaction -vvv

# To be removed when this issue will be resolved: https://github.com/composer/composer/issues/5355
#if [ "${COMPOSER_FLAGS}" = '--prefer-lowest' ]; then
#    composer update --prefer-dist --no-interaction --prefer-stable --quiet
#fi
#composer update --prefer-dist --no-interaction --prefer-stable ${COMPOSER_FLAGS}
