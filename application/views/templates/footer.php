</div> <!-- Menutup tag <div class="main-container container mt-4"> yang dibuka di header.php -->
<!-- Tag ini digunakan untuk membungkus konten utama halaman dan memberikan margin atas -->

<footer class="bg-white text-center text-muted p-4 mt-5 border-top">
    <!-- Elemen footer dengan latar belakang putih (bg-white), teks abu-abu (text-muted),
         teks rata tengah (text-center), padding (p-4), margin atas (mt-5),
         dan garis batas atas (border-top) -->
    
    <div class="container">
        <!-- Container Bootstrap untuk memastikan isi footer tetap berada dalam layout grid -->
        
        <p class="mb-0">
            <!-- Paragraf tanpa margin bawah (mb-0) agar lebih rapat -->
            &copy; <?php echo date('Y'); ?> TokoKita. Dibuat dengan CodeIgniter 3.
            <!-- Menampilkan simbol © diikuti tahun saat ini (otomatis dari fungsi PHP date('Y'))
                 dan nama aplikasi beserta framework yang digunakan -->
        </p>
    </div>
</footer>

<!-- Menyisipkan JavaScript bundle dari Bootstrap 5.3.3 melalui CDN.
     Termasuk juga Popper.js untuk fungsi-fungsi seperti dropdown dan tooltip -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<!-- Menutup tag <body> dan <html> sebagai akhir dari halaman HTML -->