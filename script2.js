
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

