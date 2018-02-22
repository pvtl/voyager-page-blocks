<?php

namespace Pvtl\VoyagerPageBlocks\Http\Controllers;

use Pvtl\VoyagerPageBlocks\Page;
use Pvtl\VoyagerPageBlocks\PageBlock;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\VoyagerBreadController as BaseVoyagerBreadController;
use Illuminate\Http\Request;

class PageBlockController extends BaseVoyagerBreadController
{
    public function edit(Request $request, $id)
    {
        $page = Page::findOrFail($id);

        return view('vendor/voyager/page-blocks/edit-add', [
            'page' => $page,
            'pageBlocks' => $page->blocks->sortBy('order'),
        ]);
    }

    public function update(Request $request, $id)
    {
        $block = PageBlock::findOrFail($id);
        $template = $block->template();
        $dataType = Voyager::model('DataType')->where('slug', '=', 'page-blocks')->first();

        // Get all block data
        $data = [];
        foreach ($template->fields as $row) {
            $data[$row->field] = $request->input($row->field);
        }

        $block->data = $data;
        $block->is_hidden = $request->has('is_hidden');
        $block->is_delete_denied = $request->has('is_delete_denied');
        $block->cache_ttl = $request->input('cache_ttl');
        $block->order = $request->input('order');
        $block->save();

        return redirect()
            ->back()
            ->with([
                'message' => __('voyager.generic.successfully_updated') . " {$dataType->display_name_singular}",
                'alert-type' => 'success',
            ]);
    }

    /**
     * POST BRE(A)D - Store data.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $page = Page::findOrFail($request->input('page_id'));
        $dataType = Voyager::model('DataType')->where('slug', '=', 'page-blocks')->first();
        list($type, $filepath) = explode('|', $request->input('type'));

        $page->blocks()->create([
            'type' => $type,
            'filepath' => $filepath,
            'data' => $this->generatePlaceholders($request),
            'order' => time(),
        ]);

        return redirect()
            ->route('voyager.page-blocks.edit', $page->id)
            ->with([
                'message' => __('voyager.generic.successfully_added_new') . " {$dataType->display_name_singular}",
                'alert-type' => 'success',
            ]);
    }

    public function destroy(Request $request, $id)
    {
        $block = PageBlock::findOrFail($id);
        $dataType = Voyager::model('DataType')->where('slug', '=', 'page-blocks')->first();

        $block->delete();

        return redirect()
            ->back()
            ->with([
                'message' => __('voyager.generic.successfully_deleted') . " {$dataType->display_name_singular}",
                'alert-type' => 'error',
            ]);
    }

    public function generatePlaceholders(Request $request)
    {
        $configKey = preg_replace(
            '/.blade.php/',
            '',
            explode('|', $request->input('type'))
        )[1];

        return array_map(function ($field) {
            return array_key_exists('placeholder', $field) ? $field['placeholder'] : '';
        }, config("page-blocks.$configKey.fields"));
    }
}
