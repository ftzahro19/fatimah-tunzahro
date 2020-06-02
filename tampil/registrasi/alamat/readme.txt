-= Entri, Edit, Delete, Tampil dengan PHP dan Ajax JQuery =-

Dibuat oleh	: Achmad Solichin
Situs 		: http://achmatim.net
Tanggal 	: 15 Januari 2013

Cukup banyak pengunjung situs Achmatim.Net yang bertanya seputar manipulasi ComboBox secara dinamis. Yang dimaksud dinamis di sini, selain data diambil dari database, juga terkait dengan isi dari Combobox yang menyesuaikan pada kondisi tertentu. Hal itulah yang melatarbelakangi saya menulis tutorial ini, walaupun jika mau sedikit berusaha, tutorial di Google terkait hal tersebut sudah cukup banyak.

Pada tutorial kali ini, kita akan mengambil studi kasus berupa data inputan Propinsi dan Kabupaten/Kota di Indonesia. Jika kita menggunakan jenis inputan combobox, tentunya kita akan menampilkan semua data Propinsi dan Kabupaten/Kota dalam dua combobox yang berbeda. Tentunya hal tersebut tidak efektif karena ada ratusan kabupaten yang ada di seluruh propinsi di Indonesia. Selain itu, rentan juga terhadap kesalahan input, misalnya pada inputan Propinsi diisi “DKI Jakarta”, tapi di inputan Kabupaten diisi dengan kabupaten “Banyumas” yang tidak terletak di propinsi DKI Jakarta.

Solusi yang akan disampaikan di tutorial ini adalah dengan membuat kedua combobox Propinsi dan Kabupaten saling terkait. Saat dipilih Propinsi tertentu, maka pada combobox Kabupaten akan otomatis berisi nama-nama kabupaten/kota sesuai dengan propinsi yang dipilih tersebut. tutorial ini akan menggunakan konsep Ajax dengan library JQuery. Misalnya jika dipilih propinsi DKI Jakarta, maka otomatis combobox kabupaten hanya berisi Jakarta Selatan, Jakarta Utara, Jakarta Barat, Jakarta Timur, Jakarta Pusat dan Kepulauan Seribu.

Dapatkan tutorial komputer lainnya dengan mengunjungi situs http://achmatim.net

Maju terus ilmu pengetahuan Indonesia!
