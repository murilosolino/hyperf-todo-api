<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id 
 * @property string $title 
 * @property string $description 
 * @property int $is_done 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 */
class Task extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'task';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['id', 'title', 'description', 'is_done', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'is_done' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
