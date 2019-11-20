"use strict";

var init_size = 12;
var count=0;
function fontSize(){
    var size_timer = setInterval(fontSize,500);
    count++;
    var size = init_size+count*2;
    document.getElementById("area").style.fontSize=size.toString()+"pt";
}

function fontWeight(){
    var bling= document.getElementById("bling");
    if(bling.checked==true){
        document.getElementById("area").style.fontWeight="bold";  
        document.getElementById("area").style.color="green";
        document.getElementById("area").style.textDecoration="underline";
        document.body.style.backgroundImage = "url('https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/8/hundred.jpg')"
    }
    else{
        document.getElementById("area").style.fontWeight="normal";
        document.getElementById("area").style.color="black";
        document.getElementById("area").style.textDecoration="none";
        document.body.style.backgroundImage = "none";
    }
}

function fontUpper(){
    var text=document.getElementById("area").value.toUpperCase();
    var textadd = text.split(".");
    text = textadd.join("-izzle.");
    document.getElementById("area").value = text;

}

function igpay(){
    var text = document.getElementById("area").value;
    var vowel = ["a","e","i","o","u"];
    var text_con="";
    for(var i=0;i<text.length;i++){
        if(vowel.includes(text[i])){
            break;
        }
        text_con+=text[i];
    }
    var str = text.split(text_con);
    text = str[1]+text_con+"ay";
    document.getElementById("area").value = text;
}

function changetext(){
    var text = document.getElementById("area").value;
    var words = text.split(" ");
    for(var i=0;i<words.length;i++){
        if(words[i].length>=5){
            words[i] = "Malkovich";
        }
    }
    text = words.join(" ");
    document.getElementById("area").value = text;
}