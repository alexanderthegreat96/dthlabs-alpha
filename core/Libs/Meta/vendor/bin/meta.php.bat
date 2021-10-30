@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../skrz/meta/bin/meta.php
php "%BIN_TARGET%" %*
