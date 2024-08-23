<?php

namespace App\Http\Controllers;

use App\Models\Bela;
use Illuminate\Http\Request;

class ScraperController extends Controller
{
    public function BELA_INDEX()
    {
        return view('pages.scraper.bela.index');
    }

    public function BELA_SCRAPE()
    {       
        return view('pages.scraper.bela.scrape');
    }
}
