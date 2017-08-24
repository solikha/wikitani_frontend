--- Update terhadap database sql setelah tgl 11 APR 2016 harap diletakkan di bawah ini, dengan dilengkapi 
--- tanggal update deskripsi dan perintah SQL-nya.

--- Tgl : 12 April 2016
--- Deskripsi : Perubahan isi data app_task

delete from app_task;
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (4, 8, 'check-data-wni', 'Pengecekan Data WNI', 'Pengecekan Data WNI', 'Data WNI sedang diperiksa oleh petugas KBRI. Harap ditunggu.', 'KBRI', 'operator', NULL, 'process');
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (11, 8, 'tidak-lolos-cekal', 'Tidak Lolos Pengecekan Cekal', 'Tidak Lolos Pengecekan Cekal', 'Tidak Lolos Pengecekan Cekal', '-', 'none', NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (10, 8, 'check-cekal', 'Pengecekan Cekal', 'Pengecekan Data WNI', 'Data WNI sedang diperiksa oleh petugas KBRI. Harap ditunggu.', 'KBRI', 'operator', NULL, 'process');
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (36, 2, 'pending', 'Pending', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (27, 1, 'pending', 'Pending', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (28, 2, 'pengecekan-data', 'Pengecekan Data', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (20, 1, 'siap-proses', 'Permohonan siap diproses.', 'Permohonan siap diproses di KBRI.', 'Permohonan siap diproses di KBRI dengan membawa dokumen-dokumen sebagai berikut :', 'KBRI', 'operator', NULL, 'process');
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (1, 8, 'draft', 'Draft', 'Draft', '-', 'Pemohon', 'user', 'user', 'draft');
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (2, 8, 'start', 'Start Permohonan', 'Start Permohonan', '-', 'KBRI', 'operator', NULL, 'process');
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (3, 8, 'attachment', 'User Attachment', 'Add Attachment', 'Silahkan attachment dilengkapi.
1. Scan Paspor
2. Scan Surat Izin Tinggal
3. Foto', 'Pemohon', 'user', NULL, 'process');
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (5, 8, 'verified-wni', 'WNI Verified', 'WNI Verified', 'Data sudah terverifikasi.', '-', 'none', NULL, 'process');
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (6, 8, 'isi-data-wni', 'Input Data oleh Pemohon', 'Input Data Pribadi', 'Silahkan data diisi dengan lengkap sesuai dokumen formal yang anda miliki.', 'Pemohon', 'user', NULL, 'process');
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (8, 8, 'registration-finished', 'Selesai Registrasi Data', 'Registrasi Sudah Selesai', NULL, '-', 'none', NULL, 'finished');
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (9, 8, 'registration-canceled', 'Registrasi Dibatalkan', 'Registrasi dibatalkan.', NULL, '-', 'none', NULL, 'canceled');
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (7, 8, 'check-input-data', 'Check Input Data', 'Pengecekan Hasil Input Data', 'Data WNI sedang diperiksa oleh petuas KBRI. Harap ditunggu.', 'KBRI', 'operator', NULL, 'process');
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (12, 1, 'permohonan', 'Permohonan', 'Permohonan', 'Silahkan lengkapi formulir permohonan, serta lakukan upload paspor lama anda sebagai attachment.', 'Pomohon', 'user', 'user', 'draft');
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (13, 2, 'permohonan', 'Permohonan', 'Permohonan', 'Silahkan lengkapi Formulir Permohonan, serta lakukan upload data anak anda sebagai attachment.', 'Pemohon', 'user', 'user', 'draft');
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (14, 3, 'permohonan', 'Permohonan', 'Permohonan', 'Silahkan lengkapi Formulir Permohonan, serta lakukan upload data anda sebaga attachment.', 'Pemohon', 'user', 'user', 'draft');
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (15, 4, 'permohonan', 'Permohonan', 'Permohonan', 'Silahkan lengkapi Formulir Permohonan, serta lakukan upload paspor anda sebagai attachment', 'Pemohon', 'user', 'user', 'draft');
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (16, 5, 'permohonan', 'Permohonan', 'Permohonan', 'Silahkan lengkapi Formulir Permohonan, serta lakukan upload paspor anda sebagai attachment.', 'Pemohon', 'user', 'user', 'draft');
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (17, 6, 'permohonan', 'Permohonan', 'Permohonan', 'Silahkan lengkapi Formulir Permohonan, serta lakukan upload paspor WNI yang meninggal sebagai attachment.', 'Pemohon', 'user', 'user', 'draft');
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (18, 7, 'permohonan', 'Permohonan', 'Permohonan', 'Silahkan lengkapi Formulir Permohonan, serta lakukan upload paspor anda sebagai attachment.', 'Pemohon', 'user', 'user', 'draft');
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (19, 1, 'pengecekan-data', 'Pengecekan Data Permohonan', 'Pengecekan Data Permohonan', 'Data Permohonan sedang diperiksa oleh petugas KBRI.', 'KBRI', 'operator', NULL, 'process');
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (29, 2, 'siap-proses', 'Siap Proses', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (37, 1, 'tidak-lolos-cekal', 'Tidak Lolos Cekal', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (23, 1, 'pencetakan', 'Pencetakan', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (32, 2, 'pencetakan', 'Pencetakan', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (38, 2, 'tidak-lolos-cekal', 'Tidak Lolos Cekal', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (24, 1, 'siap-ambil', 'Siap Ambil', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (33, 2, 'siap-ambil', 'Siap Ambil', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (39, 3, 'pengecekan-data', 'Pegecekan Data', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (40, 3, 'siap-proses', 'Siap Proses', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (41, 3, 'check-cekal', 'Check Cekal', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (42, 3, 'tidak-lolos-cekal', 'Tidak Lolos Cekal', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (43, 3, 'pencetakan', 'Pencetakan', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (44, 3, 'siap-ambil', 'Siap Ambil', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (45, 3, 'sudah diambil', 'Sudah Diambil', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (46, 3, 'dibatalkan', 'Dibatalkan', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (47, 3, 'pending', 'Pending', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (48, 4, 'pengecekan-data', 'Pegecekan Data', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (49, 4, 'siap-proses', 'Siap Proses', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (50, 4, 'check-cekal', 'Check Cekal', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (51, 4, 'tidak-lolos-cekal', 'Tidak Lolos Cekal', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (52, 4, 'pencetakan', 'Pencetakan', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (53, 4, 'siap-ambil', 'Siap Ambil', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (54, 4, 'selesai', 'Sudah Diambil', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (55, 4, 'dibatalkan', 'Dibatalkan', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (56, 4, 'pending', 'Pending', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (57, 5, 'pengecekan-data', 'Pengecekan Data', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (58, 5, 'siap-proses', 'Siap Proses', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (59, 5, 'check-cekal', 'Check Cekal', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (60, 5, 'tidak-lolos-cekal', 'Tidak Lolos Cekal', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (61, 5, 'selesai', 'Sudah Diambil', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (62, 5, 'dibatalkan', 'Dibatalkan', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (63, 5, 'pending', 'Pending', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (64, 6, 'pengecekan-data', 'Pengecekan Data', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (65, 6, 'siap-proses', 'Siap Proses', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (66, 6, 'check-cekal', 'Check Cekal', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (67, 6, 'tidak-lolos-cekal', 'Tidak Lolos Cekal', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (68, 6, 'selesai', 'Sudah Diambil', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (69, 6, 'dibatalkan', 'Dibatalkan', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (70, 6, 'pending', 'Pending', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (71, 7, 'pengecekan-data', 'Pengecekan Data', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (72, 7, 'siap-proses', 'Siap Proses', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (73, 7, 'check-cekal', 'Check Cekal', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (74, 7, 'tidak-lolos-cekal', 'Tidak Lolos Cekal', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (75, 7, 'selesai', 'Sudah Diambil', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (76, 7, 'dibatalkan', 'Dibatalkan', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (77, 7, 'pending', 'Pending', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (21, 1, 'check-cekal', 'Pengecekan Cekal', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (22, 1, 'pembayaran', 'Pembayaran', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (25, 1, 'sudah-diambil', 'Sudah Diambil', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (26, 1, 'dibatalkan', 'Dibatalkan', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (30, 2, 'check-cekal', 'Pengecekan Cekal', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (31, 2, 'pembayaran', 'Pembayaran', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (34, 2, 'sudah diambil', 'Sudah Diambil', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO app_task (id, layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (35, 2, 'dibatalkan', 'Dibatalkan', NULL, NULL, NULL, NULL, NULL, NULL);

SELECT pg_catalog.setval('app_task_id_seq', 77, true);

------------------

--- Tgl : 12 April 2016
--- Deskripsi : menambah table untuk status layanan

CREATE TABLE app_status_layanan
(
  id serial NOT NULL,
  layananid integer,
  kode integer,
  updatename character varying,
  taskname character varying,
  CONSTRAINT app_status_layanan_pkey PRIMARY KEY (id)
)
;

INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('1','1','baru','pengecekan-data');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('1','2','dok-tidak-lengkap','permohonan');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('1','3','gagal-cekal','tidak-lolos-cekal');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('1','4','lolos-cekal','pembayaran');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('1','5','pending','pending');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('1','6','dibatalkan','dibatalkan');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('2','1','baru','pengecekan-data');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('2','2','dok-tidak-lengkap','permohonan');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('2','3','gagal-cekal','tidak-lolos-cekal');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('2','4','lolos-cekal','pembayaran');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('2','5','pending','pending');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('2','6','dibatalkan','dibatalkan');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('3','1','baru','pengecekan-data');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('3','2','dok-tidak-lengkap','permohonan');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('3','3','gagal-cekal','tidak-lolos-cekal');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('3','4','lolos-cekal','pencetakan');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('3','5','pending','pending');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('3','6','dibatalkan','dibatalkan');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('4','1','baru','pengecekan-data');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('4','2','dok-tidak-lengkap','permohonan');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('4','3','gagal-cekal','tidak-lolos-cekal');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('4','4','lolos-cekal','pencetakan');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('4','5','pending','pending');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('4','6','dibatalkan','dibatalkan');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('5','1','baru','pengecekan-data');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('5','2','dok-tidak-lengkap','permohonan');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('5','3','gagal-cekal','tidak-lolos-cekal');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('5','5','pending','pending');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('5','6','dibatalkan','dibatalkan');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('6','1','baru','pengecekan-data');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('6','2','dok-tidak-lengkap','permohonan');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('6','3','gagal-cekal','tidak-lolos-cekal');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('6','5','pending','pending');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('6','6','dibatalkan','dibatalkan');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('7','1','baru','pengecekan-data');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('7','2','dok-tidak-lengkap','permohonan');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('7','3','gagal-cekal','tidak-lolos-cekal');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('7','5','pending','pending');
INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES ('7','6','dibatalkan','dibatalkan');

----------------------


-- Tanggal : 13 April 2016
-- Deskripsi : Penambahan item di sys_menu

insert into sys_menu(viewindex, menuname, caption, description, 
  parentid, menulevel, frontbar, command, context, visible, ismenu)
  values(310, 'check_layanan_ganti_paspor', 'check_layanan_ganti_paspor', 'check_layanan_ganti_paspor',
  0, 1, 0, 'crud', 'check_layanan_ganti_paspor', 1, 0);
  
insert into sys_menu(viewindex, menuname, caption, description, 
  parentid, menulevel, frontbar, command, context, visible, ismenu)
  values(320, 'check_layanan_konversi_ganti_alamat', 'check_layanan_konversi_ganti_alamat', 'check_layanan_konversi_ganti_alamat',
  0, 1, 0, 'crud', 'check_layanan_konversi_ganti_alamat', 1, 0);
  
insert into sys_menu(viewindex, menuname, caption, description, 
  parentid, menulevel, frontbar, command, context, visible, ismenu)
  values(330, 'check_layanan_konversi_ganti_nama', 'check_layanan_konversi_ganti_nama', 'check_layanan_konversi_ganti_nama',
  0, 1, 0, 'crud', 'check_layanan_konversi_ganti_nama', 1, 0);
  
insert into sys_menu(viewindex, menuname, caption, description, 
  parentid, menulevel, frontbar, command, context, visible, ismenu)
  values(340, 'check_layanan_konversi_ganti_stat_pekejaan', 'check_layanan_konversi_ganti_stat_pekejaan', 'check_layanan_konversi_ganti_stat_pekejaan',
  0, 1, 0, 'crud', 'check_layanan_konversi_ganti_stat_pekejaan', 1, 0);

insert into sys_menu(viewindex, menuname, caption, description, 
  parentid, menulevel, frontbar, command, context, visible, ismenu)
  values(350, 'check_layanan_lapor_meninggal', 'check_layanan_lapor_meninggal', 'check_layanan_lapor_meninggal',
  0, 1, 0, 'crud', 'check_layanan_lapor_meninggal', 1, 0);

insert into sys_menu(viewindex, menuname, caption, description, 
  parentid, menulevel, frontbar, command, context, visible, ismenu)
  values(360, 'check_layanan_paspor_baru_anak', 'check_layanan_paspor_baru_anak', 'check_layanan_paspor_baru_anak',
  0, 1, 0, 'crud', 'check_layanan_paspor_baru_anak', 1, 0);
  
insert into sys_menu(viewindex, menuname, caption, description, 
  parentid, menulevel, frontbar, command, context, visible, ismenu)
  values(370, 'check_layanan_pindah_wn', 'check_layanan_pindah_wn', 'check_layanan_pindah_wn',
  0, 1, 0, 'crud', 'check_layanan_pindah_wn', 1, 0);
  
insert into sys_menu(viewindex, menuname, caption, description, 
  parentid, menulevel, frontbar, command, context, visible, ismenu)
  values(380, 'check_layanan_pulang_habis', 'check_layanan_pulang_habis', 'check_layanan_pulang_habis',
  0, 1, 0, 'crud', 'check_layanan_pulang_habis', 1, 0);
  

----------------------


-- Tanggal : 13 April 2016
-- Deskripsi : Penambahan di sys_menu


  INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) VALUES (NULL, 'layanan_edit_wni', NULL, NULL, 0, 1, 0, 'crud', 'layanan_edit_wni', 1, NULL, NULL, 0);
  

----------------------

-- Tanggal : 14 April 2016
-- Deskripsi : Tabel untuk dokumen yang diperlukan layanan

CREATE TABLE app_jenis_dokumen
(
  id integer NOT NULL,
  nama character varying,
  CONSTRAINT app_documents_pkey PRIMARY KEY (id)
)
;

INSERT INTO app_jenis_dokumen (id, nama) VALUES (1, 'Salinan Tanda Pengenal');
INSERT INTO app_jenis_dokumen (id, nama) VALUES (2, 'Salinan Akte Kelahiran');
INSERT INTO app_jenis_dokumen (id, nama) VALUES (3, 'Salinan Akte Perkawinan');
INSERT INTO app_jenis_dokumen (id, nama) VALUES (4, 'Salinan Izin Tinggal');
INSERT INTO app_jenis_dokumen (id, nama) VALUES (5, 'Paspor Lama');
INSERT INTO app_jenis_dokumen (id, nama) VALUES (6, 'Salinan Kutipan Akte Cerai');
INSERT INTO app_jenis_dokumen (id, nama) VALUES (7, 'Akte Kematian');
INSERT INTO app_jenis_dokumen (id, nama) VALUES (8, 'Kartu Keluarga');


CREATE TABLE app_dokumen
(
  id serial NOT NULL,
  layananid integer,
  jdokumen integer,
  CONSTRAINT app_dokumen_pkey PRIMARY KEY (id)
)
;

INSERT INTO app_dokumen (id, layananid, jdokumen) VALUES (1, 1, 1);
INSERT INTO app_dokumen (id, layananid, jdokumen) VALUES (2, 1, 2);
INSERT INTO app_dokumen (id, layananid, jdokumen) VALUES (3, 1, 4);
INSERT INTO app_dokumen (id, layananid, jdokumen) VALUES (4, 1, 5);
INSERT INTO app_dokumen (id, layananid, jdokumen) VALUES (5, 2, 1);
INSERT INTO app_dokumen (id, layananid, jdokumen) VALUES (6, 2, 2);
INSERT INTO app_dokumen (id, layananid, jdokumen) VALUES (7, 2, 4);
INSERT INTO app_dokumen (id, layananid, jdokumen) VALUES (8, 2, 5);


--- Tanggal: 15 April 2016
--- Deskripsi: Menu baru untuk referensi dokumen dan jenis dokumen.

-- tabel dokumen untuk layanan tertentu
CREATE TABLE wni_layanan_doc
(
  id serial NOT NULL,
  wni_layanan_id integer,
  doc_id integer,
  CONSTRAINT wni_layanan_doc_pkey PRIMARY KEY (id)
)
;


-- sys_menu dokumen dan jenis dokumen
INSERT INTO sys_menu (viewindex, menuname, caption, description, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) VALUES (16, 'jenis_dokumen_ref', 'Jenis Dokumen', NULL, 1, 0, 'crud', 'jenis_dokumen', 1, NULL, NULL, 1);
INSERT INTO sys_menu (viewindex, menuname, caption, description, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) VALUES (17, 'dokumen_ref', 'Dokumen', NULL, 1, 0, 'crud', 'dokumen', 1, NULL, NULL, 1);

-- sys_permision dokumen dan jenis dokumen

INSERT INTO sys_permissions (category, permissionname, description, active) VALUES ('menu', 'jenis_dokumen_ref', NULL, 1);
INSERT INTO sys_permissions (category, permissionname, description, active) VALUES ('menu', 'dokumen_ref', NULL, 1);


--- Menu Layanan Baru

insert into sys_menu(viewindex, menuname, caption, description, 
  parentid, menulevel, frontbar, command, context, visible, ismenu)
  values(390, 'layanan_baru', 'layanan_baru', 'layanan_baru',
  0, 1, 0, 'crud', 'layanan_baru', 1, 0);
  
update sys_menu
set context = 'izin_tinggal'
where menuname = 'izin_tinggal_ref'
;


--- Tanggal 18 April
--- Row di Sysmenu untuk screen edit permohonan

insert into sys_menu(viewindex, menuname, caption, description, 
  parentid, menulevel, frontbar, command, context, visible, ismenu)
  values(410, 'edit_layanan_ganti_paspor', 'edit_layanan_ganti_paspor', 'edit_layanan_ganti_paspor',
  0, 1, 0, 'crud', 'edit_layanan_ganti_paspor', 1, 0);
  
insert into sys_menu(viewindex, menuname, caption, description, 
  parentid, menulevel, frontbar, command, context, visible, ismenu)
  values(420, 'edit_layanan_konversi_ganti_alamat', 'edit_layanan_konversi_ganti_alamat', 'edit_layanan_konversi_ganti_alamat',
  0, 1, 0, 'crud', 'edit_layanan_konversi_ganti_alamat', 1, 0);
  
insert into sys_menu(viewindex, menuname, caption, description, 
  parentid, menulevel, frontbar, command, context, visible, ismenu)
  values(430, 'edit_layanan_konversi_ganti_nama', 'edit_layanan_konversi_ganti_nama', 'edit_layanan_konversi_ganti_nama',
  0, 1, 0, 'crud', 'edit_layanan_konversi_ganti_nama', 1, 0);
  
insert into sys_menu(viewindex, menuname, caption, description, 
  parentid, menulevel, frontbar, command, context, visible, ismenu)
  values(440, 'edit_layanan_konversi_ganti_stat_pekejaan', 'edit_layanan_konversi_ganti_stat_pekejaan', 'edit_layanan_konversi_ganti_stat_pekejaan',
  0, 1, 0, 'crud', 'edit_layanan_konversi_ganti_stat_pekejaan', 1, 0);

insert into sys_menu(viewindex, menuname, caption, description, 
  parentid, menulevel, frontbar, command, context, visible, ismenu)
  values(450, 'edit_layanan_lapor_diri', 'edit_layanan_lapor_diri', 'edit_layanan_lapor_diri',
  0, 1, 0, 'crud', 'edit_layanan_lapor_diri', 1, 0);

insert into sys_menu(viewindex, menuname, caption, description, 
  parentid, menulevel, frontbar, command, context, visible, ismenu)
  values(460, 'edit_layanan_lapor_meninggal', 'edit_layanan_lapor_meninggal', 'edit_layanan_lapor_meninggal',
  0, 1, 0, 'crud', 'edit_layanan_lapor_meninggal', 1, 0);

insert into sys_menu(viewindex, menuname, caption, description, 
  parentid, menulevel, frontbar, command, context, visible, ismenu)
  values(470, 'edit_layanan_paspor_baru_anak', 'edit_layanan_paspor_baru_anak', 'edit_layanan_paspor_baru_anak',
  0, 1, 0, 'crud', 'edit_layanan_paspor_baru_anak', 1, 0);
  
insert into sys_menu(viewindex, menuname, caption, description, 
  parentid, menulevel, frontbar, command, context, visible, ismenu)
  values(480, 'edit_layanan_pindah_wn', 'edit_layanan_pindah_wn', 'edit_layanan_pindah_wn',
  0, 1, 0, 'crud', 'edit_layanan_pindah_wn', 1, 0);
  
insert into sys_menu(viewindex, menuname, caption, description, 
  parentid, menulevel, frontbar, command, context, visible, ismenu)
  values(490, 'edit_layanan_pulang_habis', 'edit_layanan_pulang_habis', 'edit_layanan_pulang_habis',
  0, 1, 0, 'crud', 'edit_layanan_pulang_habis', 1, 0);

-- penambahan column di tabel wni  
alter table wni
add column last_update timestamp with time zone default now()
;

--sys_menu  layanan_baru_edit_wni
INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) VALUES (NULL, 'layanan_baru_edit_wni', NULL, NULL, 0, 1, 0, 'crud', 'layanan_baru_edit_wni', 1, NULL, NULL, 0);
--sys_permission  layanan_baru_edit_wni
INSERT INTO sys_permissions (category, permissionname, description, active) VALUES ('menu', 'layanan_baru_edit_wni', NULL, 1);

--alter column jenis kelamin menjadi jenkelid pada tabel cekal
ALTER TABLE cekal ALTER COLUMN jenis_kelamin TYPE smallint USING jenis_kelamin::smallint;
ALTER TABLE cekal RENAME jenis_kelamin TO jenkelid;



--- Tanggal 19 April
--- table jenis bayar

CREATE TABLE jenis_bayar
(
  id serial NOT NULL,
  nama character varying,
  CONSTRAINT jenis_bayar_pkey PRIMARY KEY (id)
)
;

INSERT INTO jenis_bayar (id, nama) VALUES (1, 'PIN');
INSERT INTO jenis_bayar (id, nama) VALUES (2, 'Cash');

ALTER TABLE layanan_sub ADD COLUMN biaya numeric;

-- penambahan column cekal id di tabel wni_layanan 
ALTER TABLE wni_layanan ADD COLUMN cekal_id integer;


--- 20 April 2016
--- Menu Cetak Paspor

insert into sys_menu(viewindex, menuname, caption, description, 
  parentid, menulevel, frontbar, command, context, visible, ismenu)
  values(510, 'cetak_paspor', 'cetak_paspor', 'cetak_paspor',
  0, 1, 0, 'crud', 'cetak_paspor', 1, 0);
  
  
--- 21 April

--- Menu Cetak
  
insert into sys_menu(viewindex, menuname, caption, description, 
  parentid, menulevel, frontbar, command, context, visible, ismenu)
  values(520, 'cetak_nikah', 'cetak_nikah', 'cetak_nikah',
  0, 1, 0, 'crud', 'cetak_nikah', 1, 0);

insert into sys_menu(viewindex, menuname, caption, description, 
  parentid, menulevel, frontbar, command, context, visible, ismenu)
  values(530, 'cetak_cerai', 'cetak_cerai', 'cetak_cerai',
  0, 1, 0, 'crud', 'cetak_cerai', 1, 0);

insert into sys_menu(viewindex, menuname, caption, description, 
  parentid, menulevel, frontbar, command, context, visible, ismenu)
  values(540, 'cetak_stkerja', 'cetak_stkerja', 'cetak_stkerja',
  0, 1, 0, 'crud', 'cetak_stkerja', 1, 0);

insert into sys_menu(viewindex, menuname, caption, description, 
  parentid, menulevel, frontbar, command, context, visible, ismenu)
  values(550, 'cetak_alamat', 'cetak_alamat', 'cetak_alamat',
  0, 1, 0, 'crud', 'cetak_alamat', 1, 0);
  
insert into sys_menu(viewindex, menuname, caption, description, 
  parentid, menulevel, frontbar, command, context, visible, ismenu)
  values(560, 'cetak_splp', 'cetak_splp', 'cetak_splp',
  0, 1, 0, 'crud', 'cetak_splp', 1, 0);
  
insert into sys_menu(viewindex, menuname, caption, description, 
  parentid, menulevel, frontbar, command, context, visible, ismenu)
  values(570, 'pembayaran', 'pembayaran', 'pembayaran',
  0, 1, 0, 'crud', 'pembayaran', 1, 0);
  
  
--- layanan_sub

delete from layanan_sub;

INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya) VALUES (5, 1, 'Lain-lain', NULL, NULL);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya) VALUES (6, 2, 'Anak yang baru lahir', NULL, NULL);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya) VALUES (7, 2, 'Anak dengan kewarganegaraan ganda yang lahir setelah 1 Agustus 2006', NULL, NULL);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya) VALUES (8, 2, 'Anak dengan kewarganegaraan ganda yang lahir sebelum 1 Agustus 2006', NULL, NULL);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya) VALUES (9, 2, 'Anak lahir di luar nikah', NULL, NULL);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya) VALUES (10, 3, 'Ganti Nama karena menikah', NULL, NULL);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya) VALUES (11, 3, 'Ganti Nama karena cerai', NULL, NULL);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya) VALUES (12, 3, 'Ganti Alamat', NULL, NULL);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya) VALUES (13, 3, 'Ganti Status Pekerjaan', NULL, NULL);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya) VALUES (99, 8, 'Verifikasi Data', 'update_data', NULL);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya) VALUES (1, 1, 'Halaman paspor penuh', 'ganti_paspor', NULL);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya) VALUES (3, 1, 'Paspor habis masa berlaku', 'ganti_paspor', NULL);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya) VALUES (4, 1, 'Paspor hilang', 'paspor_hilang', NULL);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya) VALUES (14, 3, 'Konversi lebih dari satu jenis data', NULL, NULL);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya) VALUES (2, 1, 'Paspor rusak', 'ganti_paspor', 20);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya) VALUES (17, 4, 'Pulang Habis', NULL, NULL);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya) VALUES (18, 5, 'Pindah Kewarganegaraan', NULL, NULL);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya) VALUES (19, 6, 'Pelaporan Meninggal', NULL, NULL);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya) VALUES (20, 7, 'Lapor Diri', NULL, NULL);

SELECT pg_catalog.setval('layanan_sub_id_seq', 20, true);

-- 22 April 2016
-- Data Layanan dan Sub Layanan

INSERT INTO layanan (id, nama) VALUES (9, 'SPLP');
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya) VALUES (21, 9, 'SPLP', NULL, NULL);
SELECT pg_catalog.setval('layanan_sub_id_seq', 21, true);


-- 25 April 2016
-- Perubahan struktur menu

update sys_menu
set caption = 'Proses Layanan',
  description = 'Proses Layanan',
  parentid = (select menuid from sys_menu where menuname='operasional'),
  menulevel = 2
where menuname = 'layanan'
;

update sys_menu
set 
  visible = 0
where menuname = 'layanan_menu'
;
  
update sys_menu
set caption = 'Data Cekal',
  description = 'Data Cekal'
where menuname = 'cekal'
;
  
update sys_menu
set caption = 'Data WNI',
  description = 'Data WNI',
  viewindex = 2
where menuname = 'wni'
;


-- 26 April 2016
-- crud nomor_paspor

INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) 
VALUES (3, 'nomor_paspor', 'Nomor Paspor', 'Nomor Paspor', (select menuid from sys_menu where menuname='referensi'), 2, 0, 'crud', 'nomor_paspor', 1, NULL, NULL, 1);

insert into sys_permissions(category, permissionname, description)
values('menu', 'nomor_paspor', 'nomor_paspor')
;

INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) 
VALUES (null, 'nomor_paspor_bulk', 'Nomor Paspor Bulk', 'Nomor Paspor Bulk', 0, 1, 0, 'crud', 'nomor_paspor_bulk', 1, NULL, NULL, 0);


CREATE TABLE app_nomor_paspor
(
  id serial NOT NULL,
  no_paspor character varying,
  wni_layanan_id integer,
  status smallint,
  CONSTRAINT app_nomor_paspor_pkey PRIMARY KEY (id)
)
;

-- 27 April 2016
-- Penambahan constraint unique di tabel nomor paspor

ALTER TABLE app_nomor_paspor
  ADD CONSTRAINT app_nomor_paspor_unique UNIQUE(no_paspor);

INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) 
VALUES (null, 'cetak_paspor_anak', 'cetak_paspor_anak', 'cetak_paspor_anak', 0, 1, 0, 'crud', 'cetak_paspor_anak', 1, NULL, NULL, 0);

--29 april 2016
-- Table: app_history

-- DROP TABLE app_history;

CREATE TABLE app_history
(
  id serial NOT NULL,
  category character varying,
  history_time timestamp with time zone,
  data_history character varying,
  update_user character varying,
  CONSTRAINT app_history_pkey PRIMARY KEY (id)
)
;


-- 29 April 2016
-- insert data

INSERT INTO app_status_layanan (layananid, kode, updatename, taskname) VALUES (8, 4, 'lolos-cekal', 'verified-wni');

-- 2 mei 2016
-- tambah menu check data anak

INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) VALUES (NULL, 'cek_data_anak', NULL, NULL, 0, 1, 0, 'crud', 'check_data_anak', 1, NULL, NULL, 0);


-- update ke sys_permission
INSERT INTO sys_permissions (category, permissionname, description, active) VALUES ('menu', 'cek_data_anak', NULL, 1);


-- field add

ALTER TABLE app_registration ADD COLUMN aluar_provinsi character varying;
ALTER TABLE app_registration ADD COLUMN aluar_negara character varying;
ALTER TABLE app_registration ADD COLUMN pengenal_tgl_keluar date;
ALTER TABLE app_registration ADD COLUMN pengenal_tpt_keluar character varying;
ALTER TABLE app_registration ADD COLUMN aindo_provinsi character varying;
ALTER TABLE app_registration ADD COLUMN ll_jenis_cacat character varying;
ALTER TABLE app_registration ADD COLUMN ll_hak_pilih boolean;
ALTER TABLE app_registration ADD COLUMN pkjaan_provinsi character varying;
ALTER TABLE app_registration ADD COLUMN pkjaan_negara character varying;
ALTER TABLE app_registration ADD COLUMN pasangan_hubungan character varying;
ALTER TABLE app_registration ADD COLUMN ll_dwi_wn boolean;


-- 4 mei 2016
-- tambah field dan table

ALTER TABLE app_registration ADD COLUMN password character varying;
ALTER TABLE app_registration ADD COLUMN pwd_key character varying;
ALTER TABLE app_registration ADD COLUMN sys_hashkey character varying;

CREATE TABLE app_key_konfirmasi
(
  id serial NOT NULL,
  key character varying,
  expired timestamp with time zone,
  regid integer,
  status integer
)
;

--tabel app_task untuk pengecekan data anak
INSERT INTO app_task (layananid, taskname, description, public_description, public_instruction, public_actionby, actionby, pembatalan, status) VALUES (2, 'pengecekan-data-anak', 'Cek Data Anak', NULL, NULL, NULL, NULL, NULL, NULL);

-- 9 mei 2016 ---
-- tambah field dan table ---

CREATE TABLE app_key_pass
(
  id serial NOT NULL,
  key character varying,
  userid integer
)
;


-- 10 mei 2016 ---
-- delete field ---

ALTER TABLE app_registration DROP COLUMN sys_hashkey;


-- penambahan column di app_history 
alter table app_history
add column wni_lyn_id bigint
;


-- 12 Mei 2016
--------------

alter table app_history
add column wniid bigint
;


-- 17-mei-2016.

INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) VALUES (NULL, 'print_diplomatik', 'print_diplomatik', 'print_diplomatik', 0, 1, 0, 'crud', 'print_diplomatik', 1, NULL, NULL, 0);
INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) VALUES (NULL, 'print_cancelation', 'print_cancelation', 'print_cancelation', 0, 1, 0, 'crud', 'print_cancelation', 1, NULL, NULL, 0);
INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) VALUES (NULL, 'print_avidafit', 'print_avidafit', 'print_avidafit', 0, 1, 0, 'crud', 'print_avidafit', 1, NULL, NULL, 0);


-- 19-mei-2016..

INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) VALUES (NULL, 'print_pulang_habis', 'print_pulang_habis', 'print_pulang_habis', 0, 1, 0, 'crud', 'print_pulang_habis', 1, NULL, NULL, 0);

--26 mei 2016
--menu cetak lapor diri
INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) VALUES (NULL, 'cetak_lapor_diri', NULL, NULL, 0, 1, 0, 'crud', 'cetak_lapor_diri', 1, NULL, NULL, 1);

INSERT INTO sys_permissions (permissionid, category, permissionname, description, active) VALUES (62, 'menu', 'cetak_lapor_diri', NULL, 1);



--27 mei 2016...
--menu cetak akte...

INSERT INTO sys_menu ( viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) VALUES ( NULL, 'cetak_akte_kelahiran', 'cetak_akte_kelahiran', 'cetak_akte_kelahiran', 0, 1, 0, 'crud', 'cetak_akte_kelahiran', 1, NULL, NULL, 0);

--10 juni 2016
-- ALTER TABLE wni_layanan DROP COLUMN create_by;

ALTER TABLE wni_layanan ADD COLUMN create_by character varying;

--13 juni 2016..
-- tambah menu layanan menikah;

INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) VALUES (NULL, 'layanan_menikah', NULL, NULL, 0, 1, 0, 'crud', 'layanan_menikah', 1, NULL, NULL, 1);

--16 juni 2016..
-- tambah menu layanan menikah;

INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) VALUES (NULL, 'edit_layanan_lapor_menikah', NULL, NULL, 0, 1, 0, 'crud', 'edit_layanan_lapor_menikah', 1, NULL, NULL, 0);
INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) VALUES (NULL, 'layanan_lapor_menikah', NULL, NULL, 0, 1, 0, 'crud', 'layanan_lapor_menikah', 1, NULL, NULL, 0);

--17 juni 2016..
-- tambah menu cetak kelahiran;

INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) VALUES (NULL, 'cetak_kelahiran', NULL, NULL, 0, 1, 0, 'crud', 'cetak_kelahiran', 1, NULL, NULL, 0);

--20 juni 2016.
-- tambah menu layanan_lapor_meninggal;
INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) VALUES (260, 'layanan_lapor_meninggal', 'layanan_lapor_meninggal', 'layanan_lapor_meninggal', 0, 1, 0, 'crud', 'layanan_lapor_meninggal', 1, NULL, NULL, 0);

-- 21 juni 2016
INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) VALUES (260, 'edit_layanan_splp', 'edit_layanan_splp', 'edit_layanan_splp', 0, 1, 0, 'crud', 'edit_layanan_splp', 1, NULL, NULL, 0);

-- 22 juni 2016..
-- tambah table nomor splp
CREATE TABLE app_nomor_splp
(
  id serial NOT NULL,
  no_splp character varying,
  wni_layanan_id integer,
  status smallint,
  CONSTRAINT app_nomor_splp_pkey PRIMARY KEY (id),
  CONSTRAINT app_nomor_splp_unique UNIQUE (no_splp)
)

INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) VALUES (4, 'nomor_splp', 'Nomor SPLP', 'Nomor SPLP', 93, 2, 0, 'crud', 'nomor_splp', 1, NULL, NULL, 1);
INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) VALUES (NULL, 'nomor_splp_bulk', NULL, NULL, 0, 1, 0, 'crud', 'nomor_splp_bulk', 1, NULL, NULL, 0);

INSERT INTO sys_permissions (category, permissionname, description, active) VALUES ('menu', 'nomor_splp', 'nomor_splp', 1);

-- Menambahkan id str agar bisa direfer oleh user
ALTER TABLE wni_layanan
  ADD COLUMN layananidstr character varying;

-- 22 juni 2016..
-- tambah menu splp

INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) VALUES (4, 'layanan_splp', NULL, NULL, 0, 1, 0, 'crud', 'layanan_splp', 1, NULL, NULL, 0);

-- 24 juni 2016..
-- tambah menu splp
CREATE TABLE app_config
(
  id serial NOT NULL,
  kategori character varying,
  nama character varying,
  value character varying,
  CONSTRAINT app_config_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE app_config
  OWNER TO postgres;

INSERT INTO app_config (kategori, nama, value,deskripsi) VALUES ('kbri', 'nama', 'KBRI Brussel','desc KBRI Brussel');
INSERT INTO app_config (kategori, nama, value,deskripsi) VALUES ('kbri', 'kode_foto', '7E','desc KBRI Brussel');
INSERT INTO app_config (kategori, nama, value,deskripsi) VALUES ('kbri', 'kode_paspor', '7E','desc KBRI Brussel');
INSERT INTO app_config (kategori, nama, value,deskripsi) VALUES ('kbri', 'alamat', 'Avenue de Tervuren 294, B-1150, Woluwe-Saint-Pierre','desc KBRI Brussel');
INSERT INTO app_config (kategori, nama, value,deskripsi) VALUES ('kbri', 'alamat1', 'Avenue de Tervuren 294','desc KBRI Brussel');
INSERT INTO app_config (kategori, nama, value,deskripsi) VALUES ('kbri', 'alamat2', 'B-1150, Woluwe-Saint-Pierre','desc KBRI Brussel');
INSERT INTO app_config (kategori, nama, value,deskripsi) VALUES ('kbri', 'kota', 'Brussels','desc KBRI Brussel');
INSERT INTO app_config (kategori, nama, value,deskripsi) VALUES ('kbri', 'phone', '+32(0)2 771 2014','desc KBRI Brussel');
INSERT INTO app_config (kategori, nama, value,deskripsi) VALUES ('kbri', 'fax', '+32(0)2 771 3347','desc KBRI Brussel');
INSERT INTO app_config (kategori, nama, value,deskripsi) VALUES ('kbri', 'nama_kepala_perwakilan_ri', 'Ifan Mahdiyat Sofiana','desc KBRI Brussel');
INSERT INTO app_config (kategori, nama, value,deskripsi) VALUES ('kbri', 'jabatan_kepala_perwakilan_ri', 'Sekretaris Pertama','desc KBRI Brussel');
INSERT INTO app_config (kategori, nama, value,deskripsi) VALUES ('kbri', 'kwitansi_nama', 'Makdum Ibrahim','desc KBRI Brussel');
INSERT INTO app_config (kategori, nama, value,deskripsi) VALUES ('kbri', 'kwitansi_jabatan', 'Bendaharawan','desc KBRI Brussel');
INSERT INTO app_config (kategori, nama, value,deskripsi) VALUES ('kbri', 'kwitansi_nip', '14354352435','desc KBRI Brussel');
INSERT INTO app_config (kategori, nama, value,deskripsi) VALUES ('kbri', 'kwitansi_mengetahui_nama', 'raden Mas said','desc KBRI Brussel');
INSERT INTO app_config (kategori, nama, value,deskripsi) VALUES ('kbri', 'kwitansi_mengetahui_jabatan', 'Kepala Bagian','desc KBRI Brussel');
INSERT INTO app_config (kategori, nama, value,deskripsi) VALUES ('kbri', 'kwitansi_mengetahui_nip','37565666765','desc KBRI Brussel');

--sys_menu screen config 24 juni 2016
INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) VALUES (NULL, 'config', 'Konfigurasi', NULL, 93, 1, 0, 'crud', 'config', 1, NULL, NULL, 1);

INSERT INTO sys_permissions (category, permissionname, description, active) VALUES ('menu', 'config', 'Konfigurasi', 1);

-- 24 Juni 2016
--------------

alter table app_config
add column deskripsi character varying
;


INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) 
VALUES (100, 'attachment_layanan', 'Attachment Layanan', NULL, 93, 1, 0, 'crud', 'attachment_layanan', 1, NULL, NULL, 1);

INSERT INTO sys_permissions (category, permissionname, description, active) VALUES ('menu', 'attachment_layanan', 'Attachment Layanan', 1);


INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) 
VALUES (99, 'jenis_attachment', 'Jenis Attachment', NULL, 93, 1, 0, 'crud', 'jenis_attachment', 1, NULL, NULL, 1);

INSERT INTO sys_permissions (category, permissionname, description, active) VALUES ('menu', 'jenis_attachment', 'Jenis Attachment', 1);

-- 27 juni 2016
INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) VALUES (270, 'layanan_splp', 'layanan_splp', 'layanan_splp', 0, 1, 0, 'crud', 'layanan_splp', 1, NULL, NULL, 0);


-- 30 juni 2016
CREATE TABLE app_email
(
  id serial NOT NULL,
  email character varying,
  kategori character varying,
  subkategori character varying,
  sourceid integer,
  data text,
  controlid integer,
  status integer,
  subject character varying,
  CONSTRAINT app_email_id_key primary key (id)
)

-- 14 juli 2017 clean database server
delete from wni_layanan where id != 406;
delete from wni_layanan_attch where wni_layanan_id != 406;
delete from wni_layanan_doc where wni_layanan_id != 406;
delete from app_history where wni_lyn_id != 406;
delete from sys_session;
delete from sys_users where username not in('admin','totok','harimurpi@live.com');
delete from app_registration where email != 'harimurpi@live.com';
delete from sys_files where hashid not in('00a46fef85c1654dba80043619c6d984','a8b164a25f5b30777b1ac9ef744c94e0','5581b737b8637e007fd1a771e2eb67cf','9ffd236d3d895aa04cff9a4139a0c240');


--29 Juli
INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) 
VALUES (1, 'laporan_statistik_bulanan', 'Laporan Statistik Bulanan', 'Laporan Statistik Bulanan', (select menuid from sys_menu where menuname = 'informasi'), 2, 0, 'crud/laporan/statistik_bulanan', '', 1, 'fa fa-print', NULL, 1);

INSERT INTO sys_permissions (category, permissionname, description, active) VALUES ('menu', 'laporan_statistik_bulanan', 'Laporan Statistik Bulanan', 1);

-- 5 agustus 2016 penambahan column di tabel app_nomor_paspor dan create table app_pengadaan_paspor
-- ALTER TABLE app_nomor_paspor DROP COLUMN pengadaanpasporid;
ALTER TABLE app_nomor_paspor ADD COLUMN pengadaanpasporid bigint;


CREATE TABLE app_pengadaan_paspor
(
  id bigserial NOT NULL,
  tanggal date,
  nomor_awal character varying,
  nomor_akhir character varying,
  CONSTRAINT app_pengadaan_paspor_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE app_pengadaan_paspor
  OWNER TO postgres;
  
  
  --sys menu 
INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) VALUES (5, 'pengadaan_paspor', 'Pengadaan Paspor', 'pengadaan paspor', 93, 2, 0, 'crud', 'pengadaan_paspor', 1, NULL, NULL, 1);
INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) VALUES (5, 'view_paspor_bulk', 'View Paspor Bulk', 'pengadaan paspor', 93, 2, 0, 'crud', 'view_paspor_bulk', 1, NULL, NULL, 0);

--sys_permission
INSERT INTO sys_permissions (category, permissionname, description, active) VALUES ('menu', 'pengadaan_paspor', NULL, 1);
INSERT INTO sys_permissions (category, permissionname, description, active) VALUES ('menu', 'view_paspor_bulk', NULL, 1);

--09 agustus 2016
CREATE TABLE app_kategori_wni
(
  id serial NOT NULL,
  nama character varying,
  CONSTRAINT app_kategori_wni_pkey PRIMARY KEY (id)
);
INSERT INTO app_kategori_wni (nama) VALUES ('Home Staf Perwakilan R');
INSERT INTO app_kategori_wni (nama) VALUES ('Lokal Staf');
INSERT INTO app_kategori_wni (nama) VALUES ('Pengusaha');
INSERT INTO app_kategori_wni (nama) VALUES ('Pegawai Perusahaan');
INSERT INTO app_kategori_wni (nama) VALUES ('Tenaga Kerja Laki-laki');
INSERT INTO app_kategori_wni (nama) VALUES ('Tenaga Kerja Wanita');
INSERT INTO app_kategori_wni (nama) VALUES ('Pelajar/Mahasiswa');
INSERT INTO app_kategori_wni (nama) VALUES ('Lain-lain');
INSERT INTO app_kategori_wni (nama) VALUES ('Keluarga Home Staf Perwakilan RI');
INSERT INTO app_kategori_wni (nama) VALUES ('Keluarga Lokal Staf dan Keluarga');
INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) VALUES (5, 'kategori_wni', 'Kategori WNI', 'description', 93, 2, 0, 'crud', 'kategori_wni', 1, '', '', 1);
INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) VALUES (5, 'pengadaan_splp', 'Pengadaan SPLP', NULL, 93, 2, 0, 'crud', 'pengadaan_splp', 1, NULL, NULL, 1);
INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) VALUES (NULL, 'view_splp_bulk', NULL, 'view splp bulk', 93, 2, 0, 'crud', 'view_splp_bulk', 1, '', '', 0);


INSERT INTO sys_permissions (category, permissionname, description, active) VALUES ('menu', 'kategori_wni', NULL, 1);
INSERT INTO sys_permissions (category, permissionname, description, active) VALUES ('menu', 'pengadaan_splp', NULL, 1);
INSERT INTO sys_permissions (category, permissionname, description, active) VALUES ('menu', 'view_splp_bulk', NULL, 1);
-- 11 agustus 2016
CREATE TABLE app_pengadaan_splp
(
  id bigserial NOT NULL,
  tanggal date,
  nomor_awal character varying,
  nomor_akhir character varying,
  CONSTRAINT app_pengadaan_splp_pkey PRIMARY KEY (id)
);

alter table app_nomor_splp add column pengadaansplpid bigint;

INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) VALUES (NULL, 'nomor_splp_bulk', NULL, 'nomor_splp_bulk bulk', 93, 2, 0, 'crud', 'nomor_splp_bulk', 1, '', '', 0);
INSERT INTO sys_permissions (category, permissionname, description, active) VALUES ('menu', 'nomor_splp_bulk', NULL, 1);


  
INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) VALUES (1, 'data_status', 'Status Sipil', 'Status Sipil', 71, 3, 0, 'chart/data_status', null, 1, '', '', 1);
INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) VALUES (2, 'data_kelamin', 'Jenis Kelamin', 'Jenis Kelamin', 71, 3, 0, 'chart/data_kelamin', null, 1, '', '', 1);
INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) VALUES (3, 'layanan_semua', 'Layanan', 'Layanan', 71, 3, 0, 'chart/layanan_semua', null, 1, '', '', 1);
INSERT INTO sys_permissions (category, permissionname, description, active) VALUES ('menu', 'data_status', NULL, 1);
INSERT INTO sys_permissions (category, permissionname, description, active) VALUES ('menu', 'data_kelamin', NULL, 1);
INSERT INTO sys_permissions (category, permissionname, description, active) VALUES ('menu', 'layanan_semua', NULL, 1);
INSERT INTO sys_rolepermissions (roleid, permissionid) VALUES ( 1, 73);
INSERT INTO sys_rolepermissions (roleid, permissionid) VALUES ( 1, 74);
INSERT INTO sys_rolepermissions (roleid, permissionid) VALUES ( 1, 75);
