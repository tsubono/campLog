<?php

namespace App\Console\Commands;

use App\Models\CampScheduleImage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use \InterventionImage;

class ResizeImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'resize:images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resize images';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        CampScheduleImage::all()->each (function($image) {
            $resizedPath = str_replace("camp-schedule/", "camp-schedule/resized-", $image->image_path);
            if (!file_exists(public_path($resizedPath))) {
                $image = InterventionImage::make(public_path($image->image_path));
                $image->orientate();
                $image->resize(
                    ($image->width() > $image->height()) ? 600 : null,
                    ($image->width() > $image->height()) ? null : 600,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                );
                $image->save(public_path($resizedPath));
            }
        });
    }
}
