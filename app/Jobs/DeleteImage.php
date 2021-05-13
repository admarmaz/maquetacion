<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;
use App\Vendor\Image\Models\Image as DBImage;

class DeleteImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filename;
    protected $content;
    protected $entity;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($filename, $content, $entity)
    {
        $this->filename = $filename;
        $this->content = $content;
        $this->entity = $entity;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $images = DBIMage::where('filename', $this->filename)
                ->where('content', $this->content)
                ->where('entity', $this->entity)
                ->get();

		foreach($images as $image){
            $path = public_path(Storage::url($image->path));
            unlink($path);
			$image->delete();
		}
    }
}
