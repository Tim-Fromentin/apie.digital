window.addEventListener('DOMContentLoaded', function() {
    var navbar = document.getElementById('navbar');
    var footer = document.getElementById('footer');
    var btnReturn = document.getElementById('btn-return'); // Ajoutez cette ligne pour sélectionner l'élément du bouton de retour
  
    var xhr = new XMLHttpRequest();
    
    xhr.open('GET', './include/navbar.html', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            navbar.innerHTML = xhr.responseText;
        }
    };
    xhr.send();
  
    // Code pour charger le contenu du footer
    var xhrFooter = new XMLHttpRequest();
    
    xhrFooter.open('GET', './include/footer.html', true);
    xhrFooter.onreadystatechange = function() {
        if (xhrFooter.readyState === 4 && xhrFooter.status === 200) {
            footer.innerHTML = xhrFooter.responseText;
        }
    };
    xhrFooter.send();

    var xhrbtnReturn = new XMLHttpRequest();
    
    xhrbtnReturn.open('GET', '../cyber-pro-0.4.5/include/btn-return.html', true);
    xhrbtnReturn.onreadystatechange = function() {
        if (xhrbtnReturn.readyState === 4 && xhrbtnReturn.status === 200) {
            btnReturn.innerHTML = xhrbtnReturn.responseText;
        }
    };
    xhrbtnReturn.send();
  });
  