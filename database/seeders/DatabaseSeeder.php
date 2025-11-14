<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Video;
use App\Models\Artikel;
use App\Models\ContentRequest;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Ahmad Dahlan',
            'email' => 'admin@qissa.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $users = [
            ['name' => 'Fatimah Azzahra', 'email' => 'fatimah@example.com'],
            ['name' => 'Muhammad Hakim', 'email' => 'hakim@example.com'],
            ['name' => 'Aisyah Ramadhani', 'email' => 'aisyah@example.com'],
            ['name' => 'Umar Faruq', 'email' => 'umar@example.com'],
            ['name' => 'Khadijah Salsabila', 'email' => 'khadijah@example.com'],
        ];

        $createdUsers = [];
        foreach ($users as $userData) {
            $createdUsers[] = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make('password'),
                'role' => 'user',
            ]);
        }

        $categories = [
            ['name' => 'Sirah Nabawiyah', 'description' => 'Kisah perjalanan hidup Nabi Muhammad SAW dari lahir hingga wafat'],
            ['name' => 'Kisah Para Nabi', 'description' => 'Cerita inspiratif dari 25 nabi dan rasul yang wajib diimani'],
            ['name' => 'Khulafaur Rasyidin', 'description' => 'Kisah 4 khalifah pertama: Abu Bakar, Umar, Utsman, Ali'],
            ['name' => 'Sahabat Nabi', 'description' => 'Teladan hidup dari para sahabat pilihan Rasulullah SAW'],
            ['name' => 'Keemasan Islam', 'description' => 'Periode kejayaan peradaban Islam di berbagai bidang'],
            ['name' => 'Wanita Teladan', 'description' => 'Kisah inspiratif wanita-wanita shalihah dalam sejarah Islam'],
            ['name' => 'Akhir Zaman', 'description' => 'Tanda-tanda kiamat dan peristiwa menjelang akhir zaman'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        $videos = [
            [
                'category_id' => 1,
                'title' => 'Kelahiran Nabi Muhammad SAW: Tahun Gajah yang Penuh Mukjizat',
                'description' => 'Kisah kelahiran Rasulullah SAW pada tahun gajah, dimana Allah menyelamatkan Makkah dari serangan pasukan Abrahah.',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'duration' => 25,
                'status' => 'approved',
                'views' => 24350,
            ],
            [
                'category_id' => 1,
                'title' => 'Perang Badar: 313 vs 1000, Kemenangan yang Mustahil',
                'description' => 'Pasukan kecil kaum Muslim menghadapi 1000 pasukan Quraisy yang lengkap persenjataannya. Pertolongan Allah datang dengan 5000 malaikat.',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'duration' => 45,
                'status' => 'approved',
                'views' => 38750,
            ],
            [
                'category_id' => 1,
                'title' => 'Isra Mi\'raj: Perjalanan Menembus Langit dalam Satu Malam',
                'description' => 'Peristiwa luar biasa dimana Nabi Muhammad SAW diangkat ke langit ketujuh dan menerima perintah shalat 5 waktu.',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'duration' => 35,
                'status' => 'approved',
                'views' => 31200,
            ],
            [
                'category_id' => 2,
                'title' => 'Nabi Ibrahim: Dibakar Hidup-hidup oleh Rakyatnya',
                'description' => 'Kisah keteguhan iman Nabi Ibrahim AS yang dibakar hidup-hidup, namun api berubah menjadi dingin dan sejuk oleh Allah.',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'duration' => 30,
                'status' => 'approved',
                'views' => 28450,
            ],
            [
                'category_id' => 2,
                'title' => 'Nabi Yusuf: Dari Sumur ke Istana Mesir',
                'description' => 'Perjalanan hidup Nabi Yusuf AS yang penuh cobaan: dibuang ke sumur, dijual sebagai budak, difitnah, dipenjara, hingga akhirnya menjadi pemimpin Mesir.',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'duration' => 50,
                'status' => 'approved',
                'views' => 42100,
            ],
            [
                'category_id' => 2,
                'title' => 'Nabi Musa: Membelah Laut Merah dengan Tongkat',
                'description' => 'Mukjizat luar biasa Nabi Musa AS membelah Laut Merah untuk menyelamatkan Bani Israil dari kejaran Firaun.',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'duration' => 40,
                'status' => 'approved',
                'views' => 35800,
            ],
            [
                'category_id' => 3,
                'title' => 'Abu Bakar As-Siddiq: Orang Pertama yang Membenarkan Isra Mi\'raj',
                'description' => 'Keistimewaan Abu Bakar yang langsung membenarkan Isra Mi\'raj tanpa ragu, hingga mendapat gelar As-Siddiq (Yang Membenarkan).',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'duration' => 28,
                'status' => 'approved',
                'views' => 19450,
            ],
            [
                'category_id' => 3,
                'title' => 'Umar bin Khattab: Dari Musuh Islam Menjadi Pahlawan Islam',
                'description' => 'Transformasi luar biasa Umar bin Khattab dari musuh bebuyutan Islam menjadi khalifah yang ditakuti raja-raja dunia.',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'duration' => 38,
                'status' => 'approved',
                'views' => 33600,
            ],
            [
                'category_id' => 5,
                'title' => 'Muhammad Al-Fatih: Pemuda 21 Tahun Penakluk Konstantinopel',
                'description' => 'Kisah inspiratif Sultan Muhammad Al-Fatih yang berhasil menaklukkan Konstantinopel sesuai sabda Rasulullah SAW di usia 21 tahun.',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'duration' => 45,
                'status' => 'approved',
                'views' => 51200,
            ],
            [
                'category_id' => 5,
                'title' => 'Salahuddin Al-Ayyubi: Pembebas Masjidil Aqsa dari Tentara Salib',
                'description' => 'Strategi militer dan kepemimpinan Salahuddin Al-Ayyubi dalam membebaskan Palestina setelah 88 tahun dikuasai Crusader.',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'duration' => 48,
                'status' => 'approved',
                'views' => 47850,
            ],
            [
                'category_id' => 7,
                'title' => 'Tanda-Tanda Kiamat Kecil yang Sudah Terjadi',
                'description' => 'Pembahasan 20+ tanda kiamat kecil yang telah terjadi di zaman kita berdasarkan hadits shahih.',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'duration' => 55,
                'status' => 'approved',
                'views' => 63400,
            ],
        ];

        foreach ($videos as $video) {
            Video::create($video);
        }

        $artikels = [
            [
                'category_id' => 1,
                'user_id' => $createdUsers[0]->id,
                'title' => 'Al-Amin: Julukan Nabi Muhammad SAW Sebelum Menjadi Rasul',
                'excerpt' => 'Sebelum diangkat menjadi nabi, Muhammad SAW sudah dikenal sebagai Al-Amin (yang terpercaya) oleh seluruh masyarakat Makkah.',
                'content' => "Sebelum menjadi nabi, Muhammad SAW sudah dikenal sebagai Al-Amin (yang terpercaya) di kalangan masyarakat Makkah. Kejujuran dan amanah beliau sangat terkenal sehingga bahkan musuh-musuhnya pun menitipkan harta kepada beliau.\n\nSifat mulia ini menjadi pondasi kuat dalam penyebaran dakwah Islam. Ketika beliau menyampaikan risalah, orang-orang Makkah tahu bahwa Muhammad bukanlah pembohong.\n\nBahkan Abu Jahal yang memusuhi Islam pun mengakui, \"Kami tidak mendustakanmu Muhammad, tapi kami mendustakan apa yang kamu bawa.\" Ini membuktikan bahwa kredibilitas pribadi Rasulullah SAW tidak pernah diragukan.",
                'status' => 'approved',
                'votes' => 245,
                'views' => 5430,
            ],
            [
                'category_id' => 2,
                'user_id' => $createdUsers[1]->id,
                'title' => 'Kesabaran Nabi Ayub: Ujian yang Berlangsung 18 Tahun',
                'excerpt' => 'Nabi Ayub AS mengalami ujian luar biasa selama 18 tahun: kehilangan harta, anak, kesehatan, hingga dijauhi semua orang kecuali istrinya.',
                'content' => "Nabi Ayub AS adalah teladan kesabaran dalam menghadapi musibah. Beliau kehilangan semua harta kekayaannya, seluruh anaknya meninggal, tubuhnya penuh penyakit kulit yang parah, dan dijauhi oleh semua orang.\n\nSelama 18 tahun ujian itu berlangsung, Nabi Ayub AS tidak pernah sekalipun mengeluh kepada Allah. Yang setia menemani hanya istrinya.\n\nKetika beliau berdoa, Allah sembuhkan penyakitnya dengan mata air yang muncul dari tanah. Allah kembalikan semua hartanya berlipat ganda, dan karuniakan anak-anak yang baru.\n\nKisah ini mengajarkan kita bahwa kesabaran dalam ujian akan berbuah kebaikan yang berlipat ganda dari Allah SWT.",
                'status' => 'approved',
                'votes' => 312,
                'views' => 6780,
            ],
            [
                'category_id' => 3,
                'user_id' => $createdUsers[2]->id,
                'title' => 'Umar bin Khattab Menangis di Malam Hari',
                'excerpt' => 'Di siang hari Umar tegas menegakkan hukum, tapi di malam hari beliau menangis takut tidak bisa memenuhi amanah sebagai pemimpin.',
                'content' => "Umar bin Khattab RA dikenal sebagai khalifah yang tegas dan adil. Di siang hari, beliau memeriksa pasar, memastikan tidak ada pengurangan timbangan, dan menegakkan hukum tanpa pandang bulu.\n\nNamun siapa sangka, di malam hari beliau adalah sosok yang berbeda. Umar sering menangis dalam shalat malam karena takut tidak bisa memenuhi amanah sebagai pemimpin umat.\n\nBeliau pernah berkata, \"Seandainya ada seekor kambing mati kelaparan di tepi sungai Eufrat, aku khawatir Allah akan memintai pertanggungjawaban dariku.\"\n\nKepemimpinan beliau menjadi teladan bagi pemimpin di seluruh dunia: tegas dalam hukum, tapi lembut dalam hati.",
                'status' => 'approved',
                'votes' => 428,
                'views' => 8920,
            ],
            [
                'category_id' => 4,
                'user_id' => $createdUsers[3]->id,
                'title' => 'Bilal bin Rabah: Muadzin Pertama yang Dianiaya karena Islam',
                'excerpt' => 'Bilal, budak berkulit hitam yang disiksa di padang pasir Makkah, namun tetap teguh dengan ucapan "Ahad, Ahad!" (Allah Maha Esa).',
                'content' => "Bilal bin Rabah adalah salah satu sahabat pertama yang masuk Islam. Sebagai budak, beliau mengalami siksaan luar biasa dari tuannya, Umayyah bin Khalaf.\n\nBilal diseret ke padang pasir Makkah yang panas terik, dadanya ditindih batu besar, namun beliau tetap berucap \"Ahad! Ahad!\" (Allah Maha Esa!).\n\nAbu Bakar akhirnya membebaskan Bilal dengan membeli dan memerdekakannya. Nabi Muhammad SAW sangat menyayangi Bilal dan menjadikannya muadzin pertama dalam Islam.\n\nSuara adzan Bilal yang merdu membuat Rasulullah SAW berkata, \"Rindu aku mendengar langkah-langkah Bilal di surga.\" SubhanAllah!\n\nKisah Bilal mengajarkan kita bahwa Islam tidak memandang warna kulit atau status sosial. Yang dilihat Allah adalah ketaqwaan.",
                'status' => 'approved',
                'votes' => 389,
                'views' => 7650,
            ],
            [
                'category_id' => 5,
                'user_id' => $createdUsers[4]->id,
                'title' => 'Ibnu Sina: Dokter Jenius yang Hafal Al-Quran di Usia 10 Tahun',
                'excerpt' => 'Ibnu Sina (Avicenna) adalah jenius Muslim yang karyanya "Al-Qanun fi at-Tibb" menjadi referensi medis Eropa selama 600 tahun.',
                'content' => "Ibnu Sina, yang dikenal di Barat sebagai Avicenna, adalah salah satu ilmuwan terbesar dalam sejarah Islam. Di usia 10 tahun, beliau sudah hafal Al-Quran!\n\nPada usia 16 tahun, Ibnu Sina sudah dipercaya mengobati Sultan Samaniyah. Kejeniusannya dalam bidang kedokteran menghasilkan karya monumental \"Al-Qanun fi at-Tibb\" (The Canon of Medicine).\n\nBuku ini menjadi referensi utama di universitas-universitas Eropa selama lebih dari 600 tahun! Bahkan hingga abad ke-18, mahasiswa kedokteran di Eropa masih mempelajari karya Ibnu Sina.\n\nSelain kedokteran, beliau juga ahli dalam filsafat, matematika, astronomi, dan kimia. Ibnu Sina menulis lebih dari 450 karya ilmiah sepanjang hidupnya.\n\nKisah ini membuktikan bahwa kejayaan peradaban Islam dibangun atas fondasi ilmu pengetahuan yang kuat, dengan Al-Quran sebagai sumber inspirasi utama.",
                'status' => 'approved',
                'votes' => 456,
                'views' => 9340,
            ],
            [
                'category_id' => 6,
                'user_id' => $createdUsers[0]->id,
                'title' => 'Khadijah binti Khuwailid: Wanita Pertama yang Masuk Islam',
                'excerpt' => 'Khadijah adalah istri pertama Nabi Muhammad SAW yang menjadi penyokong utama dakwah Islam di masa-masa awal.',
                'content' => "Khadijah binti Khuwailid adalah wanita mulia yang menjadi istri pertama Nabi Muhammad SAW. Beliau adalah wanita kaya raya, pedagang sukses, dan sangat dihormati di Makkah.\n\nKetika Muhammad SAW menerima wahyu pertama di Gua Hira dan pulang dalam keadaan gemetar, Khadijah-lah yang menenangkannya. Beliau berkata, \"Demi Allah, Allah tidak akan menghinakanmu. Karena engkau adalah orang yang menyambung silaturahmi, menolong yang lemah, dan berbuat baik kepada manusia.\"\n\nKhadijah adalah orang pertama yang beriman kepada Muhammad sebagai Rasulullah. Seluruh hartanya dikorbankan untuk mendukung dakwah Islam.\n\nSelama 25 tahun pernikahan mereka, Nabi Muhammad SAW tidak pernah menikahi wanita lain. Bahkan setelah Khadijah wafat, beliau selalu mengenang kebaikannya dengan penuh cinta.\n\nKhadijah adalah teladan istri yang shalihah, ibu yang penuh kasih sayang, dan wanita karir yang sukses tanpa meninggalkan kewajiban agamanya.",
                'status' => 'approved',
                'votes' => 534,
                'views' => 11200,
            ],
            [
                'category_id' => 7,
                'user_id' => $createdUsers[1]->id,
                'title' => 'Dajjal: Fitnah Terbesar di Akhir Zaman',
                'excerpt' => 'Dajjal adalah fitnah terbesar yang akan muncul di akhir zaman. Setiap nabi memperingatkan umatnya tentang bahaya Dajjal.',
                'content' => "Dajjal adalah makhluk yang akan muncul di akhir zaman dan menjadi fitnah terbesar bagi umat manusia. Rasulullah SAW bersabda bahwa tidak ada fitnah yang lebih besar dari penciptaan Adam hingga hari kiamat selain fitnah Dajjal.\n\nDajjal digambarkan sebagai sosok laki-laki dengan satu mata buta, dan di dahinya tertulis \"kafir\" yang dapat dibaca oleh orang mukmin. Dia akan mengklaim sebagai tuhan dan memiliki kemampuan luar biasa yang menyerupai mukjizat.\n\nDajjal akan muncul dari arah timur dan berkeliling dunia selama 40 hari. Hari pertamanya seperti satu tahun, hari kedua seperti satu bulan, hari ketiga seperti satu minggu, dan seterusnya seperti hari biasa.\n\nRasulullah SAW mengajarkan kita untuk berlindung dari fitnah Dajjal dengan membaca 10 ayat pertama Surat Al-Kahfi dan memperbanyak ibadah.\n\nAkhirnya, Dajjal akan dibunuh oleh Nabi Isa AS di pintu Ludd (Palestina), dan itulah akhir dari fitnah terbesar sepanjang sejarah manusia.",
                'status' => 'approved',
                'votes' => 612,
                'views' => 13850,
            ],
        ];

        foreach ($artikels as $artikel) {
            Artikel::create($artikel);
        }

        $requests = [
            [
                'user_id' => $createdUsers[2]->id,
                'title' => 'Video Kisah Khalid bin Walid: Pedang Allah yang Tak Terkalahkan',
                'description' => 'Request video tentang Saifullah (Pedang Allah) yang tidak pernah kalah dalam 100+ pertempuran.',
                'category_id' => 4,
                'type' => 'video',
                'priority' => 'high',
                'votes' => 156,
                'status' => 'pending',
            ],
            [
                'user_id' => $createdUsers[3]->id,
                'title' => 'Artikel Perpustakaan Baitul Hikmah di Baghdad',
                'description' => 'Ingin membaca artikel tentang kejayaan perpustakaan terbesar di dunia pada masa Dinasti Abbasiyah.',
                'category_id' => 5,
                'type' => 'artikel',
                'priority' => 'medium',
                'votes' => 89,
                'status' => 'pending',
            ],
            [
                'user_id' => $createdUsers[4]->id,
                'title' => 'Video Sejarah Pembangunan Masjidil Haram',
                'description' => 'Perjalanan sejarah pembangunan dan perluasan Masjidil Haram dari masa Nabi Ibrahim hingga kini.',
                'category_id' => 1,
                'type' => 'video',
                'priority' => 'high',
                'votes' => 203,
                'status' => 'pending',
            ],
        ];

        foreach ($requests as $request) {
            ContentRequest::create($request);
        }

        $createdUsers[0]->favorites()->create([
            'favoritable_type' => Video::class,
            'favoritable_id' => 1,
        ]);

        $createdUsers[0]->favorites()->create([
            'favoritable_type' => Artikel::class,
            'favoritable_id' => 3,
        ]);

        $createdUsers[1]->favorites()->create([
            'favoritable_type' => Video::class,
            'favoritable_id' => 9,
        ]);

        $createdUsers[2]->favorites()->create([
            'favoritable_type' => Artikel::class,
            'favoritable_id' => 5,
        ]);

        echo "\n✅ Database seeded successfully!\n";
        echo "========================================\n";
        echo "👤 Admin Account:\n";
        echo "   Email: admin@qissa.com\n";
        echo "   Password: password\n";
        echo "========================================\n";
        echo "👥 User Accounts:\n";
        foreach ($users as $user) {
            echo "   Email: {$user['email']} | Password: password\n";
        }
        echo "========================================\n";
        echo "📊 Statistics:\n";
        echo "   Categories: " . Category::count() . "\n";
        echo "   Videos: " . Video::count() . "\n";
        echo "   Articles: " . Artikel::count() . "\n";
        echo "   Requests: " . ContentRequest::count() . "\n";
        echo "========================================\n\n";
    }
}