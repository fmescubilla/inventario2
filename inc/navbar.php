<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="index.php?vista=home">
    <img src="./img/logo.png" width="65" height="28"></a>

    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
   

      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">Usuarios</a>

        <div class="navbar-dropdown">
          <a class="navbar-item" href="index.php?vista=user_new">Nuevo usuario</a>
           <a class="navbar-item"  href="index.php?vista=user_list">Lista</a>
            <a class="navbar-item"  href="index.php?vista=user_search">Buscar</a>
        </div>
      </div>

            <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">Categorias</a>

        <div class="navbar-dropdown">
          <a class="navbar-item" href="index.php?vista=category_new">Nueva Categoria</a>
           <a class="navbar-item" href="index.php?vista=category_list">Lista de Categorias</a>
            <a class="navbar-item"  href="index.php?vista=category_search">Buscar Categoria</a>
        </div>
      </div>
            <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">Productos</a>

        <div class="navbar-dropdown">
          <a class="navbar-item"  href="index.php?vista=product_new">Nuevo Producto</a>
           <a class="navbar-item" href="index.php?vista=product_list">Lista de Producto</a>
             <a class="navbar-item" href="index.php?vista=product_category">Por categoria</a>
            <a class="navbar-item" href="index.php?vista=product_search">Buscar Producto</a>
        </div>
      </div>
    </div>

    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
          <a class="button is-primary">
            <strong>Mi cuenta</strong>
          </a>
          <a  href="index.php?vista=logout"  class="button is-link 
          is-rounded">
            Salir
          </a>
        </div>
      </div>
    </div>
  </div>
</nav>