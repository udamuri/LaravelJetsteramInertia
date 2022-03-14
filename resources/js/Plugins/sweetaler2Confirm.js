import Swal from 'sweetalert2'
window.Swal = Swal;

const SweetConfirm = Swal.mixin({
    toast: false,
    showConfirmButton: false,
})

window.SweetConfirm = SweetConfirm