
let image=document.getElementById('image');
let images=['../img/m1.jpg','../img/m2.jpg','../img/m3.jpg'];
setInterval(function(){
    let random=Math.floor(Math.random()*3);
    image.src=images[random];
},800);

let room=document.getElementById('room');
let rooms=['../img/ar1.jpg','../img/ar2.jpg','../img/ar3.jpg'];
setInterval(function(){
    let random=Math.floor(Math.random()*3);
    room.src=rooms[random];
},800);
