var supprimer = document.getElementsByClassName("supprimer");
var tr = document.getElementsByTagName("tr");

function getCodeIt(i){
   return (tr[i+1].childNodes[0].innerHTML);
}

for(let i=0; i<supprimer.length; i++){
    supprimer[i].onclick = function(){
        var ID = getCodeIt(i);
        if(confirm("Voullez-vous vraiment supprimer l'Itineraire : "+ID+"?")){
            window.location.href = "supprimer.itineraire.php?ID="+ID;
        }
    }
}
    
var modal = document.getElementById("modal");
var modifier = document.getElementsByClassName("btnModif");
var close = document.getElementById("close");
var codeitToModify = document.getElementById("codeitToModify");
var villedepToModify = document.getElementById("villedepToModify");
var villearrToModify = document.getElementById("villearrToModify");

function getVilleDep(i){
    return (tr[i+1].childNodes[1].innerHTML);
}

function getVilleArr(i){
    return (tr[i+1].childNodes[2].innerHTML);
} 

for(let i=0; i<modifier.length; i++){
    modifier[i].onclick = function() {
        codeit = getCodeIt(i);
        villedep = getVilleDep(i);
        villearr = getVilleArr(i);
        modal.style.display = "block";
        codeitToModify.value = codeit;
        villedepToModify.value = villedep;
        villearrToModify.value = villearr;
    }      
}

close.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

var confirModif = document.getElementById("confirmerModif");
confirModif.onclick = function(){
    var newCodeit = codeitToModify.value;
    var newVilledep = villedepToModify.value;
    var newVillearr = villearrToModify.value;
    // console.log(newCodeit,newVilledep, newVillearr);
    window.location.href = "modifier.itineraire.php?oldCodeit="+codeit+"&newCodeit="+newCodeit+"&newVilledep="+newVilledep+"&newVillearr="+newVillearr;    
}
