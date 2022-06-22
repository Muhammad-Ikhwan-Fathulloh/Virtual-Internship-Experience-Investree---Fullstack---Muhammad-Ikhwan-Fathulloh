<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategoryModel extends Model
{
    use HasFactory;

    protected $table = 'post_categories';
    protected $primaryKey = 'post_category_id';
    protected $fillable = [
        'user_id',
        'post_category_title',
        'created_at',
        'updated_at',
    ];

}
