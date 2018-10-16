<?php

namespace App\Containers\Settings\Data\Seeders;

use App\Containers\Settings\Models\Setting;
use App\Ship\Parents\Seeders\Seeder;

/**
 * Class SettingsDefaultSettingsSeeder
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class SettingsDefaultSettingsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * 订单设置
         *
         * 约见订单自动关闭时间
         * 违约金比例
         * 问答订单自动关闭时间
         *
         * */
        $settings = new Setting();
        $settings->key = 'system_order_settings';
        $settings->value = [1, 2, 3];
        $settings->save();

        /*
         * 财务设置
         *
         * 约见费用转入时间
         * 问答费用转入时间
         *
         * */
        $settings = new Setting();
        $settings->key = 'system_finance_settings';
        $settings->value = [1, 2];
        $settings->save();

        /*
         * 抽成设置
         *
         * 大咖约见抽成比例 平台/大咖
         * 大咖问答问题收入抽成 平台/大咖
         * 答案查看抽成比例 平台/大咖/提问人
         * 违约金 平台提成比例
         *
         * */
        $settings = new Setting();
        $settings->key = 'system_take_settings';
        $settings->value = [[1, 2], [1, 2], [1, 2, 3],1];
        $settings->save();

        /*
         * 公众号管理
         *公众号关注回复内容设置
         *
         * */

        $settings = new Setting();
        $settings->key = 'system_wehchat_settings';
        $settings->value = ['默认关注回复设置：欢迎来到链咖问答系统'];
        $settings->save();

        /*
         * 快速提问价格管理
         * 提问价格
         * 查看价格
         *
         * */
        $settings = new Setting();
        $settings->key = 'system_answer_price_settings';
        $settings->value = [10, 10];
        $settings->save();

        /*
         * 大咖推荐设置
         * 算法排序 0 [0最热，1最新]
         * 自定义 1 [大咖id数组]
         *
         * */
        $settings = new Setting();
        $settings->key = 'system_linka_index_top_settings';
        $settings->value = [0, [10]];
        $settings->save();

        /*
        * 话题推荐设置
        * 算法排序 0 [0最热，1最高评分]
        * 自定义 1 [话题id数组]
        *
        * */
        $settings = new Setting();
        $settings->key = 'system_topic_index_top_settings';
        $settings->value = [0, [10]];
        $settings->save();

    }
}
