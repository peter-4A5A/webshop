<?php
  session_start();
  if (ISSET($_REQUEST['shoppingcard'])) {
    require_once '../classes/shoppingcard.class.php';
    require_once '../classes/view.class.php';
    require_once '../classes/product.class.php';

    $shoppingcard = new shoppingcard();

    switch ($_REQUEST['shoppingcard']) {
      case 'add':
        // Add product from shoppingcard
        if ($shoppingcard->checkIfIdExists($_REQUEST['productID']) == false) {
          // It isn't existsing in the shoppingcard
          $shoppingcard->add($_REQUEST['productID'], $_REQUEST['amount']);
        }
        else if ($shoppingcard->checkIfIdExists($_REQUEST['productID']) == true) {
          // Exists in the shoppingcard
          $amount = $shoppingcard->getProductAmount($_REQUEST['productID']);
          $amount = $amount + 1;
          echo " " . $amount;
          $shoppingcard->update($_REQUEST['productID'], $amount);
        }
        break;
      case 'delete':
        // Remove product form shoppingcard
        $shoppingcard->delete($_REQUEST['productID']);
        break;
      case 'update':
        // Updates the amount of a product
        $shoppingcard->update($_REQUEST['productID'], $_REQUEST['amount']);
        break;
      case 'count':
        // Counts all products in the shoppingcard
        echo $shoppingcard->count();
        break;
      case 'display':
        // Displays the content from the shoppingcard
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
            }
        }
        else {
          echo "<h2 class='col-12 center'>Uw winkelmandje is leeg!</h2>";
        }
          // Display
        $BTWPrice = $shoppingcard->calculateBTW();
        echo "<h2 class='col-10 right-text'>BTW: &euro;" . $BTWPrice . "</h2>";
        $priceWithoutBTW = $shoppingcard->calculatePriceWithoutBTW();
        echo "<h2 class='col-10 right-text'>Exclusief BTW: &euro;" . $priceWithoutBTW . "</h2>";
        $totalPrice = $shoppingcard->calculateTotalPriceShoppingcard();
        echo "<h2 class='col-10 right-text'>Totaal: &euro;" . $totalPrice . "</h2>";
        break;
    }
  }


?>
