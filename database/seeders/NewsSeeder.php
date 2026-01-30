<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\User;

class NewsSeeder extends Seeder
{
    public function run()
    {
        // Đảm bảo có user admin để gán tin tức
        $admin = User::first() ?? User::factory()->create();

        News::truncate();

        News::create([
            'title' => 'Tại sao nên chọn Ngon Plus là nơi dừng chân?',
            'content' => 'Khuôn viên quán mang lại cho quý khách một cảm giác không nơi nào có được. Không gian thoáng đãng, nhiều cây xanh...',
            'image' => 'cafe-san-vuon-co-dien.jpg',
            'user_id' => $admin->id
        ]);

        News::create([
            'title' => 'Trà đào cam sả mới! Bạn đã thử chưa?',
            'content' => 'Ngon Plus đem tới cho bạn món trà với vị ngọt thanh và hương thơm khó cưỡng từ sả tươi vùng cao...',
            'image' => 'tra-dao-cam-xa.jpg',
            'user_id' => $admin->id
        ]);

        News::create([
            'title' => 'Sự kiện cuối tuần siêu hấp dẫn',
            'content' => 'Cuối tuần cùng bạn bè chill tại Ngon Plus với nhạc sống Acoustic, trò chơi Boardgame và nhiều ưu đãi mua 1 tặng 1...',
            'image' => 'sukiendacbiet.jpg',
            'user_id' => $admin->id
        ]);
    }
}
