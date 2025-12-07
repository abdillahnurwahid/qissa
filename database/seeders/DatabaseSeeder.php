<?php

namespace Database\Seeders;

use App\Models\Artikel;
use App\Models\Category;
use App\Models\Comment;
use App\Models\ContentRequest;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Abdillah Nurwahid',
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
            ['name' => 'Ali Rahman', 'email' => 'ali@example.com'],
            ['name' => 'Zahra Maryam', 'email' => 'zahra@example.com'],
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
                'video_url' => 'https://www.youtube.com/watch?v=XqZsoesa55w',
                'duration' => 15,
                'status' => 'approved',
                'views' => 1248,
            ],
            [
                'category_id' => 1,
                'title' => 'Perang Badar: 313 vs 1000, Kemenangan yang Mustahil',
                'description' => 'Pasukan kecil kaum Muslim menghadapi 1000 pasukan Quraisy. Pertolongan Allah datang dengan 5000 malaikat.',
                'video_url' => 'https://www.youtube.com/watch?v=hDEavW36kbY',
                'duration' => 22,
                'status' => 'approved',
                'views' => 2156,
            ],
            [
                'category_id' => 1,
                'title' => 'Isra Mi\'raj: Perjalanan Menembus Langit dalam Satu Malam',
                'description' => 'Peristiwa luar biasa dimana Nabi Muhammad SAW diangkat ke langit ketujuh dan menerima perintah shalat 5 waktu.',
                'video_url' => 'https://www.youtube.com/watch?v=RYMH3qrHRE4',
                'duration' => 18,
                'status' => 'approved',
                'views' => 3421,
            ],

            [
                'category_id' => 2,
                'title' => 'Nabi Ibrahim: Dibakar Hidup-hidup oleh Rakyatnya',
                'description' => 'Kisah keteguhan iman Nabi Ibrahim AS yang dibakar hidup-hidup, namun api berubah menjadi dingin dan sejuk oleh Allah.',
                'video_url' => 'https://www.youtube.com/watch?v=vnFew2vJLZI',
                'duration' => 16,
                'status' => 'approved',
                'views' => 1876,
            ],
            [
                'category_id' => 2,
                'title' => 'Nabi Yusuf: Dari Sumur ke Istana Mesir',
                'description' => 'Perjalanan hidup Nabi Yusuf AS yang penuh cobaan: dibuang ke sumur, dijual sebagai budak, hingga menjadi pemimpin Mesir.',
                'video_url' => 'https://www.youtube.com/watch?v=jLI0aX1dJZQ',
                'duration' => 25,
                'status' => 'approved',
                'views' => 2954,
            ],
            [
                'category_id' => 2,
                'title' => 'Nabi Musa: Membelah Laut Merah dengan Tongkat',
                'description' => 'Mukjizat luar biasa Nabi Musa AS membelah Laut Merah untuk menyelamatkan Bani Israil dari kejaran Firaun.',
                'video_url' => 'https://www.youtube.com/watch?v=vZ_YpOvRd3o',
                'duration' => 20,
                'status' => 'approved',
                'views' => 3128,
            ],

            [
                'category_id' => 3,
                'title' => 'Abu Bakar As-Siddiq: Orang Pertama yang Membenarkan Isra Mi\'raj',
                'description' => 'Keistimewaan Abu Bakar yang langsung membenarkan Isra Mi\'raj tanpa ragu, hingga mendapat gelar As-Siddiq.',
                'video_url' => 'https://www.youtube.com/watch?v=MqvFxvQZ1M0',
                'duration' => 14,
                'status' => 'approved',
                'views' => 1654,
            ],
            [
                'category_id' => 3,
                'title' => 'Umar bin Khattab: Dari Musuh Islam Menjadi Pahlawan Islam',
                'description' => 'Transformasi luar biasa Umar bin Khattab dari musuh bebuyutan Islam menjadi khalifah yang ditakuti raja-raja dunia.',
                'video_url' => 'https://www.youtube.com/watch?v=cDqUKyFr1fs',
                'duration' => 19,
                'status' => 'approved',
                'views' => 2387,
            ],

            [
                'category_id' => 5,
                'title' => 'Muhammad Al-Fatih: Pemuda 21 Tahun Penakluk Konstantinopel',
                'description' => 'Kisah inspiratif Sultan Muhammad Al-Fatih yang menaklukkan Konstantinopel sesuai sabda Rasulullah di usia 21 tahun.',
                'video_url' => 'https://www.youtube.com/watch?v=QF2wj8Y8dJM',
                'duration' => 24,
                'status' => 'approved',
                'views' => 4521,
            ],
            [
                'category_id' => 5,
                'title' => 'Salahuddin Al-Ayyubi: Pembebas Masjidil Aqsa',
                'description' => 'Strategi militer dan kepemimpinan Salahuddin Al-Ayyubi dalam membebaskan Palestina dari Tentara Salib.',
                'video_url' => 'https://www.youtube.com/watch?v=TKF5M6J_Lbo',
                'duration' => 26,
                'status' => 'approved',
                'views' => 5234,
            ],

            [
                'category_id' => 7,
                'title' => 'Tanda-Tanda Kiamat Kecil yang Sudah Terjadi',
                'description' => 'Pembahasan 20+ tanda kiamat kecil yang telah terjadi di zaman kita berdasarkan hadits shahih.',
                'video_url' => 'https://www.youtube.com/watch?v=o6HZfj6wX7Y',
                'duration' => 28,
                'status' => 'approved',
                'views' => 6789,
            ],

            [
                'category_id' => 4,
                'title' => 'Khalid bin Walid: Pedang Allah yang Tak Terkalahkan',
                'description' => 'Kisah Saifullah yang tidak pernah kalah dalam 100+ pertempuran sepanjang hidupnya.',
                'video_url' => 'https://www.youtube.com/watch?v=example',
                'duration' => 30,
                'status' => 'pending',
                'views' => 0,
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
                'content' => 'Sebelum menjadi nabi, Muhammad SAW sudah dikenal sebagai Al-Amin (yang terpercaya) di kalangan masyarakat Makkah. Kejujuran dan amanah beliau sangat terkenal sehingga bahkan musuh-musuhnya pun menitipkan harta kepada beliau.

Sifat mulia ini menjadi pondasi kuat dalam penyebaran dakwah Islam. Ketika beliau menyampaikan risalah, orang-orang Makkah tahu bahwa Muhammad bukanlah pembohong.

Bahkan Abu Jahal yang memusuhi Islam pun mengakui, "Kami tidak mendustakanmu Muhammad, tapi kami mendustakan apa yang kamu bawa."

Ini membuktikan bahwa kredibilitas pribadi Rasulullah SAW tidak pernah diragukan. Kejujuran adalah fondasi kepemimpinan yang kuat.',
                'status' => 'approved',
                'votes' => 45,
                'views' => 892,
            ],
            [
                'category_id' => 2,
                'user_id' => $createdUsers[1]->id,
                'title' => 'Kesabaran Nabi Ayub: Ujian yang Berlangsung 18 Tahun',
                'excerpt' => 'Nabi Ayub AS mengalami ujian luar biasa selama 18 tahun: kehilangan harta, anak, kesehatan, hingga dijauhi semua orang kecuali istrinya.',
                'content' => 'Nabi Ayub AS adalah teladan kesabaran dalam menghadapi musibah. Beliau kehilangan semua harta kekayaannya, seluruh anaknya meninggal, tubuhnya penuh penyakit kulit yang parah, dan dijauhi oleh semua orang.

Selama 18 tahun ujian itu berlangsung, Nabi Ayub AS tidak pernah sekalipun mengeluh kepada Allah. Yang setia menemani hanya istrinya.

Ketika beliau berdoa, Allah sembuhkan penyakitnya dengan mata air yang muncul dari tanah. Allah kembalikan semua hartanya berlipat ganda, dan karuniakan anak-anak yang baru.

Kisah ini mengajarkan kita bahwa kesabaran dalam ujian akan berbuah kebaikan yang berlipat ganda dari Allah SWT.',
                'status' => 'approved',
                'votes' => 67,
                'views' => 1234,
            ],
            [
                'category_id' => 3,
                'user_id' => $createdUsers[2]->id,
                'title' => 'Umar bin Khattab Menangis di Malam Hari',
                'excerpt' => 'Di siang hari Umar tegas menegakkan hukum, tapi di malam hari beliau menangis takut tidak bisa memenuhi amanah sebagai pemimpin.',
                'content' => 'Umar bin Khattab RA dikenal sebagai khalifah yang tegas dan adil. Di siang hari, beliau memeriksa pasar, memastikan tidak ada pengurangan timbangan, dan menegakkan hukum tanpa pandang bulu.

Namun siapa sangka, di malam hari beliau adalah sosok yang berbeda. Umar sering menangis dalam shalat malam karena takut tidak bisa memenuhi amanah sebagai pemimpin umat.

Beliau pernah berkata, "Seandainya ada seekor kambing mati kelaparan di tepi sungai Eufrat, aku khawatir Allah akan memintai pertanggungjawaban dariku."

Kepemimpinan beliau menjadi teladan bagi pemimpin di seluruh dunia: tegas dalam hukum, tapi lembut dalam hati.',
                'status' => 'approved',
                'votes' => 82,
                'views' => 1567,
            ],
            [
                'category_id' => 4,
                'user_id' => $createdUsers[3]->id,
                'title' => 'Bilal bin Rabah: Muadzin Pertama yang Dianiaya karena Islam',
                'excerpt' => 'Bilal, budak berkulit hitam yang disiksa di padang pasir Makkah, namun tetap teguh dengan ucapan "Ahad, Ahad!" (Allah Maha Esa).',
                'content' => 'Bilal bin Rabah adalah salah satu sahabat pertama yang masuk Islam. Sebagai budak, beliau mengalami siksaan luar biasa dari tuannya, Umayyah bin Khalaf.

Bilal diseret ke padang pasir Makkah yang panas terik, dadanya ditindih batu besar, namun beliau tetap berucap "Ahad! Ahad!" (Allah Maha Esa!).

Abu Bakar akhirnya membebaskan Bilal dengan membeli dan memerdekakannya. Nabi Muhammad SAW sangat menyayangi Bilal dan menjadikannya muadzin pertama dalam Islam.

Suara adzan Bilal yang merdu membuat Rasulullah SAW berkata, "Rindu aku mendengar langkah-langkah Bilal di surga."

Kisah Bilal mengajarkan kita bahwa Islam tidak memandang warna kulit atau status sosial. Yang dilihat Allah adalah ketaqwaan.',
                'status' => 'approved',
                'votes' => 91,
                'views' => 2103,
            ],
            [
                'category_id' => 5,
                'user_id' => $createdUsers[4]->id,
                'title' => 'Ibnu Sina: Dokter Jenius yang Hafal Al-Quran di Usia 10 Tahun',
                'excerpt' => 'Ibnu Sina (Avicenna) adalah jenius Muslim yang karyanya menjadi referensi medis Eropa selama 600 tahun.',
                'content' => 'Ibnu Sina, yang dikenal di Barat sebagai Avicenna, adalah salah satu ilmuwan terbesar dalam sejarah Islam. Di usia 10 tahun, beliau sudah hafal Al-Quran!

Pada usia 16 tahun, Ibnu Sina sudah dipercaya mengobati Sultan Samaniyah. Kejeniusannya dalam bidang kedokteran menghasilkan karya monumental "Al-Qanun fi at-Tibb" (The Canon of Medicine).

Buku ini menjadi referensi utama di universitas-universitas Eropa selama lebih dari 600 tahun! Bahkan hingga abad ke-18, mahasiswa kedokteran di Eropa masih mempelajari karya Ibnu Sina.

Selain kedokteran, beliau juga ahli dalam filsafat, matematika, astronomi, dan kimia. Ibnu Sina menulis lebih dari 450 karya ilmiah sepanjang hidupnya.

Kisah ini membuktikan bahwa kejayaan peradaban Islam dibangun atas fondasi ilmu pengetahuan yang kuat, dengan Al-Quran sebagai sumber inspirasi utama.',
                'status' => 'approved',
                'votes' => 103,
                'views' => 2876,
            ],
            [
                'category_id' => 6,
                'user_id' => $createdUsers[5]->id,
                'title' => 'Khadijah binti Khuwailid: Wanita Pertama yang Masuk Islam',
                'excerpt' => 'Khadijah adalah istri pertama Nabi Muhammad SAW yang menjadi penyokong utama dakwah Islam di masa-masa awal.',
                'content' => 'Khadijah binti Khuwailid adalah wanita mulia yang menjadi istri pertama Nabi Muhammad SAW. Beliau adalah wanita kaya raya, pedagang sukses, dan sangat dihormati di Makkah.

Ketika Muhammad SAW menerima wahyu pertama di Gua Hira dan pulang dalam keadaan gemetar, Khadijah-lah yang menenangkannya. Beliau berkata, "Demi Allah, Allah tidak akan menghinakanmu. Karena engkau adalah orang yang menyambung silaturahmi, menolong yang lemah, dan berbuat baik kepada manusia."

Khadijah adalah orang pertama yang beriman kepada Muhammad sebagai Rasulullah. Seluruh hartanya dikorbankan untuk mendukung dakwah Islam.

Selama 25 tahun pernikahan mereka, Nabi Muhammad SAW tidak pernah menikahi wanita lain. Bahkan setelah Khadijah wafat, beliau selalu mengenang kebaikannya dengan penuh cinta.

Khadijah adalah teladan istri yang shalihah, ibu yang penuh kasih sayang, dan wanita karir yang sukses tanpa meninggalkan kewajiban agamanya.',
                'status' => 'approved',
                'votes' => 78,
                'views' => 1892,
            ],
            [
                'category_id' => 7,
                'user_id' => $createdUsers[6]->id,
                'title' => 'Dajjal: Fitnah Terbesar di Akhir Zaman',
                'excerpt' => 'Dajjal adalah fitnah terbesar yang akan muncul di akhir zaman. Setiap nabi memperingatkan umatnya tentang bahaya Dajjal.',
                'content' => 'Dajjal adalah makhluk yang akan muncul di akhir zaman dan menjadi fitnah terbesar bagi umat manusia. Rasulullah SAW bersabda bahwa tidak ada fitnah yang lebih besar sejak penciptaan Adam hingga hari kiamat selain fitnah Dajjal.

Dajjal digambarkan sebagai sosok laki-laki dengan satu mata buta, dan di dahinya tertulis "kafir" yang dapat dibaca oleh orang mukmin. Ia akan mengklaim sebagai tuhan dan memiliki kemampuan luar biasa yang menyerupai mukjizat.

Dajjal akan muncul dari arah timur dan berkeliling dunia selama 40 hari. Hari pertama seperti satu tahun, hari kedua seperti satu bulan, hari ketiga seperti satu minggu, dan seterusnya seperti hari biasa.

Rasulullah SAW mengajarkan kita untuk berlindung dari fitnah Dajjal dengan membaca 10 ayat pertama Surat Al-Kahfi dan memperbanyak ibadah.

Akhirnya, Dajjal akan dibunuh oleh Nabi Isa AS di pintu Ludd (Palestina), dan itu menjadi akhir dari fitnah terbesar sepanjang sejarah manusia.',
                'status' => 'approved',
                'votes' => 134,
                'views' => 3456,
            ],

            [
                'category_id' => 5,
                'user_id' => $createdUsers[0]->id,
                'title' => 'Perpustakaan Baitul Hikmah: Pusat Ilmu Pengetahuan Dunia',
                'excerpt' => 'Baitul Hikmah adalah perpustakaan terbesar di dunia pada masa Dinasti Abbasiyah di Baghdad.',
                'content' => 'Baitul Hikmah didirikan oleh Khalifah Harun ar-Rasyid dan dikembangkan oleh putranya Al-Makmun. Perpustakaan ini menjadi pusat penerjemahan dan penelitian ilmu pengetahuan dari berbagai peradaban: Yunani, Persia, India, dan China.

Di sini berkumpul para ilmuwan, filosof, ahli matematika, astronom, dan dokter terbaik dari seluruh dunia. Mereka menerjemahkan ribuan manuskrip dan melakukan penelitian yang menghasilkan penemuan-penemuan revolusioner.

Sayangnya, perpustakaan ini hancur ketika Mongol menyerang Baghdad pada tahun 1258 M. Konon, air sungai Tigris berubah warna: hitam karena tinta dari buku-buku yang dibuang, dan merah karena darah para ilmuwan yang dibunuh.',
                'status' => 'pending',
                'votes' => 0,
                'views' => 0,
            ],
        ];

        foreach ($artikels as $artikel) {
            Artikel::create($artikel);
        }

        $requests = [
            [
                'user_id' => $createdUsers[2]->id,
                'title' => 'Video Kisah Khalid bin Walid: Pedang Allah yang Tak Terkalahkan',
                'description' => 'Request video tentang Saifullah (Pedang Allah) yang tidak pernah kalah dalam 100+ pertempuran. Tolong bahas strategi perangnya!',
                'category_id' => 4,
                'type' => 'video',
                'priority' => 'high',
                'votes' => 23,
                'status' => 'pending',
            ],
            [
                'user_id' => $createdUsers[3]->id,
                'title' => 'Artikel Perpustakaan Baitul Hikmah di Baghdad',
                'description' => 'Ingin membaca artikel lengkap tentang kejayaan perpustakaan terbesar di dunia pada masa Dinasti Abbasiyah.',
                'category_id' => 5,
                'type' => 'artikel',
                'priority' => 'medium',
                'votes' => 15,
                'status' => 'approved',
                'created_content_id' => 8,
            ],
            [
                'user_id' => $createdUsers[4]->id,
                'title' => 'Video Sejarah Pembangunan Masjidil Haram',
                'description' => 'Perjalanan sejarah pembangunan dan perluasan Masjidil Haram dari masa Nabi Ibrahim hingga kini.',
                'category_id' => 1,
                'type' => 'video',
                'priority' => 'high',
                'votes' => 31,
                'status' => 'pending',
            ],
            [
                'user_id' => $createdUsers[5]->id,
                'title' => 'Artikel Tentang Imam Al-Ghazali',
                'description' => 'Mohon buatkan artikel tentang kehidupan dan pemikiran Imam Al-Ghazali, terutama kitab Ihya Ulumuddin.',
                'category_id' => 5,
                'type' => 'artikel',
                'priority' => 'medium',
                'votes' => 12,
                'status' => 'pending',
            ],
            [
                'user_id' => $createdUsers[1]->id,
                'title' => 'Video Kisah Fatimah Az-Zahra',
                'description' => 'Video tentang kehidupan putri Rasulullah SAW yang menjadi teladan wanita muslimah.',
                'category_id' => 6,
                'type' => 'video',
                'priority' => 'low',
                'votes' => 8,
                'status' => 'rejected',
            ],
        ];

        foreach ($requests as $request) {
            ContentRequest::create($request);
        }

        $createdUsers[0]->favorites()->create(['favoritable_type' => Video::class, 'favoritable_id' => 1]);
        $createdUsers[0]->favorites()->create(['favoritable_type' => Video::class, 'favoritable_id' => 9]);
        $createdUsers[0]->favorites()->create(['favoritable_type' => Artikel::class, 'favoritable_id' => 3]);

        $createdUsers[1]->favorites()->create(['favoritable_type' => Video::class, 'favoritable_id' => 5]);
        $createdUsers[1]->favorites()->create(['favoritable_type' => Artikel::class, 'favoritable_id' => 2]);

        $createdUsers[2]->favorites()->create(['favoritable_type' => Artikel::class, 'favoritable_id' => 5]);
        $createdUsers[2]->favorites()->create(['favoritable_type' => Video::class, 'favoritable_id' => 10]);

        Comment::create([
            'user_id' => $createdUsers[0]->id,
            'commentable_type' => Artikel::class,
            'commentable_id' => 1,
            'content' => 'MasyaAllah, artikel yang sangat menginspirasi! Memang kejujuran adalah fondasi kepemimpinan yang kuat. Jazakallah khair atas penulisannya.',
            'parent_id' => null,
        ]);

        Comment::create([
            'user_id' => $createdUsers[1]->id,
            'commentable_type' => Artikel::class,
            'commentable_id' => 1,
            'content' => 'Setuju! Rasulullah SAW adalah teladan terbaik dalam segala aspek kehidupan. Semoga kita bisa meneladani sifat-sifat mulia beliau.',
            'parent_id' => 1,
        ]);

        Comment::create([
            'user_id' => $createdUsers[2]->id,
            'commentable_type' => Artikel::class,
            'commentable_id' => 4,
            'content' => 'Kisah Bilal bin Rabah selalu membuat saya terharu. Beliau rela disiksa demi mempertahankan keimanan. Semoga kita bisa sekuat beliau.',
            'parent_id' => null,
        ]);

        Comment::create([
            'user_id' => $createdUsers[3]->id,
            'commentable_type' => Video::class,
            'commentable_id' => 9,
            'content' => 'Video yang sangat mencerahkan! Muhammad Al-Fatih adalah inspirasi bagi generasi muda Muslim. Di usia 21 tahun sudah menaklukkan Konstantinopel!',
            'parent_id' => null,
        ]);

        Comment::create([
            'user_id' => $createdUsers[4]->id,
            'commentable_type' => Artikel::class,
            'commentable_id' => 5,
            'content' => 'SubhanAllah, Ibnu Sina adalah bukti nyata kejayaan peradaban Islam dalam bidang sains. Semoga Indonesia bisa melahirkan ilmuwan-ilmuwan Muslim seperti beliau.',
            'parent_id' => null,
        ]);
    }
}
