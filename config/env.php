<?php

return [
    'APP_NAME' => env('APP_NAME', 'SimpleIMS'),
    'APP_VERSION' => env('APP_VERSION', '0.0.0'),
    'APP_URL' => env('APP_URL', 'https://simpleims.test'),
    'APP_ALLOWED_USERS' => env('APP_ALLOWED_USERS', 1),
    'APP_EXPIRY_DATE' => env('APP_EXPIRY_DATE', today()),

    'INITIAL_ADMIN_EMAIL' => env('INITIAL_ADMIN_EMAIL', 'admin@example.com'),
    'LOGO_ASSET_PATH' => env('LOGO_ASSET_PATH', 'images/lightning.png'),

    'SYS_PRODUCT_PREFIX' => env('SYS_PRODUCT_PREFIX', 'PRD'),
    'SYS_ORDER_PREFIX' => env('SYS_ORDER_PREFIX', 'ORD'),
    'SYS_INVENTORY_PREFIX' => env('SYS_INVENTORY_PREFIX', 'INV'),
    'SYS_PAYMENT_PREFIX' => env('SYS_PAYMENT_PREFIX', 'PYM'),
    'SYS_QUICK_PAY_PREFIX' => env('SYS_QUICK_PAY_PREFIX', 'QPAY'),

    'INVOICE_FILE' => env('INVOICE_FILE', 'default-english'),
    'INVOICE_COMPANY_NAME' => env('INVOICE_COMPANY_NAME'),
    'INVOICE_COMPANY_PHONE' => env('INVOICE_COMPANY_PHONE'),
    'INVOICE_COMPANY_EMAIL' => env('INVOICE_COMPANY_EMAIL'),
    'INVOICE_COMPANY_ADDRESS' => env('INVOICE_COMPANY_ADDRESS'),

    'SUPPORT_PHONE_NUMBER' => env('SUPPORT_PHONE_NUMBER'),
];
