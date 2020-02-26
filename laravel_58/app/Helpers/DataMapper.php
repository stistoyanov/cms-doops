<?php

namespace App\Helpers;

class DataMapper
{
    const DEFAULT_PAGINATE = 15;

    const BRANCH_NAME_IDENTIFIER = 'branches_name';

    const BRANCH_LOCAL = 'local';
    const BRANCH_DEVELOPMENT = 'development';
    const BRANCH_PRODUCTION = 'production';
    const BRANCH_LIVE = 'live';

    public static $branches = [
        self::BRANCH_LOCAL => self::BRANCH_LOCAL,
        self::BRANCH_DEVELOPMENT => self::BRANCH_DEVELOPMENT,
        self::BRANCH_PRODUCTION => self::BRANCH_PRODUCTION,
        self::BRANCH_LIVE => self::BRANCH_LIVE,
    ];

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

    const MAGENTO_MYSQL_HOST = 'MYSQL_HOST';
    const MAGENTO_MYSQL_ROOT_PASSWORD = 'MYSQL_ROOT_PASSWORD';
    const MAGENTO_MYSQL_USER = 'MYSQL_USER';
    const MAGENTO_MYSQL_PASSWORD = 'MYSQL_PASSWORD';
    const MAGENTO_MYSQL_DATABASE = 'MYSQL_DATABASE';
    const MAGENTO_LANGUAGE = 'MAGENTO_LANGUAGE';
    const MAGENTO_TIMEZONE = 'MAGENTO_TIMEZONE';
    const MAGENTO_DEFAULT_CURRENCY = 'MAGENTO_DEFAULT_CURRENCY';
    const MAGENTO_URL = 'MAGENTO_URL';
    const MAGENTO_BACKEND_FRONTNAME = 'MAGENTO_BACKEND_FRONTNAME';
    const MAGENTO_USE_SECURE = 'MAGENTO_USE_SECURE';
    const MAGENTO_BASE_URL_SECURE = 'MAGENTO_BASE_URL_SECURE';
    const MAGENTO_USE_SECURE_ADMIN = 'MAGENTO_USE_SECURE_ADMIN';
    const MAGENTO_ADMIN_FIRSTNAME = 'MAGENTO_ADMIN_FIRSTNAME';
    const MAGENTO_ADMIN_LASTNAME = 'MAGENTO_ADMIN_LASTNAME';
    const MAGENTO_ADMIN_EMAIL = 'MAGENTO_ADMIN_EMAIL';
    const MAGENTO_ADMIN_USERNAME = 'MAGENTO_ADMIN_USERNAME';
    const MAGENTO_ADMIN_PASSWORD = 'MAGENTO_ADMIN_PASSWORD';

    public static $magentoEnvSettings = [
        'MAGENTO_MYSQL_HOST' => self::MAGENTO_MYSQL_HOST,
        'MAGENTO_MYSQL_ROOT_PASSWORD' => self::MAGENTO_MYSQL_ROOT_PASSWORD,
        'MAGENTO_MYSQL_USER' => self::MAGENTO_MYSQL_USER,
        'MAGENTO_MYSQL_PASSWORD' => self::MAGENTO_MYSQL_PASSWORD,
        'MAGENTO_MYSQL_DATABASE' => self::MAGENTO_MYSQL_DATABASE,
        'MAGENTO_LANGUAGE' => self::MAGENTO_LANGUAGE,
        'MAGENTO_TIMEZONE' => self::MAGENTO_TIMEZONE,
        'MAGENTO_DEFAULT_CURRENCY' => self::MAGENTO_DEFAULT_CURRENCY,
        'MAGENTO_URL' => self::MAGENTO_URL,
        'MAGENTO_BACKEND_FRONTNAME' => self::MAGENTO_BACKEND_FRONTNAME,
        'MAGENTO_USE_SECURE' => self::MAGENTO_USE_SECURE,
        'MAGENTO_BASE_URL_SECURE' => self::MAGENTO_BASE_URL_SECURE,
        'MAGENTO_USE_SECURE_ADMIN' => self::MAGENTO_USE_SECURE_ADMIN,
        'MAGENTO_ADMIN_FIRSTNAME' => self::MAGENTO_ADMIN_FIRSTNAME,
        'MAGENTO_ADMIN_LASTNAME' => self::MAGENTO_ADMIN_LASTNAME,
        'MAGENTO_ADMIN_EMAIL' => self::MAGENTO_ADMIN_EMAIL,
        'MAGENTO_ADMIN_USERNAME' => self::MAGENTO_ADMIN_USERNAME,
        'MAGENTO_ADMIN_PASSWORD' => self::MAGENTO_ADMIN_PASSWORD,
    ];

    public static $magentoEnvIntegers = [
        self::MAGENTO_USE_SECURE,
        self::MAGENTO_BASE_URL_SECURE,
        self::MAGENTO_USE_SECURE_ADMIN,
    ];

    public static $magentoEnvStrings = [
        self::MAGENTO_MYSQL_HOST,
        self::MAGENTO_MYSQL_ROOT_PASSWORD,
        self::MAGENTO_MYSQL_USER,
        self::MAGENTO_MYSQL_PASSWORD,
        self::MAGENTO_MYSQL_DATABASE,
        self::MAGENTO_URL,
        self::MAGENTO_BACKEND_FRONTNAME,
        self::MAGENTO_ADMIN_FIRSTNAME,
        self::MAGENTO_ADMIN_LASTNAME,
        self::MAGENTO_ADMIN_EMAIL,
        self::MAGENTO_ADMIN_USERNAME,
        self::MAGENTO_ADMIN_PASSWORD,
    ];
}