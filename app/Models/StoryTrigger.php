<?php

namespace App\Models;

use App\Observers\StoryTriggerObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


#[ObservedBy([StoryTriggerObserver::class])]
class StoryTrigger extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        "parameters" => "array",
        "characters" => "array"
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parameters', 'characters', 'status'
    ];
}
