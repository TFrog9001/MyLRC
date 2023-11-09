<?php require_once '../App/Views/menu/header.php'; ?>
<?php require_once '../App/Views/menu/admin_menu.php'; ?>

<!-- Main -->
<div class="row m-4">
    <h3 class="fs-4 mb-3 ms-3">Borrow History</h3>
    <div class="col">
        <table id="borrows_table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">BorrowID</th>
                    <th scope="col">UserID</th>
                    <th scope="col">Username</th>
                    <th scope="col">Fullname</th>
                    <th scope="col">Email</th>
                    <th scope="col">BookID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Borrow Date</th>
                    <th scope="col">Return Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($borrows as $borrow): ?>
                    <tr>
                        <td>
                            <?= $borrow['BorrowID'] ?>
                        </td>
                        <td>
                            <?= $borrow['UserID'] ?>
                        </td>
                        <td>
                            <?= $borrow['Username'] ?>
                        </td>
                        <td>
                            <?= $borrow['FullName'] ?>
                        </td>
                        <td>
                            <?= $borrow['Email'] ?>
                        </td>
                        <td>
                            <?= $borrow['BookID'] ?>
                        </td>
                        <td>
                            <?= $borrow['Title'] ?>
                        </td>
                        <td>
                            <?= $borrow['BorrowDate'] ?>
                        </td>
                        <td>
                            <?= $borrow['ReturnDate'] ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <!-- Table Ends Here -->
    </div>
</div>
<!-- End main -->
<!-- Model -->
<div class="modal fade" id="delete-confirm" tabindex="-1" aria-labelledby="deleteBookModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteBookModal">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Do you want to delete this book
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="delete">Delete</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<?php require_once '../App/Views/menu/footer.php'; ?>
<script>
    $(document).ready(function () {
        $('#borrows_table').DataTable();
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
</body>

</html>