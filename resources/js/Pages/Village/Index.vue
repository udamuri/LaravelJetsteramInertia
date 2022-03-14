<template>
    <app-layout title="kelurahan">
		<template #header>
			<li class="flex items-center text-blue-500">
				<Link :href="route('dashboard')" class="text-gray-700" >Dashboard</Link>
				<svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
			</li>

			<li class="flex items-center text-blue-500">
				<Link :href="'#'" class="text-gray-700" >kelurahan</Link>
			</li>
        </template>
		
		<template #header_button>
			<Link :href="route('villages.create')"><jet-button class="bg-blue-500 hover:bg-indigo-400 text-white font-bold py-2 px-4 rounded">Tambah</jet-button></Link>
        </template>

        <div class="max-w-full mx-auto py-7">

            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <div class="container flex px-2 py-2">              
                                <div class="relative">
                                    <input type="text" class="h-10 w-96 pr-8 pl-5 rounded z-0 focus:shadow focus:outline-none" v-model="seachKey" placeholder="Cari..." @keyup.enter="quickSearch">
                                    <div v-if="seachKey" class="absolute top-2 right-9">
                                        <button @click="clearSearchBar">
                                             <i class="fas fa-times text-gray-400 z-20 hover:text-gray-500"></i>
                                        </button>
                                    </div>
                                    <div class="absolute top-2 right-3"> 
                                        <Link :href="route('villages.index', { 'search': seachKey } )">
                                          <i class="fas fa-search text-gray-400 z-20 hover:text-gray-500"></i>
                                        </Link> 
                                    </div>
                                </div>
                            </div>

                            <table class="min-w-full divide-y divide-gray-200 w-full">
                                <thead>
                                <tr>
                                    <th scope="col" width="50" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelurahan</th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kecamatan</th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kota</th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Updated At</th>
                                    <th scope="col" width="50" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="(item, index) in datas.data" :key="item.id">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ (index + 1) + (start)}}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ item.kelurahan }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ item.kecamatan }}</td>
										<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ item.kota }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ item.formattedCreatedAt }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ item.formattedUpdatedAt }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <Link :href="route('villages.edit', item.id)" type="button"><jet-button class="bg-coolGray-500 ml-4 hover:bg-coolGray-400">Edit</jet-button></Link>
                                            &nbsp;<jet-danger-button @click="confirmModelDeletion(item.id)">Delete </jet-danger-button></td>
                                    </tr>
                                </tbody>
                            </table>
                            <pagination :links="datas.links"></pagination> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import JetButton from "@/Jetstream/Button";
    import JetInput from "@/Jetstream/Input";
    import Pagination from '@/Components/Pagination'
    import { Link } from '@inertiajs/inertia-vue3';
    import JetFormSection from '@/Jetstream/FormSection.vue'
    import JetDialogModal from '@/Jetstream/DialogModal.vue'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'
    import JetDangerButton from '@/Jetstream/DangerButton.vue'
    import ActionMessage from '@/Jetstream/ActionMessage.vue'

    export default defineComponent({
        components: {
          AppLayout,
          JetButton,
          JetInput,
          Pagination,
          Link,
          JetFormSection,
          JetDialogModal, 
          JetDangerButton, 
          JetSecondaryButton, 
          ActionMessage,
        },

        props: [
          'datas',
          'filtersDatas',
          'start',
        ],

        data(){
            return{
                confirmingUserDeletion: false,
                itemId : null,
                start : this.start,
                seachKey : route().params.search ? route().params.search : null,
                form: this.$inertia.form({
                    _method : 'DELETE',
                })
            }
        },
        methods:{
            quickSearch(){                
                this.$inertia.get(route('villages.index', { 'search': this.seachKey } ),{})
            },
            clearSearchBar(){
                if(route().params.search){
                    this.$inertia.get(route('villages.index'),{})
                }else{
                    this.seachKey = null
                }
            },
            confirmModelDeletion(id) {
                this.itemId = id
                this.confirmingUserDeletion = true

				SweetConfirm.fire({
					title: "Yakin ingin menghapus?",
					text: "Apa kamu yakin? Anda tidak akan dapat mengembalikan data ini!",
					showCancelButton: true,
					showConfirmButton: true,
					confirmButtonColor: "#3085d6",
					confirmButtonText: "Ya, Hapus!"
				}).then((result) => { // <--
					if(result?.isConfirmed) {
						console.log("deleted");
						this.form.delete(route('villages.destroy', this.itemId), {
                     		onSuccess: () => this.quickSearch(),
                 		})
					}
				})
            },
        }

    })
</script>
