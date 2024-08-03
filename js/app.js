


function toggleMenu() {
    var menuLinks = document.getElementById("menu-links");
    menuLinks.classList.toggle("show");
}

function toggleDropdownContent(dropdownId) {
    var dropdownContent = document.getElementById(dropdownId);
    dropdownContent.classList.toggle("show");
}

// Ajoutez le gestionnaire d'événement pour empêcher la propagation du clic
document.getElementById("menu-links").addEventListener("click", function(event) {
    event.stopPropagation();
});

document.getElementById('btn-produits1').addEventListener('click', function() {
    var icon = this.querySelector('.icon-close-1');
    icon.classList.toggle('rotate-icon-1');
});
document.getElementById('btn-produits2').addEventListener('click', function() {
    var icon = this.querySelector('.icon-close-2');
    icon.classList.toggle('rotate-icon-2');
});
document.getElementById('btn-produits3').addEventListener('click', function() {
    var icon = this.querySelector('.icon-close-3');
    icon.classList.toggle('rotate-icon-2');
});



function filterOptions() {
    var input, filter, select, options, i;
    input = document.getElementById("form_product_choice_id");
    filter = input.value.toUpperCase();
    select = document.getElementById("form_product_choice_id");
    options = select.getElementsByTagName("option");
    
    // Parcourir toutes les options du select et afficher seulement celles qui correspondent à la recherche
    for (i = 0; i < options.length; i++) {
      if (options[i].text.toUpperCase().indexOf(filter) > -1) {
        options[i].style.display = "";
      } else {
        options[i].style.display = "none";
      }
    }
  }
  