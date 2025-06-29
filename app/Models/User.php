<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        // Name Fields
        'first_name',
        'last_name',

        // Contact
        'email',
        'whatsapp_number',
        'phone_number',
        'profile_picture',

        // Location
        'city',
        'state',
        'country',
        'address',

        // Role
        'role',

        // Farm Details
        'farm_name',
        'farm_location',
        'farm_size',
        'farm_type',
        'about_farmer',
        'social_media',
        'farm_contact',

        // Auth fields
        'password',
        'email_verified_at',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'social_media' => 'array',
        ];
    }

    // Products this user owns (if a farmer)
    public function farmProducts(): HasMany
    {
        return $this->hasMany(FarmProduct::class, 'farmer_id');
    }

    // Orders this user has made (as a buyer)
    public function orders(): HasMany
    {
        return $this->hasMany(ProductOrder::class, 'buyer_id');
    }



    public function sales()
    {
        return $this->hasManyThrough(
            ProductOrder::class,
            FarmProduct::class,
            'farmer_id', // Foreign key on FarmProduct table
            'product_id', // Foreign key on ProductOrder table
            'id', // Local key on User table
            'id' // Local key on FarmProduct table
        );
    }

    // If needed, all customers who bought from this farmer
    public function customers()
    {
        return $this->hasManyThrough(
            User::class,
            ProductOrder::class,
            'product_id', // Foreign key on ProductOrder table
            'id',         // Local key on User table
            'id',         // Local key on this model (farmer_id)
            'buyer_id'    // Foreign key on ProductOrder for buyer
        );
    }


    public function farmerOrders()
    {
        return $this->hasMany(ProductOrder::class, 'farmer_id');
    }

    public function buyerOrders()
    {
        return $this->hasMany(ProductOrder::class, 'buyer_id');
    }
}
