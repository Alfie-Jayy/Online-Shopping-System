$(document).ready(function() {

    $('.btn-plus').click(function() {
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find('#pizzaPrice').html().replace("Kyats", ""));
        // console.log($price);
        $qty = Number($parentNode.find('#qty').val());
        $total = $price * $qty;
        $parentNode.find('#total').html($total + " Kyats");

        summaryCalculation();

    })

    $('.btn-minus').click(function() {

        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find('#pizzaPrice').html().replace("Kyats", ""));
        $qty = Number($parentNode.find('#qty').val());
        $total = $price * $qty;
        $parentNode.find('#total').html($total + " Kyats");

        summaryCalculation();
    })


    function summaryCalculation() {

        $totalPrice = 0;

        $('#dataTable tr').each(function(index,row) {


            $totalPrice += Number($(row).find('#total').text().replace("Kyats", ""));
            console.log($totalPrice);

            $('#subTotalPrice').html(`${$totalPrice} Kyats`);
            $('#finalTotalPrice').html(`${$totalPrice + 3000 }Kyats`);

        })

    }

})
