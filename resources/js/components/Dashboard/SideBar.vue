<template>
  <div class="sidebar-wrapper sidebar-theme">
    <nav id="sidebar">
      <div class="shadow-bottom"></div>
      <ul class="list-unstyled menu-categories" id="accordionExample">
        <li class="menu">
          <a href="#dashboard" data-active="true" data-toggle="collapse" aria-expanded="true"
             class="dropdown-toggle">
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
            <div>
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                   stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                   class="feather feather-chevron-right">
                <polyline points="9 18 15 12 9 6"></polyline>
              </svg>
            </div>
          </a>
          <ul class="collapse submenu list-unstyled show" id="dashboard" data-parent="#accordionExample">
            <li class="active">
              <a href="index-2.html"> List </a>
            </li>
          </ul>
        </li>

        <li class="menu">
          <a href="#components" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <div class="">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                   stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                   class="feather feather-box">
                <path
                    d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                <line x1="12" y1="22.08" x2="12" y2="12"></line>
              </svg>
              <span>Components</span>
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
            <li>
              <a href="component_tabs.html"> Tabs </a>
            </li>
            <li>
              <a href="component_accordion.html"> Accordions </a>
            </li>
            <li>
              <a href="component_modal.html"> Modals </a>
            </li>
            <li>
              <a href="component_cards.html"> Cards </a>
            </li>
            <li>
              <a href="component_bootstrap_carousel.html">Carousel</a>
            </li>
            <li>
              <a href="component_blockui.html"> Block UI </a>
            </li>
            <li>
              <a href="component_countdown.html"> Countdown </a>
            </li>
            <li>
              <a href="component_counter.html"> Counter </a>
            </li>
            <li>
              <a href="component_sweetalert.html"> Sweet Alerts </a>
            </li>
            <li>
              <a href="component_timeline.html"> Timeline </a>
            </li>
            <li>
              <a href="component_snackbar.html"> Notifications </a>
            </li>
            <li>
              <a href="component_session_timeout.html"> Session Timeout </a>
            </li>
            <li>
              <a href="component_media_object.html"> Media Object </a>
            </li>
            <li>
              <a href="component_list_group.html"> List Group </a>
            </li>
            <li>
              <a href="component_pricing_table.html"> Pricing Tables </a>
            </li>
            <li>
              <a href="component_lightbox.html"> Lightbox </a>
            </li>
          </ul>
        </li>

        <li class="menu">
          <a href="fonticons.html" aria-expanded="false" class="dropdown-toggle">
            <div class="">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                   stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                   class="feather feather-target">
                <circle cx="12" cy="12" r="10"></circle>
                <circle cx="12" cy="12" r="6"></circle>
                <circle cx="12" cy="12" r="2"></circle>
              </svg>
              <span>Font Icons</span>
            </div>
          </a>
        </li>

      </ul>
    </nav>
  </div>
</template>

<script>
  export default {
    name: "SideBar"
  }
</script>
