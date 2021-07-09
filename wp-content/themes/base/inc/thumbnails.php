<?php
// Theme thumbnails
add_theme_support('post-thumbnails');

add_image_size('thumbnail_1920x1080',   1920, 1080, true);
add_image_size('thumbnail_800x600',     800,  600,  true);
add_image_size('thumbnail_420x480',     420,  480,  true);
add_image_size('thumbnail_200x130',     200,  130,  true);
add_image_size('thumbnail_446x510',     446,  510,  true);
add_image_size('thumbnail_237x237',     237,  237,  true);
add_image_size('thumbnail_1187x586',    1187, 586,  true);
add_image_size('thumbnail_593x293',     593,  293,  true);
add_image_size('thumbnail_600x383',     600,  383,  true);
add_image_size('thumbnail_800x435',     800,  435,  true);
add_image_size('thumbnail_300x435',     300,  435,  true);
add_image_size('thumbnail_645x435',     645,  435,  true);
add_image_size('thumbnail_1000x356',    1000, 356,  true);
add_image_size('thumbnail_374x222',     374,  222,  true);
add_image_size('thumbnail_1520x540',    1520, 540,  true);
add_image_size('thumbnail_1440x320',    1440, 320,  true);
add_image_size('thumbnail_720x160',     720,  160,  true);
add_image_size('thumbnail_465x212',     465,  212,  true);

//===ENABLE UPLOADING SVG===
function cc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


