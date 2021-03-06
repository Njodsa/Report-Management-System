<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Events\FilesUploadedEvent;
use App\Events\FilesUploadFailedEvent;
use App\Traits\UploadFileTrait;
use App\Report;
use Storage;

class UploadFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels ,UploadFileTrait;

    protected $email;

    /**
     * Create a new job instance.
     *
     * @return void
     */


    public function __construct($files, $report,$email)
    {
        $this->report = $report;
        $this->email  = $email;
        $this->files  = $this->processFile($files);
    }

    /**
     * Execute the job.
     *
     * @return void
     */

    public function handle()
    {
      foreach($this->files as $file) {
        Storage::disk('s3')->put($file['path'],base64_decode($file['file']));
        $createFile = $this->report->createFile($file['name'],$file['type'],$file['path']);
      }
      event( new FilesUploadedEvent($this->report,$this->email));
    }

    public function failed()
   {
      event(new FilesUploadFailedEvent($this->report,$this->email));
   }
}
