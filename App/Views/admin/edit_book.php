<?php require_once '../App/Views/menu/header.php'; ?>
<?php require_once '../App/Views/menu/admin_menu.php'; ?>


<!-- Main -->
<div class="row m-4">
    <h3 class="fs-4 mb-3 ms-3">Edit Book</h3>
    <div class="col-6">
        <form>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?=$editBook['books']['Title']?>" required>
            </div>

            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" class="form-control text-capitalize" id="author" name="author" value="<?=$editBook['books']['Author']?>" required>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" id="category" name="category" required>
                    <?php foreach ($editBook['categories'] as $category):?>
                        <option value="<?=$category['CategoryID']?>">
                            <?=$category['CategoryName']?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="<?=$editBook['books']['Quantity']?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Book</button>
        </form>
    </div>
</div>
</div>
</div>
<?php require_once '../App/Views/menu/footer.php'; ?>
</body>
</html>