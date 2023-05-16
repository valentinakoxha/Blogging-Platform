<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Blog extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = [];

    public function user()
	{
		return $this->belongsTo(Event::class);
  	}

    public function getImage()
    {
        if ($this->hasMedia('blogs') == 1) {
            return asset('storage/' . $this->getMedia('blogs')->first()->id . '/' . $this->getMedia('blogs')->first()->file_name);
        } 
    }
}
