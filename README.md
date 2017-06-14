# 在onethink基础上做了修改  

增加了地图 
隐藏控件 

原来上传会返回cover_id,取图片时要通过cover_id去picture表里找到真实路径，需要一次查询。如果不想多做次查询，可将路径直接保存到各业务的表中。只需要增加picture_url字段，这个字段目前是固定的，必须要用picture_url命名,
然后上传后，js脚本会将图片路径也存放到名picture_path的隐藏域中，保存时便会入库。
SHIFT_DEL 彻底删除的功能,原列表DELETE只做假删除，若要物理删除可用 id:操作:[SHIFT_DEL]|删除


# 其它使用技巧
1. 列表字段使用函数方法，比如pid是父id,一般是数字，列表显示时要显示分类的标题，可用pid|getPidTitle
pid|getPidTitle:所属分类

2.每个页面要加载独有的css文件,
如用户新闻列表页要加载list.css,创建view/news/css.html ,
css.html写入 <link href="list.css" rel="stylesheet">
然后公共的 header.html 加入 <include file="css"/>


