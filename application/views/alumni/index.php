<?php $this->load->view('templates/head.php'); ?>
<?php $this->load->view('templates/nav.php'); ?>
<!-- Main content -->
<div class="main-content" id="panel">
  <?php $this->load->view('templates/topbar.php'); ?>
  <?php $this->load->view('templates/header.php'); ?>
  <div class="container-fluid mt--6">
    <div class="row">
      <div class="col-xl-12">
        <a href="<?= site_url('alumni/tambah'); ?>" class="btn btn-outline-white mb-3 btn-lg"><i class="fas fa-plus-square"></i> Tambah Alumni</a>
        <!-- <a href="<?= site_url('alumni/import_excel'); ?>" class="btn btn-success mb-3 btn-lg"><i class="far fa-file"></i> Import Excel</a> -->
        <?php if (!empty($this->session->flashdata('success') || $this->session->flashdata('error'))) : ?>
          <div class="alert alert-<?php if($this->session->flashdata('success')) { echo "success"; } else if($this->session->flashdata('error')) { echo "warning"; } ?> mb-2 alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              <span class="sr-only">Close</span>
            </button>
            <?= $this->session->flashdata('success'); ?>
            <?= $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table align-items-center table-flush" id="tableAlumni">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">NIS</th>
                    <th scope="col">Nama Siswa</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Angkatan</th>
                   <!--  <th scope="col">Surat Keterangan</th> -->
                    <th scope="col">Ijazah</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Opsi</th>
                    <th scope="col">Riwayat</th>

                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($alumni as $key => $alm) : ?>
                    <tr>
                      <td><?= $key + 1; ?></td>
                      <td><a href="<?= site_url('alumni/detail/' . $alm['nis']); ?>" class="btn btn-link" data-toggle="tooltip" title="Lihat Detail"><?= $alm['nis']; ?></a></td>
                      <td>
                        <a href="<?= site_url('alumni/detail/' . $alm['nis']); ?>" class="btn btn-link" data-toggle="tooltip" title="Lihat Detail"><?= $alm['nama_siswa']; ?></a>
                      </td>
                      <td><?= $alm['kelamin']; ?></td>
                      <td><?= $alm['angkatan']; ?></td>
                      <!-- <td>
                        <a href="<?= site_url('alumni/print_keterangan/' . $alm['nis']); ?>" target="_blank" class="btn btn-danger btn-sm" data-toggle="tooltip" data-original-title="Print"><i class="fas fa-print"></i> Cetak</a>
                      </td> -->
                      <td>
                        <?php if ($alm['ijazah'] == null) : ?>
                          <a href="<?= site_url('alumni/upload_ijazah/' . $alm['nis']); ?>" class="btn btn-info btn-sm" data-toggle="modal" data-target="#upload<?= $alm['nis']; ?>" title="Upload Ijazah"><i class="fas fa-upload"></i></a>
                        <?php else : ?>
                          <a href="<?= site_url('alumni/download_ijazah/' . $alm['nis']); ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-original-title="Download"><i class="fas fa-download"></i></a>
                        <?php endif; ?>
                      </td>
                      <td>
                        <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="<?= $alm['nama_siswa']; ?>">
                          <img alt="Image placeholder" src="<?= base_url('./assets/img/alumni/' . $alm['foto']) ?>">
                        </a>
                      </td>
                      <td>
                        <a href="#" class="btn btn-secondary btn-sm" data-toggle="modal" title="Hapus" data-target="#delete<?= $alm['nis']; ?>"><i class="fas fa-trash"></i></a>
                      </td>
                      <td>
                        <a href="#" class="btn btn-primary btn-sm" title="Riwayat"><i class="fas fa-book"></i></a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php $this->load->view('templates/footer.php'); ?>
  </div>
</div>

<?php $this->load->view('templates/js.php'); ?>

<?php foreach ($alumni as $alm) : ?>
  <div class="modal fade" id="delete<?= $alm['nis']; ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Anda yakin ingin menghapusnya?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h2>Data <?= $alm['nama_siswa']; ?></h2>
          <form action="<?= site_url('alumni/hapus') ?>" method="post">
            <input type="hidden" name="nis" value="<?= $alm['nis']; ?>">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal">Tidak</button>
          <button type="submit" class="btn btn-warning">Ya, Hapus!</button>
        </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>

<?php foreach ($alumni as $alm) : ?>
  <div class="modal fade" id="upload<?= $alm['nis']; ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Upload Ijazah <?= $alm['nama_siswa']; ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?= site_url('alumni/upload_ijazah') ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="ijazah">Ijazah</label>
              <div class="custom-file">
                <input type="hidden" name="nis" value="<?= $alm['nis']; ?>">
                <input type="file" class="custom-file-input" name="ijazah" id="customFileLang" lang="id">
                <label class="custom-file-label" for="customFileLang">Pilih file</label>
              </div>
              <span class="text-dark mt-2">Format file jpg|png|jpeg|pdf maksimal 1MB.</span>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> Upload</button>
        </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>