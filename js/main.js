var shoppingcard;
var product;
(function() {
  shoppingcard = {
    add: function(productID) {
      var result = shoppingcard.ajax("php/ctrl/shoppingcard.ctrl.php?shoppingcard=add&productID=" + productID + "&amount=1");
      shoppingcard.count();
    },
  count: function() {
    // This function gets all products from the shoppingcard counts the row - php
    // Displays it
    var result = shoppingcard.ajax("php/ctrl/shoppingcard.ctrl.php?shoppingcard=count");
    document.getElementById('shoppingcardCount').innerHTML = result;
    // $('shoppingcardCount').innerHTML = result.responseText;
  },
  remove: function(productID) {
    // Removes a item from the shoppingcard
    shoppingcard.ajax("php/ctrl/shoppingcard.ctrl.php?shoppingcard=delete&productID=" + productID + "");
    shoppingcard.display();
    shoppingcard.count();
  },
  update: function(productID, amount) {
    // Update the amount of one product in the shoppingcard
    shoppingcard.ajax("php/ctrl/shoppingcard.ctrl.php?shoppingcard=update&productID=" + productID + "&amount=" + amount + "");
    shoppingcard.display();
    shoppingcard.count();
  },
  display: function() {
    // Displays the shoppingcard after a update
    var result = shoppingcard.ajax("php/ctrl/shoppingcard.ctrl.php?shoppingcard=display");
    document.getElementById('content').innerHTML = result;
  },
  goTo: function() {
    window.location.replace('winkelmandje.php');
  },
  ajax: function(url) {
    // AJAX SYNC GET REQUEST
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", url, false);
    xhttp.send();

    return(xhttp.responseText);
  }
}
})();
(function() {
  title = {
    
  }
})();
