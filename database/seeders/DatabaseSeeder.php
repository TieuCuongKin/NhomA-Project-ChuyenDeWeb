<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Table Payment
        DB::table('location')->insert([
          [
              'location_id' => '1',
              'location_name' => 'Thành Phố Hồ Chí Minh',
          
          ],
          [
            'location_id' => '2',
            'location_name' => 'Hà Nội',
          ],
          [
            'location_id' => '3',
            'location_name' => 'Đà Nẵng',
          ]
      ]);
      // Table Payment
      DB::table('post_job')->insert([
        [
            'post_job_id' => '1',
            'job_title' => 'Fresher/Junior Developer (Java/.NET/JavaScript)',
            'company_id' => '1',
            'job_type_id' => '1',
            'job_location_id' => '2',
            'job_salary_min' => '100000',
            'job_salary_max' => '1500000',
            'job_description' => '',
            'job_posting_date' => '2022/10/10',
            'job_expired_at' => '',
            'job_status' => '1',
        
        ],
        [
          'post_job_id' => '2',
            'job_title' => 'Full-stack Java Dev (SQL, JavaScript)',
            'company_id' => '2',
            'job_type_id' => '2',
            'job_location_id' => '2',
            'job_salary_min' => '100000',
            'job_salary_max' => '1500000',
            'job_description' => 'Pythagoras develops IT solutions and services for managing strategic information within Property & Real Estate and Facilities Management. We also engage in work within Smart Buildings, AR and AI. Using the latest technology, we create solutions and platforms that help our customers digitize their operations.',
            'job_posting_date' => '2022/10/10',
            'job_expired_at' => '',
            'job_status' => '1',
        
        ],
        [
          'post_job_id' => '3',
          'job_title' => 'Full Stack Developer (Java/Python/PHP/AngularJS)',
          'company_id' => '3',
          'job_type_id' => '3',
          'job_location_id' => '1',
          'job_salary_min' => '100000',
          'job_salary_max' => '1500000',
          'job_description' => 'Pythagoras develops IT solutions and services for managing strategic information within Property & Real Estate and Facilities Management. We also engage in work within Smart Buildings, AR and AI. Using the latest technology, we create solutions and platforms that help our customers digitize their operations.',
          'job_posting_date' => '2022/10/10',
          'job_expired_at' => '',
          'job_status' => '1',
        ]
    ]);
      // Table Payment
      DB::table('company')->insert([
        [
            'company_id' => '1',
            'company_name' => 'PIACOM',
            'company_address' => 'Số 1 Khâm Thiên, Phường Khâm Thiên, Quận Đống Đa, Hà Nội',
            'company_email' => 'info.piacom@petrolimex.com.vn',
            'company_contact' => 'info.piacom@petrolimex.com.vn',
            'company_website' => ' http://www.piacom.vn',
            'description' => 'Công ty Cổ phần Tin học Viễn thông Petrolimex

            Công ty Cổ phần Tin học Viễn thông Petrolimex (PIACOM) là đơn vị thành viên của Tập đoàn Xăng dầu Việt Nam (PETROLIMEX). Công ty được thành lập ngày 19/08/2003 trên cơ sở cổ phần hóa Trung tâm Tin học và Tự động hóa của Tổng Công ty xăng dầu Việt Nam. Kế thừa những thành quả áp dụng công nghệ trong quản lý của PETROLIMEX, Công ty đã có trên 20 năm hoạt động trong lĩnh vực CNTT và Tự động hóa ngành xăng dầu với hơn 100 thạc sỹ, kỹ sư giàu kinh nghiệm triển khai các dự án trong nước và quốc tế.
            
             ',
            'image' => '',

        
        ],
        [
          'company_id' => '2',
            'company_name' => 'Scandinavian Software Park',
            'company_address' => 'Dong Da, Ha Noi',
            'company_email' => 'ssp@gmail.com',
            'company_contact' => 'ssp@gmail.com',
            'company_website' => 'ssp.com.vn',
            'description' => 'Scandinavian Software Park

           
           Scandinavian Software Park gathers software engineers at some of Scandinavias market leading SaaS companies that develop cutting edge products for a wide variety of industries across the world. The Park is founded by Scandinavian growth investor Monterro to support their portfolio companies with high-quality software development in Vietnam. ',
           'image' => '',
          ],
        [
          'company_id' => '3',
            'company_name' => 'IVC (ISB Vietnam)',
            'company_address' => 'Etown 2, 364 Cong Hoa, Tan Binh, Ho Chi Minh',
            'company_email' => 'icv@gmail.com',
            'company_contact' => 'icv@gmail.com',
            'company_website' => 'icv@gmail.com',
            'description' => 'Business Application Development: Finance/Banking/Securities, Business Application/Sustem, Medical Susrem, Web System/Application.',
            'image' => '',
            ]
    ]);
    }
}
