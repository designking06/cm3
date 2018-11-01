function connectForHead(){
  var xhr = new XMLHttpRequest();

  var file = "https://www.w3schools.com";
  var randomNum = Math.round(Math.random() * 10000);

  xhr.open('HEAD', file + "?rand=" + randomNum, false);
  xhr.send();

  xhr.addEventlistener("readystatechange", processRequest, false);

  function processRequest(e){
    if (xhr.readyState == 4){
      if (xhr.status >=200 && xhr.status < 304){
        alert("connection exists");
      }else{
        alert("nope");
      }
    }
  }
}
