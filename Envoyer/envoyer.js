var tr = document.getElementsByTagName("tr");

function getVal(tab, i, j){
    return (tab[i+1].childNodes[j].innerHTML);
}

var supprimer = document.getElementsByClassName("btnSup");
for(let i = 0; i < supprimer.length; i++){
    supprimer[i].onclick = function(){
        var idenvoi = getVal(tr, i, 0);
        var idcolis = getVal(tr, i, 2);

        if(confirm("Voulez-vous supprimer cet envoi portant le numéro : "+idenvoi+" ?")){
            window.location.href="supprimer.envoyer.php?idenvoi="+idenvoi+"&idcolis="+idcolis;
        }
    }
}

var modifier = document.getElementsByClassName("btnModif");
var close = document.getElementById("close");
var modal = document.getElementById("modal");

var idvoit = document.getElementById("idvoitToModify");
var nomEnvoyeur = document.getElementById("nomEnvoyeurToModify");
var emailEnvoyeur = document.getElementById("emailEnvoyeurToModify");
var nomRecepteur = document.getElementById("nomRecepteurToModify");
var contactRecepteur = document.getElementById("contactRecepteurToModify");

for(let i = 0; i < modifier.length; i++){
    modifier[i].onclick = function(){
        modal.style.display = "block";
        idenvoi = getVal(tr, i, 0);
        idvoit.value = getVal(tr, i, 1);
        nomEnvoyeur.value = getVal(tr, i, 3);
        emailEnvoyeur.value = getVal(tr, i, 4);
        nomRecepteur.value = getVal(tr, i, 5);
        contactRecepteur.value = getVal(tr, i, 6);
    }
}

var confirModif = document.getElementById("confirmerModif");
confirModif.onclick = function(){
    var newIdvoit = idvoit.value;
    var newNomEnvoyeur = nomEnvoyeur.value ;
    var newEmailEnvoyeur = emailEnvoyeur.value;
    var newNomRecepteur = nomRecepteur.value;
    var newContactRecepteur = contactRecepteur.value;

    window.location.href = "modifier.envoyer.php?idenvoi="+idenvoi+"&idvoit="+newIdvoit+"&nomEnvoyeur="+newNomEnvoyeur+"&emailEnvoyeur="+newEmailEnvoyeur+"&nomRecepteur="+newNomRecepteur+"&contactRecepteur="+newContactRecepteur;
}


close.onclick = function(){
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
}

