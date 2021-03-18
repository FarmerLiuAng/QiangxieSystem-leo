一、系统功能介绍

这一部分主要对前端页面和后端页面的功能进行介绍。

一、  前端页面功能

前端页面主要使用bootstrap进行编写，主界面如下图所示：

![img](file:///C:/Users/ADMINI~1/AppData/Local/Temp/msohtmlclip1/01/clip_image004.jpg)

1、   登陆功能：用户输入用户名和密码进行登陆

![img](file:///C:/Users/ADMINI~1/AppData/Local/Temp/msohtmlclip1/01/clip_image006.jpg)

2、   界面左侧是标签栏，一共包括三个品牌的鞋子，安踏、李宁和AJ，通过点击可以到达三个品牌的界面：

下面是李宁的界面和aj的界面

![img](file:///C:/Users/ADMINI~1/AppData/Local/Temp/msohtmlclip1/01/clip_image008.jpg)

![img](file:///C:/Users/ADMINI~1/AppData/Local/Temp/msohtmlclip1/01/clip_image010.jpg)

3、   右侧上方商品以轮播图的形式进行展示，可以通过点击图片左侧和右侧进行图片切换，也可以按照时间进行定时切换。

 

4、   右侧下方是对商品进行购买的表格，每款鞋子包括男款和女款两种，两种价位不同，可以通过下拉框选择尺码，然后点击购买按钮对球鞋进行购买。

![img](file:///C:/Users/ADMINI~1/AppData/Local/Temp/msohtmlclip1/01/clip_image012.jpg)

 

 

 

 

 

二、  后端页面功能

1、   登陆功能：和前端界面相同，但是将登陆的管理员分为两个，一个权限为1，一个权限为2，进行不同的管理功能。

2、   首页（欢迎页）：首页界面如下图所示，可以看到，左侧是导航栏，可以通过点击进行不同界面的切换，右上方展示的是你的权限id，首页展示的是公告的内容。首页的界面如下图所示

![img](file:///C:/Users/ADMINI~1/AppData/Local/Temp/msohtmlclip1/01/clip_image014.jpg)

3、   管理员1可以进行人员管理，有以下五个权限：查看管理员列表、查看用户列表，用户删除、管理员管理、人员查询功能。管理员2，只有查看用户列表、用户删除、人员查询功能。

（1）查看管理员列表功能，管理员列表可以展示管理员的姓名和其权限：

![img](file:///C:/Users/ADMINI~1/AppData/Local/Temp/msohtmlclip1/01/clip_image016.jpg)

（2）展示用户列表功能，展示用户名ID和用户姓名以及用户邮箱。

（3）用户删除功能：通过输入用户ID，并对管理员身份进行确认之后即可对用户进行删除。

![img](file:///C:/Users/ADMINI~1/AppData/Local/Temp/msohtmlclip1/01/clip_image018.jpg)

（4）管理员管理功能，通过下拉选框可以选择对管理员进行的操作，可以进行删除、增加、修改权限的功能，并通过Ajax显示所操作管理员的权限。

![img](file:///C:/Users/ADMINI~1/AppData/Local/Temp/msohtmlclip1/01/clip_image020.jpg)

（5）人员查询功能，通过输入用户或者管理员姓名都可从数据库中获得所查人员的具体信息。

![img](file:///C:/Users/ADMINI~1/AppData/Local/Temp/msohtmlclip1/01/clip_image022.jpg)

4、   管理员1和管理员2 都可以对商品进行以下三种操作，商品

列表查询、商品修改、商品查询功能。

（1）商品列表查询功能，可以将数据库中的所有商品数据进行展示，包括商品名称、鞋码和剩余库存信息

![img](file:///C:/Users/ADMINI~1/AppData/Local/Temp/msohtmlclip1/01/clip_image024.jpg)

​     （2）商品修改功能，可以通过下拉列表对商品进行删除和修改数量的选择，并且在对用户名和密码的核实之后进行操作

![img](file:///C:/Users/ADMINI~1/AppData/Local/Temp/msohtmlclip1/01/clip_image026.jpg)

​     （3）商品查询功能，对商品进行查询，显示球鞋ID，球鞋名称，球鞋大小和球鞋数量的商品信息

![img](file:///C:/Users/ADMINI~1/AppData/Local/Temp/msohtmlclip1/01/clip_image028.jpg)

5、   管理员1和管理员2都可进行修改密码操作：

![img](file:///C:/Users/ADMINI~1/AppData/Local/Temp/msohtmlclip1/01/clip_image030.jpg)

6、   管理员1可以进行日志的查看，管理员2没有此权限，日志记录了所有对数据库进行修改或删除的操作，包括操作人的姓名、权限以及具体的操作内容和操作

![img](file:///C:/Users/ADMINI~1/AppData/Local/Temp/msohtmlclip1/01/clip_image032.jpg)



我的github地址为：https://github.com/FarmerLiuAng/QiangxieSystem-leo

我的网站地址为：

http://119.29.65.190/index.php/admin/login/index.html

进入前端购买界面的账号为：yonghu1 密码为：123

管理员1登陆账号为：liu 密码为：123

管理员2登陆账号为：zhangsan 密码为：123

 