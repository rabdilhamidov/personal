@ECHO OFF
SET BIN_TARGET=%~dp0/../vendor/Doctrine/dbal/bin/doctrine-dbal
php "%BIN_TARGET%" %*
