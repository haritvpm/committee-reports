<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Report extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'reports';

    protected $appends = [
        'report',
    ];

    protected $dates = [
        'received_date',
        'submitted_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'file_number',
        'seat_id',
        'file_year',
        'from',
        'from_eng',
        'dept_id',
        'received_date',
        'submitted_date',
        'subject',
        'subject_eng',
        'district_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function seat()
    {
        return $this->belongsTo(User::class, 'seat_id');
    }

    public function dept()
    {
        return $this->belongsTo(Department::class, 'dept_id');
    }

    public function getReceivedDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setReceivedDateAttribute($value)
    {
        $this->attributes['received_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getSubmittedDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setSubmittedDateAttribute($value)
    {
        $this->attributes['submitted_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function getReportAttribute()
    {
        return $this->getMedia('report');
    }
}
