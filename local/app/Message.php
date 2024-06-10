<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'name', 'email', 'mobile', 'file', 'message', 'seen'
    ];

    public function getFileUrlAttribute($value)
    {
        $fileUrl = "";

        if ( ! is_null($this->file))
        {
            $filePath = public_path() . "/storage/files/attachments/" . $this->file;
            if (file_exists($filePath)) $fileUrl = asset("storage/files/attachments/" . $this->file);
        }

        return $fileUrl;
    }
}
