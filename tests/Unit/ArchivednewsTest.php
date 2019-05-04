<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Category;
use App\Models\Archivednews;
use App\Models\Deletecriteria;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArchivednewsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_category()
    {
        $archived_news = factory(Archivednews::class)->create();

        $this->assertInstanceOf(Category::class, $archived_news->category);
    }

    /** @test */
    public function it_has_a_deletecrieria()
    {
        $archived_news = factory(Archivednews::class)->create();

        $this->assertInstanceOf(Deletecriteria::class, $archived_news->deletecriteria);
    }
}
