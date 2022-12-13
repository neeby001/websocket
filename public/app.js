const status = document.getElementById('status');
const messages = document.getElementById('messages');
const form = document.getElementById('form');
const input = document.getElementById('input');
const you = document.getElementById('you').innerHTML;

const ws = new WebSocket('ws://localhost:3000');

const map = new Map();
map.set("Ð°","a");
map.set("Ð±","б");
map.set("Ð²","в");
map.set("Ð³","г");
map.set("Ð´","д");
map.set("Ðµ","е");
map.set("Ñ\x91","ё");
map.set("Ð¶","ж");
map.set("Ð·","з");
map.set("Ð¸","и");
map.set("Ð¹","й");
map.set("Ðº","к");
map.set("Ð»","л");
map.set("Ð¼","м");
map.set("Ð½","н");
map.set("Ð¾","о");
map.set("Ð¿","п");
map.set("Ñ\x80","р");
map.set("Ñ\x81","с");
map.set("Ñ\x82","т");
map.set("Ñ\x83","у");
map.set("Ñ\x84","ф");
map.set("Ñ\x85","x");
map.set("Ñ\x86","ц");
map.set("Ñ\x87","ч");
map.set("Ñ\x88","ш");
map.set("Ñ\x89","щ");
map.set("Ñ\x8A","ъ");
map.set("Ñ\x8B","ы");
map.set("Ñ\x8C","ь");
map.set("Ñ\x8D","э");
map.set("Ñ\x8E","ю");
map.set("Ñ\x8F","я");
map.set("Ð\x90","А");
map.set("Ð\x91","Б");
map.set("Ð\x92","В");
map.set("Ð\x93","Г");
map.set("Ð\x94","Д");
map.set("Ð\x95","Е");
map.set("Ð\x81","Ё");
map.set("Ð\x96","Ж");
map.set("Ð\x97","З");
map.set("Ð\x98","И");
map.set("Ð\x99","Й");
map.set("Ð\x9A","К");
map.set("Ð\x9B","Л");
map.set("Ð\x9C","М");
map.set("Ð\x9D","Н");
map.set("Ð\x9E","О");
map.set("Ð\x9F","П");
map.set("Ð ","Р");
map.set("Ð¡","С");
map.set("Ð¢","Т");
map.set("Ð£","У");
map.set("Ð¤","Ф");
map.set("Ð¥","Х");
map.set("Ð¦","Ц");
map.set("Ð§","Ч");
map.set("Ð¨","Ш");
map.set("Ð©","Щ");
map.set("Ðª","Ъ");
map.set("Ð«","Ы");
map.set("Ð¬","Ь");
map.set("Ð­","Э");
map.set("Ð®","Ю");
map.set("Ð¯","Я");

function setStatus(value) {
    status.innerHTML = value;
}

function printMessage(value) {
    const div = document.createElement('div');
    const p = document.createElement('p');
    const span = document.createElement('span');
    div.className = "cell__message-right";
    p.innerHTML = value;
    span.innerHTML = you;
    p.className = "message";
    messages.appendChild(div);
    div.appendChild(p);
    div.appendChild(span);
}
form.addEventListener('submit',event => {
 event.preventDefault();
 ws.send(input.value);
 //input.value = '';
});

//абвгдеёжзийклмнопрстуфхцчшщъыьэюя
//АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ
$("#form").submit(function(e) {
  e.preventDefault(); // avoid to execute the actual submit of the form.
  var form = $(this);
  var actionUrl = form.attr('action');
  console.log('act')

  $.ajax({
      type: "POST",
      url: actionUrl,
      data: form.serialize(), // serializes the form's elements.
      success: function(data){
        console.log(data); // show response from the php script.
      },
      error: function(xhr, ajaxOptions, thrownError){
        console.log(xhr.status);
        console.log(thrownError);

      }
  });

});
ws.onopen = () => setStatus('ONLINE');
ws.onclose = () => setStatus('DISCONNECTED');
ws.onmessage = response => {
  let x = JSON.parse(response.data).data;
  if(x!=undefined){
    let res = x.map((str) => String.fromCharCode(str));
    for(let x = 0;x < res.length; x++){
      y = res[x].charCodeAt(0);
      if (y > 127){
        res[x] = res[x]+res[x+1];
        res.splice(x+1,1);
        let z = map.get(res[x]);
        res[x] = z;
      }
    }
    let finish = res.join('');

    printMessage(finish);
    input.value = '';
    window.scrollTo(0,document.body.scrollHeight);
    //console.log(finish);
    //console.log(res);
    //console.log("Ñ\x8D".charCodeAt(0));
  }
}
//ws.onmessage = (message: object) => {
//  printMessage(JSON.parse(message['data']));
//};

//form.addEventListener('submit',event => {
//  event.preventDefault();

//});
