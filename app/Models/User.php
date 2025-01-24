<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Awcodes\Curator\Models\Media;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image_id',
        'banner_id',
        'site_id',
        'about',
        'title',
        'phone',
        'whatsapp',
        'telegram',
        'facebook',
        'instagram',
        'twitter',
        'tiktok',
        'linkedin',
        'youtube',
        'pinterest',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'user_product', 'user_id', 'product_id');
    }

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class, 'site_id');
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'image_id', 'id')->withDefault([
            'ext' => "png",
            'path' => "",
        ]);
    }

    public function banner(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'banner_id', 'id')->withDefault([
            'ext' => "png",
            'path' => "",
        ]);
    }

    public function listings(): HasMany
    {
        return $this->hasMany(Listing::class, 'user_id');
    }

    public function sites(): HasMany
    {
        return $this->hasMany(Site::class, 'user_id');
    }

    public function url($subdomain=Null): string
    {
        if(!$this->id) return route('agency.agents');
        if($subdomain) return route('sub.agency.agent',[$subdomain,$this->id]);
        return route('agency.agent',$this->id);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'admin') {
            return $this->email == config('app.admin_email');
        }
        return str_ends_with($this->email, '@'.config('app.domain'));
    }

    public function panel_url(){
        if($this->email == config('app.admin_email')) return '/admin';
        return '/app';
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable')->where('status','published');
    }

}
