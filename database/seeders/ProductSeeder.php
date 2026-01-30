<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Xoá dữ liệu cũ để tránh trùng lặp khi chạy lại
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Product::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $products = [
            // === NHÓM COFFEE (CÀ PHÊ) ===
            [
                'name' => 'Americano',
                'price' => 90000,
                'image' => 'americano.jpg',
                'category' => 'Coffee',
                'description' => 'Cà phê The Rainbow được chọn lọc kỹ lưỡng từ vùng đất đỏ bazan Buôn Mê Thuột...'
            ],
            [
                'name' => 'Cà phê Capuchino',
                'price' => 90000,
                'image' => 'capuchino.jpg',
                'category' => 'Coffee',
                'description' => 'Capuchino chuẩn Ý với lớp bọt sữa dày mịn màng.'
            ],
            [
                'name' => 'Cà phê Espresso',
                'price' => 90000,
                'image' => 'espresso.jpg',
                'category' => 'Coffee',
                'description' => 'Espresso đậm đà, tinh tế, đánh thức mọi giác quan.'
            ],
            [
                'name' => 'Cà phê Mocha',
                'price' => 90000,
                'image' => 'mocha.jpg',
                'category' => 'Coffee',
                'description' => 'Sự kết hợp ngọt ngào giữa Chocolate nóng và Espresso.'
            ],
            [
                'name' => 'Cà phê Nền Trắng (Flat White)',
                'price' => 90000,
                'image' => 'flatWhite.jpg',
                'category' => 'Coffee',
                'description' => 'Hương vị cà phê nhẹ nhàng với lớp sữa mỏng.'
            ],
            [
                'name' => 'Latte',
                'price' => 90000,
                'image' => 'latte.jpg',
                'category' => 'Coffee',
                'description' => 'Latte nghệ thuật với hương vị sữa béo ngậy.'
            ],
            [
                'name' => 'Cà phê Muối (Salt Coffee)',
                'price' => 90000,
                'image' => 'salt-coffee.jpg',
                'category' => 'Coffee',
                'description' => 'Vị mặn lạ miệng làm tôn lên vị ngọt và đắng của cà phê.'
            ],
            [
                'name' => 'Cà phê Macchiato',
                'price' => 90000,
                'image' => 'macchiato.jpg',
                'category' => 'Coffee',
                'description' => 'Sự hòa quyện giữa Espresso và lớp bọt sữa bồng bềnh.'
            ],
            [
                'name' => 'Đen đá không đường', // Iced Coffee
                'price' => 90000,
                'image' => 'icedCoffee.jpg',
                'category' => 'Coffee',
                'description' => 'Cà phê đen nguyên bản, mát lạnh sảng khoái.'
            ],

            // === NHÓM TEA (TRÀ) ===
            [
                'name' => 'Trà gừng',
                'price' => 90000,
                'image' => 'ginger_tea.jpg',
                'category' => 'Tea',
                'description' => 'Trà gừng ấm nóng, tốt cho sức khỏe, giải cảm tuyệt vời.'
            ],
            [
                'name' => 'Trà Chanh giã tay',
                'price' => 90000,
                'image' => 'traChanhGiaTay.jpg',
                'category' => 'Tea',
                'description' => 'Hương thơm tinh dầu chanh tươi giã tay độc đáo.'
            ],
            [
                'name' => 'Trà Đào',
                'price' => 90000,
                'image' => 'peachTea.jpg',
                'category' => 'Tea',
                'description' => 'Những miếng đào giòn ngọt trong ly trà thanh mát.'
            ],
            [
                'name' => 'Trà bạc hà',
                'price' => 90000,
                'image' => 'traBacHa.jpg',
                'category' => 'Tea',
                'description' => 'Cảm giác the mát lạnh buốt từ lá bạc hà tươi.'
            ],
            [
                'name' => 'Trà đào cam sả',
                'price' => 90000,
                'image' => 'tradaocamsa.jpg',
                'category' => 'Tea',
                'description' => 'Hương sả thơm lừng kết hợp vị cam đào tươi mát.'
            ],
            [
                'name' => 'Trà Vải',
                'price' => 90000,
                'image' => 'traVai.jpg',
                'category' => 'Tea',
                'description' => 'Vị ngọt ngào của vải thiều nhiệt đới.'
            ],
            [
                'name' => 'Trà Matcha Latte',
                'price' => 90000,
                'image' => 'matcha-latte.jpg',
                'category' => 'Tea',
                'description' => 'Hương trà xanh Nhật Bản thơm mát kết hợp với sữa.'
            ],
            [
                'name' => 'Trà Hoa Cúc',
                'price' => 90000,
                'image' => 'tra-hoa-cuc.jpg',
                'category' => 'Tea',
                'description' => 'Thanh lọc cơ thể, giúp thư giãn tinh thần.'
            ],
            [
                'name' => 'Trà Chanh Việt Quất',
                'price' => 90000,
                'image' => 'tra-chanh-viet-quat.jpg',
                'category' => 'Tea',
                'description' => 'Vị chua ngọt thanh mát của chanh và việt quất.'
            ],

            // === NHÓM SNACK (BÁNH) ===
            [
                'name' => 'Bánh bông lan trứng muối',
                'price' => 90000,
                'image' => 'banh-bong-lan-trung-muoi.jpg',
                'category' => 'Snack',
                'description' => 'Sốt trứng muối mặn mà trên nền bánh bông lan mềm xốp.'
            ],
            [
                'name' => 'Bánh sừng bò Croissant',
                'price' => 90000,
                'image' => 'banh-mi-sung-bo-croissant.jpg',
                'category' => 'Snack',
                'description' => 'Bánh sừng bò ngàn lớp thơm lừng mùi bơ.'
            ],
            [
                'name' => 'Bánh OREO',
                'price' => 90000,
                'image' => 'banh-oreo.jpg',
                'category' => 'Snack',
                'description' => 'Bánh Oreo kem sữa truyền thống.'
            ],
            [
                'name' => 'Bánh Flan Caramen',
                'price' => 90000,
                'image' => 'banh-plan-caramen.jpg',
                'category' => 'Snack',
                'description' => 'Mềm mịn, béo ngậy, tan trong miệng.'
            ],
            [
                'name' => 'Snack Rong biển',
                'price' => 90000,
                'image' => 'snack-rongbien.jpg',
                'category' => 'Snack',
                'description' => 'Giòn tan rôm rốp, món ăn vặt không thể thiếu.'
            ],
        ];

        foreach ($products as $p) {
            Product::create($p);
        }
    }
}
