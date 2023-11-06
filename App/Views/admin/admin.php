<?php require_once '../App/Views/menu/header.php';?>
<?php require_once '../App/Views/menu/admin_menu.php';?>

            <!-- Main -->
            <div class="row m-4">
                <h3 class="fs-4 mb-3 ms-3">List Books</h3>
                <div class="col">
                    <table id="books_table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">BookID</th>
                                <th scope="col">Title</th>
                                <th scope="col">Author</th>
                                <th scope="col">Category</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">AvailableQuantity</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($books as $book): ?>
                                <tr>
                                    <td>
                                        <?= $book['BookID'] ?>
                                    </td>
                                    <td>
                                        <?= $book['Title'] ?>
                                    </td>
                                    <td>
                                        <?= $book['Author'] ?>
                                    </td>
                                    <td>
                                        <?= $book['CategoryName'] ?>
                                    </td>
                                    <td>
                                        <?= $book['Quantity'] ?>
                                    </td>
                                    <td>
                                        <?= $book['AvailableQuantity'] ?>
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        <a href="<?= '/books/edit/' . $book['BookID'] ?>"
                                            class="btn btn-xs btn-warning me-2">
                                            <i alt="Edit" class="fa fa-pencil"></i> Edit</a>
                                        <form class="form-inline ml-1" action="<?= '/books/delete/' . $book['BookID'] ?>"
                                            method="POST">
                                            <button type="submit" class="btn btn-xs btn-danger" name="delete-book">
                                                <i alt="Delete" class="fa fa-trash"></i> Delete
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
    <?php require_once '../App/Views/menu/footer.php';?>
</body>
</html>