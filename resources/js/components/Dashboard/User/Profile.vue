<template>
  <div class="layout-px-spacing">
    <b-modal id="modal-user-update" title="Update profile">
      <div>
        <div class="form-group">
          <label for="updateName">Name</label>
          <input type="text"
                 class="form-control"
                 id="updateName"
                 v-model="updatedUser.name"
                 placeholder="Enter name">
          <div v-if="errors.name">
            <strong>{{ errors.name[0] }}</strong>
          </div>
        </div>
        <div class="form-group">
          <label>Email address</label>
          <input type="email"
                 disabled
                 :value="user.email"
                 class="form-control">
        </div>

        <div class="field-wrapper">
          <div class="d-flex justify-content-between">
            <label for="company">COMPANY</label>
          </div>
        </div>
        <vue-select v-model="updatedUser.company_id"
                    id="company"
                    class="form-control basic"
                    :options="companies"
                    :reduce="company => company.id" label="name"></vue-select>

        <div class="field-wrapper">
          <div class="d-flex justify-content-between">
            <label for="position">POSITION</label>
          </div>
        </div>
        <vue-select v-model="updatedUser.position_id"
                    id="position"
                    class="form-control basic"
                    :options="positions"
                    :reduce="position => position.id" label="name"></vue-select>



      </div>

      <template v-slot:modal-footer="{close}">
        <button
            type="submit"
            class="btn btn-primary"
            @click="update(updatedUser);close()">
          Update
        </button>
      </template>
    </b-modal>

    <div class="row layout-spacing">

      <!-- Content -->
      <div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">

        <div class="user-profile layout-spacing">
          <div class="widget-content widget-content-area">
            <div class="d-flex justify-content-between">
              <h3 class="">Profile</h3>
              <a href="#"
                 @click="$bvModal.show('modal-user-update');
                 updatedUser.name = user.name;
                 updatedUser.company_id = user.company_id;
                 updatedUser.position_id = user.position_id;"
                 class="mt-2 edit-profile">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="feather feather-edit-3">
                  <path d="M12 20h9"></path>
                  <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                </svg>
              </a>
            </div>
            <div class="text-center user-info">
              <img src="assets/img/profile-3.jpg" alt="avatar">
              <p class="">{{ user.name }}</p>
            </div>
            <div class="user-info-list">

              <div class="">
                <ul class="contacts-block list-unstyled">
                  <li class="contacts-block__item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-coffee">
                      <path d="M18 8h1a4 4 0 0 1 0 8h-1"></path>
                      <path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path>
                      <line x1="6" y1="1" x2="6" y2="4"></line>
                      <line x1="10" y1="1" x2="10" y2="4"></line>
                      <line x1="14" y1="1" x2="14" y2="4"></line>
                    </svg>
                    <br>
                    <span>Company: <strong>{{ user.company }}</strong></span>
                    <br>
                    <span>Position: <strong>{{ user.position }}</strong></span>
                  </li>
                  <li class="contacts-block__item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-calendar">
                      <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                      <line x1="16" y1="2" x2="16" y2="6"></line>
                      <line x1="8" y1="2" x2="8" y2="6"></line>
                      <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    <br>
                    <span>Created at: <strong>{{ user.created_at }}</strong></span>
                    <br>
                    <span>Updated at: <strong>{{ user.updated_at }}</strong></span>
                  </li>
                  <li class="contacts-block__item">
                    <a href="mailto:example@mail.com">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                           stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                           class="feather feather-mail">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                      </svg>
                      {{ user.email }}
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="col-xl-8 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">

        <div class="bio layout-spacing ">
          <div class="widget-content widget-content-area">
            <h3 class="">Bio</h3>
            <p>I'm Web Developer from California. I code and design websites worldwide. Mauris varius tellus vitae
              tristique sagittis. Sed aliquet, est nec auctor aliquet, orci ex vestibulum ex, non pharetra lacus erat ac
              nulla.</p>

            <p>Sed vulputate, ligula eget mollis auctor, lectus elit feugiat urna, eget euismod turpis lectus sed ex.
              Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nunc ut velit
              finibus, scelerisque sapien vitae, pharetra est. Nunc accumsan ligula vehicula scelerisque vulputate.</p>

            <div class="bio-skill-box">

              <div class="row">

                <div class="col-12 col-xl-6 col-lg-12 mb-xl-5 mb-5 ">

                  <div class="d-flex b-skills">
                    <div>
                    </div>
                    <div class="">
                      <h5>Sass Applications</h5>
                      <p>Duis aute irure dolor in reprehenderit in voluptate velit esse eu fugiat nulla pariatur.</p>
                    </div>
                  </div>

                </div>

                <div class="col-12 col-xl-6 col-lg-12 mb-xl-5 mb-5 ">

                  <div class="d-flex b-skills">
                    <div>
                    </div>
                    <div class="">
                      <h5>Github Countributer</h5>
                      <p>Ut enim ad minim veniam, quis nostrud exercitation aliquip ex ea commodo consequat.</p>
                    </div>
                  </div>

                </div>

                <div class="col-12 col-xl-6 col-lg-12 mb-xl-0 mb-5 ">

                  <div class="d-flex b-skills">
                    <div>
                    </div>
                    <div class="">
                      <h5>Photograhpy</h5>
                      <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia anim id est
                        laborum.</p>
                    </div>
                  </div>

                </div>

                <div class="col-12 col-xl-6 col-lg-12 mb-xl-0 mb-0 ">

                  <div class="d-flex b-skills">
                    <div>
                    </div>
                    <div class="">
                      <h5>Mobile Apps</h5>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do et dolore magna aliqua.</p>
                    </div>
                  </div>

                </div>

              </div>

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
    name: "Profile",
    data() {
      return {
        updatedUser: {
          name: "",
          company_id: "",
          position_id: "",
        }
      }
    },
    computed: mapState(["user", "errors", "positions", "companies"]),
    methods: {
      ...mapActions(['updateUser']),
      update(data) {
        this.updateUser({'token': getCookie('token'), data: data});
      },
      getCookie,
    },
  }
</script>
