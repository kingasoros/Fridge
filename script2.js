
    // Array to store added ingredients
let ingredients = [];

// Function to display ingredients
function displayIngredients() {
    let ingredientsList = document.getElementById("ingredientsList");
    ingredientsList.innerHTML = "";
    ingredients.forEach((ingredient, index) => {
        let div = document.createElement("div");
        div.className = "ingredient";
        div.innerHTML = `
            <input type="checkbox" id="ingredient${index}" name="ingredient${index}" value="${ingredient.name}">
            <label for="ingredient${index}">${ingredient.name} - ${ingredient.quantity}</label>
        `;
        ingredientsList.appendChild(div);
    });
}


// Function to search ingredients
function searchIngredients() {
    let searchInput = document.getElementById("searchInput").value.toLowerCase();
    let searchResults = document.getElementById("searchResults");
    searchResults.innerHTML = "";
    let filteredIngredients = ingredients.filter(ingredient =>
        ingredient.name.toLowerCase().includes(searchInput)
    );
    filteredIngredients.forEach(ingredient => {
        let div = document.createElement("div");
        div.innerHTML = `${ingredient.name} - ${ingredient.quantity}`;
        searchResults.appendChild(div);
    });
}


function moveChecked(checkbox) {
    if (checkbox.checked) {
        let selectedIngredients = document.getElementById('selectedIngredients');
        let ingredientName = checkbox.value.split(' - ')[0];
        let ingredientParagraph = document.createElement('p');
        ingredientParagraph.textContent = ingredientName;
        selectedIngredients.appendChild(ingredientParagraph);
        checkbox.parentNode.style.display = 'none';

        // Ha van kiválasztott összetevő, akkor töröljük az üzenetet
        document.getElementById('noIngredientsMsg').style.display = 'none';
    } else {
        // Ha nincs kiválasztott összetevő, akkor jelenítjük meg az üzenetet
        document.getElementById('noIngredientsMsg').style.display = 'block';
        
        // Visszateszi az összetevőt az ingredientsList div-be és kiírja
        let ingredientsList = document.getElementById('ingredientsList');
        let ingredientId = checkbox.id;
        let ingredientDiv = document.getElementById(ingredientId + "_div");
        if (ingredientDiv) {
            ingredientsList.appendChild(ingredientDiv);
            
            // Töröljük a korábban kiválasztott összetevők kiírását
            ingredientsList.innerHTML = '';
            
            // Hozzáadjuk az összes összetevőt az ingredientsList div-hez
            ingredients.forEach(function(ingredient) {
                let div = document.createElement('div');
                div.className = 'ingredient';
                div.innerHTML = `
                    <input type="checkbox" id="${ingredient}" name="${ingredient}" value="${ingredient}" onclick="moveChecked(this)">
                    <label for="${ingredient}">${ingredient}</label>
                `;
                ingredientsList.appendChild(div);
            });
        }
    }
}



function clearAllIngredients() {
    // Töröljük az összes kiválasztott összetevőt
    let selectedIngredientsDiv = document.getElementById('selectedIngredients');
    selectedIngredientsDiv.innerHTML = '';

    // Töröljük az összes elemet az ingredientsList div-ből
    let ingredientsList = document.getElementById('ingredientsList');
    ingredientsList.innerHTML = '';

    // Visszaadjuk az összes elemet az ingredientsList div-be
    fetchIngredients();

    // Ha üres, akkor megjelenítjük az üzenetet
    let noIngredientsMsg = document.getElementById('noIngredientsMsg');
    if (noIngredientsMsg) {
        if (selectedIngredientsDiv.children.length > 0) {
            noIngredientsMsg.style.display = 'none';
        } else {
            // Ha üres, akkor megjelenítjük az üzenetet
            noIngredientsMsg.style.display = 'block';
        }
    }
}


function refreshIngredientsList() {
    fetch('get_ingredients.php')
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        let ingredientsList = document.getElementById('ingredientsList');
        ingredientsList.innerHTML = ''; // Töröljük az ingredientsList tartalmát

        // Hozzáadjuk az összes összetevőt az ingredientsList div-hez
        data.forEach(function(ingredient) {
            let div = document.createElement('div');
            div.className = 'ingredient';
            div.innerHTML = `
                <input type="checkbox" id="${ingredient}" name="${ingredient}" value="${ingredient}" onclick="moveChecked(this)">
                <label for="${ingredient}">${ingredient}</label>
            `;
            ingredientsList.appendChild(div);
        });
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
    });
}

// Frissíti az ingredientsListet a kapott összetevők alapján
function updateIngredientsList(ingredients) {
    let ingredientsList = document.getElementById('ingredientsList');
    ingredientsList.innerHTML = ''; // Töröljük az ingredientsList tartalmát
    ingredients.forEach(function(ingredient) {
        let div = document.createElement('div');
        div.className = 'ingredient';
        div.innerHTML = `
            <input type="checkbox" id="${ingredient.name}" name="${ingredient.name}" value="${ingredient.name}">
            <label for="${ingredient.name}">${ingredient.name} - ${ingredient.quantity}</label>
        `;
        ingredientsList.appendChild(div);
    });
}


// Frissíti az ingredientsList-et a get_ingredients.php fájlból kapott adatok alapján
function fetchIngredients() {
    fetch('get_ingredients.php')
        .then(response => response.json())
        .then(data => appendIngredients(data))
        .catch(error => console.error('Hiba történt a hozzávalók lekérésekor:', error));
}


// Oldal betöltésekor frissítsük az ingredientsListet
document.addEventListener('DOMContentLoaded', fetchIngredients);

// Újra hozzáadja az összetevőket az ingredientsList-hez
function appendIngredients(ingredients) {
    let ingredientsList = document.getElementById('ingredientsList');
    ingredients.forEach(function(ingredient) {
        let div = document.createElement('div');
        div.className = 'ingredient';
        div.innerHTML = `
            <input type="checkbox" id="${ingredient}" name="${ingredient}" value="${ingredient}" onclick="moveChecked(this)">
            <label for="${ingredient}">${ingredient}</label>
        `;
        ingredientsList.appendChild(div);
    });
}

function addEntry() {
    var entry = "<div class='input-group in_ingrediens'><div class='form-group ing_in'><label for='ingredientName' class='form-label'>Ingredient</label><input type='text' id='ingredientName' name='ingredients[]' placeholder='Enter ingredient here...' class='form-control' required='required'/></div><div class='form-group ms-2 ing_in'><label for='quantity' class='form-label'>Quantity</label><input type='text' id='quantity' name='quantities[]' placeholder='Enter quantity here...' class='form-control' required='required'/></div><button type='button' class='btn btn-danger btn-sm remove_btn' onclick='removeEntry(this);'>-</button></div>";
    var element = document.createElement("div");
    element.innerHTML = entry;
    document.getElementById('ingredients').appendChild(element);
  }

  function removeEntry(btn) {
    btn.parentNode.parentNode.removeChild(btn.parentNode);
  }

  function showResult(str) {
    if (str.length == 0) {
        document.getElementById("livesearch").innerHTML = "";
        document.getElementById("livesearch").style.border = "0px";
        return;
    }
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("livesearch").innerHTML = this.responseText;
            document.getElementById("livesearch").style.border = "1px solid #A5ACB2";
        }
    };
    var currentPage = document.getElementById("currentPage").value;
    xmlhttp.open("GET", "search.php?q=" + str + "&page=" + currentPage, true);
    xmlhttp.send();
}


function showResult2(str) {
    if (str.length == 0) {
        document.getElementById("livesearch2").innerHTML = "";
        document.getElementById("livesearch2").style.border = "0px";
        return;
    }
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("livesearch2").innerHTML = this.responseText;
            document.getElementById("livesearch2").style.border = "1px solid #A5ACB2";
        }
    }
    xmlhttp.open("GET", "search_ing.php?q=" + str, true);
    xmlhttp.send();
}


function addEntry() {
    var entry = "<div class='input-group in_ingrediens'><div class='form-group ing_in'><label for='ingredientName' class='form-label'>Ingredient</label><input type='text' id='ingredientName' name='ingredients[]' placeholder='Enter ingredient here...' class='form-control' required='required'/></div><div class='form-group ms-2 ing_in'><label for='quantity' class='form-label'>Quantity</label><input type='text' id='quantity' name='quantities[]' placeholder='Enter quantity here...' class='form-control' required='required'/></div><button type='button' class='btn btn-danger btn-sm remove_btn' onclick='removeEntry(this);'>-</button></div>";
    var element = document.createElement("div");
    element.innerHTML = entry;
    document.getElementById('ingredients').appendChild(element);
  }

  function removeEntry(btn) {
    btn.parentNode.parentNode.removeChild(btn.parentNode);
  }

function findRecipes() {
    var form = document.createElement('form');
    form.method = 'post';
    form.action = 'find_recipes.php';

    var ingredients = document.querySelectorAll('#ingredientsList input[type="checkbox"]:checked');
    ingredients.forEach(function(ingredient) {
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'ingredients[]';
        input.value = ingredient.value;
        form.appendChild(input);
    });

    document.body.appendChild(form);
    form.submit();
}


  




