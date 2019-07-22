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
    passwod varchar(50) not null
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