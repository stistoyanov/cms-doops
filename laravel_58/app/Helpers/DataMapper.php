<?php
namespace App\Helpers;

class DataMapper
{
    const DEFAULT_PAGINATE = 15;

    const PERMISSION_ROLE_LIST = 'role-list';
    const PERMISSION_ROLE_CREATE = 'role-create';
    const PERMISSION_ROLE_EDIT = 'role-edit';
    const PERMISSION_ROLE_DELETE = 'role-delete';
    const PERMISSION_PRODUCTS_LIST = 'product-list';
    const PERMISSION_PRODUCTS_CREATE = 'product-create';
    const PERMISSION_PRODUCTS_EDIT = 'product-edit';
    const PERMISSION_PRODUCTS_DELETE = 'product-delete';

    public static $rolePermissions = [
        1 => self::PERMISSION_ROLE_LIST,
        2 => self::PERMISSION_ROLE_CREATE,
        3 => self::PERMISSION_ROLE_EDIT,
        4 => self::PERMISSION_ROLE_DELETE,
    ];

    public static $productPermissions = [
        5 => self::PERMISSION_PRODUCTS_LIST,
        6 => self::PERMISSION_PRODUCTS_CREATE,
        7 => self::PERMISSION_PRODUCTS_EDIT,
        8 => self::PERMISSION_PRODUCTS_DELETE,
    ];

    public static $allPermissions = [
        1 => self::PERMISSION_ROLE_LIST,
        2 => self::PERMISSION_ROLE_CREATE,
        3 => self::PERMISSION_ROLE_EDIT,
        4 => self::PERMISSION_ROLE_DELETE,
        5 => self::PERMISSION_PRODUCTS_LIST,
        6 => self::PERMISSION_PRODUCTS_CREATE,
        7 => self::PERMISSION_PRODUCTS_EDIT,
        8 => self::PERMISSION_PRODUCTS_DELETE,
    ];
}