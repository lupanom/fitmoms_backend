<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImageTest extends TestCase
{
    /** @test */
    public function it_retrieve_an_image_in_public()
    {

        $url = asset('storage/images/food/apple_red.png');
        dd($url);

    }
}
