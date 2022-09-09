 window.onload=function(){
  //тут пишем код, который будет ожидать загрузки DOM    
 }
 //здесь в обычном режиме
 
//функция для вывода на экран товара для страниц:
//crockery.php, collection.php, interior.php, sale.php
//  function getProduct(event, catId) {
//     let attribute = event.getAttribute("data-id");
//     fetch("/system/getProduct.php", {
//             method: 'post',
//             headers: {
//                 "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
//             },
//             body: `productId=${attribute}&catId=${catId}`,
//             })
//         .then(response =>response.text())
//         .then(data => console.log(data))
// }