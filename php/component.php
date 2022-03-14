<?php
    // $element = '';
    function component($productName,$productOldPrice,$productImg,$productid){
        $element ="
        <div class='col-md-3 col-sm-6 my-3 my-md-0'>
        <form action='shop.php' method='post'>
            <div class='card mb-3 p-2 shadow'>
                <div>
                    <img src='uploads/$productImg' alt='' srcset=''>
                </div>
                <div class='card-body'>
                    <h5 class='card-title'>$productName</h5>
                    <h6>
                        <i class='fa-solid fa-star'></i>
                        <i class='fa-solid fa-star'></i>
                        <i class='fa-solid fa-star'></i>
                        <i class='fa-solid fa-star'></i>
                        <i class='fa-solid fa-star-half'></i>
                    </h6>
                    <p class='card-text'>
                        Some Quick Exaple text to build on the card.
                    </p>
                    <h5>
                        <small class='text-secondary'><s>$44</s></small>
                        <span class='price'>$productOldPrice</span>
                    </h5>

                    <button type='submit' name='add' class='btn btn-warning my-3'>Add To Cart <i class='fa-solid fa-shopping-cart'></i></button>
                    <input type=hidden name='product_id' value='$productid'>
                </div>
            </div>
        </form>
        </div>
        ";
        echo $element   ;
    }

    function cartProuct($productImage, $productName, $productPrice, $productid){
        $element = "
        
        <form action=\"cart.php?action=remove&id=$productid\" method=\"post\" class=\"cart-items\">
                        <div class=\"border rounded p-3 mb-2\">
                            <div class=\"row bg-white\">
                                <div class=\"col-md-3 \">
                                    <img src=\"../uploads/$productImage\" alt=\"product image\">
                                </div>
                                <div class=\"col-md-6\">
                                    <h5 class=\"pt-2\">$productName</h5>
                                    <small class=\"text-secondary\">Seller: Samsung</small>
                                    <h5 class=\"pt-2\">$$productPrice</h5>
                                    <button type=\"submit\" class=\"btn btn-warning\">Save For Later</button>
                                    <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
                                </div>
                                <div class=\"col-md-3 py-5\">
                                    <button class=\"bg-light btn border rounded-circle\"><i class=\"fa-solid fa-minus\"></i></button>
                                    <input type=\"text\" value=\"1\" class=\"form-control w-25 px-2 d-inline\">
                                    <button class=\"bg-light btn border rounded-circle\"><i class=\"fa-solid fa-plus\"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
        ";
        echo $element;
    }
?>

