<?php require_once '../App/Views/menu/header.php'; ?>
<?php require_once '../App/Views/menu/admin_menu.php'; ?>

<!-- Main -->
<div class="row m-4">
    <h3 class="fs-4 mb-3 ms-3">Add Book</h3>
    <div class="col-6">
        <div id="addBookMessage" class="alert" role="alert"></div>
        <form id="addBookForm">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="VD: Đắc Nhân Tâm" required>
            </div>

            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" class="form-control text-capitalize" id="author" name="author"
                    placeholder="VD: Vetera Axelsen" required>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" id="category" name="category" required>
                    <option>-- Chọn thể loại --</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['CategoryID'] ?>">
                            <?= $category['CategoryName'] ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
            </div>
            <button name="addBook" type="submit" class="btn btn-primary">Add Book</button>
        </form>
    </div>
</div>
</div>
</div>

<script>
    $(document).ready(function () {
        $('#addBookForm').submit(function (e) {
            e.preventDefault(); // Ngăn chặn gửi mặc định
            clearErrors();

            let title = $('#title').val();
            let author = $('#author').val();
            let category = $('#category').val();
            let quantity = $('#quantity').val();

            // Perform the AJAX submission here
            $.ajax({
                type: 'POST',
                url: '/books/add',
                data: {
                    title: title,
                    author: author,
                    category: category,
                    quantity: quantity
                },
                success: function (response) {
                    if (response.status === 'success') {
                        window.location.href = response.redirect;
                    } else {
                        $('#addBookMessage').addClass('alert-danger');
                        $('#addBookMessage').text(response.message);
                    }
                }
            });
        });
        function clearErrors() {
            $('#addBookMessage').hidden = true;
            $('#addBookMessage').text('');
        }
    });
</script>

<?php require_once '../App/Views/menu/footer.php'; ?>
</body>

</html>