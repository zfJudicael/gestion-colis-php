////////////////////////////////////////////////////////////
//////////////////Pour voiture uniquement///////////////////
////////////////////////////////////////////////////////////

function getValTab(tab, i, x){
    return (tab[i].childNodes[x].innerHTML);
}

var supprimerVoit = document.getElementsByClassName("supprimerVoit");
var tr1 = document.getElementsByClassName("trTab1");

for(let i=0; i<supprimerVoit.length; i++){
    supprimerVoit[i].onclick = function(){
        var ID = getValTab(tr1, i, 0);
        if(confirm("Voullez-vous vraiment supprimer la voiture : "+ID+"?")){
            window.location.href = "supprimer.voiture.php?ID="+ID;
        }
    }
}
    
var modalVoit = document.getElementById("modalForVoit");
var modifierVoit = document.getElementsByClassName("btnModifVoit");
var closeModalForVoit = document.getElementById("closeModalForVoit");
var idvoitToModify = document.getElementById("idvoitToModify");
var designToModify = document.getElementById("designToModify");

for(let i=0; i<modifierVoit.length; i++){
    modifierVoit[i].onclick = function() {
        idvoit = getValTab(tr1, i, 0);
        design = getValTab(tr1, i, 1);
        modalVoit.style.display = "block";
        idvoitToModify.value = idvoit;
        designToModify.value = design;
    }      
}
  
closeModalForVoit.onclick = function() {
  modalVoit.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modalVoit) {
    modalVoit.style.display = "none";
  }
}

var confirModif = document.getElementById("confirmerModifVoit");
confirModif.onclick = function(){
    var newIdvoit = idvoitToModify.value;
    var newDesign = designToModify.value;
    window.location.href = "modifier.voiture.php?oldIdvoit="+idvoit+"&newIdvoit="+newIdvoit+"&newDesign="+newDesign;    
}

//////////////////////////////////////////////////////////////
///////////////////////Pour desservir/////////////////////////
//////////////////////////////////////////////////////////////
var supprimerDes = document.getElementsByClassName("supprimerDes");
var tr2 = document.getElementsByClassName("trTab2");

for(let i=0; i<supprimerDes.length; i++){
    supprimerDes[i].onclick = function(){
        var ID = getValTab(tr2, i, 0);
        var idvoit = getValTab(tr2, i, 1);
        if(confirm("Voullez-vous retirer en activité la voiture : "+idvoit+"?")){
            window.location.href = "supprimer.desservir.php?ID="+ID;
        }
    }
}

var modalDes = document.getElementById("modalForDes");
var modifierDes = document.getElementsByClassName("btnModifDes");
var closeModalForDes = document.getElementById("closeModalForDes");
var codeitToModify = document.getElementById("codeitToModify");
var fraisToModify = document.getElementById("fraisToModify");

for(let i=0; i<modifierDes.length; i++){
    modifierDes[i].onclick = function() {
        IDdes = getValTab(tr2, i, 0);
        codeit = getValTab(tr2, i, 2);
        frais = getValTab(tr2, i, 3);
        modalDes.style.display = "block";
        codeitToModify.value = codeit;
        fraisToModify.value = frais;
    }      
}

closeModalForDes.onclick = function() {
  modalDes.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modalDes) {
    modalDes.style.display = "none";
  }
}

var confirModif = document.getElementById("confirmerModifDes");
confirModif.onclick = function(){
    var newCodeit = codeitToModify.value;
    var newFrais = fraisToModify.value;
    window.location.href = "modifier.desservir.php?oldCodeit="+IDdes+"&newCodeit="+newCodeit+"&newFrais="+newFrais;    
}