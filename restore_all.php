<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\KategoriProduk;
use App\Models\Produk;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

$disk = Storage::disk('public');

// Find empty categories and add products
$accessoryProducts = [
    'Keyboard' => [
        ['nama_produk' => 'Razer BlackWidow V4 Pro', 'harga' => 3500000, 'stok' => 5],
        ['nama_produk' => 'Razer Huntsman V3 Pro TKL', 'harga' => 3200000, 'stok' => 4],
        ['nama_produk' => 'Corsair K70 RGB Pro', 'harga' => 2800000, 'stok' => 6],
        ['nama_produk' => 'Corsair K65 Plus Wireless', 'harga' => 2500000, 'stok' => 5],
        ['nama_produk' => 'Logitech G Pro X TKL', 'harga' => 2200000, 'stok' => 7],
        ['nama_produk' => 'Logitech G413 SE', 'harga' => 1200000, 'stok' => 10],
        ['nama_produk' => 'Keychron Q3 Pro', 'harga' => 2500000, 'stok' => 4],
        ['nama_produk' => 'Keychron V1', 'harga' => 1300000, 'stok' => 8],
        ['nama_produk' => 'Rexus K9', 'harga' => 350000, 'stok' => 25],
        ['nama_produk' => 'Rexus KX-5', 'harga' => 250000, 'stok' => 30],
        ['nama_produk' => 'Royal Kludge RK61', 'harga' => 500000, 'stok' => 15],
        ['nama_produk' => 'Royal Kludge RK100', 'harga' => 700000, 'stok' => 10],
        ['nama_produk' => 'Logitech MK235 Combo', 'harga' => 250000, 'stok' => 20],
        ['nama_produk' => 'Logitech K380 Bluetooth', 'harga' => 450000, 'stok' => 15],
        ['nama_produk' => 'Dell KB216', 'harga' => 150000, 'stok' => 30],
    ],
    'Mouse' => [
        ['nama_produk' => 'Logitech G Pro X Superlight 2', 'harga' => 2200000, 'stok' => 5],
        ['nama_produk' => 'Logitech G502 X Plus', 'harga' => 1800000, 'stok' => 7],
        ['nama_produk' => 'Logitech G304 Lightspeed', 'harga' => 500000, 'stok' => 15],
        ['nama_produk' => 'Razer DeathAdder V3 Pro', 'harga' => 2000000, 'stok' => 5],
        ['nama_produk' => 'Razer Viper V3 Pro', 'harga' => 2300000, 'stok' => 4],
        ['nama_produk' => 'Razer Basilisk V3 X', 'harga' => 600000, 'stok' => 10],
        ['nama_produk' => 'Corsair M75 Wireless', 'harga' => 1500000, 'stok' => 5],
        ['nama_produk' => 'Corsair Harpoon RGB', 'harga' => 400000, 'stok' => 12],
        ['nama_produk' => 'Logitech MX Master 3S', 'harga' => 1600000, 'stok' => 8],
        ['nama_produk' => 'Logitech M750', 'harga' => 600000, 'stok' => 10],
        ['nama_produk' => 'Logitech M190', 'harga' => 200000, 'stok' => 20],
        ['nama_produk' => 'Microsoft Arc Mouse', 'harga' => 700000, 'stok' => 6],
        ['nama_produk' => 'Dell MS5320W', 'harga' => 350000, 'stok' => 12],
        ['nama_produk' => 'Rexus M100', 'harga' => 100000, 'stok' => 30],
    ],
    'Headset & Audio' => [
        ['nama_produk' => 'Logitech G Pro X 2 Lightspeed', 'harga' => 2500000, 'stok' => 5],
        ['nama_produk' => 'Logitech G733', 'harga' => 1800000, 'stok' => 7],
        ['nama_produk' => 'Razer BlackShark V2 Pro (2023)', 'harga' => 2200000, 'stok' => 5],
        ['nama_produk' => 'Razer Kraken V4 Pro', 'harga' => 2800000, 'stok' => 3],
        ['nama_produk' => 'Corsair HS80 RGB Wireless', 'harga' => 2000000, 'stok' => 5],
        ['nama_produk' => 'Corsair Void Elite Wireless', 'harga' => 1200000, 'stok' => 8],
        ['nama_produk' => 'SteelSeries Arctis Nova 7', 'harga' => 2300000, 'stok' => 4],
        ['nama_produk' => 'SteelSeries Arctis Nova 1', 'harga' => 800000, 'stok' => 10],
        ['nama_produk' => 'Rexus H5', 'harga' => 150000, 'stok' => 25],
        ['nama_produk' => 'Apple AirPods Pro 2', 'harga' => 3500000, 'stok' => 8],
        ['nama_produk' => 'Apple AirPods 4', 'harga' => 2500000, 'stok' => 10],
        ['nama_produk' => 'Samsung Galaxy Buds3 Pro', 'harga' => 3000000, 'stok' => 5],
        ['nama_produk' => 'Samsung Galaxy Buds FE', 'harga' => 1200000, 'stok' => 10],
        ['nama_produk' => 'Nothing Ear (2)', 'harga' => 2000000, 'stok' => 6],
        ['nama_produk' => 'Nothing Ear (a)', 'harga' => 1200000, 'stok' => 8],
        ['nama_produk' => 'Xiaomi Redmi Buds 5', 'harga' => 400000, 'stok' => 20],
        ['nama_produk' => 'Xiaomi Redmi Buds 6 Active', 'harga' => 250000, 'stok' => 25],
        ['nama_produk' => 'JBL Flip 6', 'harga' => 1500000, 'stok' => 8],
        ['nama_produk' => 'JBL Charge 5', 'harga' => 2200000, 'stok' => 5],
        ['nama_produk' => 'Logitech Z333 2.1', 'harga' => 800000, 'stok' => 8],
        ['nama_produk' => 'Logitech Z407 2.1 Bluetooth', 'harga' => 1200000, 'stok' => 6],
    ],
    'Penyimpanan' => [
        ['nama_produk' => 'Samsung 990 Pro 1TB NVMe', 'harga' => 2200000, 'stok' => 10],
        ['nama_produk' => 'Samsung 990 Pro 2TB NVMe', 'harga' => 4000000, 'stok' => 5],
        ['nama_produk' => 'Samsung 870 Evo 1TB SATA', 'harga' => 1500000, 'stok' => 8],
        ['nama_produk' => 'Samsung 870 Evo 500GB SATA', 'harga' => 800000, 'stok' => 12],
        ['nama_produk' => 'WD Black SN850X 1TB NVMe', 'harga' => 2000000, 'stok' => 8],
        ['nama_produk' => 'WD Black SN850X 2TB NVMe', 'harga' => 3800000, 'stok' => 4],
        ['nama_produk' => 'WD Blue SN580 1TB NVMe', 'harga' => 1200000, 'stok' => 10],
        ['nama_produk' => 'Kingston KC3000 1TB NVMe', 'harga' => 1800000, 'stok' => 8],
        ['nama_produk' => 'Kingston NV2 1TB NVMe', 'harga' => 900000, 'stok' => 15],
        ['nama_produk' => 'Kingston A400 480GB SATA', 'harga' => 500000, 'stok' => 15],
        ['nama_produk' => 'Sandisk Ultra Dual 128GB', 'harga' => 200000, 'stok' => 20],
        ['nama_produk' => 'Sandisk Ultra Dual 256GB', 'harga' => 350000, 'stok' => 15],
        ['nama_produk' => 'Sandisk Ultra Fit 64GB', 'harga' => 150000, 'stok' => 25],
        ['nama_produk' => 'Sandisk iXpand 128GB (Lightning)', 'harga' => 500000, 'stok' => 8],
        ['nama_produk' => 'Kingston DataTraveler 64GB', 'harga' => 100000, 'stok' => 30],
        ['nama_produk' => 'Kingston DataTraveler 128GB', 'harga' => 180000, 'stok' => 20],
        ['nama_produk' => 'WD My Passport 1TB', 'harga' => 900000, 'stok' => 10],
        ['nama_produk' => 'WD My Passport 2TB', 'harga' => 1300000, 'stok' => 8],
        ['nama_produk' => 'Seagate Backup Plus 1TB', 'harga' => 850000, 'stok' => 10],
        ['nama_produk' => 'Seagate Backup Plus 2TB', 'harga' => 1200000, 'stok' => 7],
    ],
    'Charger & Power Bank' => [
        ['nama_produk' => 'ASUS Original Charger 150W', 'harga' => 500000, 'stok' => 8],
        ['nama_produk' => 'Lenovo Original Charger 135W', 'harga' => 450000, 'stok' => 8],
        ['nama_produk' => 'Dell Original Charger 130W', 'harga' => 500000, 'stok' => 6],
        ['nama_produk' => 'MacBook USB-C Charger 67W Original', 'harga' => 800000, 'stok' => 5],
        ['nama_produk' => 'MacBook USB-C Charger 96W Original', 'harga' => 1000000, 'stok' => 4],
        ['nama_produk' => 'UGREEN GaN 65W 3 Port', 'harga' => 400000, 'stok' => 15],
        ['nama_produk' => 'UGREEN GaN 100W 4 Port', 'harga' => 600000, 'stok' => 10],
        ['nama_produk' => 'Anker GaN 65W 3 Port', 'harga' => 450000, 'stok' => 12],
        ['nama_produk' => 'Anker GaN 100W 4 Port', 'harga' => 700000, 'stok' => 8],
        ['nama_produk' => 'Anker PowerCore 20100mAh', 'harga' => 500000, 'stok' => 12],
        ['nama_produk' => 'Anker PowerCore 26800mAh', 'harga' => 700000, 'stok' => 8],
        ['nama_produk' => 'Anker MagSafe Power Bank 10000mAh', 'harga' => 600000, 'stok' => 10],
        ['nama_produk' => 'Xiaomi Power Bank 20000mAh', 'harga' => 300000, 'stok' => 20],
        ['nama_produk' => 'Xiaomi Power Bank 10000mAh', 'harga' => 200000, 'stok' => 25],
        ['nama_produk' => 'Samsung 10000mAh 25W', 'harga' => 350000, 'stok' => 15],
        ['nama_produk' => 'UGREEN USB-C to USB-C 1M PD 100W', 'harga' => 100000, 'stok' => 30],
        ['nama_produk' => 'UGREEN USB-C to Lightning 1M', 'harga' => 90000, 'stok' => 30],
        ['nama_produk' => 'Anker PowerLine USB-C 1M', 'harga' => 120000, 'stok' => 25],
        ['nama_produk' => 'Apple USB-C to Lightning 1M Original', 'harga' => 300000, 'stok' => 10],
    ],
    'Aksesoris Lainnya' => [
        ['nama_produk' => 'Logitech C920 HD Pro', 'harga' => 800000, 'stok' => 8],
        ['nama_produk' => 'Logitech StreamCam', 'harga' => 1800000, 'stok' => 5],
        ['nama_produk' => 'Logitech Brio 4K', 'harga' => 2200000, 'stok' => 3],
        ['nama_produk' => 'Cooler Master NotePal U3 Plus', 'harga' => 350000, 'stok' => 10],
        ['nama_produk' => 'Rexus Cooling Pad 15.6"', 'harga' => 150000, 'stok' => 15],
        ['nama_produk' => 'SteelSeries QcK XXL', 'harga' => 350000, 'stok' => 10],
        ['nama_produk' => 'SteelSeries QcK Medium', 'harga' => 200000, 'stok' => 15],
        ['nama_produk' => 'Razer Gigantus V2 XXL', 'harga' => 400000, 'stok' => 8],
        ['nama_produk' => 'Rexus Gaming Mousepad XL', 'harga' => 100000, 'stok' => 20],
        ['nama_produk' => 'UGREEN USB-C Hub 7-in-1', 'harga' => 350000, 'stok' => 12],
        ['nama_produk' => 'Anker 555 USB-C Hub 8-in-1', 'harga' => 600000, 'stok' => 8],
        ['nama_produk' => 'Apple USB-C Digital AV Multiport', 'harga' => 800000, 'stok' => 6],
        ['nama_produk' => 'North Bayou H100 Single Arm', 'harga' => 250000, 'stok' => 10],
        ['nama_produk' => 'North Bayou G40 Dual Arm', 'harga' => 500000, 'stok' => 6],
        ['nama_produk' => 'UPS APC Back-UPS 650VA', 'harga' => 1200000, 'stok' => 5],
        ['nama_produk' => 'UPS APC Back-UPS 1200VA', 'harga' => 2000000, 'stok' => 3],
        ['nama_produk' => 'Stavol SVC 1000VA', 'harga' => 400000, 'stok' => 8],
        ['nama_produk' => 'TP-Link Archer AX73 AX5400', 'harga' => 1000000, 'stok' => 8],
        ['nama_produk' => 'TP-Link Deco X50 Mesh 2 Pack', 'harga' => 1500000, 'stok' => 5],
        ['nama_produk' => 'ASUS RT-AX57 AX3000', 'harga' => 800000, 'stok' => 6],
    ],
];

echo "Menambahkan produk ke kategori kosong...\n";
foreach ($accessoryProducts as $catName => $products) {
    $cat = KategoriProduk::where('nama_kategori', $catName)->first();
    if (!$cat) {
        echo "  Kategori '$catName' tidak ditemukan, buat baru...\n";
        $cat = KategoriProduk::create(['nama_kategori' => $catName, 'deskripsi' => '']);
    }
    $count = $cat->produk()->count();
    if ($count > 0) {
        echo "  {$catName}: sudah ada {$count} produk, skip\n";
        continue;
    }
    foreach ($products as $p) {
        Produk::create(array_merge($p, ['category_id' => $cat->id]));
    }
    echo "  {$catName}: " . count($products) . " produk ditambahkan\n";
}

echo "\n=== AFTER ===\n";
$total = Produk::count();
echo "Total produk: {$total}\n";

// Now download images for all products without images
echo "\nMendownload gambar untuk produk tanpa gambar...\n";
$noImg = Produk::whereNull('gambar')->get();
echo "Produk tanpa gambar: " . $noImg->count() . "\n";

$keywordMap = [
    'razer blackwidow' => 'razer blackwidow keyboard',
    'razer huntsman' => 'razer huntsman keyboard',
    'corsair k70' => 'corsair k70 keyboard',
    'corsair k65' => 'corsair keyboard',
    'logitech g pro x tkl' => 'logitech g pro x keyboard',
    'logitech g413' => 'logitech g413 keyboard',
    'keychron q3' => 'keychron q3 keyboard',
    'keychron v1' => 'keychron keyboard',
    'rexus k9' => 'rexus keyboard',
    'rexus kx' => 'rexus keyboard',
    'royal kludge rk61' => 'royal kludge rk61 keyboard',
    'royal kludge rk100' => 'royal kludge keyboard',
    'logitech mk235' => 'logitech mk235 keyboard',
    'logitech k380' => 'logitech k380 keyboard',
    'dell kb216' => 'dell keyboard',
    'logitech g pro x superlight' => 'logitech superlight mouse',
    'logitech g502' => 'logitech g502 mouse',
    'logitech g304' => 'logitech g304 mouse',
    'razer deathadder' => 'razer deathadder mouse',
    'razer viper' => 'razer viper mouse',
    'razer basilisk' => 'razer basilisk mouse',
    'corsair m75' => 'corsair mouse',
    'corsair harpoon' => 'corsair harpoon mouse',
    'logitech mx master' => 'logitech mx master mouse',
    'logitech m750' => 'logitech mouse',
    'logitech m190' => 'logitech mouse',
    'microsoft arc mouse' => 'microsoft arc mouse',
    'dell ms5320w' => 'dell mouse',
    'rexus m100' => 'rexus mouse',
    'logitech g pro x 2' => 'logitech g pro x headset',
    'logitech g733' => 'logitech g733 headset',
    'razer blackshark' => 'razer blackshark headset',
    'razer kraken' => 'razer kraken headset',
    'corsair hs80' => 'corsair hs80 headset',
    'corsair void elite' => 'corsair void headset',
    'steelseries arctis nova 7' => 'steelseries arctis nova 7',
    'steelseries arctis nova 1' => 'steelseries arctis nova',
    'rexus h5' => 'rexus headset',
    'airpods pro' => 'airpods pro',
    'airpods 4' => 'airpods 4',
    'galaxy buds3 pro' => 'samsung galaxy buds3 pro',
    'galaxy buds fe' => 'samsung galaxy buds fe',
    'nothing ear' => 'nothing ear earbuds',
    'redmi buds 5' => 'xiaomi redmi buds',
    'redmi buds 6' => 'xiaomi redmi buds',
    'jbl flip' => 'jbl flip speaker',
    'jbl charge' => 'jbl charge speaker',
    'logitech z333' => 'logitech z333 speaker',
    'logitech z407' => 'logitech z407 speaker',
    'samsung 990 pro' => 'samsung 990 pro ssd',
    'samsung 870 evo' => 'samsung 870 evo ssd',
    'wd black sn850x' => 'wd black sn850x ssd',
    'wd blue sn580' => 'wd blue ssd',
    'kingston kc3000' => 'kingston kc3000 ssd',
    'kingston nv2' => 'kingston nv2 ssd',
    'kingston a400' => 'kingston a400 ssd',
    'sandisk ultra dual' => 'sandisk ultra dual flash drive',
    'sandisk ultra fit' => 'sandisk flash drive',
    'sandisk ixand' => 'sandisk flash drive lightning',
    'kingston datatraveler 64' => 'kingston flash drive',
    'kingston datatraveler 128' => 'kingston flash drive',
    'wd my passport 1tb' => 'wd my passport external drive',
    'wd my passport 2tb' => 'wd my passport external drive',
    'seagate backup plus 1tb' => 'seagate external hard drive',
    'seagate backup plus 2tb' => 'seagate external hard drive',
    'asus original charger' => 'asus laptop charger',
    'lenovo original charger' => 'lenovo laptop charger',
    'dell original charger' => 'dell laptop charger',
    'macbook usb-c charger' => 'macbook charger',
    'ugreen gan 65' => 'ugreen gan charger',
    'ugreen gan 100' => 'ugreen gan charger',
    'anker gan 65' => 'anker gan charger',
    'anker gan 100' => 'anker gan charger',
    'anker powercore 20100' => 'anker powerbank',
    'anker powercore 26800' => 'anker powerbank',
    'anker magsafe power bank' => 'anker magsafe power bank',
    'xiaomi power bank 20000' => 'xiaomi power bank',
    'xiaomi power bank 10000' => 'xiaomi power bank',
    'samsung 10000mah 25w' => 'samsung power bank',
    'ugreen usb-c to usb-c' => 'ugreen usb c cable',
    'ugreen usb-c to lightning' => 'ugreen lightning cable',
    'anker powerline' => 'anker usb c cable',
    'apple usb-c to lightning' => 'apple lightning cable',
    'logitech c920' => 'logitech c920 webcam',
    'logitech streamcam' => 'logitech streamcam',
    'logitech brio' => 'logitech brio 4k webcam',
    'cooler master notepal' => 'cooler master laptop cooling pad',
    'rexus cooling pad' => 'laptop cooling pad',
    'steelseries qck xxl' => 'steelseries qck mousepad',
    'steelseries qck medium' => 'steelseries qck mousepad',
    'razer gigantus' => 'razer gigantus mousepad',
    'rexus gaming mousepad' => 'gaming mousepad',
    'ugreen usb-c hub' => 'ugreen usb c hub',
    'anker 555' => 'anker usb c hub',
    'apple usb-c digital av' => 'apple usb c av adapter',
    'north bayou h100' => 'monitor arm',
    'north bayou g40' => 'dual monitor arm',
    'apc back-ups 650' => 'apc ups',
    'apc back-ups 1200' => 'apc ups',
    'stavol svc' => 'stavol voltage stabilizer',
    'tp-link archer ax73' => 'tp-link router',
    'tp-link deco x50' => 'tp-link deco mesh',
    'asus rt-ax57' => 'asus router',
];

foreach ($noImg as $p) {
    $name = strtolower($p->nama_produk);
    $keyword = $name . ' product';
    foreach ($keywordMap as $key => $kw) {
        if (str_contains($name, $key)) {
            $keyword = $kw;
            break;
        }
    }

    // Try Openverse first
    $imgUrl = null;
    $ovUrl = 'https://api.openverse.engineering/v1/images/?q=' . urlencode($keyword) . '&page_size=1';
    try {
        $resp = Http::timeout(8)->get($ovUrl);
        if ($resp->successful()) {
            $data = $resp->json();
            if (!empty($data['results'][0]['url'])) {
                $imgUrl = $data['results'][0]['url'];
            }
        }
    } catch (\Exception $e) {}

    // Fallback to loremflickr
    if (!$imgUrl) {
        $imgUrl = 'https://loremflickr.com/400/400/' . urlencode($keyword);
    }

    try {
        $resp2 = Http::timeout(10)->get($imgUrl);
        if ($resp2->successful() && strlen($resp2->body()) > 1000) {
            $ext = 'jpg';
            $filename = 'produk/' . str()->slug($p->nama_produk) . '-' . $p->id . '.' . $ext;
            $disk->put($filename, $resp2->body());
            $p->update(['gambar' => $filename]);
            echo "  OK: {$p->nama_produk}\n";
        }
    } catch (\Exception $e) {
        echo "  FAIL: {$p->nama_produk}\n";
    }
}

// Also add images for categories without images
echo "\nMendownload gambar kategori...\n";
foreach (KategoriProduk::whereNull('gambar')->get() as $k) {
    $keyword = $k->nama_kategori;
    $imgUrl = 'https://loremflickr.com/400/300/' . urlencode($keyword);
    try {
        $resp = Http::timeout(10)->get($imgUrl);
        if ($resp->successful() && strlen($resp->body()) > 1000) {
            $filename = 'kategori/' . str()->slug($k->nama_kategori) . '.jpg';
            $disk->put($filename, $resp->body());
            $k->update(['gambar' => $filename]);
            echo "  OK kategori: {$k->nama_kategori}\n";
        }
    } catch (\Exception $e) {}
}

echo "\n=== FINAL ===\n";
echo "Total produk: " . Produk::count() . "\n";
echo "Produk dengan gambar: " . Produk::whereNotNull('gambar')->count() . "\n";
echo "Kategori dengan gambar: " . KategoriProduk::whereNotNull('gambar')->count() . "\n";
