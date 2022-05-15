<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

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
        // Table others
        DB::table('others')->insert([
            [
                'product_id' => '1',
                'user_id' => '2',
                'like' => '1',
                'submit' => 'Good!',
                'star' => '4',
            ],
            [
                'product_id' => '1',
                'user_id' => '3',
                'like' => '1',
                'submit' => 'Verry good!',
                'star' => '5',
            ],
            [
                'product_id' => '2',
                'user_id' => '2',
                'like' => '0',
                'submit' => 'Bad!',
                'star' => '3',
            ],
            [
                'product_id' => '2',
                'user_id' => '3',
                'like' => '0',
                'submit' => 'Verry bad!',
                'star' => '2',
            ],
        ]);

        // Table detail
        DB::table('details')->insert([
            [
                'payment_id' => '1',
                'product_id' => '1',
                'quantity' => '2',
            ],
            [
                'payment_id' => '1',
                'product_id' => '2',
                'quantity' => '1',
            ],
            [
                'payment_id' => '2',
                'product_id' => '3',
                'quantity' => '3',
            ]
        ]);

        // Table Payment
        DB::table('payments')->insert([
            [
                'user_id' => '2',
                'discount' => '3',
                'created_at' => '2022-03-05',
            ],
            [
                'user_id' => '3',
                'discount' => '5',
                'created_at' => '2022-01-21',
            ]
        ]);

        //Table Users
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123456'),
                'admin' => '1',
            ],
            [
                'name' => 'user1',
                'email' => 'user1@gmail.com',
                'password' => Hash::make('user123456'),
                'admin' => '0',
            ],
            [
                'name' => 'user2',
                'email' => 'user2@gmail.com',
                'password' => Hash::make('user23456'),
                'admin' => '0',
            ],
            [
                'name' => 'user3',
                'email' => 'user3@gmail.com',
                'password' => Hash::make('user3456'),
                'admin' => '0',
            ]
        ]);

        // Table Manufacturers
        DB::table('manufacturers')->insert([
            [
                'manu_name' => 'Apple',
            ],
            [
                'manu_name' => 'Samsung',
            ],
            [
                'manu_name' => 'Oppo',
            ],
            [
                'manu_name' => 'Xiaomi',
            ],
            [
                'manu_name' => 'Realme',
            ]
        ]);

        // Table Products
        DB::table('products')->insert([
            [
                'manu_id' => '1',
                'product_name' => 'iPhone 13 Pro Max',
                'price' => '32390000',
                'image' => 'iphone-13promax.jpg',
                'description' => 'Màn hình: OLED6.7"Super Retina XDR#Hệ điều hành: iOS 15#Camera sau: 3 camera 12 MP#Camera trước: 12 MP#Chip: Apple A15 Bionic#RAM: 6 GB#Bộ nhớ trong: 128 GB#SIM:1 Nano SIM & 1 eSIM Hỗ trợ 5G#Pin, Sạc: 4352 mAh, 20 W',
                'quantity' => '5',
                'feature' => '1',
                'sale' => '0',
                'star' => '5',
                'created_at' => '2022-01-09',
            ],
            [
                'manu_id' => '1',
                'product_name' => 'iPhone 13 Pro',
                'price' => '29990000',
                'image' => 'iphone-13pro.jpg',
                'description' => 'Màn hình: OLED6.1"Super Retina XDR#Hệ điều hành: iOS 15#Camera sau: 3 camera 12 MP#Camera trước: 12 MP#Chip: Apple A15 Bionic#RAM: 6 GB#Bộ nhớ trong: 256 GB#SIM:1 Nano SIM & 1 eSIM Hỗ trợ 5G#Pin, Sạc: 3095 mAh, 20 W',
                'quantity' => '5',
                'feature' => '1',
                'sale' => '5',
                'star' => '4',
                'created_at' => '2021-02-09',
            ],
            [
                'manu_id' => '1',
                'product_name' => 'iPhone 13',
                'price' => '22790000',
                'image' => 'iphone-13.jpg',
                'description' => 'Màn hình: OLED6.1"Super Retina XDR#Hệ điều hành: iOS 15#Camera sau: 3 camera 12 MP#Camera trước: 12 MP#Chip: Apple A15 Bionic#RAM: 6 GB#Bộ nhớ trong: 128 GB#SIM:1 Nano SIM & 1 eSIM Hỗ trợ 5G#Pin, Sạc: 3240 mAh, 20 W',
                'quantity' => '10',
                'feature' => '1',
                'sale' => '5',
                'star' => '3',
                'created_at' => '2021-03-09',
            ],
            [
                'manu_id' => '1',
                'product_name' => 'iPhone 12 Pro Max',
                'price' => '29990000',
                'image' => 'iphone-12promax.jpg',
                'description' => 'Màn hình: OLED6.7"Super Retina XDR#Hệ điều hành: iOS 15#Camera sau: 3 camera 12 MP#Camera trước: 12 MP#Chip: Apple A14 Bionic#RAM: 6 GB#Bộ nhớ trong: 256 GB#SIM:1 Nano SIM & 1 eSIM Hỗ trợ 5G#Pin, Sạc: 3687 mAh, 20 W',
                'quantity' => '15',
                'feature' => '1',
                'sale' => '10',
                'star' => '3',
                'created_at' => '2020-04-19',
            ],
            [
                'manu_id' => '1',
                'product_name' => 'iPhone 12 Pro',
                'price' => '26290000',
                'image' => 'iphone-12pro.jpg',
                'description' => 'Màn hình: OLED6.1"Super Retina XDR#Hệ điều hành: iOS 15#Camera sau: 3 camera 12 MP#Camera trước: 12 MP#Chip: Apple A14 Bionic#RAM: 6 GB#Bộ nhớ trong: 256 GB#SIM:1 Nano SIM & 1 eSIM Hỗ trợ 5G#Pin, Sạc: 2815 mAh, 20 W',
                'quantity' => '20',
                'feature' => '1',
                'sale' => '15',
                'star' => '3',
                'created_at' => '2020-05-09',
            ],
            [
                'manu_id' => '2',
                'product_name' => 'Samsung Galaxy S22 Ultra',
                'price' => '30990000',
                'image' => 'samsung-galaxys22ultra.jpg',
                'description' => 'Màn hình: Dynamic AMOLED 2X6.8"Quad HD+ (2K+)#Hệ điều hành: Android 12#Camera sau: Chính 108 MP & Phụ 12 MP, 10 MP, 10 MP#Camera trước: 40 MP#Chip: Snapdragon 8 Gen 1 8 nhân#RAM: 8 GB#Bộ nhớ trong: 128 GB#SIM: 2 Nano SIM hoặc 1 Nano SIM + 1 eSIM Hỗ trợ 5G#Pin, Sạc: 5000 mAh, 45 W',
                'quantity' => '5',
                'feature' => '1',
                'sale' => '0',
                'star' => '5',
                'created_at' => '2021-06-09',
            ],
            [
                'manu_id' => '2',
                'product_name' => 'Samsung Galaxy S21 Ultra',
                'price' => '25990000',
                'image' => 'samsung-galaxys21ultra.jpg',
                'description' => 'Màn hình: Dynamic AMOLED 2X6.8"Quad HD+ (2K+)#Hệ điều hành: Android 11#Camera sau: Chính 108 MP & Phụ 12 MP, 10 MP, 10 MP#Camera trước: 40 MP#Chip: Exynos 2100#RAM: 12 GB#Bộ nhớ trong: 128 GB#SIM: 2 Nano SIM hoặc 1 Nano SIM + 1 eSIM Hỗ trợ 5G#Pin, Sạc: 5000 mAh, 25 W',
                'quantity' => '10',
                'feature' => '1',
                'sale' => '5',
                'star' => '4',
                'created_at' => '2021-07-19',
            ],
            [
                'manu_id' => '2',
                'product_name' => 'Samsung Galaxy Z Flip3',
                'price' => '19990000',
                'image' => 'samsung-galaxyzflip3.jpg',
                'description' => 'Màn hình: Dynamic AMOLED 2X6.8"Quad HD+ (2K+)#Hệ điều hành: Android 11#Camera sau: 2 camera 12 MP#Camera trước: 10 MP#Chip: Snapdragon 888#RAM: 8 GB#Bộ nhớ trong: 128 GB#SIM: 1 Nano SIM & 1 eSIM Hỗ trợ 5G#Pin, Sạc: 3300 mAh, 15 W',
                'quantity' => '10',
                'feature' => '1',
                'sale' => '5',
                'star' => '3',
                'created_at' => '2020-01-19',
            ],
            [
                'manu_id' => '2',
                'product_name' => 'Samsung Galaxy Z Fold3',
                'price' => '36990000',
                'image' => 'samsung-galaxyzfold3.jpg',
                'description' => 'Màn hình: Dynamic AMOLED 2XChính 7.6" & Phụ 6.2"Full HD+#Hệ điều hành: Android 11#Camera sau: 3 camera 12 MP#Camera trước: 10 MP & 4 MP#Chip: Snapdragon 888#RAM: 12 GB#Bộ nhớ trong: 256 GB#SIM: 2 Nano SIM + 1 eSIM Hỗ trợ 5G#Pin, Sạc: 4400 mAh, 25 W',
                'quantity' => '5',
                'feature' => '1',
                'sale' => '10',
                'star' => '3',
                'created_at' => '2021-03-08',
            ],
            [
                'manu_id' => '2',
                'product_name' => 'Samsung Galaxy S22+',
                'price' => '25990000',
                'image' => 'samsung-galaxys22plus.jpg',
                'description' => 'Màn hình: Dynamic AMOLED 2X6.6"Full HD+#Hệ điều hành: Android 12#Camera sau: Chính 50 MP & Phụ 12 MP, 10 MP#Camera trước: 10 MP#Chip: Snapdragon 8 Gen 1 8 nhân#RAM: 8 GB#Bộ nhớ trong: 128 GB#SIM: 2 Nano SIM hoặc 1 Nano SIM + 1 eSIM Hỗ trợ 5G#Pin, Sạc: 4500 mAh,45 W',
                'quantity' => '15',
                'feature' => '1',
                'sale' => '15',
                'star' => '3',
                'created_at' => '2022-02-01',
            ],
            [
                'manu_id' => '3',
                'product_name' => 'OPPO Reno7 Z',
                'price' => '10490000',
                'image' => 'oppo-reno7.jpg',
                'description' => 'Màn hình: AMOLED6.43"Full HD+#Hệ điều hành: Android 11#Camera sau: Chính 64 MP & Phụ 2 MP, 2 MP#Camera trước: 16 MP#Chip: Snapdragon 695 5G 8 nhân#RAM: 8 GB#Bộ nhớ trong: 128 GB#SIM: 2 Nano SIM (SIM 2 chung khe thẻ nhớ) Hỗ trợ 5G#Pin, Sạc: 4500 mAh, 33 W',
                'quantity' => '15',
                'feature' => '1',
                'sale' => '0',
                'star' => '5',
                'created_at' => '2021-12-09',
            ],
            [
                'manu_id' => '3',
                'product_name' => 'OPPO Reno6',
                'price' => '11990000',
                'image' => 'oppo-reno6.jpg',
                'description' => 'Màn hình: AMOLED6.43"Full HD+#Hệ điều hành: Android 11#Camera sau: Chính 64 MP & Phụ 8 MP, 2 MP#Camera trước: 32 MP#Chip: MediaTek Dimensity 900 5G#RAM: 8 GB#Bộ nhớ trong: 128 GB#SIM: 2 Nano SIM Hỗ trợ 5G#Pin, Sạc: 4300 mAh, 65 W',
                'quantity' => '5',
                'feature' => '1',
                'sale' => '5',
                'star' => '4',
                'created_at' => '2021-05-10',
            ],
            [
                'manu_id' => '3',
                'product_name' => 'OPPO Reno5',
                'price' => '8990000',
                'image' => 'oppo-reno5.jpg',
                'description' => 'Màn hình: AMOLED6.43"Full HD+#Hệ điều hành: Android 11#Camera sau: Chính 64 MP & Phụ 8 MP, 2 MP, 2 MP#Camera trước: 32 MP#Chip: Snapdragon 765G#RAM: 8 GB#Bộ nhớ trong: 128 GB#SIM: 2 Nano SIM Hỗ trợ 5G#Pin, Sạc: 4300 mAh, 65 W',
                'quantity' => '5',
                'feature' => '1',
                'sale' => '5',
                'star' => '3',
                'created_at' => '2019-04-09',
            ],
            [
                'manu_id' => '3',
                'product_name' => 'OPPO A16',
                'price' => '3990000',
                'image' => 'oppo-a16.jpg',
                'description' => 'Màn hình: IPS LCD 6.52" HD+#Hệ điều hành: Android 11#Camera sau: Chính 13 MP & Phụ 2 MP, 2 MP#Camera trước: 8 MP#Chip: MediaTek Helio G35#RAM: 3 GB#Bộ nhớ trong: 32 GB#SIM: 2 Nano SIM Hỗ trợ 4G#Pin, Sạc: 5000 mAh, 10 W',
                'quantity' => '5',
                'feature' => '0',
                'sale' => '10',
                'star' => '3',
                'created_at' => '2021-08-09',
            ],
            [
                'manu_id' => '3',
                'product_name' => 'OPPO A15s',
                'price' => '4290000',
                'image' => 'oppo-a15s.jpg',
                'description' => 'Màn hình: IPS LCD 6.52" HD+#Hệ điều hành: Android 11#Camera sau: Chính 13 MP & Phụ 2 MP, 2 MP#Camera trước: 8 MP#Chip: MediaTek Helio P35#RAM: 4 GB#Bộ nhớ trong: 64 GB#SIM: 2 Nano SIM Hỗ trợ 4G#Pin, Sạc: 4230 mAh, 10 W',
                'quantity' => '10',
                'feature' => '0',
                'sale' => '15',
                'star' => '3',
                'created_at' => '2020-07-09',
            ],
            [
                'manu_id' => '4',
                'product_name' => 'Xiaomi Redmi 9A',
                'price' => '2490000',
                'image' => 'xiaomi-redmi9a.jpg',
                'description' => 'Màn hình: IPS LCD 6.53" HD+#Hệ điều hành: Android 10#Camera sau: 13 MP#Camera trước: 5 MP#Chip: MediaTek Helio G25#RAM: 2 GB#Bộ nhớ trong: 32 GB#SIM: 2 Nano SIM Hỗ trợ 4G#Pin, Sạc: 5000 mAh, 10 W',
                'quantity' => '20',
                'feature' => '1',
                'sale' => '0',
                'star' => '5',
                'created_at' => '2021-09-09',
            ],
            [
                'manu_id' => '4',
                'product_name' => 'Xiaomi Redmi 10',
                'price' => '4290000',
                'image' => 'xiaomi-redmi10.jpg',
                'description' => 'Màn hình: IPS LCD 6.5" Full HD+#Hệ điều hành: Android 11#Camera sau: Chính 50 MP & Phụ 8 MP, 2 MP, 2 MP#Camera trước: 8 MP#Chip: MediaTek Helio G88 8 nhân#RAM: 4 GB#Bộ nhớ trong: 128 GB#SIM: 2 Nano SIM Hỗ trợ 4G#Pin, Sạc: 5000 mAh, 18 W',
                'quantity' => '15',
                'feature' => '1',
                'sale' => '5',
                'star' => '4',
                'created_at' => '2021-10-09',
            ],
            [
                'manu_id' => '4',
                'product_name' => 'Xiaomi Mi 11 Lite',
                'price' => '7990000',
                'image' => 'xiaomi-mi11.jpg',
                'description' => 'Màn hình: AMOLED 6.55" Full HD+#Hệ điều hành: Android 11#Camera sau: Chính 64 MP & Phụ 8 MP, 5 MP#Camera trước: 16 MP#Chip: Snapdragon 732G#RAM: 8 GB#Bộ nhớ trong: 128 GB#SIM: 2 Nano SIM Hỗ trợ 4G#Pin, Sạc: 4250 mAh, 33 W',
                'quantity' => '10',
                'feature' => '1',
                'sale' => '5',
                'star' => '3',
                'created_at' => '2022-02-22',
            ],
            [
                'manu_id' => '4',
                'product_name' => 'Xiaomi Redmi Note 10S',
                'price' => '6490000',
                'image' => 'xiaomi-redmi10s.jpg',
                'description' => 'Màn hình: AMOLED 6.43" Full HD+#Hệ điều hành: Android 11#Camera sau: Chính 64 MP & Phụ 8 MP, 2 MP, 2MP#Camera trước: 13 MP#Chip: MediaTek Helio G95#RAM: 8 GB#Bộ nhớ trong: 128 GB#SIM: 2 Nano SIM Hỗ trợ 4G#Pin, Sạc: 5000 mAh, 33 W',
                'quantity' => '10',
                'feature' => '1',
                'sale' => '10',
                'star' => '3',
                'created_at' => '2022-02-22',
            ],
            [
                'manu_id' => '4',
                'product_name' => 'Xiaomi Redmi Note 10S 6GB',
                'price' => '5990000',
                'image' => 'xiaomi-redmi10s6gb.jpg',
                'description' => 'Màn hình: AMOLED 6.43" Full HD+#Hệ điều hành: Android 11#Camera sau: Chính 64 MP & Phụ 8 MP, 2 MP, 2MP#Camera trước: 13 MP#Chip: MediaTek Helio G95#RAM: 6 GB#Bộ nhớ trong: 128 GB#SIM: 2 Nano SIM Hỗ trợ 4G#Pin, Sạc: 5000 mAh, 33 W',
                'quantity' => '10',
                'feature' => '1',
                'sale' => '15',
                'star' => '3',
                'created_at' => '2020-02-24',
            ],
            [
                'manu_id' => '5',
                'product_name' => 'Realme C35',
                'price' => '3990000',
                'image' => 'realme-c35.jpg',
                'description' => 'Màn hình: IPS LCD 6.6" Full HD+#Hệ điều hành: Android 11#Camera sau: Chính 50 MP & Phụ 2 MP, 0.3 MP#Camera trước: 8 MP#Chip: Unisoc T616 8 nhân#RAM: 4 GB#Bộ nhớ trong: 64 GB#SIM: 2 Nano SIM Hỗ trợ 4G#Pin, Sạc: 5000 mAh, 18 W',
                'quantity' => '5',
                'feature' => '1',
                'sale' => '0',
                'star' => '5',
                'created_at' => '2021-03-22',
            ],
            [
                'manu_id' => '5',
                'product_name' => 'Realme 7 Pro',
                'price' => '8990000',
                'image' => 'realme-7pro.jpg',
                'description' => 'Màn hình: Super AMOLED 6.4" Full HD+#Hệ điều hành: Android 11#Camera sau: Chính 64 MP & Phụ 8 MP, 2 MP, 2 MP#Camera trước: 32 MP#Chip: Snapdragon 720G#RAM: 8 GB#Bộ nhớ trong: 128 GB#SIM: 2 Nano SIM Hỗ trợ 4G#Pin, Sạc: 4500 mAh, 65 W',
                'quantity' => '8',
                'feature' => '1',
                'sale' => '5',
                'star' => '4',
                'created_at' => '2021-11-19',
            ],
            [
                'manu_id' => '5',
                'product_name' => 'Realme C25Y',
                'price' => '4690000',
                'image' => 'realme-c27y.jpg',
                'description' => 'Màn hình: IPS LCD 6.5" HD+#Hệ điều hành: Android 11#Camera sau: Chính 50 MP & Phụ 2 MP, 2 MP#Camera trước: 8 MP#Chip: Unisoc T618 8 nhân#RAM: 4 GB#Bộ nhớ trong: 64 GB#SIM: 2 Nano SIM Hỗ trợ 4G#Pin, Sạc: 5000 mAh, 18 W',
                'quantity' => '9',
                'feature' => '1',
                'sale' => '5',
                'star' => '3',
                'created_at' => '2021-01-01',
            ],
            [
                'manu_id' => '5',
                'product_name' => 'Realme C25 series',
                'price' => '4690000',
                'image' => 'realme-c25.jpg',
                'description' => 'Màn hình: IPS LCD 6.5" HD+#Hệ điều hành: Android 11#Camera sau: Chính 48 MP & Phụ 2 MP, 2 MP#Camera trước: 8 MP#Chip: MediaTek Helio G70#RAM: 4 GB#Bộ nhớ trong: 128 GB#SIM: 2 Nano SIM Hỗ trợ 4G#Pin, Sạc: 6000 mAh, 18 W',
                'quantity' => '10',
                'feature' => '0',
                'sale' => '10',
                'star' => '3',
                'created_at' => '2022-4-16',
            ],
            [
                'manu_id' => '5',
                'product_name' => 'Realme C11',
                'price' => '2990000',
                'image' => 'realme-c11.jpg',
                'description' => 'Màn hình: IPS LCD, 6.5", HD+#Hệ điều hành: Android 11#Camera sau: 8 MP#Camera trước: 5 MP#Chip: Spreadtrum SC9863A#RAM: 2 GB#Bộ nhớ trong: 32 GB#SIM: 2 Nano SIM Hỗ trợ 4G#Pin, Sạc: 5000 mAh, 10 W',
                'quantity' => '5',
                'feature' => '1',
                'sale' => '15',
                'star' => '3',
                'created_at' => '2021-11-02',
            ]
        ]);
    }
}
