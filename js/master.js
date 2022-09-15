 window.onload=function(){
  //тут пишем код, который будет ожидать загрузки DOM    
 }
 //здесь в обычном режиме
 
// ###########################################       функция добавления новой кнопки       ###################################################
function addInputTypeButton(name, value, id) {
    let Button = document.createElement("input");
    Button.setAttribute("type","button");
    Button.setAttribute("name",name);
    Button.setAttribute("value",value);
    Button.id=id;
    Button.classList.add("input");
    return Button;
}
