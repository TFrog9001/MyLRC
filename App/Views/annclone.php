<script>

    $(document).ready(function () {
        $("*#delete_cart").click(function (e) {
            e.preventDefault();
            const confirmed = confirm("Bạn có chắc chắn muốn xóa sản phẩm?");
            if (confirmed) {
                window.location.href = $(this).attr("href");
            }
        });
        $(".quantity").change(function () {
            console.log("Change event triggered");
            var id = $(this).attr("data-id"); //lay gia tri cua thuoc tinh data-id
            var qty = $(this).val();
            var data = { id: id, qty: qty };
            // console.log(data);
            $.ajax({
                url: "?mod=cart&act=update", //Tran xử lý, mặc định trang hiện tại
                method: "POST", // Post hoặc Get, mặt định get
                data: data, //Dữ liệu truyền lên server
                dataType: "json", //html,text,scritp hoặc json
                success: function (data) {
                    $("#sub-total-" + id).text(data.sub_total);
                    $("#total-money").text(data.total_money);
                    $("#total-order").text(data.total_order + " sản phẩm");
                    $("#total-order-bill").text(data.total_order + " SẢN PHẨM");
                    $("#total_oder_cart").text(data.total_order);
                    // console.log(data);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                },
            });
            // alert("Chó hào");
        });
        $(".btn-link").click(function () {
            var input = $(this).parent().find("input.quantity");
            input.change(); // Kích hoạt sự kiện change
        });
    });

</script>