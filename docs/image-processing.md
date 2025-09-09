# Image Processing

Bunny Optimizer is a real-time on the fly image manipulation and optimization service that automatically optimizes your
images for faster image delivery, bandwidth savings and enables smart dynamic image manipulation using a simple query
API.

## Usage

Generate URL with optimization parameters.

```php
<?php
require 'vendor/autoload.php';

use ToshY\BunnyNet\BunnyImageProcessor;

BunnyImageProcessor::generate(
    url: 'https://myzone.b-cdn.net/bunny.jpg',
    optimization: [
        'width' => 200,
        'height' => 300,
        'aspect_ratio' => '16:9',
        'quality' => 85,
        'sharpen' => false,
        'blur' => 0,
        'crop' => '50,50',
        'crop_gravity' => 'center',
        'flip' => false,
        'flop' => false,
        'brightness' => 0,
        'saturation' => 0,
        'hue' => 0,
        'contrast' => 0,
        'sepia' => 0,
        'auto_optimize' => 'medium',
        'class' => 'my-custom-class',
    ],
);
```

???+ note

    - The `quality` argument determines the compression level of the resulting image with 0 being the lowest level of
    compression and 100 being the highest. Higher compression means smaller files, but might visually degrade the image
    (e.g. JPEG compression under 70 tends to produce visible artefacts). The `quality` argument is ignored if the
    requested output image format is lossless (e.g. PNG).
    - The `crop` argument crops the output image to the given width and height. Two formats are accepted. Format 1 one only
    includes the width and height of the crop: `width,height`. Format 2 also includes the X and Y position of where the
    crop should start: `width,height,x,y`. Image resizing with the width and height parameters is processed after the crop
    and the resized measurements. If only width and height are given, the `Crop Gravity` parameter will be used.

## Reference

* [Image Processing API](https://docs.bunny.net/docs/stream-image-processing)
* [Bunny Optimizer Engine Documentation](https://support.bunny.net/hc/en-us/articles/360027448392-Bunny-Optimizer-Engine-Documentation)
