<?php require_once '../App/Views/menu/header.php'; ?>
<?php require_once '../App/Views/menu/admin_menu.php'; ?>

<!-- Main -->
<div class="row m-1">
    <h3 class="fs-4 mb-3 ms-1">Borrow History</h3>
    <div class="col">
        <table id="borrows_table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">Borrow&#10;ID</th>
                    <th scope="col">User&#10;ID</th>
                    <th scope="col">User&#10;name</th>
                    <th scope="col">Fullname&#160;&#160;&#160;&#160;</th>
                    <th scope="col">Email</th>
                    <th scope="col">Book ID</th>
                    <th scope="col">Title&#160;&#160;&#160;&#160;&#160;&#160;</th>
                    <th scope="col">BorrowDate&#160;&#160;</th>
                    <th scope="col">ReturnDate&#160;&#160;</th>
                    <th scope="col">Action</th>
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
                        <td class="text-capitalize">
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
                        <td>
                            <form class="form-inline ml-1" action="<?= '/borrows/return/' . $borrow['BorrowID'] ?>" method="POST">
                                <button type="submit" class="btn btn-xs btn-primary" name="return-book">
                                    Return
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <!-- Table Ends Here -->
    </div>
</div>
<!-- End main -->
</div>
</div>
<?php require_once '../App/Views/menu/footer.php'; ?>
<script>
    $(document).ready(function () {
        $('#borrows_table').DataTable();
        

    });

</script>
</body>

</html>