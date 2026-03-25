<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\View\View;

class PageController extends Controller
{
    public function index(): View
    {
        $page = Page::where('slug', 'index')->firstOrFail();

        return view('page', compact('page'));
    }

    public function show(string $slug): View
    {
        abort_if($slug === 'index', 404);

        $page = Page::where('slug', $slug)->firstOrFail();

        return view('page', compact('page'));
    }
}
