
class Carrito{
    //add producto car
    comprarProducto(e){
        e.preventDefault();
        if(e.target.classList.contains('agregar-carrito')){
            //console.log(e.target.parentElement);
            const producto = e.target.parentElement.parentElement.parentElement.parentElement;
            //console.log(producto);
            this.leerDatosProducto(producto);
            
        }
    }
    leerDatosProducto(producto){
        const infoProducto = {
            imagen : producto.querySelector('img').src,
            titulo : producto.querySelector('.card-title').textContent,
            precio : producto.querySelector('.text-muted span').textContent,
            id : producto.querySelector('.title_promotion').getAttribute('value'),
            cantidad : 1
        }
        let productosLS;
        let cont_p = 0;
        productosLS = this.obtenerProductosLocalStorage();
        productosLS.forEach(function(productoLS){
            if(productoLS.id === infoProducto.id){
                productoLS.cantidad++;
                cont_p++;
            }
        });
        if(cont_p>0){
            localStorage.setItem('productos',JSON.stringify(productosLS));
            this.vaciarCarrito2();
            this.leerLocalStorage();
        }else{
            this.insertaCarrito(infoProducto);
        }
        //console.log(productosLS);
        //if(productosLS === infoProducto.id){
           // productosLS.cantidad++;
            //this.guardarProductosLocalStorage(productosLS);
        //}else{
            //this.insertaCarrito(infoProducto);
        //}
    }
    insertaCarrito(producto){
        const row = document.createElement('tr');
        row.innerHTML = `
            <th scope="row"><img src="${producto.imagen}" width=100></th>
            <td><p>${producto.titulo}</p></td>
            <td><p>S/. ${producto.precio * producto.cantidad}</p></td>
            <td><p>Cantidad: ${producto.cantidad}</p></td>
            <td><a href="" class="borrar-producto icon-cancel-circled" data-id="${producto.id}"></a></td>

        `;
        listaProductos.appendChild(row);
        this.guardarProductosLocalStorage(producto);
    }
    eliminarProducto(e){
        e.preventDefault();
        let producto,productoID;
        if(e.target.classList.contains('borrar-producto')){
            e.target.parentElement.parentElement.remove();
            producto = e.target.parentElement.parentElement;
            productoID = producto.querySelector('a').getAttribute('data-id');
        }
        this.eliminarProductoLocalStorage(productoID);
    }
    vaciarCarrito(e){
        e.preventDefault();
        while(listaProductos.firstChild){
            listaProductos.removeChild(listaProductos.firstChild);
        }
        this.vaciarLocalStorage();
        return false;
    }
    vaciarCarrito2(){
        while(listaProductos.firstChild){
            listaProductos.removeChild(listaProductos.firstChild);
        }
        return false;
    }
    guardarProductosLocalStorage(producto){
        let productos;
        productos = this.obtenerProductosLocalStorage();
        productos.push(producto);
        localStorage.setItem("productos",JSON.stringify(productos));
    }
    obtenerProductosLocalStorage(){
        let productoLS;

        if(localStorage.getItem("productos") == null){
            productoLS = [];
        }else{
            productoLS = JSON.parse(localStorage.getItem('productos'));
        }
        return productoLS;
    }
    eliminarProductoLocalStorage(productoID){
        let productosLS;
        productosLS = this.obtenerProductosLocalStorage();
        productosLS.forEach(function(productoLS, index){
            if(productoLS.id == productoID){
                productosLS.splice(index,1);
            }

        });

        localStorage.setItem('productos',JSON.stringify(productosLS));
    }

    leerLocalStorage(){
        let productosLS;
        
        productosLS = this.obtenerProductosLocalStorage();
        productosLS.forEach(function(producto){
            const row = document.createElement('tr');
            row.innerHTML = `
                <th scope="row"><img src="${producto.imagen}" width=100></th>
                <td><p>${producto.titulo}</p></td>
                <td><p>S/. ${(producto.precio * producto.cantidad).toFixed(2)}</p></td>
                <td><p>Cantidad: ${producto.cantidad}</p></td>
                <td><a href="" class="borrar-producto icon-cancel-circled"" data-id="${producto.id}"></a></td>
            `;
            listaProductos.appendChild(row);
        });

    }

    vaciarLocalStorage(){
        localStorage.clear();
    }

}