<?php

namespace DDD\Http\Media;

use DDD\App\Controllers\Controller;
// Models
use DDD\Domain\Media\Media;

class MediaDownloadController extends Controller
{
    public function download(Media $media)
    {
        return $media;
    }
}
