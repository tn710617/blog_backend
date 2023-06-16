<?php

return [
    'admin_wallet_addresses' => explode(',', env('ADMIN_WALLET_ADDRESSES', '')),
    'medium_token' => env('MEDIUM_TOKEN'),
    'medium_publication_id' => env('MEDIUM_PUBLICATION_ID'),
    'frontend_url' => env('FRONTEND_URL'),
];
