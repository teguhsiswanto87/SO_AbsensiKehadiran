create database so_absensi;
use so_absensi;

create table riset(
    id_riset int(5) primary key auto_increment,
    bidang_riset varchar(50) not null,
    waktu_riset varchar(50)
)Engine=InnoDB;

create table prodi(
    id_prodi int(5) primary key auto_increment,
    nama_prodi varchar(50) not null
)Engine=InnoDB;

create table administrator(
    username varchar(50) primary key,
    nama_lengkap varchar(50) not null,
    url_photo varchar(50),
    password varchar(50) not null,
    id_session varchar(50)
)Engine=InnoDB;

create table anggota(
    id_rfid varchar(50) primary key,
    username varchar(50) not null,
    id_riset int(5) not null,
    id_prodi int(5) not null,
    nim varchar(12) not null,
    nama_anggota varchar(50) not null,
    tgl_terdaftar date not null,
    url_photo varchar (50),

    constraint fk_anggota_idriset foreign key(id_riset) references riset(id_riset),
    constraint fk_anggota_idprodi foreign key(id_prodi) references prodi(id_prodi)

)Engine=InnoDB;

create table absensi(
    id_absensi int(5) primary key auto_increment,
    id_rfid varchar(50) not null,
    tgl_kehadiran date not null,
    waktu_datang time not null,
    waktu_pulang time not null,
    status varchar(50),

    constraint fk_absensi_idrfid foreign key(id_rfid) references anggota(id_rfid)

)Engine=InnoDB;

create table jenis_piket(
    id_jenis_piket int(5) primary key auto_increment,
    jenis_piket varchar(50) not null
)Engine=InnoDB;

create table piket(
    id_piket int(5) primary key auto_increment,
    id_rfid varchar(50) not null,
    id_jenis_piket int(5) not null,
    username varchar(50) not null,
    tgl_piket date not null,
    status_piket varchar(50),

    constraint fk_piket_idrfid foreign key(id_rfid) references anggota(id_rfid),
    constraint fk_piket_username foreign key(username) references administrator(username),
    constraint fk_piket_idjenispiket foreign key(id_jenis_piket) references jenis_piket(id_jenis_piket)

)Engine=InnoDB;


-- untuk mengelola modul/data menu pada halaman administrator
create table module(
    module_id int primary key auto_increment,
    module_name varchar(50) not null,
    link varchar(50),
    icon varchar(50),
    active enum('Y','N') not null default 'Y'
)Engine=InnoDB;

-- ### INSERT DATA MODULE
insert into module values
(1, "beranda","?m=beranda","fa-chart-pie","Y"),
(2, "module","?m=module","fa-clone","Y"),
(3, "jenis piket","?m=jenispiket","fa-tags","Y"),
(4, "piket","?m=piket","fa-calendar","Y"),
(5, "prodi","?m=prodi","fa-ribbon","Y"),
(6, "anggota","?m=anggota","fa-users","Y"),
(7, "pengguna","?m=pengguna","fa-user","Y"),
(8, "absensi","?m=absensi","fa-table","Y");

-- ### INSERT DATA ADMINISTRATOR
insert into administrator(username, nama_lengkap,url_photo,password) values
('yusrizal','Yusrizal Falahan','https://akademik.unikom.ac.id/foto/10117043.jpg',sha1('yusrizal')),
('donny','Donny Aditya Respati','https://akademik.unikom.ac.id/foto/10117047.jpg',sha1('donny')),
('teguh','Teguh Siswanto','https://akademik.unikom.ac.id/foto/10117065.jpg',sha1('teguh')),
('daffa','Daffa Qinthara Senjaya','https://akademik.unikom.ac.id/foto/10117080.jpg',sha1('daffa'));

insert into prodi(id_prodi, nama_prodi) values
(1,'Teknik Informatika'),
(2,'Teknik Komputer'),
(3,'Sistem Informasi'),
(4,'Desain Komunikasi Visual'),
(5,'Teknik Arsitektur'),
(6,'Teknik Komputer'),
(7,'Teknik Elektro'),
(8,'Sistem Komputer');
