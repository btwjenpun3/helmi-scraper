<?php

namespace App\Console\Commands;

use App\Models\Bela;
use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;

class BelaCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:bela {--p=} {--c=} {--pg=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $url = 'https://bela.gratisongkir.id/products/' . $this->option('p');

        $client = HttpClient::create();    

        for ($i = 1; $i <= $this->option('pg'); $i++) {
            $response = $client->request('GET', $url . '?page=' . $i . '&cat=' . $this->option('c')); 

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
                
                Bela::create([
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

                $this->info('Scrape [' . $name . '] Berhasil!');
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
}
