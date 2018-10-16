<?php

namespace App\Containers\Advert\Data\Seeders;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Seeders\Seeder;

/*Seeder:App\Containers\Advert\Data\Seeders\AdvertSeeder*/
class AdvertSeeder extends Seeder
{
    public function run()
    {


        Apiato::call('Advert@CreateAdvertTask', [
            [
                'name'  => '轮播广告1',
                'path'  => 'http://edu.elinkport.com/storage/uploads/images/nav_轮播广告1-5a4311bed9089.png',
                'type'  => '1',
                'order' => '1',
                'url'   => '12',
                'user_id' => Apiato::call('User@FindUserByEmailTask', ['admin@admin.com'])->id,
            ]
        ]);

        Apiato::call('Advert@CreateAdvertTask', [
            [
                'name'  => '轮播广告2',
                'path'  => 'http://edu.elinkport.com/storage/uploads/images/nav_轮播广告2-5a4311ebd0327',
                'type'  => '1',
                'order' => '2',
                'url'   => '12',
                'user_id' => Apiato::call('User@FindUserByEmailTask', ['admin@admin.com'])->id,
            ]
        ]);

        Apiato::call('Advert@CreateAdvertTask', [
            [
                'name'  => '轮播广告3',
                'path'  => 'http://edu.elinkport.com/storage/uploads/images/nav_轮播广告3-5a4311ff289fd.png',
                'type'  => '1',
                'order' => '3',
                'url'   => '12',
                'user_id' => Apiato::call('User@FindUserByEmailTask', ['admin@admin.com'])->id,
            ]
        ]);

        Apiato::call('Advert@CreateAdvertTask', [
            [
                'name'  => '轮播广告4',
                'path'  => 'http://edu.elinkport.com/storage/uploads/images/nav_轮播广告4-5a43121679e32.png',
                'type'  => '1',
                'order' => '4',
                'url'   => '12',
                'user_id' => Apiato::call('User@FindUserByEmailTask', ['admin@admin.com'])->id,

            ]
        ]);

        Apiato::call('Advert@CreateAdvertTask', [
            [
                'name'  => '轮播广告5',
                'path'  => 'http://edu.elinkport.com/storage/uploads/images/nav_轮播广告5-5a431225b9df1.png',
                'type'  => '1',
                'order' => '5',
                'url'   => '12',
                'user_id' => Apiato::call('User@FindUserByEmailTask', ['admin@admin.com'])->id,
            ]
        ]);
    }
}
