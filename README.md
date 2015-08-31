# WeChar-API
# 作者： xuyingwei
# mail:  64400573@qq.com
# 时间： 2015 08 30

# 用途： 使用微信的公众号（企业号）给关注人/关注组发送微信内容
# [持续更新维护] Send message to Group by WeChar API

# 提前准备：
1.	申请微信的公众号（企业号）；
2.	新增该公众号的一个应用；
3.	新建权限管理组，并在管理组内设置“应用权限”、“通讯录权限”，并获得：CorpID、Secret ；
4.	最重要的是设置一个管理员，该管理员可以用来发送消息；
5.	使用接警人的微信关注该公众号的应用，这必须先在公众号内新建一个组，设置该关注用户的信息，之后才能关注上；

# 使用方法：
6.	将 WeChar_API.php 和 WeChar_config.php 拷贝至服务器上；
7.	设置 WeChar_config.php 的变量；
8.	使用 Send_test.php 进行逻辑设置 和 发送；
