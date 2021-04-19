<script>
    const editDateModal = document.getElementById('editDateModal');
    editDateModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const form = editDateModal.querySelector('#editDateModalForm').action = button.getAttribute('data-bs-url');
        const description = button.getAttribute('data-bs-description');
        const status = button.getAttribute('data-bs-status');
        $('#description').val(description);
        $('#status').val(status);
        console.log(form, '(edit)', description);
    });
</script>
