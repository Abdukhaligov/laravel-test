<template>
  <div v-if="credential.status === 'ok' || getCookie('token')">
    <hr>
    <div class="row">
      <div class="col-3 p-4" style="border-right: 1px solid rgba(0,0,0,.1)">
        <table class="table" style="max-height: 100%">
          <thead class="thead-dark">
          <tr>
            <th scope="col">User</th>
            <th scope="col">Company</th>
            <th scope="col">Position</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="user in users">
            <td><a href="#">{{ user.name }}</a></td>
            <td><span style="font-size: 13px">{{ user.company ? user.company : 'no'}}</span></td>
            <td><span style="font-size: 13px">{{ user.position ? user.position : 'no'}}</span></td>
          </tr>
          </tbody>
        </table>
      </div>
      <div class="col-9">
        <div class="container row m-auto">
          <div class="p-2 col-12">
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
          </div>
        </div>
        <hr>
        <div class="container row m-auto">
          <div v-for="product in products" :key="product.id" class="col-4 p-2">
            <div class="card">
              <div class="card-header">
                <strong>#{{product.id}} Name:</strong> {{product.name}}
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-5">
                    <p class="card-title">Category: {{product.category}}</p>
                    <p class="card-text"><strong>Price: </strong>{{product.price}}</p>
                    <p class="card-text"><strong>Author: </strong>{{product.user}}</p>
                  </div>
                  <div class="col-7">
                    <div class="input-group">
                      <input :value="product.created_at" disabled type="text" class="form-control">
                    </div>
                    <hr>
                    <div class="input-group">
                      <input :value="product.updated_at" disabled type="text" class="form-control">
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-header">
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

                <button class="btn btn-danger float-right" @click="deleteForm({id:product.id})">X</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

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
  </div>
</template>

<script>

  import {mapState, mapActions} from 'vuex'
  import {getCookie} from 'tiny-cookie'

  export default {
    name: "ProductList",
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
    computed: mapState(['products', 'credential', 'users', 'userDetails']),
    methods: {
      ...mapActions(['setNewProduct', 'setProducts', 'deleteProduct', 'editProduct', 'getUsers']),
      getCookie,
      createNewProduct(args) {
        this.setNewProduct(args);
      },
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
      if (this.getCookie('token')) {
        this.setProducts();
        this.getUsers(getCookie('token'));
      }
    },
    watch: {
      credential: function () {
        if (this.credential.status === "ok") {
          this.setProducts();
          this.getUsers(getCookie('token'));
        }
      },
      userDetails: function () {
        this.getUsers(getCookie('token'));
        this.setProducts();
      }
    }
  }
</script>

<style scoped>

</style>