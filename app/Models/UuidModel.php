<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UuidModel extends Model
{
    //uuid setting part
    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model){
            $model->id = Str::uuid()->toString();
        });
    }

    /**
     * @return bool
     */
    public function getIncrementing()
    {
        return false; // TODO: Change the autogenerated stub
    }

    /**
     * @return string
     */
    public function getKeyName()
    {
        return 'id'; // TODO: Change the autogenerated stub
    }

    /**
     * @return string
     */
    public function getKeyType()
    {
        return 'string'; // TODO: Change the autogenerated stub
    }
}
