<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\File;

class UpdateSettingsAddEnvatoKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('purchase_code', 100)->nullable();

        });

        $legalFile = storage_path() . '/legal';
        if (file_exists($legalFile)) {
            $legalFileInfo = File::get($legalFile);

            $legalFileInfo = explode('**', $legalFileInfo);
            $purchaseCode = $legalFileInfo[1];

            $setting = \App\Models\Setting::first();
            if ($setting) {
                $setting->purchase_code = $purchaseCode;
                $setting->save();
            }

        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
