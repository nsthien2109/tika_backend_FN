This API for tika shop

php artisan make:migration create_category_table --create=category
php artisan make:controller CategoryController --resource
php artisan make:model Category

php artisan make:migration create_order_table --create=order
php artisan make:migration create_bill_table --create=bill
php artisan make:migration create_feeship_table --create=feeship
php artisan make:migration create_cart_table --create=cart
php artisan make:migration create_comment_table --create=comment
php artisan make:migration create_favorite_table --create=favorite
php artisan make:migration create_coupon_table --create=coupon
php artisan make:migration create_flashdeal_table --create=flashdeal
php artisan make:migration create_deal_of_day_table --create=deal_of_day
php artisan make:migration create_sub_category_table --create=sub_category
