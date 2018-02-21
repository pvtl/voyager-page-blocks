<?php

namespace Pvtl\VoyagerPageBlocks\Unit;

use App\PageBlock;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PageBlockTest extends TestCase
{
    use DatabaseMigrations;

    protected function createPageBlock()
    {
        return factory(PageBlock::class)->create([
            'type' => 'template',
            'filepath' => 'html_content.blade.php',
            'data' => ['glados' => '<p>This was a triumph!</p>'],
            'is_hidden' => 0,
            'is_minimized' => 0,
            'is_delete_denied' => 0,
            'cache_ttl' => 0,
        ]);
    }

    public function testStoringAndFetchingData()
    {
        // 1. Arrange
        $pageBlock = $this->createPageBlock();

        // 2. Act
        $pageBlock->fresh();

        // 3. Assert
        $this->assertObjectHasAttribute('glados', $pageBlock->data);
        $this->assertEquals($pageBlock->data->glados, '<p>This was a triumph!</p>');
    }
}
