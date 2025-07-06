# 📚 Sistem Informasi Penilaian Mata Kuliah

Sistem ini merupakan aplikasi berbasis web untuk manajemen data nilai mahasiswa, pengelolaan KRS (Kartu Rencana Studi), dan KHS (Kartu Hasil Studi) berbasis Laravel 11.

---

## 📌 Fitur Utama

### 🔑 Autentikasi
- Login menggunakan **NPM / NIP / NIDN** sesuai role:
  - **Mahasiswa**
  - **Dosen**
  - **TU/Admin**

### 🎓 Mahasiswa
- **KRS**: Mahasiswa memilih mata kuliah yang akan diambil.
- **KHS**: Melihat hasil nilai mata kuliah yang telah diambil beserta nilai huruf (A, AB, B, dst) dan IPK.

### 👨‍🏫 Dosen
- Melihat daftar mata kuliah yang diampu.
- Melihat daftar mahasiswa yang kontrak di mata kuliah tersebut.
- Memberikan / mengubah nilai mahasiswa.

### 🗄️ TU / Admin
- Manajemen data:
  - Mahasiswa
  - Dosen
  - Mata Kuliah

### 📊 Export Data
- Export nilai mahasiswa ke file **Excel**.

---

## 📚 Database Structure

- **mahasiswa**
- **dosen**
- **matakuliah**
- **kontrak_matakuliah** (relasi pivot mahasiswa-matakuliah)
- **nilai**

---

## 📈 Alur Sistem

1. **Login**
2. Cek **Role User**
   - Mahasiswa → KRS / KHS
   - Dosen → Input Nilai
   - Admin → Manajemen Data
3. Mahasiswa kontrak mata kuliah via **KRS**
4. Dosen input nilai untuk mahasiswa yang sudah kontrak
5. Mahasiswa melihat nilai di **KHS**
6. Admin dapat mengelola data dan melakukan export nilai

---

## 🛠️ Instalasi

```bash
git clone https://github.com/username/penilaian-mk.git
cd penilaian-mk
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
