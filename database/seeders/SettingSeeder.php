<?php

namespace Database\Seeders;

use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::truncate();
        $setting = [
            [
                'user_id' => '1',
                'name' => 'smtp_host',
                'value' => 'smtp.gmail.com',
                'ip_address' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ],
            [
                'user_id' => '1',
                'name' => 'smtp_port',
                'value' => '465',
                'ip_address' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ],
            [
                'user_id' => '1',
                'name' => 'smtp_encryption',
                'value' => 'tls',
                'ip_address' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ],
            [
                'user_id' => '1',
                'name' => 'smtp_user',
                'value' => 'example@gmail.com',
                'ip_address' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ],
            [
                'user_id' => '1',
                'name' => 'smtp_password',
                'value' => 'password',
                'ip_address' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ],
            [
                'user_id' => '1',
                'name' => 'from_name',
                'value' => 'example@yopmail.com',
                'ip_address' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => '1',
                'name' => 'reply_to_email',
                'value' => 'example@yopmail.com',
                'ip_address' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => '1',
                'name' => 'email_signature',
                'value' => 'xyz',
                'ip_address' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => '1',
                'name' => 'email_header',
                'value' => 'header',
                'ip_address' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => '1',
                'name' => 'email_footer',
                'value' => 'footer',
                'ip_address' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => '1',
                'name' => 'site_name',
                'value' => 'Laravel',
                'ip_address' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => '1',
                'name' => 'site_email',
                'value' => 'example@gmail.com',
                'ip_address' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => '1',
                'name' => 'site_contact',
                'value' => '9876543210',
                'ip_address' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => '1',
                'name' => 'site_address',
                'value' => 'Surat',
                'ip_address' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => '1',
                'name' => 'admin_name',
                'value' => 'admin',
                'ip_address' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => '1',
                'name' => 'admin_email',
                'value' => 'admin@narola.email',
                'ip_address' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => '1',
                'name' => 'admin_contact',
                'value' => '7894561230',
                'ip_address' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => '1',
                'name' => 'site_logo',
                'value' => 'blank.png',
                'ip_address' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => '1',
                'name' => 'facebook_url',
                'value' => 'https://www.facebook.com/',
                'ip_address' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => '1',
                'name' => 'instagram_url',
                'value' => 'https://www.instagram.com/',
                'ip_address' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => '1',
                'name' => 'twitter_url',
                'value' => 'https://twitter.com',
                'ip_address' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => '1',
                'name' => 'timezone',
                'value' => 'UTC',
                'ip_address' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ];
        Setting::insert($setting);
    }
}
