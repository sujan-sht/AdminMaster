<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    /*
    |--------------------------------------------------------------------------
    | Application Information
    |--------------------------------------------------------------------------
    |
    */
    // site information
    'title' => env('APP_NAME', 'Lara Admin'),
    'logo' => 'lara-admin/assets/static-img/logo.png',
    'favicon' => 'lara-admin/assets/static-img/favicon.png',
    'meta_description' => 'Lara Admin|Laravel Admin Panel',
    'keywords' => 'Lara Admin, Admin Panel',
    'address' => 'Kathmandu, Nepal',
    'phone' => '9812345678',
    'facebook' => 'https://facebook.com/',
    'youtube' => 'https://youtube.com/',
    'instagram' => 'https://instagram.com/',
    'tiktok' => 'https://tiktok.com/',
    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in purus pellentesque, sagittis risus sit amet, varius ligula. Suspendisse ligula erat, dapibus sit amet convallis id, maximus nec mi. Donec auctor, nulla quis auctor iaculis, massa quam pharetra lorem, vitae scelerisque turpis nunc at augue. Aliquam bibendum lacus id purus iaculis, non gravida ipsum porta. Pellentesque laoreet, risus ac venenatis tincidunt, neque sapien iaculis nunc, gravida gravida sapien nibh quis lorem.',

    // backend
    'post_status' => ['Not Approved','Publish','Pending','Draft'],
    'post_type' => ['Blog & Story','News','Meet The Locals'],
    'page_type' => ['Other','About'],




];
