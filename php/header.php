<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        
                <?php
                if($_SERVER['REQUEST_URI'] == "/E-wallet-2/shop.php"){
                    echo "<a href='index.php' class='navbar-brand'><h3 class=\"px-5\">";
                    echo "<i class='fa-solid fa-home'></i>Home";
                }elseif(($_SERVER['REQUEST_URI'] == "/E-wallet-2/php/cart.php")){
                    echo "<a href='../shop.php' class='navbar-brand'><h3 class=\"px-5\">";
                    echo "<i class='fa-solid fa-shopping-basket'></i>Shop";
                }
                ?>
            </h3>
        </a>
        <button class="navbar-toggler"
            data-toggle="collapse"
            data-target = "#navbarNavAltMarkup"
            aria-controls = "navbarNavAltMarkup"
            aria-expanded = "false"
            aria-lable = "Toggle navigation"
        >
            <span class="navbar-toggle-icon"></span>
        </button>

        <div class="collpase navbar-collapse" id="navbarNavAltMarkup">
            <div class="me-auto"></div>
            <div class="navbar-nav">
                <a href="php/cart.php" class="nav-item nav-link active">
                    <h5 class="px-5 cart">
                        <i class="fa-solid fa-shopping-cart"></i> Cart 
                        <?php 
                            if(isset($_SESSION['cart'])){
                                $count = count($_SESSION['cart']);
                                echo "<span id=\"cart-count\" class=\"text-warning bg-light\">$count</span>";
                            }else {
                                echo "<span id=\"cart-count\" class=\"text-warning bg-light\">0</span>";
                            }
                        ?>
                    </h5>
                </a>
            </div>
        </div>
    </nav>
</header>
