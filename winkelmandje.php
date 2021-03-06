<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <title>Multiversum - VR-brillen</title>

  <link rel="stylesheet" href="style/grid.css" type="text/css">
  <link rel="stylesheet" href="style/style.css" type="text/css">

  <link href="https://fonts.googleapis.com/css?family=Quicksand:300" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <script src="js/main.js"></script>

  </head>
  <body onload="shoppingcard.count();">
    <div class="wrapper">
      <div class="row">
        <?php require("assets/header.php"); ?>

          <content id="content">
          <?php

            require_once 'php/classes/shoppingcard.class.php';
            require_once 'php/classes/product.class.php';
            require_once 'php/classes/view.class.php';

            $view = new View();
            $shoppingcard = new Shoppingcard();
            $product = new product();

            $shoppingcardArray = $shoppingcard->get();
            // Gets the shoppingcard array
            if (!empty($shoppingcardArray)) {
              foreach ($shoppingcardArray as $key) {
                // Loops trough every item of the shoppingcard
                $product_details = $product->details($key['productID']);
                // Get the details of a product

                $amount = $shoppingcardArray[$key['productID']]['amount'];
                // Get how mutch we have of one product

                $productTotal = $shoppingcard->productTotalPriceInShoppingCard($key['productID']);
                // Total cost of one product with multiple items

                echo $view->displayShoppingCard($product_details, $amount, $productTotal);
                // Display
              }
              $BTWPrice = $shoppingcard->calculateBTW();
              echo "<h2 class='col-10 right-text'>BTW: &euro;" . $BTWPrice . "</h2>";
              $priceWithoutBTW = $shoppingcard->calculatePriceWithoutBTW();
              echo "<h2 class='col-10 right-text'>Exclusief BTW: &euro;" . $priceWithoutBTW . "</h2>";
              $totalPrice = $shoppingcard->calculateTotalPriceShoppingcard();
              echo "<h2 class='col-10 right-text'>Totaal: &euro;" . $totalPrice . "</h2>";
            }
            else {
              echo "<h2 class='col-12 center'>Uw winkelmandje is leeg!</h2>";
            }

          ?>
        </content>

        <div class="col-9"></div>
        <button class="col-1 paybutton" type="button">Betalen</button>
        <div class="col-2"></div>

        <?php require("assets/footer.php"); ?>
      </div>
    </div>

  </body>
</html>
