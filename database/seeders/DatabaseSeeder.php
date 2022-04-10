<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Table Users
        DB::table('users')->insert([
            'username' =>'user1',
            'password' =>'user1',
            'phone' =>'0987654321',
        ]);

        DB::table('users')->insert([
            'username' =>'user2',
            'password' =>'user2',
            'phone' =>'0123456789',
        ]);

        DB::table('users')->insert([
            'username' =>'user3',
            'password' =>'user3',
            'phone' =>'0987654123',
        ]);

        DB::table('users')->insert([
            'username' =>'user4',
            'password' =>'user4',
            'phone' =>'0123456987',
        ]);

        DB::table('users')->insert([
            'username' =>'user5',
            'password' =>'user6',
            'phone' =>'0912345678',
        ]);

        // Table Manufacturers
        DB::table('manufacturers')->insert([
            'manu_name' =>'Apple',
        ]);

        DB::table('manufacturers')->insert([
            'manu_name' =>'Samsung',
        ]);

        DB::table('manufacturers')->insert([
            'manu_name' =>'Oppo',
        ]);

        DB::table('manufacturers')->insert([
            'manu_name' =>'Xiaomi',
        ]);

        DB::table('manufacturers')->insert([
            'manu_name' =>'Realme',
        ]);


        // Table Products
        DB::table('products')->insert([
            'manu_id' =>'1',
            'product_name' =>'Điện thoại iPhone 13 Pro Max 128GB',
            'price'=>'32390000',
            'image'=>'https://cdn.tgdd.vn/Products/Images/42/230529/iphone-13-pro-max-1-2.jpg',
            'description'=>'Màn hình: OLED6.7"Super Retina XDR
            Hệ điều hành:iOS 15
            Camera sau: 3 camera 12 MP
            Camera trước: 12 MP
            Chip: Apple A15 Bionic
            RAM: 6 GB
            Bộ nhớ trong: 128 GB
            SIM:1 Nano SIM & 1 eSIMHỗ trợ 5G
            Pin, Sạc: 4352 mAh, 20 W',
            'quantity'=>'10',
            'feature'=>'1',
            'create_at'=>'2022-04-09',
        ]);

        DB::table('products')->insert([
            'manu_id' =>'1',
            'product_name' =>'Điện thoại iPhone 13 Pro 128GB',
            'price'=>'29990000',
            'image'=>'https://cdn.tgdd.vn/Products/Images/42/230521/iphone-13-pro-xam-1.jpg',
            'description'=>'Màn hình: OLED6.1"Super Retina XDR
            Hệ điều hành:iOS 15
            Camera sau: 3 camera 12 MP
            Camera trước: 12 MP
            Chip: Apple A15 Bionic
            RAM: 6 GB
            Bộ nhớ trong: 256 GB
            SIM:1 Nano SIM & 1 eSIMHỗ trợ 5G
            Pin, Sạc: 3095 mAh, 20 W',
            'quantity'=>'10',
            'feature'=>'1',
            'create_at'=>'2022-04-09',
        ]);

        DB::table('products')->insert([
            'manu_id' =>'1',
            'product_name' =>'Điện thoại iPhone 13 128GB',
            'price'=>'22790000',
            'image'=>'https://cdn.tgdd.vn/Products/Images/42/223602/iphone-13-blue-1-200x200.jpg',
            'description'=>'Màn hình: OLED6.1"Super Retina XDR
            Hệ điều hành:iOS 15
            Camera sau: 3 camera 12 MP
            Camera trước: 12 MP
            Chip: Apple A15 Bionic
            RAM: 6 GB
            Bộ nhớ trong: 128 GB
            SIM:1 Nano SIM & 1 eSIMHỗ trợ 5G
            Pin, Sạc: 3240 mAh, 20 W',
            'quantity'=>'10',
            'feature'=>'1',
            'create_at'=>'2022-04-09',
        ]);

        DB::table('products')->insert([
            'manu_id' =>'1',
            'product_name' =>'Điện thoại iPhone 12 Pro Max 256GB',
            'price'=>'29990000',
            'image'=>'https://cdn.tgdd.vn/Products/Images/42/228743/iphone-12-pro-max-256gb-1-org.jpg',
            'description'=>'Màn hình: OLED6.7"Super Retina XDR
            Hệ điều hành:iOS 15
            Camera sau: 3 camera 12 MP
            Camera trước: 12 MP
            Chip: Apple A14 Bionic
            RAM: 6 GB
            Bộ nhớ trong: 256 GB
            SIM:1 Nano SIM & 1 eSIMHỗ trợ 5G
            Pin, Sạc: 3687 mAh, 20 W',
            'quantity'=>'10',
            'feature'=>'1',
            'create_at'=>'2022-04-09',
        ]);

        DB::table('products')->insert([
            'manu_id' =>'1',
            'product_name' =>'Điện thoại iPhone 12 Pro 256GB',
            'price'=>'26290000',
            'image'=>'https://cdn.tgdd.vn/Products/Images/42/228738/iphone-12-pro-vang-dong-new-600x600-200x200.jpg',
            'description'=>'Màn hình: OLED6.1"Super Retina XDR
            Hệ điều hành:iOS 15
            Camera sau: 3 camera 12 MP
            Camera trước: 12 MP
            Chip: Apple A14 Bionic
            RAM: 6 GB
            Bộ nhớ trong: 256 GB
            SIM:1 Nano SIM & 1 eSIMHỗ trợ 5G
            Pin, Sạc: 2815 mAh, 20 W',
            'quantity'=>'10',
            'feature'=>'1',
            'create_at'=>'2022-04-09',
        ]);

        DB::table('products')->insert([
            'manu_id' =>'2',
            'product_name' =>'Điện thoại Samsung Galaxy S22 Ultra 5G 128GB',
            'price'=>'30990000',
            'image'=>'https://cdn.tgdd.vn/Products/Images/42/235838/samsung-galaxy-s22-ultra-1-1.jpg',
            'description'=>'Màn hình: Dynamic AMOLED 2X6.8"Quad HD+ (2K+)
            Hệ điều hành: Android 12
            Camera sau: Chính 108 MP & Phụ 12 MP, 10 MP, 10 MP
            Camera trước: 40 MP
            Chip: Snapdragon 8 Gen 1 8 nhân
            RAM: 8 GB
            Bộ nhớ trong: 128 GB
            SIM: 2 Nano SIM hoặc 1 Nano SIM + 1 eSIMHỗ trợ 5G
            Pin, Sạc: 5000 mAh, 45 W',
            'quantity'=>'10',
            'feature'=>'1',
            'create_at'=>'2022-04-09',
        ]);

        DB::table('products')->insert([
            'manu_id' =>'2',
            'product_name' =>'Điện thoại Samsung Galaxy S21 Ultra 5G 128GB',
            'price'=>'25990000',
            'image'=>'https://cdn.tgdd.vn/Products/Images/42/226316/samsung-galaxy-s21-ultra-bac-600x600-1-200x200.jpg',
            'description'=>'Màn hình: Dynamic AMOLED 2X6.8"Quad HD+ (2K+)
            Hệ điều hành: Android 11
            Camera sau: Chính 108 MP & Phụ 12 MP, 10 MP, 10 MP
            Camera trước: 40 MP
            Chip: Exynos 2100
            RAM: 12 GB
            Bộ nhớ trong: 128 GB
            SIM: 2 Nano SIM hoặc 1 Nano SIM + 1 eSIMHỗ trợ 5G
            Pin, Sạc: 5000 mAh, 25 W',
            'quantity'=>'10',
            'feature'=>'1',
            'create_at'=>'2022-04-09',
        ]);

        DB::table('products')->insert([
            'manu_id' =>'2',
            'product_name' =>'Điện thoại Samsung Galaxy Z Flip3 5G 128GB',
            'price'=>'19990000',
            'image'=>'https://cdn.tgdd.vn/Products/Images/42/229949/samsung-galaxy-z-flip-3-black-1-200x200.jpg',
            'description'=>'Màn hình: Dynamic AMOLED 2X6.8"Quad HD+ (2K+)
            Hệ điều hành: Android 11
            Camera sau: 2 camera 12 MP
            Camera trước: 10 MP
            Chip: Snapdragon 888
            RAM: 8 GB
            Bộ nhớ trong: 128 GB
            SIM: 1 Nano SIM & 1 eSIMHỗ trợ 5G
            Pin, Sạc: 3300 mAh, 15 W',
            'quantity'=>'10',
            'feature'=>'1',
            'create_at'=>'2022-04-09',
        ]);

        DB::table('products')->insert([
            'manu_id' =>'2',
            'product_name' =>'Điện thoại Samsung Galaxy Z Fold3 5G 256GB ',
            'price'=>'36990000',
            'image'=>'https://cdn.tgdd.vn/Products/Images/42/226935/samsung-galaxy-z-fold-3-green-1-200x200.jpg',
            'description'=>'Màn hình: Dynamic AMOLED 2XChính 7.6" & Phụ 6.2"Full HD+
            Hệ điều hành: Android 11
            Camera sau: 3 camera 12 MP
            Camera trước: 10 MP & 4 MP
            Chip: Snapdragon 888
            RAM: 12 GB
            Bộ nhớ trong: 256 GB
            SIM: 2 Nano SIM + 1 eSIMHỗ trợ 5G
            Pin, Sạc: 4400 mAh, 25 W',
            'quantity'=>'10',
            'feature'=>'1',
            'create_at'=>'2022-04-09',
        ]);

        DB::table('products')->insert([
            'manu_id' =>'2',
            'product_name' =>'Điện thoại Samsung Galaxy S22+ 5G 128GB',
            'price'=>'25990000',
            'image'=>'https://cdn.tgdd.vn/Products/Images/42/242439/Galaxy-S22-Plus-Black-200x200.jpg',
            'description'=>'Màn hình: Dynamic AMOLED 2X6.6"Full HD+
            Hệ điều hành: Android 12
            Camera sau: Chính 50 MP & Phụ 12 MP, 10 MP
            Camera trước: 10 MP
            Chip: Snapdragon 8 Gen 1 8 nhân
            RAM: 8 GB
            Bộ nhớ trong: 128 GB
            SIM: 2 Nano SIM hoặc 1 Nano SIM + 1 eSIMHỗ trợ 5G
            Pin, Sạc: 4500 mAh,45 W',
            'quantity'=>'10',
            'feature'=>'1',
            'create_at'=>'2022-04-09',
        ]);

        DB::table('products')->insert([
            'manu_id' =>'3',
            'product_name' =>'Điện thoại OPPO Reno7 Z 5G',
            'price'=>'10490000',
            'image'=>'https://cdn.tgdd.vn/Products/Images/42/271717/oppo-reno7-z-5g-thumb-2-1-200x200.jpg',
            'description'=>'Màn hình: AMOLED6.43"Full HD+
            Hệ điều hành: Android 11
            Camera sau: Chính 64 MP & Phụ 2 MP, 2 MP
            Camera trước: 16 MP
            Chip: Snapdragon 695 5G 8 nhân
            RAM: 8 GB
            Bộ nhớ trong: 128 GB
            SIM: 2 Nano SIM (SIM 2 chung khe thẻ nhớ)Hỗ trợ 5G
            Pin, Sạc: 4500 mAh, 33 W',
            'quantity'=>'10',
            'feature'=>'1',
            'create_at'=>'2022-04-09',
        ]);

        DB::table('products')->insert([
            'manu_id' =>'3',
            'product_name' =>'Điện thoại OPPO Reno6 5G',
            'price'=>'11990000',
            'image'=>'https://cdn.tgdd.vn/Products/Images/42/236186/oppo-reno6-5g-aurora-200x200.jpg',
            'description'=>'Màn hình: AMOLED6.43"Full HD+
            Hệ điều hành: Android 11
            Camera sau: Chính 64 MP & Phụ 8 MP, 2 MP
            Camera trước: 32 MP
            Chip: MediaTek Dimensity 900 5G
            RAM: 8 GB
            Bộ nhớ trong: 128 GB
            SIM: 2 Nano SIMHỗ trợ 5G
            Pin, Sạc: 4300 mAh, 65 W',
            'quantity'=>'10',
            'feature'=>'1',
            'create_at'=>'2022-04-09',
        ]);

        DB::table('products')->insert([
            'manu_id' =>'3',
            'product_name' =>'Điện thoại OPPO Reno5 5G',
            'price'=>'8990000',
            'image'=>'https://cdn.tgdd.vn/Products/Images/42/233460/oppo-reno5-5g-black-thumb-200x200.jpg',
            'description'=>'Màn hình: AMOLED6.43"Full HD+
            Hệ điều hành: Android 11
            Camera sau: Chính 64 MP & Phụ 8 MP, 2 MP, 2 MP
            Camera trước: 32 MP
            Chip: Snapdragon 765G
            RAM: 8 GB
            Bộ nhớ trong: 128 GB
            SIM: 2 Nano SIMHỗ trợ 5G
            Pin, Sạc: 4300 mAh, 65 W',
            'quantity'=>'10',
            'feature'=>'1',
            'create_at'=>'2022-04-09',
        ]);

        DB::table('products')->insert([
            'manu_id' =>'3',
            'product_name' =>'Điện thoại OPPO A16',
            'price'=>'3990000',
            'image'=>'https://cdn.tgdd.vn/Products/Images/42/240631/oppo-a16-silver-8-600x600.jpg',
            'description'=>'Màn hình IPS LCD 6.52" HD+
            Hệ điều hành: Android 11
            Camera sau: Chính 13 MP & Phụ 2 MP, 2 MP
            Camera trước: 8 MP
            Chip: MediaTek Helio G35
            RAM: 3 GB
            Bộ nhớ trong: 32 GB
            SIM: 2 Nano SIM Hỗ trợ 4G
            Pin, Sạc: 5000 mAh, 10 W',
            'quantity'=>'10',
            'feature'=>'0',
            'create_at'=>'2022-04-09',
        ]);
   
        DB::table('products')->insert([
            'manu_id' =>'3',
            'product_name' =>'Điện thoại OPPO A15s',
            'price'=>'4290000',
            'image'=>'https://cdn.tgdd.vn/Products/Images/42/229948/TimerThumb/oppo-a15s-(10).jpg',
            'description'=>'Màn hình IPS LCD 6.52" HD+
            Hệ điều hành: Android 11
            Camera sau: Chính 13 MP & Phụ 2 MP, 2 MP
            Camera trước: 8 MP
            Chip: MediaTek Helio P35
            RAM: 4 GB
            Bộ nhớ trong: 64 GB
            SIM: 2 Nano SIM Hỗ trợ 4G
            Pin, Sạc: 4230 mAh, 10 W',
            'quantity'=>'10',
            'feature'=>'0',
            'create_at'=>'2022-04-09',
        ]);
  
        DB::table('products')->insert([
            'manu_id' =>'4',
            'product_name' =>'Điện thoại Xiaomi Redmi 9A',
            'price'=>'2490000',
            'image'=>'https://cdn.tgdd.vn/Products/Images/42/218734/xiaomi-redmi-9a-grey-600x600-1-600x600.jpg',
            'description'=>'Màn hình: IPS LCD 6.53" HD+
            Hệ điều hành: Android 10
            Camera sau: 13 MP
            Camera trước: 5 MP
            Chip: MediaTek Helio G25
            RAM: 2 GB
            Bộ nhớ trong: 32 GB
            SIM: 2 Nano SIMHỗ trợ 4G
            Pin, Sạc: 5000 mAh, 10 W',
            'quantity'=>'10',
            'feature'=>'1',
            'create_at'=>'2022-04-09',
        ]);
     
        DB::table('products')->insert([
            'manu_id' =>'4',
            'product_name' =>'Điện thoại Xiaomi Redmi 10',
            'price'=>'4290000',
            'image'=>'https://cdn.tgdd.vn/Products/Images/42/249081/redmi-10-gray-600x600.jpg',
            'description'=>'Màn hình: IPS LCD 6.5" Full HD+
            Hệ điều hành: Android 11
            Camera sau: Chính 50 MP & Phụ 8 MP, 2 MP, 2 MP
            Camera trước: 8 MP
            Chip: MediaTek Helio G88 8 nhân
            RAM: 4 GB
            Bộ nhớ trong: 128 GB
            SIM: 2 Nano SIMHỗ trợ 4G
            Pin, Sạc: 5000 mAh, 18 W',
            'quantity'=>'10',
            'feature'=>'1',
            'create_at'=>'2022-04-09',
        ]);
    
        DB::table('products')->insert([
            'manu_id' =>'4',
            'product_name' =>'Điện thoại Xiaomi Mi 11 Lite',
            'price'=>'7990000',
            'image'=>'https://cdn.tgdd.vn/Products/Images/42/233241/xiaomi-mi-11-lite-4g-blue-600x600.jpg',
            'description'=>'Màn hình: AMOLED 6.55" Full HD+
            Hệ điều hành: Android 11
            Camera sau: Chính 64 MP & Phụ 8 MP, 5 MP
            Camera trước: 16 MP
            Chip: Snapdragon 732G
            RAM: 8 GB
            Bộ nhớ trong: 128 GB
            SIM: 2 Nano SIM Hỗ trợ 4G
            Pin, Sạc: 4250 mAh, 33 W',
            'quantity'=>'10',
            'feature'=>'1',
            'create_at'=>'2022-04-09',
        ]);
    
        DB::table('products')->insert([
            'manu_id' =>'4',
            'product_name' =>'Điện thoại Xiaomi Redmi Note 10S',
            'price'=>'6490000',
            'image'=>'https://cdn.tgdd.vn/Products/Images/42/235969/TimerThumb/xiaomi-redmi-note-10s-(4).jpg',
            'description'=>'Màn hình: AMOLED 6.43" Full HD+
            Hệ điều hành: Android 11
            Camera sau: Chính 64 MP & Phụ 8 MP, 2 MP, 2MP
            Camera trước: 13 MP
            Chip: MediaTek Helio G95
            RAM: 8 GB
            Bộ nhớ trong: 128 GB
            SIM: 2 Nano SIM Hỗ trợ 4G
            Pin, Sạc: 5000 mAh, 33 W',
            'quantity'=>'10',
            'feature'=>'1',
            'create_at'=>'2022-04-09',
        ]);
     
        DB::table('products')->insert([
            'manu_id' =>'4',
            'product_name' =>'Điện thoại Xiaomi Redmi Note 10S ',
            'price'=>'5990000',
            'image'=>'https://cdn.tgdd.vn/Products/Images/42/262534/TimerThumb/xiaomi-redmi-note-10s-6gb-(2).jpg',
            'description'=>'Màn hình: AMOLED 6.43" Full HD+
            Hệ điều hành: Android 11
            Camera sau: Chính 64 MP & Phụ 8 MP, 2 MP, 2MP
            Camera trước: 13 MP
            Chip: MediaTek Helio G95
            RAM: 6 GB
            Bộ nhớ trong: 128 GB
            SIM: 2 Nano SIM Hỗ trợ 4G
            Pin, Sạc: 5000 mAh, 33 W',
            'quantity'=>'10',
            'feature'=>'1',
            'create_at'=>'2022-04-09',
        ]);
     
        DB::table('products')->insert([
            'manu_id' =>'5',
            'product_name' =>'Điện thoại Realme C35 ',
            'price'=>'3990000',
            'image'=>'https://cdn.tgdd.vn/Products/Images/42/261888/realme-c35-thumb-new-600x600.jpg',
            'description'=>'Màn hình: IPS LCD 6.6" Full HD+
            Hệ điều hành: Android 11
            Camera sau: Chính 50 MP & Phụ 2 MP, 0.3 MP
            Camera trước: 8 MP
            Chip: Unisoc T616 8 nhân
            RAM: 4 GB
            Bộ nhớ trong: 64 GB
            SIM: 2 Nano SIM Hỗ trợ 4G
            Pin, Sạc: 5000 mAh, 18 W',
            'quantity'=>'10',
            'feature'=>'1',
            'create_at'=>'2022-04-09',
        ]);
     
        DB::table('products')->insert([
            'manu_id' =>'5',
            'product_name' =>'Điện thoại Realme 7 Pro ',
            'price'=>'8990000',
            'image'=>'https://cdn.tgdd.vn/Products/Images/42/227689/realme-7-pro-bac-600x600.jpg',
            'description'=>'Màn hình: Super AMOLED 6.4" Full HD+
            Hệ điều hành: Android 11
            Camera sau: Chính 64 MP & Phụ 8 MP, 2 MP, 2 MP
            Camera trước: 32 MP
            Chip: Snapdragon 720G
            RAM: 8 GB
            Bộ nhớ trong: 128 GB
            SIM: 2 Nano SIM Hỗ trợ 4G
            Pin, Sạc: 4500 mAh, 65 W',
            'quantity'=>'10',
            'feature'=>'1',
            'create_at'=>'2022-04-09',
        ]);
   
        DB::table('products')->insert([
            'manu_id' =>'5',
            'product_name' =>'Điện thoại Realme C25Y ',
            'price'=>'4690000',
            'image'=>'https://cdn.tgdd.vn/Products/Images/42/265313/realme-c25y-64gb-xanh-thumb-600x600.jpeg',
            'description'=>'Màn hình: IPS LCD 6.5" HD+
            Hệ điều hành: Android 11
            Camera sau: Chính 50 MP & Phụ 2 MP, 2 MP
            Camera trước: 8 MP
            Chip: Unisoc T618 8 nhân
            RAM: 4 GB
            Bộ nhớ trong: 64 GB
            SIM: 2 Nano SIM Hỗ trợ 4G
            Pin, Sạc: 5000 mAh, 18 W',
            'quantity'=>'10',
            'feature'=>'1',
            'create_at'=>'2022-04-09',
        ]);

        DB::table('products')->insert([
            'manu_id' =>'5',
            'product_name' =>'Điện thoại Realme C25 series ',
            'price'=>'4690000',
            'image'=>'https://cdn.tgdd.vn/Products/Images/42/235996/realme-c25-black-600x600-600x600.jpg',
            'description'=>'Màn hình: IPS LCD 6.5" HD+
            Hệ điều hành: Android 11
            Camera sau: Chính 48 MP & Phụ 2 MP, 2 MP
            Camera trước: 8 MP
            Chip: MediaTek Helio G70
            RAM: 4 GB
            Bộ nhớ trong: 128 GB
            SIM: 2 Nano SIM Hỗ trợ 4G
            Pin, Sạc: 6000 mAh, 18 W',
            'quantity'=>'10',
            'feature'=>'0',
            'create_at'=>'2022-04-09',
        ]);
   
        DB::table('products')->insert([
            'manu_id' =>'5',
            'product_name' =>'Điện thoại Realme C11',
            'price'=>'2990000',
            'image'=>'https://cdn.tgdd.vn/Products/Images/42/261957/realme-c11-2021-2gb-32gb-xanh-600x600.jpg',
            'description'=>'Màn hình IPS LCD, 6.5", HD+
            Hệ điều hành: Android 11
            Camera sau: 8 MP
            Camera trước: 5 MP
            Chip: Spreadtrum SC9863A
            RAM: 2 GB
            Bộ nhớ trong: 32 GB
            SIM: 2 Nano SIM Hỗ trợ 4G
            Pin, Sạc: 5000 mAh, 10 W',
            'quantity'=>'10',
            'feature'=>'1',
            'create_at'=>'2022-04-09',
        ]);
        
    }
}
