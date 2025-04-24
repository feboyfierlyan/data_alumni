// Fungsi untuk konfirmasi simpan data
function confirmSubmit(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Konfirmasi',
        text: 'Apakah Anda yakin ingin menyimpan data ini?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, Simpan',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            event.target.submit();
        }
    });
}

// Fungsi untuk konfirmasi hapus data
function confirmDelete(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Konfirmasi',
        text: 'Apakah Anda yakin ingin menghapus data ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            event.target.submit();
        }
    });
}

// Tambahkan event listener ke form
document.addEventListener('DOMContentLoaded', function() {
    const createForm = document.querySelector('form[action*="alumni.store"]');
    const deleteForms = document.querySelectorAll('form[action*="alumni.destroy"]');

    if (createForm) {
        createForm.addEventListener('submit', confirmSubmit);
    }

    deleteForms.forEach(form => {
        form.removeAttribute('onsubmit');
        form.addEventListener('submit', confirmDelete);
    });
});