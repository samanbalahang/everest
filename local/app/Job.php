<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'title', 'desc', 'content', 'job_cat_id', 'department_id', 'end_date', 'featured', 'views'
    ];

    public function jobCat()
    {
        return $this->belongsTo(JobCat::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function getExpiredAttribute()
    {
        $time = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at);
        $diff = $time->diffInDays(\Carbon\Carbon::now());
        if ($diff > 15) {
            return true;
        } else {
            return false;
        }
    }
}
