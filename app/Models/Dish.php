<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    const SORT = [
        'asc_title' => 'Title A-Z',
        'desc_title' => 'Title Z-A',
        'asc_price' => 'Price 0-9',
        'desc_price' => 'Price 9-0',
    ];

    const PER_PAGE = [
        'all', 8, 16, 32
    ];

    public function dishRestorant()
    {
        return $this->belongsTo(Restorant::class, 'restorant_id', 'id');
    }

    public function deletePhoto()
    {
        $fileName = $this->photo;
        if (file_exists(public_path().$fileName)) {
            unlink(public_path().$fileName);
        }
        $this->photo = null;
        $this->save();
    }
}
