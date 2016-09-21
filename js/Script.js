function process(plusMinusOne, productName, productPrice) {

    // Il .value prende il valore contenuto nella textfield con id specificato
    var value = parseInt(document.getElementById(productName).value);
    value = value + plusMinusOne; // Incremento o decremento

    if(value >= 0) {
        var newTotal = parseFloat(document.getElementById('totCheck').value) + plusMinusOne * productPrice; // Arrotondo a due decimali
        document.getElementById('totCheck').value = Math.round(newTotal * 100) / 100; // Aggiorno il costo totale

        document.getElementById(productName).value = value; // Imposto il costo per quel tipo di prodotto
    }

    checkAmount();

}

function checkAmount() {
    // Se il totale è maggiore di 0 tasto abilitato, altrimenti no
    if(document.getElementById('totCheck').value > 0) {
        document.getElementById('checkAll').disabled = false;
    }
    else {
        document.getElementById('checkAll').disabled = true;
    }
}

function checkValuesType(customerName, customerTable) {
    // Con questa funzione evito continui richiami alla pagina index in caso di form non validi
    if(isNaN(customerName) && customerName != "" && !isNaN(customerTable) && customerTable != "") {
        return true;
    }
    else {
        if(isNaN(customerName) == false || customerName == "") {
            document.getElementById('errorName').innerHTML = "Errore campo nome.";
        }
        else {
            document.getElementById('errorName').innerHTML = "";
        }

        if(isNaN(customerTable) == true || customerTable == "") {
            document.getElementById('errorTable').innerHTML = "Errore campo tavolo.";
        }
        else {
            document.getElementById('errorTable').innerHTML = "";
        }

        return false;
    }

}

function payment($id) {
    // function below will run clear.php?h=michael
    $.ajax({
        type: "GET",
        url: "payment.php" ,
        data: { id: $id },
        success : function() {
            location.reload();
        }
    });
}

function deleteOrder($id) {
    // function below will run clear.php?h=michael
    $.ajax({
        type: "GET",
        url: "delete_order.php" ,
        data: { id: $id },
        success : function() {
            location.reload();
        }
    });
}

function isChecked() {
    if(document.getElementById("takeawayF").checked) { // Checcato NO asporto
        document.getElementById('tableNum').disabled = false;
    }
    if(document.getElementById("takeawayT").checked) { // Checcato SI asporto
        document.getElementById('tableNum').innerHTML = ""; // DA RIVEDERE
        document.getElementById('tableNum').disabled = true;
    }
}














