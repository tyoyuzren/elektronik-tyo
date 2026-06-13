<?php

namespace Database\Seeders;

use App\Models\KategoriProduk;
use App\Models\Produk;
use Illuminate\Database\Seeder;

class LaptopAksesorisSeeder extends Seeder
{
    public function run(): void
    {
        // --- LAPTOP CATEGORIES ---
        $laptopGaming = KategoriProduk::firstOrCreate(
            ['nama_kategori' => 'Laptop Gaming'],
            ['deskripsi' => 'Laptop khusus gaming performa tinggi']
        );
        $laptopUltrabook = KategoriProduk::firstOrCreate(
            ['nama_kategori' => 'Laptop Ultrabook'],
            ['deskripsi' => 'Laptop tipis ringan untuk mobilitas tinggi']
        );
        $macbook = KategoriProduk::firstOrCreate(
            ['nama_kategori' => 'MacBook'],
            ['deskripsi' => 'Apple MacBook series']
        );

        // --- ACCESSORIES CATEGORIES ---
        $monitor = KategoriProduk::firstOrCreate(
            ['nama_kategori' => 'Monitor'],
            ['deskripsi' => 'Monitor komputer dan laptop']
        );
        $keyboard = KategoriProduk::firstOrCreate(
            ['nama_kategori' => 'Keyboard'],
            ['deskripsi' => 'Keyboard mekanik dan membran']
        );
        $mouse = KategoriProduk::firstOrCreate(
            ['nama_kategori' => 'Mouse'],
            ['deskripsi' => 'Mouse wired dan wireless']
        );
        $headset = KategoriProduk::firstOrCreate(
            ['nama_kategori' => 'Headset & Audio'],
            ['deskripsi' => 'Headset, earphone, dan speaker']
        );
        $storage = KategoriProduk::firstOrCreate(
            ['nama_kategori' => 'Penyimpanan'],
            ['deskripsi' => 'SSD, flashdisk, dan hardisk eksternal']
        );
        $charger = KategoriProduk::firstOrCreate(
            ['nama_kategori' => 'Charger & Power Bank'],
            ['deskripsi' => 'Charger, power bank, dan kabel']
        );
        $aksesorisLain = KategoriProduk::firstOrCreate(
            ['nama_kategori' => 'Aksesoris Lainnya'],
            ['deskripsi' => 'Aksesoris elektronik lainnya']
        );

        // ========================
        // LAPTOP GAMING
        // ========================
        $laptopGamingProducts = [
            // ASUS ROG
            ['nama_produk' => 'ASUS ROG Zephyrus G14 (2024)', 'harga' => 28000000, 'stok' => 5],
            ['nama_produk' => 'ASUS ROG Zephyrus G16 (2024)', 'harga' => 35000000, 'stok' => 3],
            ['nama_produk' => 'ASUS ROG Strix G16 (2024)', 'harga' => 22000000, 'stok' => 7],
            ['nama_produk' => 'ASUS ROG Strix Scar 16 (2024)', 'harga' => 42000000, 'stok' => 2],
            ['nama_produk' => 'ASUS TUF Gaming A15 (2024)', 'harga' => 15000000, 'stok' => 10],
            ['nama_produk' => 'ASUS TUF Gaming F15 (2024)', 'harga' => 14000000, 'stok' => 8],
            // Lenovo Legion
            ['nama_produk' => 'Lenovo Legion 5 Pro (2024)', 'harga' => 24000000, 'stok' => 5],
            ['nama_produk' => 'Lenovo Legion 7i (2024)', 'harga' => 35000000, 'stok' => 3],
            ['nama_produk' => 'Lenovo LOQ 15 (2024)', 'harga' => 13000000, 'stok' => 10],
            // Acer Predator
            ['nama_produk' => 'Acer Predator Helios Neo 16', 'harga' => 22000000, 'stok' => 5],
            ['nama_produk' => 'Acer Nitro V15', 'harga' => 12000000, 'stok' => 8],
            // MSI
            ['nama_produk' => 'MSI Katana 15 (2024)', 'harga' => 18000000, 'stok' => 6],
            ['nama_produk' => 'MSI Stealth 16 Studio', 'harga' => 33000000, 'stok' => 3],
            ['nama_produk' => 'MSI Cyborg 14', 'harga' => 15000000, 'stok' => 5],
            // Dell
            ['nama_produk' => 'Dell Alienware m16 R2', 'harga' => 38000000, 'stok' => 2],
            ['nama_produk' => 'Dell G15 (2024)', 'harga' => 16000000, 'stok' => 7],
            // HP
            ['nama_produk' => 'HP Victus 16 (2024)', 'harga' => 14000000, 'stok' => 8],
            ['nama_produk' => 'HP OMEN Transcend 16', 'harga' => 26000000, 'stok' => 4],
        ];

        // ========================
        // LAPTOP ULTRABOOK
        // ========================
        $laptopUltrabookProducts = [
            // ASUS Zenbook
            ['nama_produk' => 'ASUS Zenbook 14 OLED (2024)', 'harga' => 16000000, 'stok' => 8],
            ['nama_produk' => 'ASUS Zenbook 14X OLED', 'harga' => 19000000, 'stok' => 5],
            ['nama_produk' => 'ASUS Vivobook 14 (2024)', 'harga' => 9000000, 'stok' => 12],
            ['nama_produk' => 'ASUS Vivobook 16 (2024)', 'harga' => 10000000, 'stok' => 10],
            ['nama_produk' => 'ASUS ExpertBook B5', 'harga' => 18000000, 'stok' => 4],
            // Lenovo
            ['nama_produk' => 'Lenovo ThinkPad X1 Carbon Gen 12', 'harga' => 30000000, 'stok' => 3],
            ['nama_produk' => 'Lenovo ThinkPad T14s Gen 5', 'harga' => 22000000, 'stok' => 5],
            ['nama_produk' => 'Lenovo Yoga 9i (2024)', 'harga' => 23000000, 'stok' => 4],
            ['nama_produk' => 'Lenovo IdeaPad Slim 5 (2024)', 'harga' => 10000000, 'stok' => 10],
            // Dell
            ['nama_produk' => 'Dell XPS 14 (2024)', 'harga' => 26000000, 'stok' => 4],
            ['nama_produk' => 'Dell XPS 16 (2024)', 'harga' => 32000000, 'stok' => 3],
            ['nama_produk' => 'Dell Inspiron 14 (2024)', 'harga' => 11000000, 'stok' => 8],
            ['nama_produk' => 'Dell Latitude 7450', 'harga' => 20000000, 'stok' => 5],
            // HP
            ['nama_produk' => 'HP Spectre x360 14 (2024)', 'harga' => 22000000, 'stok' => 4],
            ['nama_produk' => 'HP Envy 16 (2024)', 'harga' => 18000000, 'stok' => 5],
            ['nama_produk' => 'HP Pavilion Plus 14 (2024)', 'harga' => 13000000, 'stok' => 7],
            // Acer
            ['nama_produk' => 'Acer Swift Go 14 (2024)', 'harga' => 11000000, 'stok' => 6],
            ['nama_produk' => 'Acer Aspire 5 (2024)', 'harga' => 8000000, 'stok' => 10],
            // Microsoft
            ['nama_produk' => 'Microsoft Surface Laptop 6', 'harga' => 24000000, 'stok' => 3],
            ['nama_produk' => 'Microsoft Surface Pro 10', 'harga' => 20000000, 'stok' => 4],
        ];

        // ========================
        // MacBook
        // ========================
        $macbookProducts = [
            // MacBook Air
            ['nama_produk' => 'MacBook Air M1 (2020)', 'harga' => 11000000, 'stok' => 8],
            ['nama_produk' => 'MacBook Air M2 (2022)', 'harga' => 15000000, 'stok' => 10],
            ['nama_produk' => 'MacBook Air M3 (2024)', 'harga' => 18000000, 'stok' => 8],
            ['nama_produk' => 'MacBook Air M4 (2025)', 'harga' => 20000000, 'stok' => 5],
            // MacBook Pro
            ['nama_produk' => 'MacBook Pro 14 M3 (2023)', 'harga' => 26000000, 'stok' => 4],
            ['nama_produk' => 'MacBook Pro 16 M3 Max (2023)', 'harga' => 42000000, 'stok' => 2],
            ['nama_produk' => 'MacBook Pro 14 M4 (2024)', 'harga' => 29000000, 'stok' => 5],
            ['nama_produk' => 'MacBook Pro 16 M4 Max (2024)', 'harga' => 48000000, 'stok' => 2],
            ['nama_produk' => 'MacBook Pro 14 M4 Pro (2024)', 'harga' => 35000000, 'stok' => 3],
        ];

        // ========================
        // MONITOR
        // ========================
        $monitorProducts = [
            // Gaming Monitor
            ['nama_produk' => 'Samsung Odyssey G7 27" 240Hz', 'harga' => 8000000, 'stok' => 5],
            ['nama_produk' => 'Samsung Odyssey G5 27" 165Hz', 'harga' => 5000000, 'stok' => 8],
            ['nama_produk' => 'LG UltraGear 27" 165Hz', 'harga' => 4500000, 'stok' => 7],
            ['nama_produk' => 'LG UltraGear 32" 240Hz', 'harga' => 7500000, 'stok' => 4],
            ['nama_produk' => 'ASUS ROG Swift PG27AQDM 27" OLED 240Hz', 'harga' => 14000000, 'stok' => 2],
            ['nama_produk' => 'ASUS TUF Gaming VG27AQ3A 27" 180Hz', 'harga' => 5500000, 'stok' => 6],
            ['nama_produk' => 'Acer Nitro XV272U 27" 180Hz', 'harga' => 4500000, 'stok' => 5],
            // Office/Productivity Monitor
            ['nama_produk' => 'Dell UltraSharp U2723QE 27" 4K', 'harga' => 10000000, 'stok' => 4],
            ['nama_produk' => 'Dell S2722QC 27" 4K', 'harga' => 7000000, 'stok' => 5],
            ['nama_produk' => 'LG 27UP850N 27" 4K', 'harga' => 6500000, 'stok' => 5],
            ['nama_produk' => 'Samsung Smart Monitor M7 32" 4K', 'harga' => 7000000, 'stok' => 6],
            ['nama_produk' => 'ASUS ProArt PA278QV 27" 2K', 'harga' => 6000000, 'stok' => 4],
            ['nama_produk' => 'Lenovo ThinkVision P27u-20 27" 4K', 'harga' => 8500000, 'stok' => 3],
            // Budget Monitor
            ['nama_produk' => 'Samsung LS24R350 24"', 'harga' => 1800000, 'stok' => 15],
            ['nama_produk' => 'LG 24MR400 24" 100Hz', 'harga' => 2000000, 'stok' => 12],
            ['nama_produk' => 'Acer SA240Y 24"', 'harga' => 1600000, 'stok' => 15],
        ];

        // ========================
        // KEYBOARD
        // ========================
        $keyboardProducts = [
            // Mechanical Keyboard
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
            // Membrane Keyboard
            ['nama_produk' => 'Logitech MK235 Combo', 'harga' => 250000, 'stok' => 20],
            ['nama_produk' => 'Logitech K380 Bluetooth', 'harga' => 450000, 'stok' => 15],
            ['nama_produk' => 'Dell KB216', 'harga' => 150000, 'stok' => 30],
        ];

        // ========================
        // MOUSE
        // ========================
        $mouseProducts = [
            // Gaming Mouse
            ['nama_produk' => 'Logitech G Pro X Superlight 2', 'harga' => 2200000, 'stok' => 5],
            ['nama_produk' => 'Logitech G502 X Plus', 'harga' => 1800000, 'stok' => 7],
            ['nama_produk' => 'Logitech G304 Lightspeed', 'harga' => 500000, 'stok' => 15],
            ['nama_produk' => 'Razer DeathAdder V3 Pro', 'harga' => 2000000, 'stok' => 5],
            ['nama_produk' => 'Razer Viper V3 Pro', 'harga' => 2300000, 'stok' => 4],
            ['nama_produk' => 'Razer Basilisk V3 X', 'harga' => 600000, 'stok' => 10],
            ['nama_produk' => 'Corsair M75 Wireless', 'harga' => 1500000, 'stok' => 5],
            ['nama_produk' => 'Corsair Harpoon RGB', 'harga' => 400000, 'stok' => 12],
            // Office/Productivity Mouse
            ['nama_produk' => 'Logitech MX Master 3S', 'harga' => 1600000, 'stok' => 8],
            ['nama_produk' => 'Logitech M750', 'harga' => 600000, 'stok' => 10],
            ['nama_produk' => 'Logitech M190', 'harga' => 200000, 'stok' => 20],
            ['nama_produk' => 'Microsoft Arc Mouse', 'harga' => 700000, 'stok' => 6],
            ['nama_produk' => 'Dell MS5320W', 'harga' => 350000, 'stok' => 12],
            ['nama_produk' => 'Rexus M100', 'harga' => 100000, 'stok' => 30],
        ];

        // ========================
        // HEADSET & AUDIO
        // ========================
        $headsetProducts = [
            // Gaming Headset
            ['nama_produk' => 'Logitech G Pro X 2 Lightspeed', 'harga' => 2500000, 'stok' => 5],
            ['nama_produk' => 'Logitech G733', 'harga' => 1800000, 'stok' => 7],
            ['nama_produk' => 'Razer BlackShark V2 Pro (2023)', 'harga' => 2200000, 'stok' => 5],
            ['nama_produk' => 'Razer Kraken V4 Pro', 'harga' => 2800000, 'stok' => 3],
            ['nama_produk' => 'Corsair HS80 RGB Wireless', 'harga' => 2000000, 'stok' => 5],
            ['nama_produk' => 'Corsair Void Elite Wireless', 'harga' => 1200000, 'stok' => 8],
            ['nama_produk' => 'SteelSeries Arctis Nova 7', 'harga' => 2300000, 'stok' => 4],
            ['nama_produk' => 'SteelSeries Arctis Nova 1', 'harga' => 800000, 'stok' => 10],
            ['nama_produk' => 'Rexus H5', 'harga' => 150000, 'stok' => 25],
            // TWS Earphone
            ['nama_produk' => 'Apple AirPods Pro 2', 'harga' => 3500000, 'stok' => 8],
            ['nama_produk' => 'Apple AirPods 4', 'harga' => 2500000, 'stok' => 10],
            ['nama_produk' => 'Samsung Galaxy Buds3 Pro', 'harga' => 3000000, 'stok' => 5],
            ['nama_produk' => 'Samsung Galaxy Buds FE', 'harga' => 1200000, 'stok' => 10],
            ['nama_produk' => 'Nothing Ear (2)', 'harga' => 2000000, 'stok' => 6],
            ['nama_produk' => 'Nothing Ear (a)', 'harga' => 1200000, 'stok' => 8],
            ['nama_produk' => 'Xiaomi Redmi Buds 5', 'harga' => 400000, 'stok' => 20],
            ['nama_produk' => 'Xiaomi Redmi Buds 6 Active', 'harga' => 250000, 'stok' => 25],
            // Speaker
            ['nama_produk' => 'JBL Flip 6', 'harga' => 1500000, 'stok' => 8],
            ['nama_produk' => 'JBL Charge 5', 'harga' => 2200000, 'stok' => 5],
            ['nama_produk' => 'Logitech Z333 2.1', 'harga' => 800000, 'stok' => 8],
            ['nama_produk' => 'Logitech Z407 2.1 Bluetooth', 'harga' => 1200000, 'stok' => 6],
        ];

        // ========================
        // PENYIMPANAN (STORAGE)
        // ========================
        $storageProducts = [
            // SSD
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
            // Flashdisk
            ['nama_produk' => 'Sandisk Ultra Dual 128GB', 'harga' => 200000, 'stok' => 20],
            ['nama_produk' => 'Sandisk Ultra Dual 256GB', 'harga' => 350000, 'stok' => 15],
            ['nama_produk' => 'Sandisk Ultra Fit 64GB', 'harga' => 150000, 'stok' => 25],
            ['nama_produk' => 'Sandisk iXpand 128GB (Lightning)', 'harga' => 500000, 'stok' => 8],
            ['nama_produk' => 'Kingston DataTraveler 64GB', 'harga' => 100000, 'stok' => 30],
            ['nama_produk' => 'Kingston DataTraveler 128GB', 'harga' => 180000, 'stok' => 20],
            // Hardisk Eksternal
            ['nama_produk' => 'WD My Passport 1TB', 'harga' => 900000, 'stok' => 10],
            ['nama_produk' => 'WD My Passport 2TB', 'harga' => 1300000, 'stok' => 8],
            ['nama_produk' => 'Seagate Backup Plus 1TB', 'harga' => 850000, 'stok' => 10],
            ['nama_produk' => 'Seagate Backup Plus 2TB', 'harga' => 1200000, 'stok' => 7],
        ];

        // ========================
        // CHARGER & POWER BANK
        // ========================
        $chargerProducts = [
            // Charger Laptop
            ['nama_produk' => 'ASUS Original Charger 150W', 'harga' => 500000, 'stok' => 8],
            ['nama_produk' => 'Lenovo Original Charger 135W', 'harga' => 450000, 'stok' => 8],
            ['nama_produk' => 'Dell Original Charger 130W', 'harga' => 500000, 'stok' => 6],
            ['nama_produk' => 'MacBook USB-C Charger 67W Original', 'harga' => 800000, 'stok' => 5],
            ['nama_produk' => 'MacBook USB-C Charger 96W Original', 'harga' => 1000000, 'stok' => 4],
            // GaN Charger
            ['nama_produk' => 'UGREEN GaN 65W 3 Port', 'harga' => 400000, 'stok' => 15],
            ['nama_produk' => 'UGREEN GaN 100W 4 Port', 'harga' => 600000, 'stok' => 10],
            ['nama_produk' => 'Anker GaN 65W 3 Port', 'harga' => 450000, 'stok' => 12],
            ['nama_produk' => 'Anker GaN 100W 4 Port', 'harga' => 700000, 'stok' => 8],
            // Power Bank
            ['nama_produk' => 'Anker PowerCore 20100mAh', 'harga' => 500000, 'stok' => 12],
            ['nama_produk' => 'Anker PowerCore 26800mAh', 'harga' => 700000, 'stok' => 8],
            ['nama_produk' => 'Anker MagSafe Power Bank 10000mAh', 'harga' => 600000, 'stok' => 10],
            ['nama_produk' => 'Xiaomi Power Bank 20000mAh', 'harga' => 300000, 'stok' => 20],
            ['nama_produk' => 'Xiaomi Power Bank 10000mAh', 'harga' => 200000, 'stok' => 25],
            ['nama_produk' => 'Samsung 10000mAh 25W', 'harga' => 350000, 'stok' => 15],
            // Kabel
            ['nama_produk' => 'UGREEN USB-C to USB-C 1M PD 100W', 'harga' => 100000, 'stok' => 30],
            ['nama_produk' => 'UGREEN USB-C to Lightning 1M', 'harga' => 90000, 'stok' => 30],
            ['nama_produk' => 'Anker PowerLine USB-C 1M', 'harga' => 120000, 'stok' => 25],
            ['nama_produk' => 'Apple USB-C to Lightning 1M Original', 'harga' => 300000, 'stok' => 10],
        ];

        // ========================
        // AKSESORIS LAINNYA
        // ========================
        $aksesorisLainProducts = [
            // Webcam
            ['nama_produk' => 'Logitech C920 HD Pro', 'harga' => 800000, 'stok' => 8],
            ['nama_produk' => 'Logitech StreamCam', 'harga' => 1800000, 'stok' => 5],
            ['nama_produk' => 'Logitech Brio 4K', 'harga' => 2200000, 'stok' => 3],
            // Cooling Pad
            ['nama_produk' => 'Cooler Master NotePal U3 Plus', 'harga' => 350000, 'stok' => 10],
            ['nama_produk' => 'Rexus Cooling Pad 15.6"', 'harga' => 150000, 'stok' => 15],
            // Mousepad
            ['nama_produk' => 'SteelSeries QcK XXL', 'harga' => 350000, 'stok' => 10],
            ['nama_produk' => 'SteelSeries QcK Medium', 'harga' => 200000, 'stok' => 15],
            ['nama_produk' => 'Razer Gigantus V2 XXL', 'harga' => 400000, 'stok' => 8],
            ['nama_produk' => 'Rexus Gaming Mousepad XL', 'harga' => 100000, 'stok' => 20],
            // USB Hub
            ['nama_produk' => 'UGREEN USB-C Hub 7-in-1', 'harga' => 350000, 'stok' => 12],
            ['nama_produk' => 'Anker 555 USB-C Hub 8-in-1', 'harga' => 600000, 'stok' => 8],
            ['nama_produk' => 'Apple USB-C Digital AV Multiport', 'harga' => 800000, 'stok' => 6],
            // Monitor Arm
            ['nama_produk' => 'North Bayou H100 Single Arm', 'harga' => 250000, 'stok' => 10],
            ['nama_produk' => 'North Bayou G40 Dual Arm', 'harga' => 500000, 'stok' => 6],
            // Stabilizer / UPS
            ['nama_produk' => 'UPS APC Back-UPS 650VA', 'harga' => 1200000, 'stok' => 5],
            ['nama_produk' => 'UPS APC Back-UPS 1200VA', 'harga' => 2000000, 'stok' => 3],
            ['nama_produk' => 'Stavol SVC 1000VA', 'harga' => 400000, 'stok' => 8],
            // Wi-Fi & Networking
            ['nama_produk' => 'TP-Link Archer AX73 AX5400', 'harga' => 1000000, 'stok' => 8],
            ['nama_produk' => 'TP-Link Deco X50 Mesh 2 Pack', 'harga' => 1500000, 'stok' => 5],
            ['nama_produk' => 'ASUS RT-AX57 AX3000', 'harga' => 800000, 'stok' => 6],
        ];

        // Insert laptops
        foreach ($laptopGamingProducts as $p) {
            Produk::create(array_merge($p, ['category_id' => $laptopGaming->id]));
        }
        foreach ($laptopUltrabookProducts as $p) {
            Produk::create(array_merge($p, ['category_id' => $laptopUltrabook->id]));
        }
        foreach ($macbookProducts as $p) {
            Produk::create(array_merge($p, ['category_id' => $macbook->id]));
        }

        // Insert accessories
        foreach ($monitorProducts as $p) {
            Produk::create(array_merge($p, ['category_id' => $monitor->id]));
        }
        foreach ($keyboardProducts as $p) {
            Produk::create(array_merge($p, ['category_id' => $keyboard->id]));
        }
        foreach ($mouseProducts as $p) {
            Produk::create(array_merge($p, ['category_id' => $mouse->id]));
        }
        foreach ($headsetProducts as $p) {
            Produk::create(array_merge($p, ['category_id' => $headset->id]));
        }
        foreach ($storageProducts as $p) {
            Produk::create(array_merge($p, ['category_id' => $storage->id]));
        }
        foreach ($chargerProducts as $p) {
            Produk::create(array_merge($p, ['category_id' => $charger->id]));
        }
        foreach ($aksesorisLainProducts as $p) {
            Produk::create(array_merge($p, ['category_id' => $aksesorisLain->id]));
        }
    }
}
