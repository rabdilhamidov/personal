@ECHO OFF
SET BIN_TARGET=%~dp0/../vendor/Doctrine/orm/bin/doctrine
php "%BIN_TARGET%" %*
