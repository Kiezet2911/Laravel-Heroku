function showDialog_HistoryPay(_id, date, money, tinhtrang) {
    let details = document
        .getElementById("DialogDetailsHistoryPay__Container");
    details.style.display = "block";
    if (tinhtrang == true) { TT = "true" } else { TT = "false" }
    $.ajax({
        url: "CTBill/" + _id + "/" + date + "/" + money + "/" + TT,
        type: "GET",
    }).done((res) => {
        $(".DialogDetailsHistoryPay").empty();
        $(".DialogDetailsHistoryPay").html(res);
    });
}

function closeDialog_HistoryPay() {
    let details = document
        .getElementById("DialogDetailsHistoryPay__Container");
    details.style.display = "none";
}