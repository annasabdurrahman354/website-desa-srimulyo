<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KotakSaran extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;

    public $table = 'kotak_sarans';

    public $orderable = [
        'id',
        'pengirim',
        'nomor_telepon',
        'isi',
    ];

    public $filterable = [
        'id',
        'pengirim',
        'nomor_telepon',
        'isi',
    ];

    protected $fillable = [
        'pengirim',
        'nomor_telepon',
        'isi',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format(config('project.datetime_format'));
    }
}
