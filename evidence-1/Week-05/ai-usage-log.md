Tujuan	Saran AI	Keputusan	Hasil uji
Review struktur form	Pastikan label/id/name konsisten dan method akhir POST	Diterima	Form dapat disubmit dan output tampil aman
Uji GET vs POST	Pisahkan halaman demo GET agar form utama tetap POST	Diterima	Query string dapat diamati tanpa mengubah milestone akhir
Review mobile	Gunakan grid 2 kolom yang turun menjadi 1 kolom <= 680px	Diterima	Tidak ada overflow pada viewport mobile
Validasi input	Tambahkan atribut required, type="email", dan minlength pada field penting	Diterima	Browser menolak input kosong atau format salah sebelum submit
Keamanan output	Escape input pengguna (mis. htmlspecialchars) sebelum ditampilkan ke halaman	Diterima	Input berisi <script> tampil sebagai teks biasa, tidak dieksekusi
Aksesibilitas	Hubungkan setiap <label for> dengan id input dan tambahkan autocomplete	Diterima sebagian	Label berfungsi saat diklik; autocomplete dipakai hanya untuk nama dan email
Pesan error	Tampilkan pesan error di dekat field, bukan hanya alert()	Ditolak	Tetap memakai pesan teks sederhana karena di luar cakupan tugas pertemuan ini