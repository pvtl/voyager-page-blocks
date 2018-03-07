<?php

namespace Pvtl\VoyagerPageBlocks\Tests\Unit;

use Tests\TestCase;
use Pvtl\VoyagerPageBlocks\PageBlock;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PageBlockTest extends TestCase
{
    use DatabaseMigrations;

    protected function createPageBlock()
    {
        return factory(PageBlock::class)->create([
            'type' => 'template',
            'path' => 'content_one_column',
            'data' => ['html_content_1' => '<p>This was a triumph!</p>'],
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
        $this->assertObjectHasAttribute('html_content_1', $pageBlock->data);
        $this->assertEquals($pageBlock->data->html_content_1, '<p>This was a triumph!</p>');
    }
}
