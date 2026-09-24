<?php
$f = "resources/views/admin/setting.blade.php";
$c = file_get_contents($f);

// Remove footer_pt_name entirely
$c = preg_replace("/<div class=\"col-md-6 mb-3\">\s*<label class=\"form-label\">Nama PT di Footer<\/label>[\s\S]*?<\/div>/", "", $c, 1);

// Remove footer_pt_description entirely
$c = preg_replace("/<div class=\"col-12 mb-3\">\s*<label class=\"form-label\">Deskripsi PT di Footer<\/label>[\s\S]*?<\/div>/", "", $c, 1);

file_put_contents($f, $c);

