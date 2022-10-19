<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Ticket extends Authenticatable
{
    use HasFactory, HasApiTokens, HasRoles;

    public $timestamps = false;

    protected $guarded = [
        'user_id',
        'priority_id',
        'status_id',
        'category_id'
    ];

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'priority_id',
        'status_id',
        'category_id',
        'developer_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function developer()
    {
        return $this->belongsTo(User::class, "developer_id");
    }

    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}