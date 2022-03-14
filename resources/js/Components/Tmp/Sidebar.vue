<template>
    <!-- give the sidebar z-50 class so its higher than the navbar if you want to see the logo -->
    <!-- you will need to add a little "X" button next to the logo in order to close it though -->
    <div class="w-1/2 md:w-1/3 lg:w-64 fixed md:top-0 md:left-0 h-screen lg:block bg-white border-r z-30 overflow-auto" :class="sideBarOpen ? '' : 'hidden'" id="main-nav">

          <div class="w-full h-20 border-b flex px-4 items-center mb-8 bg-blue-700">
            <p id="brand_name" class="font-semibold text-3xl text-white pl-4">LaravelMedika</p>
          </div>

          <div class="mb-4">
            <p class="pl-4 text-sm font-semibold mb-1">Utama</p>

            <nav-link :href="route('dashboard')" :active="route().current('dashboard')" v-if="$page.props.user.isOperator" >
              <svg class="h-6 w-6 fill-current mr-2" viewBox="0 0 20 20">
                <path d="M18.121,9.88l-7.832-7.836c-0.155-0.158-0.428-0.155-0.584,0L1.842,9.913c-0.262,0.263-0.073,0.705,0.292,0.705h2.069v7.042c0,0.227,0.187,0.414,0.414,0.414h3.725c0.228,0,0.414-0.188,0.414-0.414v-3.313h2.483v3.313c0,0.227,0.187,0.414,0.413,0.414h3.726c0.229,0,0.414-0.188,0.414-0.414v-7.042h2.068h0.004C18.331,10.617,18.389,10.146,18.121,9.88 M14.963,17.245h-2.896v-3.313c0-0.229-0.186-0.415-0.414-0.415H8.342c-0.228,0-0.414,0.187-0.414,0.415v3.313H5.032v-6.628h9.931V17.245z M3.133,9.79l6.864-6.868l6.867,6.868H3.133z"></path>
              </svg>
              <span class="text-gray-700">Dashboard</span>
            </nav-link>
          </div>

          <div class="mb-4">
            <p class="pl-4 text-sm font-semibold mb-1">Data</p>

			<nav-link :href="route('villages.index')" :active="route().current('villages.index')" v-if="$page.props.user.isSuperAdmin">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="h-6 w-6 fill-current mr-2"><path d="M12 18.62l-6.55 3.27A1 1 0 0 1 4 21V4c0-1.1.9-2 2-2h12a2 2 0 0 1 2 2v17a1 1 0 0 1-1.45.9L12 18.61zM18 4H6v15.38l5.55-2.77a1 1 0 0 1 .9 0L18 19.38V4z" class="heroicon-ui"></path></svg>
				<span class="text-gray-700">Kelurahan</span>
			</nav-link>

			<nav-link :href="route('patients.index')" :active="route().current('patients.index')" v-if="$page.props.user.isOperator">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="h-6 w-6 fill-current mr-2"><path d="M12 18.62l-6.55 3.27A1 1 0 0 1 4 21V4c0-1.1.9-2 2-2h12a2 2 0 0 1 2 2v17a1 1 0 0 1-1.45.9L12 18.61zM18 4H6v15.38l5.55-2.77a1 1 0 0 1 .9 0L18 19.38V4z" class="heroicon-ui"></path></svg>
				<span class="text-gray-700">Pasien</span>
			</nav-link>

          </div>
		  
		  <div class="mb-4" v-if="$page.props.user.isSuperAdmin">
            <p class="pl-4 text-sm font-semibold mb-1">Akun</p>
			<nav-link :href="route('admins.index')"  :active="route().current('admins.index')" >
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="h-6 w-6 fill-current mr-2">
					<path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
				</svg>
				<span class="text-gray-700">Administrator</span>
			</nav-link>
          </div>

        </div>
</template>

<script>
	import { mapState } from 'vuex'
	import NavLink from '@/Components/Tmp/NavLink.vue'

	export default {
		name: 'Sidebar',
		components: {
			NavLink,
		},
		computed: {
			...mapState(['sideBarOpen'])
		}
	}
</script>