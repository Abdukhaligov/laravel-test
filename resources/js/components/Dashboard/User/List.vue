<template>
  <div class="layout-px-spacing">
    <div class="row layout-top-spacing">
      <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
          <div class="table-responsive mb-4 mt-4">
            <b-table hover foot-clone bordered
                     :table-variant="'dark'"
                     :items="users" :fields="user.isAdmin ? fieldsAdmin : fields">
              <template v-slot:cell(actions)="data" class="col-2">
                <!--                {{ data.item.id }}-->
                <button class="btn btn-secondary float-left"
                        @click="$bvModal.show('modal-user-edit');
                    editedUser.id = data.item.id;
                    editedUser.name = data.item.name;
                    editedUser.email = data.item.email;
                    editedUser.company_id = data.item.company_id;
                    editedUser.position_id = data.item.position_id;
                    editedUser.created_at = data.item.created_at;
                    editedUser.updated_at = data.item.updated_at;
                    editedUser.roles_id = data.item.roles_id;
                    editedUser.roles_name = data.item.roles_name;
                    ">Edit
                </button>
                <button class="btn btn-danger float-right" @click="removeUser({id:data.item.id})">X</button>
              </template>
            </b-table>
          </div>
        </div>
      </div>
    </div>

    <b-modal id="modal-user-edit" :title="'Edit user with id'+ editedUser.id">
      <div>
        <div class="form-group">
          <label for="updateName">Name</label>
          <input type="text"
                 class="form-control"
                 id="updateName"
                 v-model="editedUser.name"
                 placeholder="Enter name">
          <div v-if="errors.name">
            <strong>{{ errors.name[0] }}</strong>
          </div>
        </div>
        <div class="form-group">
          <label>Email address</label>
          <input type="email"
                 disabled
                 :value="editedUser.email"
                 class="form-control">
        </div>
        <div class="field-wrapper">
          <div class="d-flex justify-content-between">
            <label for="company">COMPANY</label>
          </div>
        </div>
        <vue-select v-model="editedUser.company_id"
                    id="company"
                    class="form-control basic"
                    :options="companies"
                    :reduce="company => company.id" label="name"></vue-select>
        <div class="field-wrapper">
          <div class="d-flex justify-content-between">
            <label for="position">POSITION</label>
          </div>
        </div>
        <vue-select v-model="editedUser.position_id"
                    id="position"
                    class="form-control basic"
                    :options="positions"
                    :reduce="position => position.id" label="name"></vue-select>
        <div class="field-wrapper">
          <div class="d-flex justify-content-between">
            <label for="company">Roles</label>
          </div>
        </div>

        <vue-select multiple v-model="editedUser.roles_id"
                    class="form-control basic"
                    :options="roles"
                    :reduce="roles => roles.id" label="name"></vue-select>

        <div class="form-group">
          <label>Updated At</label>
          <input type="text"
                 disabled
                 :value="editedUser.updated_at"
                 class="form-control">
        </div>
        <div class="form-group">
          <label>Created At</label>
          <input type="text"
                 disabled
                 :value="editedUser.created_at"
                 class="form-control">
        </div>
      </div>
      <template v-slot:modal-footer="{close}">
        <button
            type="submit"
            class="btn btn-primary"
            @click="updateEditedUser(editedUser);close()">
          Update
        </button>
      </template>
    </b-modal>
  </div>
</template>

<script>
  import {mapActions, mapState} from "vuex";
  import {getCookie} from "tiny-cookie";

  export default {
    name: "List",
    data() {
      return {
        fields:[
          'email',
          'name',
          'company',
          'position'
        ],
        fieldsAdmin: [
          'email',
          'name',
          'company',
          'position',
          {key: 'roles_name', label: 'Roles'},
          // A virtual column made up from two fields
          {key: 'actions', label: 'Actions', 'class': 'actions-column',}
        ],
        editedUser: {
          id: "",
          name: "",
          email: "",
          company_id: "",
          position_id: "",
          updated_at: "",
          created_at: "",
          roles_id: [],
          roles_name: [],
        },
      }
    },
    computed: mapState(["user", "users", "roles", "positions", "companies", "errors"]),
    methods:{
      ...mapActions(["editUser", "deleteUser"]),
      removeUser(args) {
        this.$bvModal.msgBoxConfirm('Are you sure you want to delete user with id: ' + args.id + ' ?')
          .then(value => {
            if (value === true) {
              this.deleteUser({'id': args.id, 'token': getCookie('token')})
            }
          });
      },
      updateEditedUser(data) {
        this.editUser({'token': getCookie('token'), data: data})
      }
    }
  }
</script>