<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'category_id', 'target_donation', 'max_date', 'description', 'image', 'user_id'
    ];

    // fungsi untuk memanggil tabel kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // fungsi untuk memanggil data user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // fungsi untuk memanggil data donasi
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    // fungsi untuk menjumlahkan total donasi
    public function sumDonation()
    {
        return $this->hasMany(Donation::class)->selectRaw('donations.campaign_id,SUM(donations.amount) as total')
            ->where('donations.status', 'success')->groupBy('donations.campaign_id');
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset('/storage/campaigns/' . $value),
        );
    }
}
