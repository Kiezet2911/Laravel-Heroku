


function lessProducts() {
    let inputNum = document.getElementById("inputNum");
    if (inputNum.value == 1) {
    inputNum.value = 1;
    } else {
    inputNum.value--;
    }
}

function  moreProducts() {
    let inputNum = document.getElementById("inputNum");
    inputNum.value++;
};

function  onCheckAll(){
    let checkAll =  document.getElementById("checkbox__all-product");
    let btnDeleteAll = document.getElementById("deleteAll");
    if(checkAll && checkAll.checked){
        btnDeleteAll.style.display = "flex";
    }else{
        btnDeleteAll.style.display = "none";
    }
}