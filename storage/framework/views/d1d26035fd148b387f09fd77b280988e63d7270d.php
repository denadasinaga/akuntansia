
<?php $__env->startSection('judul','Jurnal Penyesuaian - Sistem Informasi Akuntansi'); ?>

<?php $__env->startSection('form-search'); ?>
    <?php echo $__env->make('layouts.navbars.form-search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('form-search-mobile'); ?>
    <?php echo $__env->make('layouts.navbars.form-search-mobile', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card shadow h-100">
                    <div class="card-header border-0">
                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-between text-center text-md-left">
                            <div class="mb-3">
                                <h2 class="mb-0">Jurnal Penyesuaian</h2>
                                <p class="mb-0 text-sm">Kelola Jurnal Penyesuaian</p>
                            </div>
                            <div class="mb-3">
                                <a href="#laporan" id="btn-laporan" data-toggle="tooltip" class="btn btn-primary" title="Laporan"><i class="fas fa-calendar"></i></a>
                                <button type="button" data-toggle="tooltip" title="Hapus data terpilih" class="btn btn-danger" id="delete" name="delete" >
                                    <i class="fas fa-trash"></i>
                                </button>
                                <a href="<?php echo e(route('jurnal-penyesuaian.create')); ?>?page=<?php echo e(request('page')); ?>" class="btn btn-success" title="Tambah" data-toggle="tooltip"><i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt--7">
    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="mb-3 table table-hover table-sm table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" width="20px">
                                <input type="checkbox" id="check_all">
                            </th>
                            <th class="text-center" width="20px">Opsi</th>
                            <th class="text-center"><a href="<?php echo e(request('tanggal') == 1 ? URL::current() . '?tanggal=0' : URL::current() . '?tanggal=1'); ?>">Tanggal <?php echo request('tanggal') == 1 ? '<i class="fas fa-caret-up"></i>' : '<i class="fas fa-caret-down"></i>'; ?></a></th>
                            <th class="text-center">Keterangan</th>
                            <th class="text-center">Akun</th>
                            <th class="text-center">Debit</th>
                            <th class="text-center">Kredit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $jurnal_penyesuaian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td style="vertical-align: middle">
                                    <input type="checkbox" class="jurnal-penyesuaian-checkbox" id="delete<?php echo e($item->id); ?>" name="delete[]" value="<?php echo e($item->id); ?>">
                                </td>
                                <td style="vertical-align: middle">
                                    <a href="<?php echo e(route('jurnal-penyesuaian.edit', $item)); ?>?page=<?php echo e(request('page')); ?>" class="btn btn-sm btn-success" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>
                                    <a class="btn btn-sm btn-danger hapus-data" data-nama="<?php echo e($item->keterangan); ?>" data-action="<?php echo e(route("jurnal-penyesuaian.destroy", $item)); ?>" data-toggle="tooltip" title="Hapus" href="#modal-hapus"><i class="fas fa-trash"></i></a>
                                    <?php if($item->bukti): ?><a href="<?php echo e(route('jurnal-penyesuaian.show', $item)); ?>" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Download Bukti"><i class="fas fa-download"></i></a><?php endif; ?>
                                </td>
                                <td style="vertical-align: middle; text-align: center"><?php echo e(tgl($item->tanggal)); ?></td>
                                <td style="vertical-align: middle"><?php echo e($item->keterangan); ?></td>
                                <td style="vertical-align: middle; text-align: center"><a href="<?php echo e(url('/buku-besar?kode_akun=' . $item->akun->kode . '&kriteria=periode&periode=1-bulan-terakhir')); ?>" data-toggle="tooltip" title="<?php echo e($item->akun->nama); ?>"><?php echo e($item->akun->kode); ?></a></td>
                                <td style="vertical-align: middle; text-align: right"><?php echo e($item->debit_atau_kredit == 1 ? 'Rp. ' . substr(number_format($item->nilai, 2, ',', '.'),0,-3) : '-'); ?></td>
                                <td style="vertical-align: middle; text-align: right"><?php echo e($item->debit_atau_kredit == 2 ? 'Rp. ' . substr(number_format($item->nilai, 2, ',', '.'),0,-3) : '-'); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="15" align="center">Data tidak tersedia</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <?php echo e($jurnal_penyesuaian->links('layouts.footers.pagination')); ?>

            </div>
        </div>
    </div>
    <?php echo $__env->make('layouts.footers.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<div class="modal fade" id="modal-hapus" tabindex="-1" role="dialog" aria-labelledby="modal-hapus" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger">

            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-delete">Hapus Jurnal Penyesuaian?</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="py-3 text-center">
                    <i class="ni ni-bell-55 ni-3x"></i>
                    <h4 class="heading mt-4">Perhatian!!</h4>
                    <p>Menghapus jurnal penyesuaian akan menghapus semua data yang dimilikinya</p>
                    <p><strong id="nama-hapus"></strong></p>
                </div>

            </div>

            <div class="modal-footer">
                <form id="form-hapus" action="" method="POST" >
                    <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                    <button type="submit" class="btn btn-white">Yakin</button>
                </form>
                <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Tidak</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="laporanModal" tabindex="-1" role="dialog" aria-labelledby="laporanModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-delete">Laporan</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body pt-0">
                <form class="d-inline" action="<?php echo e(route("jurnal-penyesuaian.laporan")); ?>" method="get">
                    <div class="form-group">
                        <label class="form-control-label" for="ditandatangani">Awal</label>
                        <input class="form-control" type="date" name="awal" required>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="diketahui">Akhir</label>
                        <input class="form-control" type="date" name="akhir" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>
                <button type="button" class="btn btn-white" data-dismiss="modal">Batal</button>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script>
    $(document).ready(function () {
        $('#btn-laporan').click(function (e) {
            e.preventDefault();
            $("#laporanModal").modal('show');
        });

        $(document).on('click', '#delete', function(){
            let id = [];
            if (confirm("Apakah anda yakin ingin menghapus data ini?")) {
                $(".jurnal-penyesuaian-checkbox:checked").each(function () {
                    id.push($(this).val());
                });
                if (id.length > 0) {
                    $.ajax({
                        url     : "<?php echo e(route('jurnal-penyesuaian.destroys')); ?>",
                        method  : 'delete',
                        data    : {
                            _token  : "<?php echo e(csrf_token()); ?>",
                            id      : id,
                        },
                        success : function(data){
                            alertSuccess(data.message);
                            location.reload();
                        }
                    });
                } else {
                    alertFail('Harap pilih salah satu jurnal penyesuaian');
                }
            }
        });

        $("#check_all").click(function(){
            if (this.checked) {
                $(".jurnal-penyesuaian-checkbox").prop('checked',true);
            } else {
                $(".jurnal-penyesuaian-checkbox").prop('checked',false);
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\X441N\Documents\denada_akun\akuntansi\resources\views/jurnal-penyesuaian/index.blade.php ENDPATH**/ ?>