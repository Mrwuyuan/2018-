//key方式，创建一个分表（5个）出来
create table goods(
    id mediumint  unsigned not null auto_increment comment '主键id',
    name  varchar(32) not null comment '名称',
    price  decimal(10,2) not null default 0 comment '价格',
    pubdate datetime not null default '0000-00-00 00:00:00'  comment '出厂时间',
    primary key (id)
)engine=Myisam charset=utf8
partition by key (id) partitions 5;

insert into goods values (12,'htc',3451.3,'2016-02-14 12:30:12');
insert into goods values (13,'apple',3451.3,'2016-02-14 12:30:12');
insert into goods values (14,'nokia',3451.3,'2016-02-14 12:30:12');


//② hash方式，"字段表达式"条件创建分表
//   同时设置“复合主键”
create table goods_HH(
    id mediumint  unsigned not null auto_increment comment '主键id',
    name  varchar(32) not null comment '名称',
    price  decimal(10,2) not null default 0 comment '价格',
    pubdate datetime not null default '0000-00-00 00:00:00'  comment '出厂时间',
    primary key (id,pubdate)
)engine=Myisam charset=utf8
partition by hash (month(pubdate)) partitions 12;

insert into goods_HH values (12,'htc',3451.3,'2016-02-14 12:30:12');
insert into goods_HH values (13,'apple',3451.3,'2016-03-14 12:30:12');
insert into goods_HH values (14,'nokia',3451.3,'2016-04-14 12:30:12');
insert into goods_HH values (15,'nokia',3451.3,'2016-05-14 12:30:12');
insert into goods_HH values (16,'nokia',3451.3,'2016-06-14 12:30:12');

//给goods增加分表
alter table goods coalesce partition 2           //减少2个
alter table goods add partition partitions 2     //增加2个

//③ range方式，字段表达式 "范围"条件创建分表
//   根据商品出厂的"年代"创建分表
create table goods_RR(
    id mediumint  unsigned not null auto_increment comment '主键id',
    name  varchar(32) not null comment '名称',
    price  decimal(10,2) not null default 0 comment '价格',
    pubdate datetime not null default '0000-00-00 00:00:00'  comment '出厂时间',
    primary key (id,pubdate)
)engine=Myisam charset=utf8
partition by range (year(pubdate))(
    partition hou70  values  less than (1980),
    partition hou80  values  less than (1990),
    partition hou90  values  less than (2000)
)

insert into goods_RR values (12,'htc',3451.3,'1975-02-14 12:30:12');
insert into goods_RR values (13,'apple',3451.3,'1977-03-14 12:30:12');
insert into goods_RR values (14,'nokia',3451.3,'1979-04-14 12:30:12');
insert into goods_RR values (15,'nokia',3451.3,'1983-05-14 12:30:12');
insert into goods_RR values (16,'nokia',3451.3,'1996-06-14 12:30:12');

insert into goods_RR values (17,'nokia',3451.3,'2015-06-14 12:30:12');

//给 goods_RR 增加分表
alter table goods_RR add partition (
    partition hou00  values  less than (2010),
    partition hou10  values  less than (2020)
)

//④ list方式，字段表达式 是否在某个 列表中创建分表
//   根据商品的月份 制作一个"4季节"的分表
create table goods_LL(
    id mediumint  unsigned not null auto_increment comment '主键id',
    name  varchar(32) not null comment '名称',
    price  decimal(10,2) not null default 0 comment '价格',
    pubdate datetime not null default '0000-00-00 00:00:00'  comment '出厂时间',
    primary key (id,pubdate)
)engine=Myisam charset=utf8
partition by list (month(pubdate))(
    partition spring  values  in (3,4,5),
    partition summer  values  in (6,7,8),
    partition autumn  values  in (9,10,11),
    partition winter  values  in (12,1,2)
)
insert into goods_LL values (13,'apple',3451.3,'1977-03-14 12:30:12');
insert into goods_LL values (14,'nokia',3451.3,'1979-04-14 12:30:12');
insert into goods_LL values (15,'nokia',3451.3,'1983-05-14 12:30:12');
insert into goods_LL values (16,'nokia',3451.3,'1996-06-14 12:30:12');
insert into goods_LL values (17,'nokia',3451.3,'1996-07-14 12:30:12');
insert into goods_LL values (18,'nokia',3451.3,'1996-08-14 12:30:12');
insert into goods_LL values (19,'nokia',3451.3,'1996-09-14 12:30:12');




//物理分表
create table goods_wu_1(
    id mediumint  unsigned not null auto_increment comment '主键id',
    name  varchar(32) not null comment '名称',
    price  decimal(10,2) not null default 0 comment '价格',
    pubdate datetime not null default '0000-00-00 00:00:00'  comment '出厂时间',
    primary key (id)
)engine=Myisam charset=utf8
create table goods_wu_2(
    id mediumint  unsigned not null auto_increment comment '主键id',
    name  varchar(32) not null comment '名称',
    price  decimal(10,2) not null default 0 comment '价格',
    pubdate datetime not null default '0000-00-00 00:00:00'  comment '出厂时间',
    primary key (id)
)engine=Myisam charset=utf8