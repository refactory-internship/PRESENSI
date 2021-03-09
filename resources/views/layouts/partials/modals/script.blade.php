<script>
    const deleteModal = document.getElementById('staticBackdrop');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const form = deleteModal.querySelector('#permanentDelete').action = button.getAttribute('data-bs-url');
        console.log(form, '(delete)');
    });
</script>
