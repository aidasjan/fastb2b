<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email_h', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin(){
        return $this->role === 'admin';
    }

    public function isClient(){
        return $this->role === 'client';
    }

    public function getAllDiscounts(){
        $user = $this;
        if(!($user->isClient())) return null;
        $discounts = Discount::where('user_id', $user->id)->get();
        return $discounts;
    }

    public function getDiscount($subcategory){
        $user = $this;
        if(!($user->isClient())) return null;
        $discount = $user->getAllDiscounts()->where('subcategory_id', $subcategory->id)->first();
        if($discount === null) return 0;
        return $discount->discount;
    }
}
