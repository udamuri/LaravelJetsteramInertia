<template>
    <div>
        <Head :title="title" />

		<div class="leading-normal tracking-normal" id="main-body">
			<div class="flex flex-wrap">

			<Sidebar />

			<div class="w-full bg-gray-100 pl-0 lg:pl-64 min-h-screen" :class="sideBarOpen ? 'overlay' : ''" id="main-content">

				<Navbar />

				<div class="bg-gray-100 mb-20">
					<!-- breadcrumb -->
					<div class="grid grid-cols-2 gap-4 bg-white px-6 py-3 border-b">
						<div>
							<nav class="text-sm font-semibold pt-2" aria-label="Breadcrumb">
								<ol class="list-none p-0 inline-flex" v-if="$slots.header">
									<slot name="header"></slot>
								</ol>
							</nav>
						</div>
						
						<div class="text-right" v-if="$slots.header_button">
							<slot name="header_button"></slot>
						</div>
					</div>
					<!-- breadcrumb end -->
					<div class="container mx-auto">
						<slot></slot>
					</div>
				</div>
			</div>
		</div>
  </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'
	import { mapState } from 'vuex'

	import Sidebar from '@/Components/Tmp/Sidebar'
	import Navbar from '@/Components/Tmp/Navbar'
	import Footer from '@/Components/Tmp/Footer'

    import { Head, Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        props: {
            title: String,
        },

        components: {
            Head,
            Link,
            Sidebar,
            Navbar,
            Footer,
        },

        data() {
            return {
                showingNavigationDropdown: false,
            }
        },

        mounted () {
           
        },

        methods: {

        },
        computed: {
			...mapState(['sideBarOpen']),
            getMessage() {
                return this.$page.props.success?.message || ''
            },
        },
        beforeMount(){
            if(this.getMessage) {
                Toast.fire({
                    position: 'top-end',
                    icon: 'success',
                    toast: true,
                    title: this.getMessage
                });
            }
        },
    })
</script>