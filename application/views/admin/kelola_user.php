<h2 class="mb-4">Kelola Pengguna</h2>

<!-- Notifikasi -->
<?php if ($this->session->flashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $this->session->flashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<?php if ($this->session->flashdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo $this->session->flashdata('error'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- [BARU] Tombol untuk menambah user -->
<div class="mb-3">
    <a href="<?php echo site_url('admin/tambah_user'); ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah User Baru
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Peran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)) : ?>
                        <?php foreach ($users as $user) : ?>
                            <tr>
                                <td><?php echo $user->id_user; ?></td>
                                <td><?php echo htmlspecialchars($user->nama_user); ?></td>
                                <td><?php echo htmlspecialchars($user->email); ?></td>
                                <td>
                                    <?php if ($user->role == 'admin') : ?>
                                        <span class="badge bg-danger">Admin</span>
                                    <?php elseif ($user->role == 'penjual') : ?>
                                        <span class="badge bg-success">Penjual</span>
                                    <?php else : ?>
                                        <span class="badge bg-primary">Pembeli</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?php echo site_url('admin/edit_user/' . $user->id_user); ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i> Edit</a>
                                    <a href="<?php echo site_url('admin/hapus_user/' . $user->id_user); ?>" onclick="return confirm('PERINGATAN: Menghapus pengguna juga akan menghapus semua data terkait. Yakin ingin melanjutkan?')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data pengguna.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>