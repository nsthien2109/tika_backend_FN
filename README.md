This API for tika shop

php artisan make:migration create_category_table --create=category
php artisan make:controller CategoryController --resource
php artisan make:model Category

php artisan make:migration create_flashsale_product_table --create=flashsale_product
php artisan make:migration create_bill_table --create=bill
php artisan make:migration create_feeship_table --create=feeship
php artisan make:migration create_cart_table --create=cart
php artisan make:migration create_comment_table --create=comment
php artisan make:migration create_favorite_table --create=favorite
php artisan make:migration create_coupon_table --create=coupon
php artisan make:migration create_flashdeal_table --create=flashdeal
php artisan make:migration create_deal_of_day_table --create=deal_of_day
php artisan make:migration create_sub_category_table --create=sub_category

php artisan migrate --path=/database/migrations/2022_09_27_144825_create_comment_table.php
php artisan migrate:refresh --path=/database/migrations/2022_11_03_082049_create_order_detail_table.php
php artisan migrate:refresh --path=/database/migrations/2022_09_27_144802_create_order_table.php
