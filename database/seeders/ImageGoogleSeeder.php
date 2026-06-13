<?php

namespace Database\Seeders;

use App\Models\KategoriProduk;
use App\Models\Produk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ImageGoogleSeeder extends Seeder
{
    public function run(): void
    {
        $disk = Storage::disk('public');
        $total = Produk::count();
        $done = 0;

        $this->command->info("Searching real product images via Openverse...");

        Produk::chunk(50, function ($produks) use ($disk, &$done, $total) {
            foreach ($produks as $p) {
                $keyword = $this->keyword($p->nama_produk);
                $url = $this->searchImage($keyword);

                if ($url) {
                    $ext = pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION);
                    $ext = in_array($ext, ['jpg', 'jpeg', 'png', 'webp']) ? $ext : 'jpg';
                    $filename = 'produk/' . str()->slug($p->nama_produk) . '-' . $p->id . '.' . $ext;

                    try {
                        $response = Http::timeout(15)->get($url);
                        if ($response->successful() && strlen($response->body()) > 2000) {
                            $disk->put($filename, $response->body());
                            $p->update(['gambar' => $filename]);
                            $this->command->info("  OK: {$p->nama_produk}");
                        }
                    } catch (\Exception $e) {
                        $this->command->warn("  FAIL: {$p->nama_produk} - {$e->getMessage()}");
                    }
                } else {
                    $this->command->warn("  SKIP (no img): {$p->nama_produk}");
                }

                $done++;
                if ($done % 20 === 0) {
                    $this->command->info("  Progress: {$done}/{$total}");
                }
            }
        });

        // Also update categories
        $this->command->info("Updating category images...");
        foreach (KategoriProduk::all() as $k) {
            $keyword = $k->nama_kategori;
            $url = $this->searchImage($keyword);
            if ($url) {
                $ext = pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION);
                $ext = in_array($ext, ['jpg', 'jpeg', 'png', 'webp']) ? $ext : 'jpg';
                $filename = 'kategori/' . str()->slug($k->nama_kategori) . '.' . $ext;
                try {
                    $response = Http::timeout(15)->get($url);
                    if ($response->successful() && strlen($response->body()) > 2000) {
                        $disk->put($filename, $response->body());
                        $k->update(['gambar' => $filename]);
                        $this->command->info("  OK kategori: {$k->nama_kategori}");
                    }
                } catch (\Exception $e) {}
            }
        }

        $this->command->info("Done!");
    }

    private function searchImage(string $keyword): ?string
    {
        $url = 'https://api.openverse.engineering/v1/images/?q=' . urlencode($keyword) . '&page_size=1&license=cc0,cc-by,cc-by-sa,pdm';
        try {
            $response = Http::timeout(10)->get($url);
            if ($response->successful()) {
                $data = $response->json();
                if (!empty($data['results'][0]['url'])) {
                    $imgUrl = $data['results'][0]['url'];
                    // Prefer larger images
                    if (!empty($data['results'][0]['width']) && $data['results'][0]['width'] >= 200) {
                        return $imgUrl;
                    }
                    return $imgUrl;
                }
            }
        } catch (\Exception $e) {}

        // Fallback: try loremflickr
        $fallbackUrl = 'https://loremflickr.com/400/400/' . urlencode($keyword);
        return $fallbackUrl;
    }

    private function keyword(string $name): string
    {
        $name = strtolower($name);
        $name = preg_replace('/[\(\d{4}\)]/', '', $name);
        $name = trim(preg_replace('/\s+/', ' ', $name));

        $map = [
            'iphone' => 'iphone apple smartphone photography',
            'macbook' => 'macbook apple laptop computer',
            'samsung galaxy s25 ultra' => 'samsung galaxy s25 ultra phone',
            'samsung galaxy s25 plus' => 'samsung galaxy s25 plus phone',
            'samsung galaxy s25' => 'samsung galaxy s25 phone',
            'samsung galaxy s24 ultra' => 'samsung galaxy s24 ultra phone',
            'samsung galaxy s24 plus' => 'samsung galaxy s24 plus phone',
            'samsung galaxy s24' => 'samsung galaxy s24 phone',
            'samsung galaxy s23 ultra' => 'samsung galaxy s23 ultra phone',
            'samsung galaxy z fold' => 'samsung galaxy z fold smartphone',
            'samsung galaxy z flip' => 'samsung galaxy z flip smartphone',
            'samsung galaxy a55' => 'samsung galaxy a55 phone',
            'samsung galaxy a35' => 'samsung galaxy a35 phone',
            'samsung galaxy a25' => 'samsung galaxy a25 phone',
            'samsung galaxy a15' => 'samsung galaxy a15 phone',
            'xiaomi 14 ultra' => 'xiaomi 14 ultra smartphone',
            'xiaomi 14t' => 'xiaomi 14t smartphone',
            'xiaomi redmi note 13 pro' => 'xiaomi redmi note 13 pro',
            'xiaomi redmi note 13' => 'xiaomi redmi note 13',
            'poco x6 pro' => 'xiaomi poco x6 pro',
            'poco f6' => 'xiaomi poco f6',
            'oppo find x8' => 'oppo find x8 smartphone',
            'oppo reno 12 pro' => 'oppo reno 12 pro',
            'oppo reno 12' => 'oppo reno 12',
            'oppo a79' => 'oppo a79 smartphone',
            'vivo x200 pro' => 'vivo x200 pro',
            'vivo v40 pro' => 'vivo v40 pro',
            'vivo v40' => 'vivo v40',
            'vivo y28' => 'vivo y28',
            'realme gt 6' => 'realme gt 6',
            'realme 12 plus' => 'realme 12 plus',
            'realme c67' => 'realme c67',
            'google pixel 9 pro' => 'google pixel 9 pro',
            'google pixel 9' => 'google pixel 9',
            'google pixel 8 pro' => 'google pixel 8 pro',
            'google pixel 8' => 'google pixel 8',
            'nothing phone' => 'nothing phone smartphone',
            'rog zephyrus' => 'asus rog zephyrus gaming laptop',
            'rog strix' => 'asus rog strix gaming laptop',
            'tuf gaming' => 'asus tuf gaming laptop',
            'asus zenbook' => 'asus zenbook laptop',
            'asus vivobook' => 'asus vivobook laptop',
            'asus expertbook' => 'asus expertbook laptop',
            'lenovo legion' => 'lenovo legion gaming laptop',
            'lenovo loq' => 'lenovo loq gaming laptop',
            'lenovo thinkpad x1' => 'lenovo thinkpad x1 carbon laptop',
            'lenovo thinkpad t14' => 'lenovo thinkpad t14 laptop',
            'lenovo yoga' => 'lenovo yoga laptop',
            'lenovo ideapad slim' => 'lenovo ideapad slim laptop',
            'dell alienware' => 'dell alienware gaming laptop',
            'dell xps' => 'dell xps laptop',
            'dell inspiron' => 'dell inspiron laptop',
            'dell latitude' => 'dell latitude laptop',
            'dell g15' => 'dell g15 gaming laptop',
            'hp spectre' => 'hp spectre x360 laptop',
            'hp envy' => 'hp envy laptop',
            'hp pavilion plus' => 'hp pavilion plus laptop',
            'hp victus' => 'hp victus gaming laptop',
            'hp omen' => 'hp omen gaming laptop',
            'acer predator helios' => 'acer predator helios gaming laptop',
            'acer nitro' => 'acer nitro gaming laptop',
            'acer swift go' => 'acer swift go laptop',
            'acer aspire' => 'acer aspire laptop',
            'msi katana' => 'msi katana gaming laptop',
            'msi stealth' => 'msi stealth gaming laptop',
            'msi cyborg' => 'msi cyborg gaming laptop',
            'microsoft surface laptop' => 'microsoft surface laptop',
            'microsoft surface pro' => 'microsoft surface pro',
            'airpods pro' => 'airpods pro apple',
            'airpods 4' => 'airpods 4 apple',
            'galaxy buds3 pro' => 'samsung galaxy buds3 pro',
            'galaxy buds fe' => 'samsung galaxy buds fe',
            'nothing ear' => 'nothing ear earbuds',
            'redmi buds' => 'xiaomi redmi buds',
            'jbl flip' => 'jbl flip speaker',
            'jbl charge' => 'jbl charge speaker',
            'logitech z333' => 'logitech z333 speaker',
            'logitech z407' => 'logitech z407 speaker',
            'samsung odyssey g7' => 'samsung odyssey g7 monitor',
            'samsung odyssey g5' => 'samsung odyssey g5 monitor',
            'lg ultragear 27' => 'lg ultragear 27 monitor',
            'lg ultragear 32' => 'lg ultragear 32 monitor',
            'lg 27up850n' => 'lg 27up850n monitor',
            'asus rog swift' => 'asus rog swift oled monitor',
            'asus tuf gaming vg27' => 'asus tuf gaming monitor',
            'asus proart' => 'asus proart monitor',
            'dell ultrasharp' => 'dell ultrasharp monitor',
            'dell s2722qc' => 'dell s2722qc monitor',
            'samsung smart monitor m7' => 'samsung smart monitor m7',
            'samsung ls24r350' => 'samsung 24 inch monitor',
            'lg 24mr400' => 'lg 24mr400 monitor',
            'acer nitro xv272u' => 'acer nitro monitor',
            'acer sa240y' => 'acer 24 inch monitor',
            'lenovo thinkvision' => 'lenovo thinkvision monitor',
            'razer blackwidow' => 'razer blackwidow keyboard',
            'razer huntsman' => 'razer huntsman keyboard',
            'razer deathadder' => 'razer deathadder mouse',
            'razer viper' => 'razer viper mouse',
            'razer basilisk' => 'razer basilisk mouse',
            'razer kraken' => 'razer kraken headset',
            'razer blackshark' => 'razer blackshark headset',
            'razer gigantus' => 'razer gigantus mousepad',
            'corsair k70' => 'corsair k70 keyboard',
            'corsair k65' => 'corsair k65 keyboard',
            'corsair hs80' => 'corsair hs80 headset',
            'corsair void elite' => 'corsair void elite headset',
            'corsair m75' => 'corsair m75 mouse',
            'corsair harpoon' => 'corsair harpoon mouse',
            'logitech g pro x superlight' => 'logitech g pro x superlight mouse',
            'logitech g502' => 'logitech g502 mouse',
            'logitech g304' => 'logitech g304 mouse',
            'logitech g pro x tkl' => 'logitech g pro x tkl keyboard',
            'logitech g413' => 'logitech g413 keyboard',
            'logitech g733' => 'logitech g733 headset',
            'logitech g pro x 2' => 'logitech g pro x 2 headset',
            'logitech mx master' => 'logitech mx master mouse',
            'logitech m750' => 'logitech m750 mouse',
            'logitech m190' => 'logitech m190 mouse',
            'logitech mk235' => 'logitech mk235 keyboard',
            'logitech k380' => 'logitech k380 keyboard',
            'logitech c920' => 'logitech c920 webcam',
            'logitech streamcam' => 'logitech streamcam webcam',
            'logitech brio' => 'logitech brio 4k webcam',
            'keychron q3' => 'keychron q3 keyboard',
            'keychron v1' => 'keychron v1 keyboard',
            'rexus k9' => 'rexus k9 keyboard',
            'rexus kx-5' => 'rexus keyboard',
            'rexus h5' => 'rexus headset',
            'rexus m100' => 'rexus mouse',
            'rexus cooling pad' => 'rexus cooling pad',
            'royal kludge rk61' => 'royal kludge rk61 keyboard',
            'royal kludge rk100' => 'royal kludge rk100 keyboard',
            'steelseries arctis nova 7' => 'steelseries arctis nova 7 headset',
            'steelseries arctis nova 1' => 'steelseries arctis nova 1 headset',
            'steelseries qck' => 'steelseries qck mousepad',
            'microsoft arc mouse' => 'microsoft arc mouse',
            'dell kb216' => 'dell kb216 keyboard',
            'dell ms5320w' => 'dell mouse',
            'samsung 990 pro' => 'samsung 990 pro ssd',
            'samsung 870 evo' => 'samsung 870 evo ssd',
            'wd black sn850x' => 'wd black sn850x ssd',
            'wd blue sn580' => 'wd blue sn580 ssd',
            'wd my passport' => 'wd my passport external hard drive',
            'kingston kc3000' => 'kingston kc3000 ssd',
            'kingston nv2' => 'kingston nv2 ssd',
            'kingston a400' => 'kingston a400 ssd',
            'kingston datatraveler' => 'kingston datatraveler flash drive',
            'sandisk ultra dual' => 'sandisk ultra dual flash drive',
            'sandisk ultra fit' => 'sandisk ultra fit flash drive',
            'sandisk ixand' => 'sandisk ixand flash drive',
            'seagate backup plus' => 'seagate backup plus hard drive',
            'ugreen gan' => 'ugreen gan charger',
            'ugreen usb-c hub' => 'ugreen usb c hub',
            'ugreen usb-c to usb-c' => 'ugreen usb c cable',
            'ugreen usb-c to lightning' => 'ugreen lightning cable',
            'anker gan' => 'anker gan charger',
            'anker powercore' => 'anker powerbank',
            'anker magsafe power bank' => 'anker magsafe power bank',
            'anker 555' => 'anker usb c hub',
            'anker powerline' => 'anker usb c cable',
            'apple usb-c to lightning' => 'apple lightning cable',
            'apple usb-c digital av' => 'apple usb c av adapter',
            'xiaomi power bank' => 'xiaomi power bank',
            'samsung 10000mah' => 'samsung power bank',
            'north bayou h100' => 'north bayou monitor arm',
            'north bayou g40' => 'north bayou dual monitor arm',
            'apc back-ups 650' => 'apc ups battery backup',
            'apc back-ups 1200' => 'apc ups battery backup',
            'stavol svc' => 'stavol stabilizer',
            'tp-link archer ax73' => 'tp-link archer ax73 router',
            'tp-link deco x50' => 'tp-link deco x50 mesh',
            'asus rt-ax57' => 'asus rt-ax57 router',
            'cooler master notepal' => 'cooler master notepal cooling pad',
            'wireless mouse logitech' => 'logitech wireless mouse',
            'keyboard mechanical rexus' => 'rexus mechanical keyboard',
        ];

        foreach ($map as $key => $value) {
            if (str_contains($name, $key)) {
                return $value;
            }
        }

        // Generic fallback based on category
        if (str_contains($name, 'gaming')) return 'gaming laptop computer';
        if (str_contains($name, 'ultrabook') || str_contains($name, 'laptop')) return 'laptop computer';
        if (str_contains($name, 'monitor') || str_contains($name, 'display') || str_contains($name, 'inch')) return 'computer monitor';
        if (str_contains($name, 'keyboard') || str_contains($name, 'keychron') || str_contains($name, 'rk6')) return 'mechanical keyboard';
        if (str_contains($name, 'mouse') || str_contains($name, 'mous')) return 'computer mouse';
        if (str_contains($name, 'headset') || str_contains($name, 'headphone') || str_contains($name, 'earphone') || str_contains($name, 'earbud') || str_contains($name, 'tws')) return 'headset headphones';
        if (str_contains($name, 'speaker') || str_contains($name, 'jbl') || str_contains($name, 'logitech z')) return 'speaker audio';
        if (str_contains($name, 'ssd') || str_contains($name, 'nvme') || str_contains($name, 'flash drive') || str_contains($name, 'datatraveler')) return 'ssd storage';
        if (str_contains($name, 'hard drive') || str_contains($name, 'hdd') || str_contains($name, 'external')) return 'external hard drive';
        if (str_contains($name, 'charger') || str_contains($name, 'charging') || str_contains($name, 'power bank')) return 'charger power bank';
        if (str_contains($name, 'kabel') || str_contains($name, 'cable') || str_contains($name, 'lightning')) return 'usb cable';
        if (str_contains($name, 'cooling') || str_contains($name, 'cooler master')) return 'laptop cooling pad';
        if (str_contains($name, 'mousepad') || str_contains($name, 'mouse pad') || str_contains($name, 'qck') || str_contains($name, 'gigantus')) return 'gaming mousepad';
        if (str_contains($name, 'webcam') || str_contains($name, 'c920') || str_contains($name, 'brio')) return 'webcam camera';
        if (str_contains($name, 'hub') || str_contains($name, 'usb c hub')) return 'usb c hub adapter';
        if (str_contains($name, 'monitor arm') || str_contains($name, 'monitor stand')) return 'monitor arm stand';
        if (str_contains($name, 'ups') || str_contains($name, 'apc')) return 'ups battery backup';
        if (str_contains($name, 'stabilizer') || str_contains($name, 'stavol')) return 'voltage stabilizer';
        if (str_contains($name, 'router') || str_contains($name, 'tp-link') || str_contains($name, 'deco') || str_contains($name, 'wifi')) return 'wifi router';
        if (str_contains($name, 'iphone')) return 'iphone apple smartphone';

        return $name . ' product photography';
    }
}
