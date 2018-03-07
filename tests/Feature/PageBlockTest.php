<?php

namespace Pvtl\VoyagerPageBlocks\Tests\Feature;

use Tests\TestCase;
use Pvtl\VoyagerPageBlocks\Page;
use Pvtl\VoyagerPageBlocks\PageBlock;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PageBlockTest extends TestCase
{
    use DatabaseMigrations;

    protected function createPage()
    {
        return Page::create([
            'id' => 1,
            'author_id' => 1,
            'title' => 'A page title',
            'excerpt' => 'The home page',
            'body' => '',
            'slug' => 'home',
            'meta_description' => 'A meta description',
            'meta_keywords' => 'keyword1, keyword2',
            'status' => 'ACTIVE',
            'layout' => 'default',
        ]);
    }

    protected function createPageBlock($content = '<p>Hello world!</p>', $order = 10000, $hidden = false)
    {
        return factory(PageBlock::class)->create([
            'page_id' => 1,
            'type' => 'template',
            'path' => 'content_one_column',
            'data' => ['html_content_1' => $content, 'spaces' => 0],
            'is_hidden' => (bool)$hidden,
            'is_minimized' => false,
            'is_delete_denied' => false,
            'cache_ttl' => 0,
            'order' => (int)$order,
        ]);
    }

    public function testIfPageBlockIsVisible()
    {
        // Create new "/home" page and associate a page block
        $page = $this->createPage();

        $page->blocks()->save($this->createPageBlock());

        // 2. Act
        $response = $this->get('/home');

        // 3. Assert
        $response
            ->assertStatus(200)
            ->assertSee('<p>Hello world!</p>');
    }

    public function testIfPageBlockIsHidden()
    {
        // Create new "/home" page and associate a page block
        $page = $this->createPage();

        $page->blocks()->save($this->createPageBlock('', '', true));

        // 2. Act
        $response = $this->get('/home');

        // 3. Assert
        $response
            ->assertStatus(200)
            ->assertDontSee('<p>Hello world!</p>');
    }

    public function testIfPageBlockOrderIsCorrect()
    {
        $strings = [
            '<p>The first string</p>',
            '<p>The second string</p>',
            '<p>The third string</p>',
        ];
        // Create new "/home" page and associate a page block
        $page = $this->createPage();

        $page->blocks()->save($this->createPageBlock($strings[1], 2));
        $page->blocks()->save($this->createPageBlock($strings[2], 3));
        $page->blocks()->save($this->createPageBlock($strings[0], 1));

        // 2. Act
        $response = $this->get('/home');

        // 3. Get positions
        $firstStringPosition = strpos($response->getContent(), $strings[0]);
        $secondStringPosition = strpos($response->getContent(), $strings[1]);
        $thirdStringPosition = strpos($response->getContent(), $strings[2]);

        // 4. Assert
        $response
            ->assertStatus(200)
            ->assertSee($strings[0])
            ->assertSee($strings[1])
            ->assertSee($strings[2]);

        $this->assertLessThan($secondStringPosition, $firstStringPosition);
        $this->assertLessThan($thirdStringPosition, $secondStringPosition);
        $this->assertGreaterThan($secondStringPosition, $thirdStringPosition);
    }
}
