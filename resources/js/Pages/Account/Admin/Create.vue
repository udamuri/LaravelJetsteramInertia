<template>
    <app-layout title="Create Admin">

        <template #header>
			<li class="flex items-center text-blue-500">
				<Link :href="route('dashboard')" class="text-gray-700" >Dashboard</Link>
				<svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
			</li>

			<li class="flex items-center text-blue-500">
				<Link :href="route('admins.index')" class="text-gray-700" >Admins</Link>
				<svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
			</li>

			<li class="flex items-center text-blue-500">
				<Link :href="'#'" class="text-gray-700" >Tambah</Link>
			</li>
        </template>

        <div>
            <div class="max-w-full mx-auto py-10">
                <jet-form @submitted="createUser">
                        <template #form>
                            <!-- Name -->
                            <div class="col-span-12 sm:col-span-6">
                                <jet-label for="name" value="Name" />
                                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="name" />
                                <jet-input-error :message="form.errors.name" class="mt-2" />
                                <div v-if="errors.name">{{ errors.name }}</div>
                                <div v-if="success_message">{{ success_message }}</div>
                            </div>
                            
                            <div class="col-span-12 sm:col-span-6">
                                <jet-label for="email" value="Email" />
                                <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" />
                                <jet-input-error :message="form.errors.email" class="mt-2" />
                            </div>
                            
                            <div class="col-span-12 sm:col-span-6">
                                <jet-label for="role" value="Role" />
                                <jet-select type="text" class="mt-1 block w-full" v-model="form.role" :options="role" />
                                <jet-input-error :message="form.errors.role" class="mt-2" />
                            </div>
                            
                            <div class="col-span-12 sm:col-span-6">
                                <jet-label for="password" value="Password" />
                                <jet-input id="password" type="text" class="mt-1 block w-full" v-model="form.password" />
                                <jet-input-error :message="form.errors.password" class="mt-2" />
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
    import JetDangerButton from '@/Jetstream/DangerButton.vue'
    import JetInputError from '@/Jetstream/InputError.vue'
    // import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'

    export default defineComponent({
        components: {
            AppLayout, JetForm, JetInput, JetLabel, Link, JetButton, JetInputError, JetSelect, JetDangerButton
        },
        props: {
            success_message: String,
            errors: Object,
        },
        data() {
            return {
                role: [{name: '==Select==', value: ''}, {name: 'Operator', value: 'operator'}, {name: 'Admin', value: 'super-admin'}],
                form: this.$inertia.form({
                    _method: "POST",
                    name: null,
                    email: null,
                    password: null,
                    role: 'operator',
                })
            }
        },
        methods: {
            createUser() {
                this.form.post(route('admins.store'), {
                    errorBag: 'createUser',
                    preserveScroll: true,
                    onSuccess: page => {
                        //console.log(page)
                    },
                });
            },
        }
    })
</script>
