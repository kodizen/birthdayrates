<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Birthday extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'birthday', 'occurrences'
    ];

    /**
     * Get the date in a formatted string.
     *
     * @return string
     */
    public function getFormattedDate()
    {
        return \Carbon\Carbon::parse($this->birthday)->format('jS F Y');
    }
}
