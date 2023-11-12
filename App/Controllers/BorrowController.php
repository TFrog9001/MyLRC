<?php

namespace App\Controllers;
use App\Models\Borrow;

class BorrowController {

    public function borrows() {
        $borrows = (new Borrow())->getAllBorrow();
        require_once '../App/Views/admin/admin_borrow.php';
    }

    public function returnBook($id) {
        $return = (new Borrow())->return($id);
        if ($return) {
            header('Location: /borrows');
        } 
    }

    public function borrowBook($id_book) {
        $id_user = $_SESSION['user_id'];
        $borrow = (new Borrow())->borrow($id_user, $id_book);
        if($borrow) {
            header('Location: /books');
        }
    }

    public function myHistory() {
        $id_user = $_SESSION['user_id'];
        $borrows = (new Borrow())->getBorrowByUser($id_user);
        require_once '../App/Views/user/history.php';
    }
}

?>