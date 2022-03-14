<template>
    <app-layout title="Tambah">

        <template #header>
			<li class="flex items-center text-blue-500">
				<Link :href="route('dashboard')" class="text-gray-700" >Dashboard</Link>
				<svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
			</li>

			<li class="flex items-center text-blue-500">
				<Link :href="route('patients.index')" class="text-gray-700" >Pasien</Link>
				<svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
			</li>

			<li class="flex items-center text-blue-500">
				<Link :href="'#'" class="text-gray-700" >Tambah</Link>
			</li>
        </template>

        <div>
            <div class="max-w-full mx-auto py-10">
                <jet-form @submitted="createModel">
                        <template #form>
                            <!-- Name -->
							<div class="col-span-12 sm:col-span-6">
								<jet-label for="name" value="Nama Pasien" />
								<jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="name" />
								<jet-input-error :message="form.errors.name" class="mt-2" />
							</div>

							<div class="col-span-12 sm:col-span-6">
                                <jet-label for="address" value="Alamat" />
                                <jet-textarea id="address" class="mt-1 block w-full" v-model="form.address" />
                                <jet-input-error :message="form.errors.address" class="mt-2" />
                            </div>

							<div class="col-span-12 sm:col-span-6">
								<jet-label for="rtrw" value="RT/RW" />
								<jet-input id="rtrw" type="text" class="mt-1 block w-full" v-model="form.rtrw" />
								<jet-input-error :message="form.errors.rtrw" class="mt-2" />
							</div>

							<div class="col-span-12 sm:col-span-6">
                                <jet-label for="village_id" value="Kelurahan" />
                                <com-select class="mt-1 block w-full" 
									v-model="form.village_id" 
									:options="villages"
								/>
                                <jet-input-error :message="form.errors.village_id" class="mt-2" />
                            </div>
							
							<div class="col-span-12 sm:col-span-6">
								<jet-label for="phone" value="No. Telepon" />
								<jet-input id="phone" type="text" class="mt-1 block w-full" v-model="form.phone" />
								<jet-input-error :message="form.errors.phone" class="mt-2" />
							</div>
							
							<div class="col-span-12 sm:col-span-6">
								<jet-label for="birth_date" value="Tanggal Lahir" />
								<jet-input id="birth_date" type="text" class="mt-1 block w-full" v-model="form.birth_date" />
								<jet-input-error :message="form.errors.birth_date" class="mt-2" />
							</div>

							<div class="col-span-12 sm:col-span-6">
                                <jet-label for="gender" value="Jenis Kelamin" />
                                <com-select class="mt-1 block w-full" 
									v-model="form.gender" 
									:options="genders"
								/>
                                <jet-input-error :message="form.errors.gender" class="mt-2" />
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
    import JetSelect from '@/Jetstream/Select.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetButton from '@/Jetstream/Button.vue'
	import JetTextarea from "@/Jetstream/Textarea";
    import JetDangerButton from '@/Jetstream/DangerButton.vue'
    import JetInputError from '@/Jetstream/InputError.vue'
	import ComSelect from '@/Components/Select.vue'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'

    export default defineComponent({
        components: {
            AppLayout, JetForm, JetInput, JetLabel, Link, JetButton, JetInputError, 
			JetSelect, JetDangerButton, JetSecondaryButton, ComSelect, JetTextarea
        },
        props: {
            success_message: String,
            errors: Object,
            genders: Object,
            villages: Object,
        },
        data() {
            return {
                is_active: [{name: 'Active', value: 1}, {name: 'InActive', value: 0}],
				url: null,
                form: this.$inertia.form({
                    _method: "POST",
                    name: null,
                    address: null,
                    rtrw: null,
                    birth_date: null,
                    gender: null,
                    phone: null,
                    village_id: null,
                })
            }
        },
        methods: {
            createModel() {
				if (this.$refs.photo) {
                    this.form.slide = this.$refs.photo.files[0]
                }

                this.form.post(route('patients.store'), {
                    errorBag: 'createModel',
                    preserveScroll: true,
                    onSuccess: page => {
                        //console.log(page)
                    },
                });
            },
        },

        
    })
</script>
