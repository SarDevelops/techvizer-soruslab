<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        if (Schema::hasTable('settings')) {
            $settings = Setting::all();
            $this->setting_data = $settings->pluck('value', 'name')->toArray();
            if (count($this->setting_data)) {
                $config_key_value = [
                    'customConfig.site.name' => 'site_name',
                    'customConfig.site.logo' => 'site_logo',
                    'customConfig.site.email' => 'site_email',
                    'customConfig.site.contact' => 'site_contact',
                    'customConfig.site.address' => 'site_address',
                    'customConfig.site.timezone' => 'timezone',

                    'customConfig.admin.name' => 'admin_name',
                    'customConfig.admin.email' => 'admin_email',
                    'customConfig.admin.contact' => 'admin_contact',

                    'mail.mailers.smtp.host' => 'smtp_host',
                    'mail.mailers.smtp.port' => 'smtp_port',
                    'mail.mailers.smtp.encryption' => 'smtp_encryption',
                    'mail.mailers.smtp.username' => 'smtp_user',
                    'mail.mailers.smtp.password' => 'smtp_password',
                    'mail.form.address' => 'from_name',
                    'customConfig.email.reply_to' => 'reply_to_email',
                    'customConfig.email.header' => 'email_header',
                    'customConfig.email.footer' => 'email_footer',
                    'customConfig.email.signature' => 'email_signature',

                    'customConfig.pages.about_us' => 'about_us',
                    'customConfig.pages.blog' => 'blog',
                    'customConfig.pages.privacy_policy' => 'privacy_policy',
                    'customConfig.pages.terms' => 'tearms',

                    'customConfig.social_links.instagram' => 'instagram_url',
                    'customConfig.social_links.facebook' => 'facebook_url',
                    'customConfig.social_links.twitter' => 'twitter_url',

                    'customConfig.environment.ip_address' => 'ip_address',
                    'customConfig.environment.production_mode' => 'production_mode',

                    'customConfig.maintance.maintance_mode' => 'maintance_mode',
                ];
                $this->set_config($config_key_value);
            }
        }

    }
    private function set_config($config_key_value)
    {
        foreach ($config_key_value as $key => $value) {
            if (array_key_exists($value, $this->setting_data)) {
                config([$key => $this->setting_data[$value]]);
            }
        }
    }
}
