-- Tạo cơ sở dữ liệu
CREATE DATABASE mylrc;

-- Sử dụng cơ sở dữ liệu vừa tạo
USE mylrc;
-- Tạo bảng danh mục sách
CREATE TABLE Categories (
    CategoryID INT AUTO_INCREMENT PRIMARY KEY,
    CategoryName VARCHAR(255) NOT NULL
);

-- Tạo bảng sách
CREATE TABLE Books (
    BookID INT AUTO_INCREMENT PRIMARY KEY,
    Title VARCHAR(255) NOT NULL,
    Author VARCHAR(255) NOT NULL,
    CategoryID INT,
    Quantity INT NOT NULL,
    AvailableQuantity INT NOT NULL,
    FOREIGN KEY (CategoryID) REFERENCES Categories(CategoryID)
);



-- Tạo bảng người dùng
CREATE TABLE Users (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(50) NOT NULL,
    Password VARCHAR(255) NOT NULL,
    FullName VARCHAR(100) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Role ENUM('Admin', 'Member') NOT NULL
);

-- Tạo bảng mượn/trả sách
CREATE TABLE BorrowHistory (
    BorrowID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    BookID INT,
    BorrowDate DATE NOT NULL,
    ReturnDate DATE NOT NULL,
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (BookID) REFERENCES Books(BookID)
);

DELIMITER //
CREATE PROCEDURE AddUser(
    IN p_Username VARCHAR(50),
    IN p_Password VARCHAR(255),
    IN p_FullName VARCHAR(100),
    IN p_Email VARCHAR(100),
    IN p_Role ENUM('Admin', 'Member')
)
BEGIN
    INSERT INTO Users (Username, Password, FullName, Email, Role)
    VALUES (p_Username, p_Password, p_FullName, p_Email, p_Role);
END;
//
DELIMITER ;
CALL AddUser('admin123', 'admin123', 'Admin', 'admin@gmail.com', 'Admin');

DELIMITER //
CREATE TRIGGER UpdateAvailableQuantity
AFTER INSERT ON BorrowHistory
FOR EACH ROW
BEGIN
    DECLARE book_id INT;
    -- Lấy mã sách từ giao dịch mượn sách
    SET book_id = NEW.BookID;
    -- Cập nhật trường AvailableQuantity trong bảng Books
    UPDATE Books
    SET AvailableQuantity = AvailableQuantity - 1
    WHERE BookID = book_id;
END;
//
DELIMITER ;

DELIMITER //
CREATE FUNCTION AddBook(
    p_Title VARCHAR(255),
    p_Author VARCHAR(255),
    p_CategoryID INT,
    p_Quantity INT
) RETURNS INT
DETERMINISTIC -- Function chỉ phụ thuộc vào đầu vào 
BEGIN
    DECLARE new_book_id INT;
    INSERT INTO Books (Title, Author, CategoryID, Quantity, AvailableQuantity)
    VALUES (p_Title, p_Author, p_CategoryID, p_Quantity, p_Quantity);
    SET new_book_id = LAST_INSERT_ID();
    RETURN new_book_id;
END;
//
DELIMITER ;

DELIMITER //
CREATE PROCEDURE UpdateBook(
    IN p_BookID INT,
    IN p_Title VARCHAR(255),
    IN p_Author VARCHAR(255),
    IN p_Category INT,
    IN p_UpdateQuantity INT
)
BEGIN
    -- Cập nhật trường Title và Author
    UPDATE Books
    SET Title = p_Title, Author = p_Author, CategoryID = p_Category,
        Quantity = Quantity + p_UpdateQuantity,
        AvailableQuantity = AvailableQuantity + p_UpdateQuantity
    WHERE BookID = p_BookID;
    SELECT * FROM Books WHERE BookID = p_BookID;
END;
//
DELIMITER ;

DELIMITER //
CREATE PROCEDURE BorrowBook(
    IN p_UserID INT,
    IN p_BookID INT
)
BEGIN
    DECLARE v_AvailableQuantity INT;

    -- Lấy số lượng sách hiện có
    SELECT AvailableQuantity INTO v_AvailableQuantity FROM Books WHERE BookID = p_BookID;

    -- Kiểm tra số lượng sách có sẵn
    IF v_AvailableQuantity > 0 THEN
        -- Thêm dòng thông tin vào BorrowHistory với ngày mượn hiện tại và ngày trả dự kiến
        INSERT INTO BorrowHistory (UserID, BookID, BorrowDate, ReturnDate)
        VALUES (p_UserID, p_BookID, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 7 DAY));

        -- Cập nhật availableQuantity giảm đi 1
        UPDATE Books
        SET AvailableQuantity = AvailableQuantity - 1
        WHERE BookID = p_BookID;
    END IF;
END;
//
DELIMITER ;


-- Chỉnh sửa BorrowHistory để thêm các dòng với UserID là 3 và 5 và thời gian mượn 1 tuần
-- Sử dụng hàm DATE_ADD để tính ngày trả dựa trên ngày mượn
-- INSERT INTO BorrowHistory (UserID, BookID, BorrowDate, ReturnDate)
-- VALUES
--     (3, 1, '2023-11-09', DATE_ADD('2023-11-09', INTERVAL 7 DAY)),
--     (3, 2, '2023-11-10', DATE_ADD('2023-11-10', INTERVAL 7 DAY)),
--     (3, 21, '2023-11-11', DATE_ADD('2023-11-11', INTERVAL 7 DAY)),
--     (3, 22, '2023-11-12', DATE_ADD('2023-11-12', INTERVAL 7 DAY)),
--     (5, 1, '2023-11-13', DATE_ADD('2023-11-13', INTERVAL 7 DAY)),
--     (5, 2, '2023-11-14', DATE_ADD('2023-11-14', INTERVAL 7 DAY)),
--     (5, 21, '2023-11-15', DATE_ADD('2023-11-15', INTERVAL 7 DAY)),
--     (5, 22, '2023-11-16', DATE_ADD('2023-11-16', INTERVAL 7 DAY));

-- SELECT
--     U.UserID,
--     U.Username,
--     U.FullName,
--     U.Email,
--     B.BookID,
--     B.Title,
--     BH.BorrowID,
--     BH.BorrowDate,
--     BH.ReturnDate
-- FROM Users U
-- JOIN BorrowHistory BH ON U.UserID = BH.UserID
-- JOIN Books B ON BH.BookID = B.BookID;


