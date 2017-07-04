<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 1/21/17
 * Time: 4:48 PM
 */
return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
         //-----------------------ADMIN MODULES--------------
        "/admin-cp"                                                  => 'admin/index/index',
        "/admin-cp/<_c:([a-zA-z0-9-]+)>"                             => 'admin/<_c>/index',
        "/admin-cp/<_c:([a-zA-z0-9-]+)>/<_a:([a-zA-z0-9-]+)>"        => 'admin/<_c>/<_a>',
        "/admin-cp/<_c:([a-zA-z0-9-]+)>/<_a:([a-zA-z0-9-]+)>//*"     => 'admin/<_c>/<_a>/',
        //-----------------------GII--------------
        "/gii"                                                      => 'gii',
        "/gii/<_c:([a-zA-z0-9-_]+)>"                                => 'gii/<_c>/',
        "/gii/<_c:([a-zA-z0-9-_]+)>/<_a:([a-zA-z0-9-_]+)>/*"        => 'gii/<_c>/<_a>/',

         //-----------------------FRONT MODULES--------------
        "/<_a:(register|login|logout|verify)>"                      => 'front/users/<_a>',
        "/helpcenter/<alias:([a-zA-z0-9-_]+)?>"                     => 'front/helpcenter/index',
        "/contact.html"                                             => 'front/index/contact',
        "/admin-login"                                              => 'front/users/admin',
        "/forgot-password"                                          => 'front/users/lostpassword',
        "/reset-password"                                           => 'front/users/resetpassword',
        "/users/verifying-email"                                    => 'front/users/verify',
        "/category/<alias:([a-zA-z0-9-_]+)?>"                       => 'front/category/index',
        "/brand/<alias:([a-zA-z0-9-_]+)?>"                          => 'front/brand/index',
        "/tags/<alias:([a-zA-z0-9-_]+)?>"                           => 'front/tag/index',
        "/detail/<id:([a-zA-z0-9-_]+)?>"                            => 'front/product/detail',
        "/cart/add"                                                 => 'front/cart/add/',
        "/cart/remove"                                              => 'front/cart/remove',
        "/cart/reset"                                               => 'front/cart/reset',
        "/cart"                                                     => 'front/cart/index',
        "/checkout"                                                 => 'front/checkout/index',
        "/payment"                                                  => 'front/checkout/payment',
        "/purchased"                                                => 'front/checkout/purchased',
        "/canceled"                                                 => 'front/checkout/canceled',
        "/page/<alias:([a-zA-z0-9-_]+)?>"                           => 'front/page/index',
        "/blog"                                                     => 'front/blog/index',
        "/infor"                                                    => 'front/infor/index',
        "/getInfor"                                                 => 'front/infor/infor',
        "/cate/<alias:([a-zA-z0-9-_]+)?>"                           => 'front/blog/cate',
        "/news/detail/<id:([a-zA-z0-9-_]+)?>"                       => 'front/blog/detail',
        "/news/tags/<alias:([a-zA-z0-9-_]+)?>"                      => 'front/blog/tag',
        '/addwishlist/<id:([a-zA-z0-9-_]+)?>'                       => 'front/wishlist/index',
        '/removewishlist/<id:([a-zA-z0-9-_]+)?>'                    => 'front/wishlist/remove',
        '/wishlist'                                                 => 'front/wishlist/wishlist',
        '/addcompare/<id:([a-zA-z0-9-_]+)?>'                        => 'front/compare/index',
        '/removecompare/<id:([a-zA-z0-9-_]+)?>'                     => 'front/compare/remove',
        '/compare'                                                  => 'front/compare/compare',
        '/bestselling'                                              => 'front/bestselling/index',
        '/products'                                                 => 'front/products/index',

        "/"                                                         => 'front/index/index',
        "/<_c:([a-zA-z0-9-]+)>"                                     => 'front/<_c>/index',
        "/<_c:([a-zA-z0-9-]+)>/<_a:([a-zA-z0-9-]+)>"                => 'front/<_c>/<_a>',
        "/<_c:([a-zA-z0-9-]+)>/<_a:([a-zA-z0-9-]+)>//*"             => 'front/<_c>/<_a>/',
     
    ],
];