function getValTab(tab, i, x){
    return (tab[i+1].childNodes[x].innerText);
}

var tr = document.getElementsByTagName("tr");
var supprimer = document.getElementsByClassName("btnSup");
for(let i = 0; i<supprimer.length; i++){
    supprimer[i].onclick = function(){
        var idcolis = getValTab(tr, i, 0);
        if(confirm("Voulez-vous supprimer ce colis : "+idcolis+"?")){
            window.location.href = "supprimer.colis.php?idcolis="+idcolis;
        }
    }
}

var modifier = document.getElementsByClassName("btnModif");
var modal = document.getElementById("modal");
var idcolisToModify = document.getElementById("idcolisToModify");
var designcolisToModify = document.getElementById("designcolisToModify");
var poidsToModify = document.getElementById("poidsToModify");
for(let i = 0; i<modifier.length; i++){
    modifier[i].onclick = function(){
        var recu = getValTab(tr, i, 3);
        if (recu == 1){
            alert("Un colis déja réçu n'est plus modifiable");
        }else {
            modal.style.display = "block";
            var idcolis = getValTab(tr, i, 0);
            var designcolis = getValTab(tr, i, 1);
            var poids = getValTab(tr, i, 2);
            idcolisToModify.value = idcolis;
            designcolisToModify.value = designcolis;
            poidsToModify.value = poids;
        }
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

var confirmerModifier = document.getElementById("confirmerModif");
confirmerModifier.onclick = function(){
    var idcolis = idcolisToModify.value;
    var newDesigncolis = designcolisToModify.value;
    var newPoids = poidsToModify.value;
    
    window.location.href = "modifier.colis.php?idcolis="+idcolis+"&newDesign="+newDesigncolis+"&newPoids="+newPoids;
}

var select = document.getElementsByTagName("select")[0];
var design = document.getElementsByClassName("design");
var idenvoi = document.getElementsByClassName("idenvoi");
var dateEnvoi = document.getElementsByClassName("dateEnvoi");
select.onchange = function(){
    if(this.value == "design"){
            design[0].style.display = "inline";
            idenvoi[0].style.display = "none";
            idenvoi[0].value = "";

        for(let i = 0; i < dateEnvoi.length; i++){
            dateEnvoi[i].style.display = "none";
            dateEnvoi['date1'].value = "";
            dateEnvoi['date2'].value = "";
        }
    }else if(this.value == "idenvoi"){
            design[0].style.display = "none";
            design[0].value = "";
            idenvoi[0].style.display = "inline";

        for(let i = 0; i < dateEnvoi.length; i++){
            dateEnvoi[i].style.display = "none";
            dateEnvoi['date1'].value = "";
            dateEnvoi['date2'].value = "";
        }
    }else {
            design[0].style.display = "none";
            idenvoi[0].style.display = "none";
            idenvoi[0].value = "";
            design[0].value = "";
        
        for(let i = 0; i < dateEnvoi.length; i++){
            dateEnvoi[i].style.display = "inline";
        }
    }
}