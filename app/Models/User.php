<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'is_active',
        'updated_at'
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
        ];
    }

    // Quan hệ với danh mục sản phẩm
    function product_categories(){
        return $this->hasMany('App\Models\ProductCategory');
    }

    // Quan hệ với danh mục bài viết
    function post_categories(){
        return $this->hasMany('App\Models\PostCategory');
    }

    // Quan hệ nhiều - nhiều với bảng user_roles
    function roles(){
        return $this->belongsToMany(Role::class,'user_roles');
    }

    // Kiểm tra quyền của user đang đăng nhập
    public function hasPermission($permission){
        foreach ($this->roles as $role){
            if($role->permissions->where('slug',$permission)->count() > 0){
                return true;
            }
        }
        return false;
    }
}
