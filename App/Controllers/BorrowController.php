<?php

namespace App\Controllers;
use App\Models\Borrow;

class BorrowController {

    public function borrows() {
        $borrows = (new Borrow())->getAllBorrow();
        require_once '../App/Views/admin/admin_borrow.php';
    }

}

?>