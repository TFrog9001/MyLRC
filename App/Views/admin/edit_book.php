<?php require_once '../App/Views/menu/header.php'; ?>
<?php require_once '../App/Views/menu/admin_menu.php'; ?>


<!-- Main -->
<div class="row m-4">
    <h3 class="fs-4 mb-3 ms-3">Edit Book</h3>
    <div class="col-6">
        <div id="editBookMessage" class="alert" role="alert"></div>
        <form id="editBookForm">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= $book['Title'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" class="form-control text-capitalize" id="author" name="author"
                    value="<?= $book['Author'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" id="category" name="category" required>
                    <?php foreach ($categories as $category): ?>
                        <?php $isSelected = ($category['CategoryID'] == $book['CategoryID']) ? 'selected' : ''; ?>
                        <option value="<?= $category['CategoryID'] ?>" <?= $isSelected ?>>
                            <?= $category['CategoryName'] ?>
                        </option>
                    <?php endforeach ?>
                </select>

            </div>

            <div class="row">
                <div class="col mb-3">
                    <label for="available_quantity" class="form-label">Availabel</label>
                    <input type="number" class="form-control" id="available_quantity" name="available_quantity"
                        value="<?= $book['AvailableQuantity'] ?>" disabled>
                </div>
                <div class="col mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity"
                        value="<?= $book['Quantity'] ?>" disabled>
                </div>
                <div class="col mb-3 mx-2">
                    <label for="updatequantity" class="form-label">Update Quantity</label>
                    <input type="number" class="form-control" id="updatequantity" name="updatequantity" value="0"
                        required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update Book</button>
        </form>
    </div>
</div>
</div>
</div>
<?php require_once '../App/Views/menu/footer.php'; ?>

<script>
    $(document).ready(function () {
        $('#editBookForm').submit(function (e) {
            e.preventDefault(); // Ngăn chặn gửi mặc định
            clearErrors();

            let title = $('#title').val();
            let author = $('#author').val();
            let category = $('#category').val();
            let updatequantity = $('#updatequantity').val();

            let currentURL = window.location.href;

            // Perform the AJAX submission here
            $.ajax({
                type: 'POST',
                url: currentURL,
                data: {
                    title: title,
                    author: author,
                    category: category,
                    updatequantity: updatequantity,
                },
                success: function (response) {
                    if (response.status === 'success') {
                        window.location.href = currentURL;
                    } else {
                        $('#editBookMessage').addClass('alert-danger');
                        $('#editBookMessage').text(response.message);
                    }
                }
            });
        });
        function clearErrors() {
            $('#editBookMessage').hidden = true;
            $('#editBookMessage').text('');
        }
    });
</script>
</body>

</html>