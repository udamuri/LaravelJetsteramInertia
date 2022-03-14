<template>
    <app-layout title="Edit Kelurahan">

    <template #header>
        <li class="flex items-center text-blue-500">
				<Link :href="route('dashboard')" class="text-gray-700" >Dashboard</Link>
				<svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
			</li>

			<li class="flex items-center text-blue-500">
				<Link :href="route('villages.index')" class="text-gray-700" >Kelurahan</Link>
				<svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
			</li>

			<li class="flex items-center text-blue-500">
				<Link :href="'#'" class="text-gray-700" >Edit</Link>
			</li>
    </template>

    <div>
        <div class="max-w-full mx-auto py-10 ">
            <jet-form @submitted="updateModel">
                    <template #form>
                        <!-- Name -->
                        <div class="col-span-12 sm:col-span-6">
							<jet-label for="kelurahan" value="Kelurahan" />
							<jet-input id="kelurahan" type="text" class="mt-1 block w-full" v-model="form.kelurahan" autocomplete="kelurahan" />
							<jet-input-error :message="form.errors.kelurahan" class="mt-2" />
						</div>

						<div class="col-span-12 sm:col-span-6">
							<jet-label for="kecamatan" value="Kecamatan" />
							<jet-input id="kecamatan" type="text" class="mt-1 block w-full" v-model="form.kecamatan" autocomplete="kecamatan" />
							<jet-input-error :message="form.errors.kecamatan" class="mt-2" />
						</div>

						<div class="col-span-12 sm:col-span-6">
							<jet-label for="kota" value="Kota" />
							<jet-input id="kota" type="text" class="mt-1 block w-full" v-model="form.kota" autocomplete="kota" />
							<jet-input-error :message="form.errors.kota" class="mt-2" />
						</div>
                    </template>

                    <template #actions>
                        <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Save
                        </jet-button>
                    </template>
            </jet-form>
        </div>
    </div>
    </app-layout>
</template>
<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import JetForm from '@/Jetstream/Form.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetDangerButton from '@/Jetstream/DangerButton.vue'
    import JetInputError from '@/Jetstream/InputError.vue'
    import JetSelect from '@/Jetstream/Select.vue'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'

    export default defineComponent({
        components: {
            AppLayout, JetForm, JetInput, JetLabel, Link, JetButton, JetInputError, JetSelect, JetDangerButton, JetSecondaryButton
        },
        props: ['data'],

        data() {
            return {
                itemId :  this.data.id,
				url : this.data.imageUrl,
                is_active: [{name: 'Active', value: 1}, {name: 'InActive', value: 0}],
                form: this.$inertia.form({
                    _method: "PUT",
					kelurahan: this.data.kelurahan,
                    kecamatan: this.data.kecamatan,
                    kota: this.data.kota,
                })
            }
        },
        methods: {
            updateModel() {
                this.form.post(route('villages.update', this.itemId), {
                    errorBag: 'updateModel',
                    preserveScroll: true,
                    onSuccess: page => {
                        //console.log(page)
                    },
                });
            },
        },
		mounted() {
            //console.log(this.data)
        }
        
    })
</script>
