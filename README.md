# Sistem Penilaian Kinerja Dosen (SPKD)

Sistem Penilaian Kinerja Dosen atau SPKD adalah sistem yang dibuat untuk melakukan penilaian dosen dengan menghasilkan nilai (rating) tiap dosen dari kuesioner yang diisi oleh mahasiswa.


## Requirement
Sistem menggunakan Framework Codeigneter 4.3.1 dengan persyaratan minimum yang harus dipenuhi, yaitu :
* PHP 7.4+
* MySQL 5.1+


## Installation

1. Buat database dengan nama 'penilaian_dosen' dan import file [penilaian_dosen.sql](http://software.endy.muhardin.com/about)

2. Jalankan program dengan cara, buka terminal dan masuk ke direktori folder penilaian_dosen lalu ketikkan perintah berikut:

```bash
  php spark serve
```

3. Kemudian akan muncul Codeigneter sudah berhasil dijalankan dengan menampilkan CodeIgniter development server started on http://localhost:8080 seperti gambar berikut:
   ![terminal](https://github.com/dhillenbp179/penilaian_dosen/blob/main/public/assets/ss/1%20ss%20php%20spark%20serve.png "terminal vs code")
   
4. Pastikan telah menjalankan Apache dan MySQL pada XAMPP atau menjalankan 'Start' pada Laragon

5. Buka browser dan ketikkan http://localhost:8080 pada url browser dan akan tampil halaman login sistem tersebut.
   ![halaman login mahasiswa](https://github.com/dhillenbp179/penilaian_dosen/blob/main/public/assets/ss/2_menjalankan_pertama.png "halaman login mahasiswa")
6. Untuk menjalankan aplikasi perlu login sebagai berikut:
* mahasiswa => username = user dan password = user
* admin => username = admin dan password = admin
* dosen => username = dosen dan password = dosen
