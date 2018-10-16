<?php

namespace App\Containers\Guest\Tasks;

use App\Containers\Guest\Data\Repositories\GuestRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\Storage;

class UploadImageTask extends Task
{

    private $repository;

    public function __construct(GuestRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $data)
    {
        $card_pic = $data['img_url'];

        try {
            if ($card_pic->isValid()) {

                //获取文件的原文件名 包括扩展名
                $original_name = $card_pic->getClientOriginalName();

                //获取文件的扩展名
                $ext = $card_pic->getClientOriginalExtension();

                //获取文件的类型
                $file_type = $card_pic->getClientMimeType();

                //获取文件的绝对路径，但是获取到的在本地不能打开
                $path = $card_pic->getRealPath();

                //要保存的文件名 时间+扩展名
                $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '-' . $original_name;
                //保存文件
                //配置文件存放文件的名字  ，文件名，路径
                $bool = Storage::disk('public')->put($filename, file_get_contents($path));

                if ($bool) {
                    return ['img_url' => env('APP_URL').'/storage/'.$filename];
                } else {
                    return ['status' => false, 'msg' => '图片上传失败'];
                }
            }
        } catch (Exception $exception) {
            report($exception);
            throw new UpdateResourceFailedException();
        }
    }
}
