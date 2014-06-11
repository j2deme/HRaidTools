-- insert's table disks

insert into disks(name,type,sector,sector_track,track_cylinder,cylinders,rpm,track_overhead,track_skew,cylinder_skew,limit_disk,short_disk,long_disk,regions,manufacturer,product_name,display_name,display_size,display_unit) values('1GB_DISK','WILKES_DISK',512,252,8,1084,4002,1900,8,18,383,'3.24 + 0.4sqrt(d)','8.0 + 0.0sqrt(d) + 0.008d','1:4-646:3  654:0-1298:18 1308:0-1952:18','Seagate','ST31051 Hawk 2XL','Hawk 2XL',1,'GB');

insert into disks(name,type,sector,sector_track,track_cylinder,cylinders,rpm,track_overhead,track_skew,cylinder_skew,limit_disk,short_disk,long_disk,regions,manufacturer,product_name,display_name,display_size,display_unit) values('2GB_DISK','WILKES_DISK',512,72,19,1962,4202,1600,8,18,383,'3.24 + 0.4ssqrt(d)','7.0 + 0.0sqrt(d) + 0.008d','1:4-646:3 654:0-1298:18 1308:0-1952:18','HP','Hewlett HP 97560 SCSI','HP 97560',2,'GB');

insert into disks(name,type,sector,sector_track,track_cylinder,cylinders,rpm,track_overhead,track_skew,cylinder_skew,limit_disk,short_disk,long_disk,regions,manufacturer,product_name,display_name,display_size,display_unit) values('4GB_DISK','WILKES_DISK',512,163,8,6582,5400,800,22,47,600,'1.55 + 0.155134sqrt(d)','6.2458 + 0.0sqrt(d) + 0.001740d','0:0 0:0','Seagate','Hawk 4 ST15230W','Hawk 4',4,'GB');

insert into disks(name,type,sector,sector_track,track_cylinder,cylinders,rpm,track_overhead,track_skew,cylinder_skew,limit_disk,short_disk,long_disk,regions,manufacturer,product_name,display_name,display_size,display_unit) values('8GB_DISK','WILKES_DISK',512,160,16,6582,7200,800,22,47,600,'1.55 + 0.1555134sqrt(d)','5.2458 + 0.0sqrt(d) + 0.001740d','0:0 0:0','Maxtor','Maxtor 90871U2','Maxtor 90871U2',8,'GB');

insert into disks(name,type,sector,sector_track,track_cylinder,cylinders,rpm,track_overhead,track_skew,cylinder_skew,limit_disk,short_disk,long_disk,regions,manufacturer,product_name,display_name,display_size,display_unit) values('18GB_DISK_SLOW','WILKES_DISK',512,63,38,16383,7200,800,22,47,600,'1.55 + 0.155134sqrt(d)','4.2458 + 0.0sqrt(d) + 0.001740d','0:0 0:0','Western Digital','WD Caviar WD204BB','WD Caviar',18,'GB');

insert into disks(name,type,sector,sector_track,track_cylinder,cylinders,rpm,track_overhead,track_skew,cylinder_skew,limit_disk,short_disk,long_disk,regions,manufacturer,product_name,display_name,display_size,display_unit) values('18GB_DISK_FSLOW','WILKES_DISK',512,63,38,16383,10003,800,22,47,600,'1.55 + 0.155134sqrt(d)','3.2458 + 0.0sqrt(d) + 0.001740d','0:0 0:0','Western Digital','WD Caviar WD204BB','WD Caviar',18,'GB');

insert into disks(name,type,sector,sector_track,track_cylinder,cylinders,rpm,track_overhead,track_skew,cylinder_skew,limit_disk,short_disk,long_disk,regions,manufacturer,product_name,display_name,display_size,display_unit) values('36GB_DISK_F','WILKES_DISK',512,302,24,9801,10033,500,22,47,600,'1.55 + 0.155134sqrt(d)','2.2458 + 0.0sqrt(d) + 0.001740d','0:0 0:0','Seagate','Seagate ST136403LC-Cheetah','Seagate Cheetah',36,'GB');

insert into disks(name,type,sector,sector_track,track_cylinder,cylinders,rpm,track_overhead,track_skew,cylinder_skew,limit_disk,short_disk,long_disk,regions,manufacturer,product_name,display_name,display_size,display_unit) values('36GB_DISK_F1','WILKES_DISK',512,302,24,9801,15033,500,22,47,600,'1.55 + 0.155134sqrt(d)','2.2458 + 0.0sqrt(d) + 0.001740d','0:0 0:0','Seagate','Seagate ST136403LC-Cheetah','Seagate Cheetah',36,'GB');

-- insert's table controllers

insert into controllers(name,type,block_size,cache_size,new_overhead,read_fence,write_fence,msg_size) values('1GB_CONTROLLER','SIMPLE_CONTROLLER',1024,'64 Kbytes',3200,'64 Kbytes','64 Kbytes',1);

insert into controllers(name,type,block_size,cache_size,new_overhead,read_fence,write_fence,msg_size) values('2GB_CONTROLLER','SIMPLE_CONTROLLER',1024,'128 Kbytes',2200,'64 Kbytes','64 Kbytes',1);

insert into controllers(name,type,block_size,cache_size,new_overhead,read_fence,write_fence,msg_size) values('4GB_CONTROLLER','SIMPLE_CONTROLLER',512,'512 Kbytes',1100,'64 Kbytes','64 Kbytes',1);

insert into controllers(name,type,block_size,cache_size,new_overhead,read_fence,write_fence,msg_size) values('8GB_CONTROLLER','SIMPLE_CONTROLLER',512,'1024 Kbytes',800,'64 Kbytes','64 Kbytes',1);

insert into controllers(name,type,block_size,cache_size,new_overhead,read_fence,write_fence,msg_size) values('18GB_CONTROLLER_SLOW','SIMPLE_CONTROLLER',512,'2048 Kbytes',800,'64 Kbytes','64 Kbytes',1);

insert into controllers(name,type,block_size,cache_size,new_overhead,read_fence,write_fence,msg_size) values('18GB_CONTROLLER_FSLOW','SIMPLE_CONTROLLER',512,'2048 Kbytes',600,'64 Kbytes','64 Kbytes',1);

insert into controllers(name,type,block_size,cache_size,new_overhead,read_fence,write_fence,msg_size) values('36GB_CONTROLLER_F','SIMPLE_CONTROLLER',512,'4096 Kbytes',600,'64 Kbytes','64 Kbytes',1);

insert into controllers(name,type,block_size,cache_size,new_overhead,read_fence,write_fence,msg_size) values('36GB_CONTROLLER_F1','SIMPLE_CONTROLLER',512,'4096 Kbytes',300,'64 Kbytes','64 Kbytes',1);

--insert's table drives

insert into drives(name,controller_id,disk_id) values('1GB_dDISK',1,1);

insert into drives(name,controller_id,disk_id) values('2GB_dDISK',2,2);

insert into drives(name,controller_id,disk_id) values('4GB_dDISK',3,3);

insert into drives(name,controller_id,disk_id) values('8GB_dDISK',4,4);

insert into drives(name,controller_id,disk_id) values('18GB_dDISK_SLOW',5,5);

insert into drives(name,controller_id,disk_id) values('18GB_dDISK_FSLOW',6,6);

insert into drives(name,controller_id,disk_id) values('36GB_dDISK_F',7,7);

insert into drives(name,controller_id,disk_id) values('36GB_dDISK_F1',8,8);

--insert's table networks

insert into networks(type,latency,bandwidth,network,display_name,display_order) values('10_GIGABIT',10,'1.2 GB/s','BUS','10 Gigabit Ethernet',1);

insert into networks(type,latency,bandwidth,network,display_name,display_order) values('BUS',32,'125 MB/s','BUS','Gigabit Ethernet',2);

insert into networks(type,latency,bandwidth,network,display_name,display_order) values('FAST_ETHERNET',50,'12.5 MB/s','BUS','Fast Ethernet',3);


