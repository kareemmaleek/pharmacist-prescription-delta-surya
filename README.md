# Medication Prescribing App

## Penjelasan:

### A. Role
- Dokter: hanya menampilkan/mengakses/mengoperasikan menu Dashboard, Patient & Examination.
- Apoteker: hanya menampilkan/mengakses/mengoperasikan menu Dashboard, Patient, Examination & Transaction.
- Administrator: dapat menampilkan/mengakses/mengoperasikan semua menu pada App.

### B. Credentials (demo)
| Role | Data |
| ------ | ------ |
| Administrator | musafeerbinmalik@gmail.com : 123456789 |
| Apoteker | radensuyoso@gmail.com : 123456789 |
| Dokter | abdulmaqruf@gmail.com : 123456789 |

---

## Installation

### 1. System Requirement
- PHP ≥ 8.3
- Composer ≥ 2.6
- MySQL
- Node.js ≥ 18
- Git

### 2. Clone Repository

```sh
git clone https://github.com/kareemmaleek/pharmacist-prescription-delta-surya.git
cd pharmacist-prescription-delta-surya
```

### 3. Install Backend Dependencies

```sh
composer install
```

### 4. Environment Configuration

Copy `.env` dari lokal

Lalu

```sh 
php artisan key:generate
```

### 5. Database Setup

Buat database kosong dengan nama `pharmacist_prescription`

Lalu jalankan migrasi dengan seeder untuk data dummy

```sh
php artisan migrate --seed
```

### 6. Storage & Filesystem

Buat symbolic link storage:
```sh
php artisan storage:link
```

### 7. Menjalankan Aplikasi (mode dev)
```sh
composer run dev
```

---

## Dokumentasi Alur App:

### A. Access Page
![AccessPage](https://drive.google.com/uc?export=view&id=1XN64y3RbvMUZvAL2t0EQwyXyOaUA9JJQ)
- untuk melakukan login ke dalam APP user diwajibkan untuk mengisi credentials berupa Email & Password pada kolom inputan.

### B. Dashboard Page
![Dashboard](https://drive.google.com/uc?export=view&id=1CyKGLq3WS0q_zL-X8fuKyAlAl8NVLeK2)
- berisi ringkasan atau static dari total patient, examination, transaction, transaction income dan medicine sold.

### C. Patient Page
![AllPatient](https://drive.google.com/uc?export=view&id=1BYuvghgGhnaj5a_67nEe3gbSsqv8yqkf)
1. Menu All Patient
- menampilkan table semua patient yang terdaftar.

![NewPatient](https://drive.google.com/uc?export=view&id=1Dg3oyuuXpS63lIlqxopCPYlrQ-GlToCH)
2. Menu New Patient
- menambahkan patient baru (New Patient).
- user dapat menambahkan patient baru dengan mengisi kolom full name & phone number.

### D. Examination Page
![AllExam](https://drive.google.com/uc?export=view&id=1V6eueTWTMbD7S52e5LkFegSJVcqkfteV)
1. Menu All Examination
- menampilkan table semua examination yang sudah diinput oleh dokter.

![NewExam](https://drive.google.com/uc?export=view&id=1_uvuYXIems47jBP9OiYO6oKZ2b8wYp8W)
2. Menu New Examination
- dokter dapat menambahkan examination baru dengan mengisi kolom patient, vital sign, doctor notes, attachment, medicine.

![EditExam](https://drive.google.com/uc?export=view&id=1bkKtQL1Dg3T28kLEr66lXWriIOyTEmD1)
3. Menu Edit Examination
- dokter dapat melakukan edit dengan megakses/mengklik button dengan simbol edit warna biru.
- setelah itu dokter dapat melakukan perubahan data dengan mengisi kolom seperti patient, vital sign, doctor notes, attachment, medicine

![NewTX](https://drive.google.com/uc?export=view&id=1iVNQlJqtXKeE_IqEjl6aV9ASg0rJep_C)
4. Menu New Transaction
- apoteker dapat membuat transaksi baru dari examination yang sudah di buat oleh dokter dengan mengakses/mengklik button dengan simbol document warna hijau.
- setelah itu apoteker dapat melakukan pengisian data transaksi seperti payment method, payment amount

### E. Transaction Page
![AllTX](https://drive.google.com/uc?export=view&id=1lBgoScR4l-sJxHFQsmX5m39tK0YL8CzU)
1. Menu All Transaction
- menampilkan table semua transaction yang sudah diinput oleh apoteker.
- apoteker dapat melihat invoice (simbol mata warna violet) dan mengunduh dengan format pdf (simbol document warna kuning).

### F. Users Page
![AllUser](https://drive.google.com/uc?export=view&id=1pDPgknIpVe5nyMQBUUmWjmswIuuiF-Ug)
1. Menu All User
- menampilkan table semua user.
- administrator dapat mengubah status user dengan cara klik statusnya.

![EditUser](https://drive.google.com/uc?export=view&id=1qP5TjRml826kblxjaN3zggheKDt3IPU8)
2. Menu Edit User
- administrator dapat mengedit user dengan cara mengakses/mengklik button simbol edit warna biru.
- setelah itu dokter dapat melakukan perubahan data dengan mengisi kolom seperti full name, email, role, status, password

![NewUser](https://drive.google.com/uc?export=view&id=1vFkvBC7CiAlEawdJ2IfI-ur_8ZMng_xP)
3. Menu New User
- administrator dapat menambahkan user baru dengan mengisi kolom full name, username, email, role, password

### G. Audit Logs Page
![AuditLogs](https://drive.google.com/uc?export=view&id=1xqCkDEfYVsm7e0JYUUjA0z9Osq4uMo6V)
- administrator dapat monitoring aktivitas user pada menu ini.
