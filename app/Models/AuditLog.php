<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;
    use HasAdvancedFilter;

    public $table = 'audit_logs';

    public $orderable = [
        'id',
        'description',
        'subject_id',
        'subject_type',
        'user_id',
        'properties',
        'host',
        'created_at',
    ];

    public $filterable = [
        'id',
        'description',
        'subject_id',
        'subject_type',
        'user_id',
        'properties',
        'host',
        'created_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'description',
        'subject_id',
        'subject_type',
        'user_id',
        'properties',
        'host',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format(config('project.datetime_format'));
    }
}
