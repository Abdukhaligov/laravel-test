<template>
  <div class="sidebar-wrapper sidebar-theme">
    <nav id="sidebar">
      <div class="shadow-bottom"></div>
      <ul class="list-unstyled menu-categories" id="accordionExample">
        <li class="menu">
          <a href="#" @click="setPage('product/list')" :data-active="page === 'product/list'" class="dropdown-toggle">
            <div class="">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                   stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                   class="feather feather-box">
                <path
                    d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                <line x1="12" y1="22.08" x2="12" y2="12"></line>
              </svg>
              <span>Products</span>
            </div>
          </a>
        </li>

        <li class="menu">
          <a href="#components" data-toggle="collapse" :data-active="page.includes('user')" class="dropdown-toggle">
            <div class="">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
              <span>Users</span>
            </div>
            <div>
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                   stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                   class="feather feather-chevron-right">
                <polyline points="9 18 15 12 9 6"></polyline>
              </svg>
            </div>
          </a>
          <ul class="collapse submenu list-unstyled" id="components" data-parent="#accordionExample">
            <li :class="page === 'user/list' ? 'active' : ''">
              <a href="#" @click="setPage('user/list')"> List </a>
            </li>
            <li :class="page === 'user/profile' ? 'active' : ''">
              <a href="#" @click="setPage('user/profile')"> Profile </a>
            </li>
          </ul>
        </li>

      </ul>
    </nav>
  </div>
</template>

<script>
  import {mapActions, mapState} from "vuex";

  export default {
    name: "SideBar",
    computed: mapState(["page"]),
    methods: mapActions(["setPage"])
  }
</script>
