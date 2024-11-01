<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Styles/styles.css">
    <title>Document</title>
</head>
<body>
    <header class="header">
        <nav class="main-nav">
            <div class="div-main-nav">
                <div class="right-nav">
                    <div class="logo">
                        <a class="mian-logo" href="../../../index.php">
                            <!--<img src="images/logo.png" alt="LOGO" class="logo">-->
                            LOGO
                        </a>
                    </div>

                    <div class="right-nav-side-logo-container">
                        <div class="right-nav-side-logo">
                            <nav class="second-nav">
                                <ul class="ul-rigth-nav">
                                    <li class="right-nav-item"> 
                                        <a class="a-nav-item" href="../../Backend/Views/productos.php"><span>Vinilos</span></a>
                                    </li>
                                    <li class="right-nav-item"> 
                                        <a class="a-nav-item" href="Artistas.html"><span>Artistas</span></a>
                                    </li>
                                    <li class="right-nav-item"> 
                                        <a class="a-nav-item" href="Categorias.html"><span>Categorias</span></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="left-nav">
                    <ul class="ul-left-nav">
                        <li class="left-nav-item"> 
                            <button class="search-button-header" type="button">
                                <span class="search-icon">
                                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                                        <path fill-rule="evenodd" d="M14.391 15.452a7 7 0 1 1 1.06-1.06l5.86 5.858-1.061 1.06-5.859-5.858ZM15.5 10a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0Z"></path>
                                    </svg>
                                </span>
                            </button>
                        </li>

                        <li class="left-nav-item">
                            <div class="person-button-header-container">
                                <a target="_self" rel="noreferrer" class="person-button-header" id="nav-person" label="LogIn" href="../../../Backend/Views/login.php">
                                    <button class="person-button-header" type="button" data-elid="header-account-button">
                                        <span class="person-icon">
                                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                                                <path fill-rule="evenodd" d="M16.75 6.25a4.75 4.75 0 1 1-9.5 0 4.75 4.75 0 0 1 9.5 0Zm-1.5 0a3.25 3.25 0 1 1-6.5 0 3.25 3.25 0 0 1 6.5 0Z M12 12.5c-2.397 0-4.827.238-6.684.991-.935.38-1.767.907-2.367 1.64-.611.746-.949 1.665-.949 2.752V20h1.5v-2.117c0-.753.226-1.334.61-1.802.393-.48.986-.881 1.77-1.2C7.464 14.238 9.66 14 12 14c2.348 0 4.542.214 6.124.845.783.312 1.373.71 1.765 1.192.382.47.61 1.063.61 1.847L20.5 20H22v-2.116c0-1.107-.335-2.04-.947-2.793-.602-.74-1.436-1.266-2.374-1.64-1.858-.74-4.29-.951-6.679-.951Z"></path>
                                            </svg>
                                        </span>
                                        <span class="span-person-button-header">Iniciar sesión</span>
                                    </button>
                                </a>
                            </div>
                        </li>

                        <li class="left-nav-item">
                            <a target="_self" rel="noreferrer" class="favorite-button-header" id="nav-favourites" label="Favoritos" href="Favoritos.html">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                                    <path d="M13.035 4.54a5.25 5.25 0 1 1 7.425 7.424L12 20.424l-8.46-8.459a5.25 5.25 0 0 1 7.424-7.425l1.037 1.034 1.034-1.034ZM19.4 5.6a3.75 3.75 0 0 0-5.303 0l-2.093 2.094-2.098-2.092a3.75 3.75 0 0 0-5.304 5.303l7.4 7.397 7.398-7.398a3.75 3.75 0 0 0 0-5.304Z"></path>
                                </svg>
                                <span class="span-facorite-button-header">Favoritos</span>
                            </a>
                        </li>

                        <li class="left-nav-item">
                            <div class="bag-button-header-container">
                                <button class="bag-button-header" type="button" data-elid="header-cart-button">
                                    <span class="bag-icon">
                                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                                            <path fill-rule="evenodd" d="M12 2c-1.17 0-2.436.262-3.437.853-1.02.601-1.813 1.586-1.813 2.97v1.178H5.126L2 7.003V21h20V7h-4.75V5.872c0-1.4-.783-2.399-1.806-3.011C14.442 2.26 13.174 2 12 2Zm3.75 6.5V12h1.5V8.5h3.25v11h-17V8.502h3.25V12h1.5V8.5h7.5Zm0-1.5V5.872c0-.75-.389-1.313-1.076-1.724-.71-.424-1.692-.648-2.674-.648-.977 0-1.961.224-2.674.644-.694.41-1.076.962-1.076 1.679v1.178L15.75 7Z"></path>
                                        </svg>
                                    </span>
                                    <span class="span-bag-button-header">Shopping bag (0)</span>
                                </button>
                            </div>
                            
                            <!--<div class="d6b5af tiyZ bcdeb9" data-testid="minicart-closed">
                                <div class="f9c217">
                                    <h2 class="fa226d af6753 d9a373">Tu Shopping Bag está vacía</h2>
                                    <button class="f05bd4 cf896c aaa2a2" type="button">Seguir comprando</button>
                                </div>
                            </div>-->
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</body>
</html>