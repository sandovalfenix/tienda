import { createApp } from 'vue';

const app = createApp({
  data() {
    return {
      Productos: [],
      Carrito: [],
      alert: {},
      vendedor: {},
    };
  },
  mounted() {
    this.listProductos();
    this.readVendedor(1);
  },
  computed: {
    total() {
      return this.Carrito.reduce((total, producto) => {
        return total + producto.precioIVA * producto.cantidad;
      }, 0);
    },
  },
  methods: {
    readVendedor: async function (id) {
      let url = 'http://localhost/tienda/vendedores/row/' + id;
      let response = await fetch(url);
      this.vendedor = await response.json();
    },
    listProductos: async function () {
      let url = 'http://localhost/tienda/productos/list';
      let response = await fetch(url);
      this.Productos = await response.json();
    },
    addCarrito(item) {
      if (
        !this.Carrito.find((producto) => {
          if (producto.idProducto === item.idProducto) {
            producto.cantidad += 1;
            return true;
          } else {
            return false;
          }
        })
      ) {
        this.Carrito.push({
          ...item,
          cantidad: 1,
          precioIVA: item.precio * (1 + parseFloat(item.iva)),
        });
      }
    },
    reducirCarrito(item) {
      if (item.cantidad > 1) {
        item.cantidad -= 1;
      } else {
        this.Carrito.splice(this.Carrito.indexOf(item), 1);
      }
    },
    aumentarCarrito(item) {
      item.cantidad += 1;
    },
    confirmarCompra() {
      if (this.Carrito.length > 0) {
        this.addFactura();
        /* const data = new FormData();

        this.Carrito.forEach(async (item) => {
          Object.keys(item).forEach((key) => {
            data.append(`${key}`, item[key]);
            console.log(`${key}`, item[key]);
          });
          let url = 'http://localhost/tienda/ventas/add';
          let response = await fetch(url, {
            method: 'POST',
            body: data,
          });
          console.log(await response.json());
        }); */

        /* this.alert.type = 'success';
        this.alert.message = 'Compra realizada con éxito'; */
      } else {
        this.alert.type = 'danger';
        this.alert.message = 'No hay productos en el carrito';
      }
    },
    async addFactura() {
      const data = new FormData();

      data.append('idVendedor', this.vendedor.idVendedor);
      data.append('valorTotal', this.total);

      let url = 'http://localhost/tienda/facturas/add';
      let response = await fetch(url, {
        method: 'POST',
        body: data,
      });

      let respuesta = await response.json();
      this.alert = respuesta.alert;
    },
  },
});

app.mount('#app');
