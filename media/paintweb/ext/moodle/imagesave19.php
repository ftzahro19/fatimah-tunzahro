<?php
/*
 * Copyright (C) 2009 Mihai Şucan
 *
 * This file is part of PaintWeb.
 *
 * PaintWeb is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * PaintWeb is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with PaintWeb.  If not, see <http://www.gnu.org/licenses/>.
 *
 * $URL: http://code.google.com/p/paintweb $
 * $Date: 2009-11-06 15:55:50 +0200 $
 */

// This script performs asynchronous image save in PaintWeb. This is used by the 
// Moodle extension of PaintWeb, to save image edits. You should not include 
// this script yourself.

// This script only works with Moodle 1.9.

// The Moodle extension (see paintweb/src/extensions/moodle.js) calls this 
// script with several parameters:
//   - url: the URL of the image being edited. '-' is used for images with data 
//   URLs.
//
//   - dataURL: the dataURL generated by the browser. This holds the 
//   base64-encoded content of the image.
//
// The image is saved only if the user is logged-in, and only if the file type 
// is known (that is, PNG or JPEG). The image is saved in the Moodle data dir, 
// in the paintweb_images folder.

require_once('../../../../config.php');

/**
 * Send the JSON object result to PaintWeb.
 *
 * @param string $url The image URL we are saving/updating.
 * @param string $urlnew The new image URL generated for the saved image.
 * @param boolean $successful Tells if the save operation was successful or not.
 * @param string $errormessage Holds an error message if the save operation 
 * failed.
 */
function paintweb_send_result($url, $urlnew, $successful, $errormessage=null) {
    $output = array(
        'successful'   => $successful,
        'url'          => $url,
        'urlNew'       => $urlnew,
        'errorMessage' => $errormessage
    );

    echo json_encode($output);
    exit;
}

// The list of allowed image MIME types associated to file extensions.
$imgallowedtypes = array(
    'image/png'  => 'png',
    'image/jpeg' => 'jpg'
);

if (empty($CFG->paintwebImagesFolder)) {
    $CFG->paintwebImagesFolder = 'paintweb_images';
}

// The PaintWeb image viewer file serve script.
$pwproxy = dirname(__FILE__) . '/imageview19.php';

$imgurl = optional_param('url', '', PARAM_URL);
$imgurlnew = null;
$imgdataurl = required_param('dataURL', PARAM_RAW);

if (empty($imgurl)) {
    $imgurl = '-';
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isloggedin()) {
    paintweb_send_result($imgurl, $imgurlnew, false,
        get_string('moodleServer:permissionDenied', 'paintweb'));
}

if (empty($imgdataurl)) {
    paintweb_send_result($imgurl, $imgurlnew, false,
        get_string('moodleServer:saveEmptyDataUrl', 'paintweb'));
}

if (!file_exists($pwproxy)) {
    paintweb_send_result($imgurl, $imgurlnew, false,
        get_string('moodleServer:proxyNotFound', 'paintweb'));
}

if (strpos($pwproxy, $CFG->dirroot) === 0) {
    $pwproxy = trim(substr($pwproxy, strlen($CFG->dirroot)), '/');
} else {
    paintweb_send_result($imgurl, $imgurlnew, false,
        get_string('moodleServer:proxyNotFound', 'paintweb'));
}

// A data URL starts like this:
// data:[<MIME-type>][;charset="<encoding>"][;base64],<data>
// See details at:
// http://en.wikipedia.org/wiki/Data_URI_scheme

$mimetype = 'text/plain';
$base64data = '';
$regex = '/^data:([^;,]+);base64,(.+)$/';
$matches = array();

if (preg_match($regex, $imgdataurl, $matches)) {
    $mimetype   = $matches[1];
    $base64data = $matches[2];
    $imgdataurl = null;
} else {
    paintweb_send_result($imgurl, $imgurlnew, false,
        get_string('moodleServer:malformedDataUrl', 'paintweb'));
}

if (empty($base64data) || !isset($imgallowedtypes[$mimetype])) {
    paintweb_send_result($imgurl, $imgurlnew, false,
        get_string('moodleServer:malformedDataUrl', 'paintweb'));
}

$imgdata = base64_decode($base64data);
$base64data = null;

$imgdest = $CFG->dataroot . '/' . $CFG->paintwebImagesFolder;

if (!is_dir($imgdest) || !make_upload_directory($imgdest, false)) {
    paintweb_send_result($imgurl, $imgurlnew, false,
        get_string('moodleServer:failedMkdir', 'paintweb'));
}

// Simply create a new file in the PainWeb images folder.
$fname = sha1($imgdata) . '.' . $imgallowedtypes[$mimetype];
$imgdest .=  '/' . $fname;
$imgurlnew = $CFG->wwwroot . '/' . $pwproxy . '?img=' . $fname;

if (!file_put_contents($imgdest, $imgdata)) {
    paintweb_send_result($imgurl, $imgurlnew, false,
        get_string('moodleServer:saveFailed', 'paintweb'));
}
$imgdata = null;

paintweb_send_result($imgurl, $imgurlnew, true);

// vim:set spell spl=en fo=tanqrowcb tw=80 ts=4 sw=4 sts=4 sta et noai nocin fenc=utf-8 ff=unix: 

