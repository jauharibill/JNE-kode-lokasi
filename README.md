# JNE Kode Lokasi

## Purposes

repository ini berisi project untuk import data lokasi dan kode lokasi dari ekspedisi JNE, project ini di buat karna JNE tidak menyediakan API untuk request kode lokasi yang di support oleh mereka. contoh kode lokasi seperti berikut :

```
CGK10000 = Jakarta
BD010000 = Bandung
BOO10000 = Bogor
```

JNE provide table Excel yang harus kita olah terlebih dahulu, file xls ada di folder public. table itu harus kita import ke table `SQL`, maka dari itu project ini dibuat. file `SQL` tidak di sertakan di repository ini, silahkan jalankan sendiri. sembari baca2 kodingan okay :)

## Prof of Concept

Excel di import ke `SQL` ke menggunakan library `maatwebsite/excel`. langkah2 import nya bertahap, dari import provinsi, sampe yang terakhir import kelurahan, kode programnya ada di folder `app\imports`.
