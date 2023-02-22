let menu = document.querySelector('#menu-bars');
let navbar = document.querySelector('.navbar');

menu.onclick = () => {
  menu.classList.toggle('fa-times');
  navbar.classList.toggle('active');
}

const getPlatosActivos = async () => {
  const response = await fetch('controller/plato.php?op=listarActivos');
  return response.json();
}


const listar = async () => {
  const menuList = document.querySelector('#menuList');
  const platos = await getPlatosActivos();
  platos.results.forEach(plato => {
    menuList.innerHTML += `
      <div class="box">
        <div class="image">
          <img loading=lazy src="${plato.imagen}" alt="${plato.nombre}">
        </div>
        <div class="content">
          <h3>${plato.nombre}</h3>
          <span class="price">$ ${plato.precio}</span>
        </div>
      </div>
    `;
  });
}


listar();