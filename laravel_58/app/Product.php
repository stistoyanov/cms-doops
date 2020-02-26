<?php

namespace App;

use App\Helpers\DataMapper;

use Log;
use Exception;

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
        'data',
        'type',
        'detail',
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

    /**
     * @param $string
     * @return mixed
     */
    private static function sanitise($string)
    {
        $string = mb_convert_encoding($string, 'UTF-8', 'UTF-8');
        $string = str_replace(' ', '_', $string);
        $string = substr($string, 0, 25);

        return $string;
    }

    /**
     * @param array $request
     * @return array
     */
    private static function handleMagento($request = [])
    {
        $request[DataMapper::BRANCH_NAME_IDENTIFIER] = self::sanitise($request[DataMapper::BRANCH_NAME_IDENTIFIER]);
        $request[DataMapper::MAGENTO_MYSQL_DATABASE] = self::sanitise($request[DataMapper::MAGENTO_MYSQL_DATABASE]);

        unset($request['type']);
        unset($request['_token']);
        unset($request[DataMapper::MAGENTO_MYSQL_PASSWORD . '_confirmation']);
        unset($request[DataMapper::MAGENTO_ADMIN_PASSWORD . '_confirmation']);
        unset($request[DataMapper::MAGENTO_MYSQL_ROOT_PASSWORD . '_confirmation']);
        $request['data']['request'] = $request;

        $i = -1;
        foreach (DataMapper::$branches as $key) {
            $i++;
            $request['data']['branches'][$i] = [
                'id' => $i,
                'key' => $key,
                'name' => $request[DataMapper::BRANCH_NAME_IDENTIFIER] . '_' . $key,
            ];
        }

        return $request;
    }

    /**
     * @param array $request
     * @return int
     */
    public static function selfCreate($request = [])
    {
        foreach (self::all() as $product) {
            if ($product->name == $request['name'] || $product->data[DataMapper::BRANCH_NAME_IDENTIFIER] == $request[DataMapper::BRANCH_NAME_IDENTIFIER]) {
                return 0;
            }
        }

        if ($request['type'] == self::getTypeIndex(self::TYPE_MAGENTO_2)) {
            $request = self::handleMagento($request);
        }

        try {
            $product = self::create([
                'name' => $request['name'],
                'data' => $request['data'],
                'type' => $request['type'],
                'detail' => $request['detail'],
            ]);
        } catch (Exception $e) {
            Log::error(__CLASS__ . '-' . __METHOD__ . ' failed with message: ' . $e->getMessage());
            return 0;
        }

        Log::info('Product: ' . $product->id . ' successfully created.');

        return $product->id;
    }
}