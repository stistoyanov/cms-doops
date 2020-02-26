<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const TYPE_MAGENTO_2 = 'magento2';

    public static $types = [
        1 => self::TYPE_MAGENTO_2,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'detail',
        'type',
        'data',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array',
    ];

    /**
     * @param string $type
     * @return int|string
     */
    public static function getTypeIndex($type = self::TYPE_MAGENTO_2)
    {
        foreach (self::$types as $i => $value) {
            if ($type == $value) {
                return $i;
            }
        }
        return 1;
    }
}