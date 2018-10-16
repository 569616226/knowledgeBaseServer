##链咖问答系统项目说明文档

####项目部署步骤
```
composer install        //安装扩展

cp .env.example .env //复制配置文件

php artisan key:generate //生成keyd

php artisan migrate //生成数据表

php artisan apiato:permissions:toRole admin //填充admin用户 后台用户 邮箱输入 admin@admin.com，密码输入 admin

php artisan db:seed

php artisan passport:install //生成OAuth 2.0密钥
```
####修改 .env 配置文件
```
APP_NAME=”knowledgeBaseServer” 

APP_URL=http://knowledgeBaseServer.test 

API_URL=http://api.knowledgeBaseServer.test

GUEST_NAMESPACE=App\Containers\Guest\Models\

npm install apidoc -g        //api文档自动生成器依赖安装 （虚拟机要使用 sudo npm install apidoc -g //api）
```
打开文件 Containers/Documentation/Configs/apidoc.php

#####修改 $(npm bin)/apidoc 为 apidoc
```
php artisan apiato:docs //生成api文档（虚拟机要使用 php artisan apiato:docs）
```
####文档地址
```
http://knowledgeBaseServer.test/api/documentation           //公共接口文档
http://knowledgeBaseServer.test/api/private/documentation   //私有接口文档
http://knowledgeBaseServer.test/api/mobile/documentation    //移动端接口文档
```
####apiato 框架命令
```
apiato:generate:container        //Create a Container for apiato from scratch
apiato:generate:action           //Create a Action file for a Container
apiato:generate:configuration    //Create a Configuration file for a Container
apiato:generate:controller       //Create a controller for a container
apiato:generate:exception        //Create a new Exception class
apiato:generate:job              //Create a new Job class
apiato:generate:mail             //Create a new Mail class
apiato:generate:migration        //Create an "empty" migration file for a Container
apiato:generate:model            //Create a new Model class
apiato:generate:notification     //Create a new Notification class
apiato:generate:repository       //Create a new Repository class
apiato:generate:request          //Create a new Request class
apiato:generate:route            //Create a new Route class
apiato:generate:seeder           //Create a new Seeder class
apiato:generate:serviceprovider  //Create a ServiceProvider for a Container
apiato:generate:subaction        //Create a new SubAction class
apiato:generate:task             //Create a Task file for a Container
apiato:generate:transformer      //Create a new Transformer class for a given Model
```
####腾讯云平台配置
```
QCLOUDSMS_TEMPLID=122014                            //短信模板ID，需要在短信应用中申请
QCLOUDSMS_APPID=1400093185                          //短信应用SDK AppID
QCLOUDSMS_APPKEY=020789c3d1034ba6d4e676465a1e5dcd   //短信应用SDK AppKey
```
```
WECHAT_OFFICIAL_ACCOUNT_APPID=wx0e6a99b1f28ca647                         //公众号appid
WECHAT_OFFICIAL_ACCOUNT_SECRET=db558664eaef6fa6ca0aad5d778ff93f          //公众号secretid
WECHAT_OFFICIAL_ACCOUNT_TOKEN=e6CSkt3kB843d3G7tGcB6cgC3GM3M478           //公众号token
WECHAT_OFFICIAL_ACCOUNT_AES_KEY=                                         //公众号aes_key
```
```
/wechat/menus               //微信公众号菜单列表
/wechat/set_menu            //微信公众号菜单设置
/wechat/delete_menu/id?     //微信公众号菜单删除
```
```
php artisan migrate:refresh --seed //重置数据表
```