
const carro = new Carrito();
const carrito = document.getElementById('carrito');
const productos = document.getElementById('lista-productos');
const listaProductos = document.querySelector('#lista-carrito #body-carrito');

cargarEventos();

function cargarEventos(){
    //console.log(productos);
    try{
        productos.addEventListener('click',(e)=>{carro.comprarProducto(e)});
    }catch (error) {
        console.log(error);
    }
}
