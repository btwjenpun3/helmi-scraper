<?php

namespace App\Livewire\Scraper;

use App\Models\Bela as ModelsBela;
use Livewire\Component;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;

class Bela extends Component
{
    public $productId, $categoryId, $pages;

    public $url;

    public $log;

    public $showProgress = false;

    public function scrape()
    {
        $this->validate([
            'productId'     => 'required|numeric',
            'categoryId'    => 'required|numeric',
            'pages'         => 'required|numeric'
        ]);

        $url = 'https://bela.gratisongkir.id/products/' . $this->productId;

        $client = HttpClient::create();

        $this->showProgress = true;        

        for ($i = 1; $i <= $this->pages; $i++) {
            $this->url = $url . '?page=' . $i . '&cat=' . $this->categoryId;

            $response = $client->request('GET', $url . '?page=' . $i . '&cat=' . $this->categoryId); 

            $html = $response->getContent();
            $crawler = new Crawler($html);
    
            // Dapatkan nama CV
            //$title = $crawler->filter('#content a')->first()->text();

            // Dapatkan info produk
            $products = $crawler->filter('#productLoad')
                                ->filter('.col-6')
                                ->each(function (Crawler $node) {
                                        return $node->filter('a')->attr('href');
                                    });

            //dd($products);
            
            foreach ($products as $key => $value) {
                $go = $client->request('GET', $value);

                $htmlProduct = $go->getContent();
                $crawlerProduct = new Crawler($htmlProduct);

                //dd($crawlerProduct);

                $name           = $crawlerProduct->filter('#title')->text();
                $price          = $crawlerProduct->filter('.row span')->eq(0)->text();
                $category       = $crawlerProduct->filter('ol li.breadcrumb-item')->eq(0)->text();
                $subCategory    = $crawlerProduct->filter('ol li.breadcrumb-item')->eq(1)->text() . ' / ' . $crawlerProduct->filter('ol li.breadcrumb-item')->eq(2)->text();;
                $sku            = $crawlerProduct->filter('table.table tr')->eq(0)->filter('td')->eq(1)->text();
                $warranty       = $crawlerProduct->filter('table.table tr')->eq(1)->filter('td')->eq(1)->text();
                $dimensions     = $crawlerProduct->filter('table.table tr')->eq(2)->filter('td')->eq(1)->text();
                $weight         = $crawlerProduct->filter('table.table tr')->eq(3)->filter('td')->eq(1)->text();
                $product        = $crawlerProduct->filter('table.table tr')->eq(4)->filter('td')->eq(1)->text();
                $made_in        = $crawlerProduct->filter('table.table tr')->eq(5)->filter('td')->eq(1)->text();
                $kbki           = $crawlerProduct->filter('table.table tr')->eq(6)->filter('td')->eq(1)->text();
                $tkdn           = $crawlerProduct->filter('table.table tr')->eq(8)->filter('td')->eq(1)->text();
                $bmp            = $crawlerProduct->filter('table.table tr')->eq(9)->filter('td')->eq(1)->text();
                $tkdn_bmp       = $crawlerProduct->filter('table.table tr')->eq(10)->filter('td')->eq(1)->text();
                $description    = $crawlerProduct->filter('.pr-lg-2 p')->eq(0)->text();
                
                ModelsBela::create([
                    'name'          => $name,
                    'price'         => $this->convertCurrencyFormat($price),
                    'category'      => $category,
                    'subcategory'   => $subCategory,
                    'sku'           => $sku,
                    'warranty'      => $warranty,
                    'dimensions'    => $dimensions,
                    'weight'        => $weight,
                    'product'       => $product,
                    'made_in'       => $made_in,
                    'kbki'          => $kbki,
                    'tkdn'          => $tkdn,
                    'bmp'           => $bmp,
                    'tkdn_bmp'      => $tkdn_bmp,
                    'description'   => $description
                ]);
            }

        }   
    }

    public function convertCurrencyFormat($currency) {
        // Menghapus "Rp" dari awal string
        $currency = str_replace("Rp", "", $currency);
    
        // Menghapus titik (.) dari string
        $currency = str_replace(".", "", $currency);
    
        // Menghapus spasi dari string
        $currency = str_replace(" ", "", $currency);
    
        // Mengubah string menjadi integer
        return (int) $currency;
    }

    public function render()
    {
        return view('livewire.scraper.bela');
    }
}
