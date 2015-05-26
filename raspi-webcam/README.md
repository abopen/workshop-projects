# Raspberry Pi Webcam Configuration 

## Packages required

Install packages:

* uv4l
* uv4l-raspicam
* uv4l-raspicam-extras
* uv4l-server
* uv4l-webrtc

## Configuration

Repository contains configuration files for uv4l.

/etc/uv4l/uv4l-raspicam.conf contains image definition parameters (dimensions, format etc.), ones here are set to (mostly) fill update a chromium window in kiosk mode.

Note: When using text overlays, the size of the image has to be a specific multiple for the text to display properly. If you get corrupted text, choose again - multiples of 320x240 are good.

## Usage

The stream is available from: http://<machine>:8080/stream

## WebRTC

WebRTC isn't used in this example, but is installed for completeness.

You can get at the uv4l options at http://<machine>:8080/

## Text overlay update

There is no automatic way in uv4l to provide a time stamp on the image, but you can tell it to update the overlay.

There is a simple background script included to update the text overlay. It will read /etc/uv4l/text_template.json once a second and write to the file given in the uv4l config for "text-filename" and tell v4l2-ctl to update.

There is a simple $time option in the template file which is replaced with a time stamp.

Other replacement options could be added as required.

"text-filename" should ideally point to a path that is not on flash (eg. /run/shm), as the file is updated once a second.

An init.d script is included, use "update-rc.d -f uv4l_updateoverlay defaults" to add to rc.x.
