#祥阿姨

演示地址 : xiangayi.coding.io  
部署后台地址：http://sites.go0356.com/xiangayi201506/admin/  
用户名：admin   
密码  ：xiangayi

###项目需求变化
---
```
1. 详细信息页面(4):
去掉 [自我介绍和雇主印象] 和 [持有证书与技能掌握]
```
```
2. 填写信息页面(6):
表单：
联系人姓名 | 联系电话 | 详细服务地址 | 服务时间 | 预产期 | 宝宝出生日期 | 个性需求
后端判断显示相应文本框
```

###应用程序目录结构
---
```
home (前台页面)
admin (后台页面)
model (模型目录，数据加工)
uploads (上传图片目录)
    |-- avatar (头像)
    |-- images (首页轮播图片)
public (静态文件目录)
    |-- css
    |-- js
    |-- images
    |-- bootstrap
```

###前后端交互
---
#####/model/getConfig.php
|name|describe|remark|
|:---:|:---:|:---:|
|作用|获取应用基本信息|轮播图 家政高中初级服务内容等|

#####/model/getWaiter.php
|name|describe|remark|
|:---:|:---:|:---:|
|作用|获取家政列表|月嫂 育儿嫂 保姆 小时工|
|参数|cid|必须,家政类别ID|
|参数|lid|必须,家政级别ID|
|参数|num|必须,获取数据条数|
|参数|snum|可选,开始条数,默认值为 1|

#####/model/getProfile.php
|name|describe|remark|
|:---:|:---:|:---:|
|作用|获取家政详细信息|月嫂 育儿嫂 保姆 小时工|
|参数|wid|必须,家政ID|

#####/model/addUser.php
|name|describe|remark|
|:---:|:---:|:---:|
|作用|添加订单信息|月嫂 育儿嫂 保姆 小时工|
|name值|addName|必须,雇主姓名|
|name值|addTel|必须,雇主联系方式|
|name值|addWid|可选,家政ID|
|name值|addAddr|可选,详细服务地址|
|name值|addDate|可选,服务时间|
|name值|addExpect|可选,预产期,仅限月嫂|
|name值|addBorn|可选,宝宝出生日期,仅限育儿嫂|
|name值|addRemark|可选,个性需求,仅限小时工|

###数据库信息
---
#####xay_waiter table:
|name|size|remark|
|:---:|:---:|:---:|
|id|int(10)|家政ID|
|category|int(10)|类别|
|level|int(10)|级别|
|firstName|varchar(10)|名|
|lastName|varchar(10)|姓|
|sex|enum(保密,男,女)|性别|
|avatar|varchar(200)|头像|
|brief|varchar(200)|一句话介绍|
|profile|text|基本信息|
|experience|text|工作履历|
|charge|varchar(100)|试用期及收费情况|
|time|datetime|添加时间|
|wstatus|tinyint|状态1为启用2为禁用|

#####xay_order table:
|name|size|remark|
|:---:|:---:|:---:|
|id|int(10)|订单ID|
|wid|int(10)|家政ID|
|name|varchar(10)|雇主姓名|
|tel|varchar(20)|联系电话|
|address|varchar(100)|详细服务地址|
|date|varchar(100)|服务时间|
|expectDate|varchar(50)|预产期［月嫂］|
|bornDate|varchar(50)|宝宝出生日期［育儿嫂］|
|remark|varchar(300)|个性需求［小时工］|
|ua|varchar(200)|useragent|
|time|datetime|当前时间|
|status|tinyint|处理状态1为未处理2为已处理|

#####xay_config table:
|name|size|remark|
|:---:|:---:|:---:|
|indexImgA|varchar(200)|轮播图片1|
|indexImgB|varchar(200)|轮播图片2|
|indexImgC|varchar(200)|轮播图片3|
|ysContH|text|高级月嫂服务详情|
|ysContM|text|中级月嫂服务详情|
|ysContL|text|初级月嫂服务详情|
|yesContH|text|高级育儿嫂服务详情|
|yesContM|text|中级育儿嫂服务详情|
|yesContL|text|初级育儿嫂服务详情|
|bmContH|text|高级保姆服务详情|
|bmContM|text|中级保姆服务详情|
|bmContL|text|初级保姆服务详情|
|xsgContH|text|高级小时工服务详情|
|xsgContM|text|中级小时工服务详情|
|xsgContL|text|初级小时工服务详情|

###页面跳转流程
---
```
首页(1) ➡ 选择服务等级页面(2) ➡ 列表页(3) ➡ 详细信息页面(4) ➡ 填写信息页面(6)
   ⬇️               ⬇️
小时工页面(7)   服务介绍页面(5)
```