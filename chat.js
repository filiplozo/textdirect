function list_chats() { //funkcija koja ispisuje poruke i osvezava chat svake 2 sekunde
    var hr = new XMLHttpRequest();
    hr.onreadystatechange = function(){
        if (hr.readyState == 4 && hr.status == 200){ //kada je zahtev obradjen, odgovor spreman i status 200 (OK)
            document.getElementById("viewChats").innerHTML = hr.responseText; //odgovor smestamo u div pod nazivom viewChats
        }
    };
    hr.open("GET", "listChats.php?t=" + Math.random(), true); //saljemo zahtev
    hr.send();
    setTimeout(list_chats, 2000);
}
function post_chat(){ //funkcija koja salje poruku na chat
    var hr = new XMLHttpRequest();
    var url = "chatinsert.php";
    var ch = document.getElementById("chat").value; //uzima vrednost input text pod nazivom chat
    var kv = "chat="+ch;
    hr.open("POST", url, true); //saljemo zahtev
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function() {
        if(hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            console.log(return_data);
            console.log(kv);
            document.getElementById("status").innerHTML = return_data;
            document.getElementById("chatButton").onclick = view_count;
        }
    };
    hr.send(kv);
    document.getElementById("status").innerHTML = "Processing...";
    document.getElementById("chat").value = "";
}
function view_count(){ //funkcija koja broji broj trenutnih korisnika na chatu
    var hr = new XMLHttpRequest();
    hr.onreadystatechange = function(){
        if (hr.readyState == 4 && hr.status == 200){
            console.log(hr.responseText);
            document.getElementById("nu").innerHTML = hr.responseText;
        }
    };
    hr.open("GET", "numUsers.php?t=" + Math.random(), true); //saljemo zahtev
    hr.send();
    setTimeout(view_count, 2000);
}
window.onbeforeunload = function leaveChat(){ //funkcija koja nas automatski izloguje iz chata kada izlazimo iz istog
    var hr = new XMLHttpRequest();
    hr.onreadystatechange = function(){
        if (hr.readystate == 4 && hr.status == 200){
            document.getElementById("nu").innerHTML = "";
        }
    };
    hr.open("GET", "chatOut.php?id= <?php echo $id; ?> ", true); //saljemo zahtev
    hr.send();
    document.getElementById("status").innerHTML = "Logging out...";
    alert("You will now be logged out of the chat");
}

