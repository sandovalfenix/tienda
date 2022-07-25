import { createApp } from 'vue';

const app = createApp({
  data() {
    return {
      Productos: [],
      Carrito: [],
      alert: {},
    };
  },
  mounted() {
    this.listProductos();
  },
  computed: {
    total() {
      return this.Carrito.reduce((total, producto) => {
        return total + producto.precioIVA * producto.cantidad;
      }, 0);
    },
  },
  methods: {
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
  },
});

app.mount('#app');
