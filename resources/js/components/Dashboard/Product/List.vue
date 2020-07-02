<template>
  <div class="layout-px-spacing">
    <button class="btn btn-primary" @click="$bvModal.show('modal-product-create')">Create Product</button>
    <b-modal id="modal-product-create" title="Create Product">
      <div class="form-group">
        <label for="newProductName">Name</label>
        <input type="text"
               class="form-control"
               v-model="newProduct['name']"
               id="newProductName">
      </div>
      <div class="form-group">
        <label for="newProductCategory">Category</label>
        <input
            type="text"
            class="form-control"
            v-model="newProduct['category']"
            id="newProductCategory">
      </div>
      <div class="form-group">
        <label for="newProductPrice">Price</label>
        <input
            type="number"
            class="form-control"
            v-model="newProduct['price']"
            id="newProductPrice">
      </div>
      <template v-slot:modal-footer="{close}">
        <button
            @click="createNewProduct({product: newProduct, token: getCookie('token')}); close()"
            class="btn btn-primary"
            type="submit">
          Create
        </button>
      </template>
    </b-modal>
    <b-modal id="editForm" :title="'Edit Product with id ' + editedProduct.id">
      <div class="form-group">
        <label for="productName">Name</label>
        <input type="text"
               class="form-control"
               id="productName"
               v-model="editedProduct.name">
      </div>
      <div class="form-group">
        <label for="productCategory">Category</label>
        <input
            type="text"
            class="form-control"
            id="productCategory"
            v-model="editedProduct.category">
      </div>
      <div class="form-group">
        <label for="productPrice">Price</label>
        <input
            type="number"
            class="form-control"
            id="productPrice"
            v-model="editedProduct.price">
      </div>
      <div class="form-group">
        <label>Created time</label>
        <input :value="editedProduct.created_at" disabled type="text" class="form-control">
      </div>
      <div class="form-group">
        <label>Updated time</label>
        <input :value="editedProduct.updated_at" disabled type="text" class="form-control">
      </div>

      <template v-slot:modal-footer="{close}">
        <button
            @click="editForm(editedProduct);close()"
            class="btn btn-primary"
            type="submit">
          Edit
        </button>
      </template>

    </b-modal>

    <div class="row layout-top-spacing">
      <div v-for="product in products" :key="product.id"
           class="col-xl-3 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="card component-card_1">
          <div class="card-body">
            <h5 class="card-title"><strong>#{{product.id}}</strong> {{product.name}}</h5>
            <p class="card-title">Category: {{product.category}}</p>
            <p class="card-text"><strong>Price: </strong>{{product.price}}</p>
            <p class="card-text"><strong>Author: </strong>{{product.user}}</p>
            <p class="card-text"><strong>Created At: </strong>{{product.created_at}}</p>
            <p class="card-text"><strong>Updated At: </strong>{{product.updated_at}}</p>
          </div>
          <div class="row col-12 m-auto">
            <div class="col-6 p-2">
              <button class="btn btn-secondary float-left"
                      @click="$bvModal.show('editForm');
                    editedProduct.id = product.id;
                    editedProduct.name = product.name;
                    editedProduct.price = product.price;
                    editedProduct.category = product.category;
                    editedProduct.created_at = product.created_at;
                    editedProduct.updated_at = product.updated_at;
                    ">Edit
              </button>
            </div>
            <div class="col-6 p-2">
              <button class="btn btn-danger float-right" @click="deleteForm({id:product.id})">X</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import {mapActions, mapState} from "vuex";
  import {getCookie} from "tiny-cookie";

  export default {
    name: "List",
    data() {
      return {
        newProduct: {
          name: 'test',
          category: 'test',
          price: 100
        },
        editedProduct: {
        id: 0,
          name: '',
          category: '',
          price: 0,
          created_at: '',
          updated_at: '',
      }
      }
    },
    computed: mapState(['products']),
    methods: {
      ...mapActions(['setNewProduct', 'setProducts', 'deleteProduct', 'editProduct']),
      createNewProduct(args) {
        this.setNewProduct(args);
      },
      getCookie,
      deleteForm(args) {
        this.$bvModal.msgBoxConfirm('Are you sure you want to delete product with id: ' + args.id + ' ?')
          .then(value => {
            if (value === true) {
              this.deleteProduct({'id': args.id, 'token': getCookie('token')})
            }
          });
      },
      editForm(data) {
        this.editProduct({'token': getCookie('token'), data: data})
      }
    },
    mounted() {
      this.setProducts();
    },
  }
</script>