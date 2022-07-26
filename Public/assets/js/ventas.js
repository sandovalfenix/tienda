import { createApp } from 'vue';

const app = createApp({
  data() {
    return {
      Ventas: [],
      Factura: {},
      Producto: {},
      Vendedor: {},
      alert: {},
    };
  },
  mounted() {
    this.listVentas();
  },
  computed: {
    total() {
      return this.Ventas.reduce((total, item) => {
        let precioIVA =
          item.Producto.precio * (1 + parseFloat(item.Producto.iva));
        return total + precioIVA * item.cantidad;
      }, 0);
    },
  },
  methods: {
    listVentas: async function () {
      let url = 'http://localhost/tienda/ventas/list';
      let response = await fetch(url);
      this.Ventas = await response.json();
    },
    readVendedor: async function (id) {
      let url = 'http://localhost/tienda/vendedores/row/' + id;
      let response = await fetch(url);
      this.Vendedor = await response.json();
    },
    showFactura: function (item) {
      this.readVendedor(item.idVendedor);
      this.Factura = item;
    },
  },
});

app.mount('#app');
