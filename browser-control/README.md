# Simple web app to control a Chromium Kiosk Browser

## Required packages:

* lightdm
* matchbox
* nginx
* fcgiwrap
* php5-cli
* php5-fpm
* chromium

## nginx

The config files here enable php and other miscellaneous options.

## X

The window and display managers used are very lightweight - matchbox is specifically designed for this sort of thing.

The lightdm.conf supplied disables screen blanking and enables auto-login etc.

In the supplied home/pi there is an autostart script which starts up the first "kiosk" entry on start.

## sudo

Because the user the kiosk/X is running under is different from the webserver then you need to add an entry to sudoers so that "www-data" can run commands as "pi".

home/pi/camsel is a bash script which starts up chromium with the given URL. There is no direct way of telling chromium to replace its current window with a different one - it opens a new window/tab, so the current chromium process is killed first.

## Kiosk list

In usr/share/nginx/www/camlist is a list of the kiosk label/URL pairs which are read by the php scripts.

A label without a URL is considered to be custom and gives the user an entry box.

A file is stored in /tmp for keep track and highlighting the most recent selection.
