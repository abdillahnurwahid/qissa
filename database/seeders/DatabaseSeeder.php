<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Video;
use App\Models\Artikel;
use App\Models\ContentRequest;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Users
        $admin = User::create([
            'name' => 'Admin Qissa',
            'email' => 'admin@qissa.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $user = User::create([
            'name' => 'User Demo',
            'email' => 'user@qissa.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        $user2 = User::create([
            'name' => 'Ahmad Rizki',
            'email' => 'ahmad@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        $user3 = User::create([
            'name' => 'Siti Nurhaliza',
            'email' => 'siti@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Create Categories
        $categories = [
            ['name' => 'Sirah Nabawiyah', 'description' => 'Kisah perjalanan hidup Nabi Muhammad SAW'],
            ['name' => 'Kisah Para Nabi', 'description' => 'Cerita inspiratif dari para nabi dan rasul'],
            ['name' => 'Khulafaur Rasyidin', 'description' => 'Kisah 4 khalifah pertama Islam'],
            ['name' => 'Keemasan Islam', 'description' => 'Periode kejayaan peradaban Islam'],
            ['name' => 'Akhir Zaman', 'description' => 'Tanda-tanda dan peristiwa akhir zaman'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // Create Videos
        $videos = [
            [
                'category_id' => 4,
                'title' => 'Muhammad Al-Fatih: Pemuda Penakluk Konstantinopel',
                'description' => 'Kisah inspiratif pemuda berusia 21 tahun yang berhasil menaklukkan Konstantinopel sesuai sabda Rasulullah SAW.',
                'video_url' => 'https://www.youtube.com/watch?v=example1',
                'duration' => 45,
                'status' => 'approved',
                'views' => 15420,
            ],
            [
                'category_id' => 4,
                'title' => 'Imam Syafi\'i: Si Kecil yang Haus Ilmu',
                'description' => 'Perjalanan hidup Imam Syafi\'i dari anak yatim menjadi salah satu imam mazhab terbesar dalam Islam.',
                'video_url' => 'https://www.youtube.com/watch?v=example2',
                'duration' => 35,
                'status' => 'approved',
                'views' => 12350,
            ],
            [
                'category_id' => 5,
                'title' => 'Tanda-Tanda Kiamat yang Sudah Terjadi',
                'description' => 'Pembahasan tentang tanda-tanda kiamat kecil yang telah terjadi di zaman kita.',
                'video_url' => 'https://www.youtube.com/watch?v=example3',
                'duration' => 50,
                'status' => 'approved',
                'views' => 28750,
            ],
            [
                'category_id' => 1,
                'title' => 'Perang Badar: Kemenangan yang Mustahil',
                'description' => '313 pasukan Muslim menghadapi 1000 pasukan musyrik Quraisy.',
                'video_url' => 'https://www.youtube.com/watch?v=example4',
                'duration' => 40,
                'status' => 'pending',
                'views' => 0,
            ],
        ];

        foreach ($videos as $video) {
            Video::create($video);
        }

        // Create Artikels
        $artikels = [
            [
                'category_id' => 1,
                'user_id' => $user2->id,
                'title' => 'Pemuda Jujur dari Makkah',
                'excerpt' => 'Nabi Muhammad ﷺ dikenal sebagai Al-Amin, sosok jujur yang dipercaya semua orang.',
                'content' => 'Sebelum menjadi nabi, Muhammad SAW sudah dikenal sebagai Al-Amin (yang terpercaya) di kalangan masyarakat Makkah. Kejujuran dan amanah beliau sangat terkenal sehingga bahkan musuh-musuhnya pun menitipkan harta kepada beliau. Sifat mulia ini menjadi pondasi kuat dalam penyebaran dakwah Islam.',
                'status' => 'approved',
                'votes' => 245,
                'views' => 5430,
            ],
            [
                'category_id' => 1,
                'user_id' => $user3->id,
                'title' => 'Perang Badar: 313 vs 1000',
                'excerpt' => 'Pasukan kecil kaum Muslim menghadapi ribuan musuh, namun kemenangan datang berkat iman dan doa.',
                'content' => 'Perang Badar adalah perang pertama yang dihadapi umat Islam. Dengan hanya 313 pasukan menghadapi 1000 pasukan Quraisy yang lengkap persenjataannya, namun dengan pertolongan Allah dan malaikat, kaum muslimin meraih kemenangan gemilang. Perang ini mengajarkan bahwa kemenangan sejati datang dari keteguhan iman.',
                'status' => 'approved',
                'votes' => 180,
                'views' => 4120,
            ],
            [
                'category_id' => 2,
                'user_id' => $user2->id,
                'title' => 'Nabi Yusuf: Dari Sumur ke Istana',
                'excerpt' => 'Dikhianati dan dipenjara, Nabi Yusuf tetap sabar hingga Allah memuliakannya.',
                'content' => 'Kisah Nabi Yusuf AS adalah bukti nyata bahwa kesabaran dan ketaqwaan akan berbuah manis. Dari seorang anak yang dibuang ke sumur oleh saudara-saudaranya, dijual sebagai budak, difitnah, hingga dipenjara, namun pada akhirnya Allah mengangkat derajatnya menjadi penguasa Mesir. Kisah ini mengajarkan kita untuk selalu bersabar dalam menghadapi cobaan.',
                'status' => 'approved',
                'votes' => 320,
                'views' => 6780,
            ],
            [
                'category_id' => 3,
                'user_id' => $user3->id,
                'title' => 'Umar bin Khattab: Pemimpin yang Menangis',
                'excerpt' => 'Dikenal tegas, namun Umar bin Khattab memiliki hati yang lembut.',
                'content' => 'Umar bin Khattab RA dikenal sebagai khalifah yang tegas dan adil. Di siang hari, beliau memeriksa pasar dan memastikan keadilan bagi rakyatnya. Namun di malam hari, beliau menangis dalam shalat malam karena takut tidak bisa memenuhi amanah sebagai pemimpin. Kepemimpinan beliau menjadi teladan bagi pemimpin di seluruh dunia.',
                'status' => 'pending',
                'votes' => 95,
                'views' => 0,
            ],
        ];

        foreach ($artikels as $artikel) {
            Artikel::create($artikel);
        }

        // Create Content Requests
        $requests = [
            [
                'user_id' => $user2->id,
                'title' => 'Video Kisah Khalid bin Walid',
                'description' => 'Request video tentang Saifullah, sang pedang Allah yang tak terkalahkan.',
                'type' => 'video',
                'priority' => 'high',
                'votes' => 120,
                'status' => 'pending',
            ],
            [
                'user_id' => $user3->id,
                'title' => 'Artikel Peradaban Islam di Andalusia',
                'description' => 'Ingin membaca artikel tentang kejayaan Islam di Spanyol.',
                'type' => 'artikel',
                'priority' => 'medium',
                'votes' => 95,
                'status' => 'pending',
            ],
            [
                'user_id' => $user->id,
                'title' => 'Video Sejarah Masjidil Haram',
                'description' => 'Perjalanan sejarah pembangunan Masjidil Haram dari masa ke masa.',
                'type' => 'video',
                'priority' => 'high',
                'votes' => 200,
                'status' => 'pending',
            ],
        ];

        foreach ($requests as $request) {
            ContentRequest::create($request);
        }

        // Create some favorites for demo user
        $user->favorites()->create([
            'favoritable_type' => Video::class,
            'favoritable_id' => 1,
        ]);

        $user->favorites()->create([
            'favoritable_type' => Artikel::class,
            'favoritable_id' => 3,
        ]);

        echo "✅ Database seeded successfully!\n";
        echo "👤 Admin: admin@qissa.com / password\n";
        echo "👤 User: user@qissa.com / password\n";
    }
}