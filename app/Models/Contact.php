<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Contact extends Model
{
    use HasFactory;

    protected $table = 'home';

    protected $fillable = [
        'email',
        'subject',
        'description'
    ];

    // protected $appends = ['formatted_created_at'];

    public function getFormCreatedAt() {
        return $this->created_at->format('d-m-y');
    }

    public function getFormattedDescriptionAttribute()
{
    if (is_null($this->description)) {
        return "No description";
    }

    // Set the initial breakpoint and maximum length
    $initialBreakPoint = 40;
    $maxLength = 90;

    $breakPoint = min(strlen($this->description), $initialBreakPoint);
    if ($breakPoint === strlen($this->description)) {
        $breakPoint = strrpos(substr($this->description, 0, $breakPoint), ' ') ?: $breakPoint;
    } else {
        $breakPoint = strpos($this->description, ' ', $breakPoint) ?: $breakPoint;
    }
    $description = substr_replace($this->description, '<br>', $breakPoint, 0);
    return Str::limit($description, $maxLength, '...');
}

}
