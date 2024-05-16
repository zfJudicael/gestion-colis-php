function confRecept(){
    var id = document.getElementsByTagName("span")[0].textContent;
    window.location.href = "validation.recevoir.php?idcolis="+id;
}

function annulerRecept(){
    window.location.href = "formulaire.recevoir.php";
}

function getValTab(tab, i, x){
    return (tab[i+1].childNodes[x].innerText);
}

var modifier = document.getElementsByClassName("btnModif");
var modal = document.getElementById("modal");
var tr = document.getElementsByTagName("tr");
var idReceptToModify = document.getElementById("idRecept");
var idcolisToModify = document.getElementById("idcolisToModify");
var dateReceptToModify = document.getElementById("dateReceptToModify");

for(let i = 0; i < modifier.length; i++){
    modifier[i].onclick = function(){
        modal.style.display = "block";
        var idRecept = getValTab(tr, i, 0);
        var idcolis = getValTab(tr, i, 1);
        idReceptToModify.value = idRecept;
        idcolisToModify.value = idcolis;
    }
}

var close = document.getElementById("close");
close.onclick = function(){
    modal.style.display = "none";
}

window.onclick = function(event){
    if(event.target == modal){
        modal.style.display = "none";
    }
}

var confirmerModif = document.getElementById("confirmerModif");
confirmerModif.onclick = function(){
    var idRecept = idReceptToModify.value;
    var idcolis = idcolisToModify.value;
    window.location.href = "modifier.recevoir.php?idrecept="+idRecept+"&newIdcolis="+idcolis;
} 

var supprimer = document.getElementsByClassName("btnSup");
for(let i=0; i < supprimer.length; i++){
    supprimer[i].onclick = function(){
        var idRecept = getValTab(tr, i, 0);
        var idcolis = getValTab(tr, i, 1);

        if(confirm("Voulez-vous supprimer ce réception portant le numéro : "+idRecept+"?")){
            window.location.href = "supprimer.recevoir.php?idRecept="+idRecept+"&idcolis="+idcolis;
        }
    }
}