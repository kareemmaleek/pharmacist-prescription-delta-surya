# Medication Prescribing App

## Penjelasan:

### A. Role
- Dokter: hanya menampilkan/mengakses/mengoperasikan menu Dashboard, Patient & Examination.
- Apoteker: hanya menampilkan/mengakses/mengoperasikan menu Dashboard, Patient, Examination & Transaction.
- Administrator: dapat menampilkan/mengakses/mengoperasikan semua menu pada App.

---

## Dokumentasi Alur App:

### A. Access Page
- untuk melakukan login ke dalam APP user diwajibkan untuk mengisi credentials berupa Email & Password pada kolom inputan.

### B. Dashboard Page
- berisi ringkasan atau static dari total patient, examination, transaction, transaction income dan medicine sold.

### C. Patient Page
1. Menu All Patient
- menampilkan table semua patient yang terdaftar.

2. Menu New Patient
- menambahkan patient baru (New Patient).
- user dapat menambahkan patient baru dengan mengisi kolom full name & phone number.

### D. Examination Page
1. Menu All Examination
- menampilkan table semua examination yang sudah diinput oleh dokter.

2. Menu New Examination
- dokter dapat menambahkan examination baru dengan mengisi kolom patient, vital sign, doctor notes, attachment, medicine.

3. Menu Edit Examination
- dokter dapat melakukan edit dengan megakses/mengklik button dengan simbol edit warna biru.
- setelah itu dokter dapat melakukan perubahan data dengan mengisi kolom seperti patient, vital sign, doctor notes, attachment, medicine

4. Menu New Transaction
- apoteker dapat membuat transaksi baru dari examination yang sudah di buat oleh dokter dengan mengakses/mengklik button dengan simbol document warna hijau.
- setelah itu apoteker dapat melakukan pengisian data transaksi seperti payment method, payment amount

### E. Transaction Page
1. Menu All Transaction
- menampilkan table semua transaction yang sudah diinput oleh apoteker.
- apoteker dapat melihat invoice (simbol mata warna violet) dan mengunduh dengan format pdf (simbol document warna kuning).

### F. Users Page
1. Menu All User
- menampilkan table semua user.
- administrator dapat mengubah status user dengan cara klik statusnya.

2. Menu Edit User
- administrator dapat mengedit user dengan cara mengakses/mengklik button simbol edit warna biru.
- setelah itu dokter dapat melakukan perubahan data dengan mengisi kolom seperti full name, email, role, status, password

3. Menu New User
- administrator dapat menambahkan user baru dengan mengisi kolom full name, username, email, role, password

### G. Audit Logs Page
- administrator dapat monitoring aktivitas user pada menu ini.

