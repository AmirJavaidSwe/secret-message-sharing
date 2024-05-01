<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Crypt;
use App\Observers\MessageObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;




/**
 * Class Message
 *
 * @property $id
 * @property $recipient_id
 * @property $message
 * @property $slug
 * @property $decrypt_key
 * @property $read_once
 * @property $auto_delete_at
 * @property $read_at
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */


#[ObservedBy([MessageObserver::class])]
class Message extends Model
{
    use SoftDeletes;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['recipient_id', 'message', 'read_once', 'auto_delete_at', 'read_at'];

    /**
     * Interact with message before save.
     */
    public function message(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Crypt::encryptString($value),
        );
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /*
    |--------------------------------------------------------------------------
    | CUSTOM METHODS
    |--------------------------------------------------------------------------
    */

    public static function findBySlug($slug)
    {
        return self::with('sender')->where('slug', $slug)->first();
    }
}
