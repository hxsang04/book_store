<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function postType()
    {
        return $this->belongsTo(PostType::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    protected function thumbnail(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => \Storage::url($value),
        );
    }
}
