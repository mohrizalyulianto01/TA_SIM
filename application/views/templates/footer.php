  <footer class="main-footer">
    <strong>Copyright &copy; <?= date("Y") ?> <a href="#">PT. Inamas Sistesis Teknologi</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url('assets') ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('assets') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/sweetalert2/sweetalert2.min.js"></script>

<script src="<?= base_url('assets') ?>/plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets') ?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets') ?>/dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>


<script>
  // Tambahkan event listener untuk meng-handle klik pada tombol delete
  const deleteButtons = document.querySelectorAll('.delete-btn');
  deleteButtons.forEach(button => {
    button.addEventListener('click', function(event) {
      event.preventDefault();

      // Ambil URL dari atribut data-url
      const url = button.getAttribute('data-url');

      // Tampilkan SweetAlert2 untuk konfirmasi
      Swal.fire({
        title: 'Konfirmasi',
        text: 'Apakah Anda yakin ingin menghapus data ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          // Jika dikonfirmasi, redirect ke halaman delete
          window.location.href = url;
        }
      });
    });
  });
</script>

<?php if ($this->session->flashdata('pesan')): ?>
  <script>
    Swal.fire({
      toast: true,
      position: 'top-end',
      icon: 'success',
      title: ' Data berhasil <?= $this->session->flashdata("pesan"); ?>',
      showConfirmButton: false,
      timer: 3000
    });
  </script>
<?php endif ?>

<script>
  function generatePDF() {
    var absensi = <?php echo json_encode($absensi); ?>;

    var docDefinition = {
      content: [
      {
        text: 'Detail Absensi Peserta Magang',
        style: 'header'
      },
      {
        table: {
          headerRows: 1,
          widths: ['*', '*', '*'],
          body: [
          ['Tanggal', 'Jam Masuk', 'Jam Keluar'],
          ...absensi.map(absensi => [
            formatDate(absensi.tgl_absen),
            absensi.jam_masuk,
            absensi.jam_keluar
            ]),
          ]
        }
      }
      ],
      styles: {
        header: {
          fontSize: 18,
          bold: true,
          margin: [0, 0, 0, 10]
        }
      }
    };

    pdfMake.createPdf(docDefinition).download('Absensi.pdf');
  }

  function formatDate(dateStr) {
    var date = new Date(dateStr);
    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();
    return (day < 10 ? '0' + day : day) + '-' + (month < 10 ? '0' + month : month) + '-' + year;
  }
</script>

<script>
  function harianPDF() {
    var absensi = <?php echo json_encode($absensi); ?>;

    var docDefinition = {
      content: [
      {
        text: 'Detail Absensi Peserta Magang',
        style: 'header'
      },
      {
        table: {
          headerRows: 1,
          widths: ['*', '*', '*'],
          body: [
          ['Tanggal', 'Jam Masuk', 'Jam Keluar'],
          ...absensi.map(absensi => [
            formatDate(absensi.tgl_absen),
            absensi.jam_masuk,
            absensi.jam_keluar
            ]),
          ]
        }
      }
      ],
      styles: {
        header: {
          fontSize: 18,
          bold: true,
          margin: [0, 0, 0, 10]
        }
      }
    };

    pdfMake.createPdf(docDefinition).download('Absensi.pdf');
  }

  function formatDate(dateStr) {
    var date = new Date(dateStr);
    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();
    return (day < 10 ? '0' + day : day) + '-' + (month < 10 ? '0' + month : month) + '-' + year;
  }
</script>



</body>
</html>