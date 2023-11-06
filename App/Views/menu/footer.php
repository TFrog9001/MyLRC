    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs4/dt-1.13.6/datatables.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#books_table').DataTable();
            $('button[name="delete-book"]').on('click', function (e) {
                e.preventDefault();
                const form = $(this).closest('form');
                const nameTd = $(this).closest('tr').find('td').eq(1);
                if (nameTd.length > 0) {
                    $('.modal-body').html(`Do you want to delete "<a class="fw-bold text-dark">${nameTd.text()}</a>" ?`);
                }
                $('#delete-confirm').modal('show');

                $('#delete').one('click', function () {
                    form.trigger('submit');
                    $('#delete-confirm').modal('hide');
                });
            });
        });
    </script>


    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>